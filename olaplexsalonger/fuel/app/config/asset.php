<?php
/**
 * Part of the Fuel framework.
 *
 * @package    Fuel
 * @version    1.0
 * @author     Fuel Development Team
 * @license    MIT License
 * @copyright  2010 - 2012 Fuel Development Team
 * @link       http://fuelphp.com
 */

/**
 * NOTICE:
 *
 * If you need to make modifications to the default configuration, copy
 * this file to your app/config folder, and make them in there.
 *
 * This will allow you to upgrade fuel without losing your custom config.
 */


return array(

    /**
     * An array of paths that will be searched for assets. Each path is a
     * RELATIVE path from the speficied url:
     *
     * array('assets/')
     *
     * These MUST include the trailing slash ('/')
     *
     * Paths specified here are suffixed with the sub-folder paths defined below.
     */
    'paths'   => array('assets/'),

    /**
     * Asset Sub-folders
     *
     * Names for the img, js and css folders (inside the asset search path).
     *
     * Examples:
     *
     * img/
     * js/
     * css/
     *
     * This MUST include the trailing slash ('/')
     */
    'img_dir' => 'img/',
    'js_dir'  => 'js/',
    'css_dir' => 'css/',

    /**
     * You can also specify one or more per asset-type folders. You don't have
     * to specify all of them.     * Each folder is a RELATIVE path from the url
     * speficied below:
     *
     * array('css' => 'assets/css/')
     *
     * These MUST include the trailing slash ('/')
     *
     * Paths specified here are expected to contain the assets they point to
     */
    'folders' => array(
        'stylesheets' => array(),
        'javascripts' => array(),
        'images'      => array(),
        'font'        => array(),
    ),

);
