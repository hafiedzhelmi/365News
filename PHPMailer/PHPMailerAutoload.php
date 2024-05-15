<?php
/**
 * PHPMailer SPL autoloader.
 * PHP Version 5.0.0
 * @package PHPMailer
 */

if (version_compare(PHP_VERSION, '5.1.2', '>=')) {
    if (version_compare(PHP_VERSION, '5.3.0', '>=')) {
        spl_autoload_register(function ($classname) {
            $filename = dirname(__FILE__) . '/class.' . strtolower($classname) . '.php';
            if (is_readable($filename)) {
                require $filename;
            }
        }, true, true);
    } else {
        function PHPMailerAutoload($classname)
        {
            $filename = dirname(__FILE__) . '/class.' . strtolower($classname) . '.php';
            if (is_readable($filename)) {
                require $filename;
            }
        }
        spl_autoload_register('PHPMailerAutoload');
    }
} else {
    function PHPMailerAutoload($classname)
    {
        $filename = dirname(__FILE__) . '/class.' . strtolower($classname) . '.php';
        if (is_readable($filename)) {
            require $filename;
        }
    }
    if (function_exists('__autoload')) {
        spl_autoload_register('__autoload');
    }
    spl_autoload_register('PHPMailerAutoload');
}
