sass_path = File.join(File.dirname(__FILE__))

css_path = File.join(File.dirname(__FILE__), "../", "css")

# output_style: The output style for your compiled CSS
# nested, expanded, compact, compressed
# More information can be found here http://sass-lang.com/docs/yardoc/file.SASS_REFERENCE.html#output_style
output_style = :compact

load File.join(sass_path)

# converts image-url("image.png") to url("../images/image.png")
images_dir = "../images"
relative_assets = true