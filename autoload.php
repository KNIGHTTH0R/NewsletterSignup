<?php
/**
 * Created by PhpStorm.
 * User: joakimcarlsten
 * Date: 19/09/16
 * Time: 10:07
 */


spl_autoload_register('vinniaAutoloadFunction');

function vinniaAutoloadFunction( $className )
{

    if ( false !== strpos( $className, 'NewsletterSignup' ) ) {
        $classes_dir = realpath( plugin_dir_path( __FILE__ ) ) . DIRECTORY_SEPARATOR . 'src' . DIRECTORY_SEPARATOR;
        $class_file = str_replace('\\', DIRECTORY_SEPARATOR, $className ) . '.php';
        $class_file = str_replace('NewsletterSignup'.DIRECTORY_SEPARATOR, '', $class_file);
        require_once $classes_dir . $class_file;
    }
}