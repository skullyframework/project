<?php
/**
 * function by Wes Edling .. http://joedesigns.com
 * feel free to use this in any project, i just ask for a credit in the source code.
 * a link back to my site would be nice too.
 *
 *
 * Changes:
 * 2012/01/30 - David Goodwin - call escapeshellarg on parameters going into the shell
 * 2012/07/12 - Whizzkid - Added support for encoded image urls and images on ssl secured servers [https://]
 * 2014/02/04 - Jay - Added some options.
 */

/**
 * SECURITY:
 * It's a bad idea to allow user supplied data to become the path for the image you wish to retrieve, as this allows them
 * to download nearly anything to your server. If you must do this, it's strongly advised that you put a .htaccess file
 * in the cache directory containing something like the following :
 * <code>php_flag engine off</code>
 * to at least stop arbitrary code execution. You can deal with any copyright infringement issues yourself :)
 */

class ImageProcessor {
    /**
     * @param string $imagePath - either a local absolute/relative path, or a remote URL (e.g. http://...flickr.com/.../ ). See SECURITY note above.
     * @param array $opts  (curl(boolean), maxCurlSize(int in Mbytes), w(pixels), h(pixels), crop(boolean), scale(boolean), thumbnail(boolean), maxOnly(boolean), canvas-color(#abcabc), output-filename(string), cache_http_minutes(int))
     * @return string new URL for resized image.
     * opts: string cacheFolder
     *       boolean noImagick
     *       string remoteFolder
     */
    public static function resize($imagePath,$opts=null){
        $imagePath = urldecode($imagePath);
        # start configuration
        $cacheFolder = $opts['cacheFolder']; # path to your cache folder, must be writeable by web server

        if (empty($opts['remoteFolder'])) {
            $remoteFolder = $cacheFolder.'remote/'; # path to the folder you wish to download remote images into
        }

        $defaults = array('curl' => false, 'crop' => false, 'scale' => true, 'thumbnail' => false, 'maxOnly' => false,
            'canvas-color' => '#FFFFFF', 'output-filename' => false,
            'cacheFolder' => $cacheFolder, 'remoteFolder' => $remoteFolder, 'quality' => 90, 'cache_http_minutes' => 20);

        $opts = array_merge($defaults, $opts);

        $path_to_convert = 'convert'; # this could be something like /usr/bin/convert or /opt/local/share/bin/convert

        ## you shouldn't need to configure anything else beyond this point

        $purl = parse_url($imagePath);
        $finfo = pathinfo($imagePath);
        if (empty($info['basename'])){
            $ext = '';
        }
        else {
            $ext = $finfo['extension'];
        }

        //if not using imagic, run the following code and return the new path immediately
        if($opts['noImagick']){
            if(file_exists($imagePath) == false):
                $imagePath = $_SERVER['DOCUMENT_ROOT'].$imagePath;
                if(file_exists($imagePath) == false):
                    return 'image not found';
                endif;
            endif;

            $filename = md5_file($imagePath);

            // If the user has requested an explicit output-filename, do not use the cache directory.
            if(false !== $opts['output-filename']) :
                $newPath = $opts['output-filename'];
            else:
                $newPath = $cacheFolder.$filename.$ext;
            endif;

            if(move_uploaded_file($imagePath, $newPath)){
                return str_replace($_SERVER['DOCUMENT_ROOT'],'',$newPath);
            }
            else{
                error_log("Unable to move the uploaded file. Please check your folder permission.");
                return false;
            }
        }

        # check for remote image..
        if(isset($purl['scheme']) && ($purl['scheme'] == 'http' || $purl['scheme'] == 'https')):
            # grab the image, and cache it so we have something to work with..
            list($filename) = explode('?',$finfo['basename']);
            $local_filepath = $remoteFolder.$filename;
            $download_image = true;
            if(file_exists($local_filepath)):
                if(filemtime($local_filepath) < strtotime('+'.$opts['cache_http_minutes'].' minutes')):
                    $download_image = false;
                endif;
            endif;
            if($download_image == true):

                try {
                    if ($opts['curl'] == true) {
                        if (!empty($opts['maxCurlSize'])) {
                            if (ImageProcessor::grabSize($imagePath) <= ($opts['maxCurlSize']*1024*1024)) {
                                ImageProcessor::grabImage($imagePath, $local_filepath);
                            }
                            else {
                                return "image too large";
                            }
                        }
                        else {
                            ImageProcessor::grabImage($imagePath, $local_filepath);
                        }
                    }
                    $img = @file_get_contents($imagePath);
                    if (empty($img)) {
                        return "invalid image pathname";
                    }
                    else {
                        file_put_contents($local_filepath,$img);
                    }
                } catch (\Exception $e) {
                    error_log("ERROR: While doing image resize, got this error: ".$e->getMessage());
                }
            endif;
            $imagePath = $local_filepath;
        endif;

        if(file_exists($imagePath) == false):
            $imagePath = $_SERVER['DOCUMENT_ROOT'].$imagePath;
            if(file_exists($imagePath) == false):
                return 'image not found';
            endif;
        endif;

        $w = 0;

        if(isset($opts['w'])): $w = $opts['w']; endif;
        if(isset($opts['h'])): $h = $opts['h']; endif;

        $filename = md5_file($imagePath);

        // If the user has requested an explicit output-filename, do not use the cache directory.
        if(false !== $opts['output-filename']) :
            $newPath = $opts['output-filename'];
        else:
            if(!empty($w) and !empty($h)):
                $newPath = $cacheFolder.$filename.'_w'.$w.'_h'.$h.(isset($opts['crop']) && $opts['crop'] == true ? "_cp" : "").(isset($opts['scale']) && $opts['scale'] == true ? "_sc" : "").'.'.$ext;
            elseif(!empty($w)):
                $newPath = $cacheFolder.$filename.'_w'.$w.'.'.$ext;
            elseif(!empty($h)):
                $newPath = $cacheFolder.$filename.'_h'.$h.'.'.$ext;
            else:
                return false;
            endif;
        endif;

        $create = true;

        if(file_exists($newPath) == true):
            $create = false;
            $origFileTime = date("YmdHis",filemtime($imagePath));
            $newFileTime = date("YmdHis",filemtime($newPath));
            if($newFileTime < $origFileTime): # Not using $opts['expire-time'] ??
                $create = true;
            endif;
        endif;

        if($create == true):
            if(!empty($w) and !empty($h)):

                list($width,$height) = getimagesize($imagePath);

                if($width > $height):
                    $resize = $w;
                    if(true === $opts['crop']):
                        $resize = "x".$h;
                    endif;
                else:
                    $resize = "x".$h;
                    if(true === $opts['crop']):
                        $resize = $w;
                    endif;
                endif;

                if(true === $opts['scale']):
                    $resize = $w."x".$h;
                    $cmd = $path_to_convert ." ". escapeshellarg($imagePath) ." -resize ". escapeshellarg($resize) .
                        (true === $opts['crop'] ? "^ -gravity center -extent " . escapeshellarg($resize) : "").
                        " -quality ". escapeshellarg($opts['quality']) . " " . escapeshellarg($newPath);
                else:
                    $cmd = $path_to_convert." ". escapeshellarg($imagePath) ." -resize ". escapeshellarg($resize) .
                        " -size ". escapeshellarg($w ."x". $h) .
                        " xc:". escapeshellarg($opts['canvas-color']) .
                        " +swap -gravity center -composite -quality ". escapeshellarg($opts['quality'])." ".escapeshellarg($newPath);
                endif;

            else:
                $cmd = $path_to_convert." " . escapeshellarg($imagePath) .
                    " -thumbnail ". (!empty($h) ? 'x':'') . $w ."".
                    (isset($opts['maxOnly']) && $opts['maxOnly'] == true ? "\>" : "") .
                    " -quality ". escapeshellarg($opts['quality']) ." ". escapeshellarg($newPath);
            endif;

            $c = exec($cmd, $output, $return_code);
            if($return_code == 127) {
                $path_to_convert = '/usr/local/bin/convert'; # this could be something like /usr/bin/convert or /opt/local/share/bin/convert
                $cmd = preg_replace('/convert/', $path_to_convert, $cmd, 1);
                $c = exec($cmd, $output, $return_code);
            }

            if($return_code != 0) {
                error_log("Tried to execute : $cmd, return code: $return_code, output: " . print_r($output, true));
                return false;
            }
        endif;

        # return cache file path
        return str_replace($_SERVER['DOCUMENT_ROOT'],'',$newPath);

    }

    public static function grabSize($remoteFile) {
        $ch = curl_init($remoteFile);
        curl_setopt($ch, CURLOPT_NOBODY, true);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HEADER, true);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true); //not necessary unless the file redirects (like the PHP example we're using here)
        $data = curl_exec($ch);
        curl_close($ch);
        if ($data === false) {
            echo 'cURL failed';
            exit;
        }

        $contentLength = 'unknown';
        $status = 'unknown';
        if (preg_match('/^HTTP\/1\.[01] (\d\d\d)/', $data, $matches)) {
            $status = (int)$matches[1];
        }
        if (preg_match('/Content-Length: (\d+)/', $data, $matches)) {
            $contentLength = (int)$matches[1];
        }
        return $contentLength;
    }

    public static function grabImage($url,$saveto){
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); //Set curl to return the data instead of printing it to the browser.
        curl_setopt($ch, CURLOPT_URL, $url);
        $raw=curl_exec($ch);
        curl_close ($ch);
        if(file_exists($saveto)){
            unlink($saveto);
        }
        $fp = fopen($saveto,'x');
        fwrite($fp, $raw);
        fclose($fp);
    }
}