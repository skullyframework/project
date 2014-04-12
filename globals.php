<?php


/**
 * Global shortcut functions. The app should not be dependent on this.
 */


function isHttps() {
	return ((!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') || (!empty($_SERVER['SERVER_PORT']) && $_SERVER['SERVER_PORT'] == 443));
}

/**
 * A convenience method to initialize logger. Useful for logging vendor code.
 * For app code it is recommended to use $this->app->getLogger()
 * @return \Skully\Logging\Logger
 */
function getLogger() {
    $logger = new \Skully\Logging\Logger(BASE_PATH);
    return $logger;
}