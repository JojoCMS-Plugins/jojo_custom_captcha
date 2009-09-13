<?php
/**
 *                    Jojo CMS
 *                ================
 *
 * Copyright 2008 Harvey Kane <code@ragepank.com>
 * Copyright 2008 Michael Holt <code@gardyneholt.co.nz>
 *
 * See the enclosed file license.txt for license information (LGPL). If you
 * did not receive this file, see http://www.fsf.org/copyleft/lgpl.html.
 *
 * @author  Harvey Kane <code@ragepank.com>
 * @license http://www.fsf.org/copyleft/lgpl.html GNU Lesser General Public License
 * @link    http://www.jojocms.org JojoCMS
 */

class Jojo_Plugin_Jojo_custom_captcha extends Jojo_Plugin
{
    /* change the background image of the CAPTCHA */
    static function captcha_background($original)
    {
        /* the location of the custom background */
        $filename = 'images/custom-captcha.jpg';
        
        /* scan plugins to ensure the file exists, and return an absolute path */
        foreach (Jojo::listPlugins($filename) as $pluginfile) {
            /* file exists, pass to CAPTCHA script */
            return $pluginfile;
        }
        
        /* if the specified file can't be found, use the original */
        return $original;
    }
    
    /* add additional fonts to the CAPTCHA */
    static function captcha_fonts($fonts)
    {
        /* ensure the input is good */
        if (!is_array($fonts)) $fonts = array();
        
        /* optionally, you may want to clear the existing default fonts - uncomment the line below */
        $fonts = array();
        
        /* define your new fonts here. These fonts must be ttf files, and the path relative to the root of the plugin */
        $newfonts = array(
                         'external/Gentium102/GenAI102.TTF',
                         'external/Gentium102/GenAR102.TTF',
                         'external/Gentium102/GenI102.TTF',
                         'external/Gentium102/GenR102.TTF'
                         );
                         
        /* scan plugins to ensure the files exist */
        foreach ($newfonts as $font) {
            foreach (Jojo::listPlugins($font) as $pluginfile) {
                $fonts[] = $pluginfile;
                break;
            }
        }
        
        /* pass the font array back to the CAPTCHA script (regardless of whether it's changed or not) */
        return $fonts;
    }

}