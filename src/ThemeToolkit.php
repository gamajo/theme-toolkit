<?php
/**
 * This file contains class name definitions for bricks in the ThemeToolkit
 *
 * @package   Gamajo\ThemeToolkit
 * @author    Gary Jones
 * @copyright Gamajo
 * @license   MIT
 */

declare(strict_types=1);

namespace Gamajo\ThemeToolkit;

use BrightNucleus\Config\ConfigInterface;

/**
 * Define the brick class names for ThemeToolkit
 *
 * These are used at the end of the config file e.g.:
 *
 * ```
 * return [
 *     'Gamajo' => [
 *         'Theme' => [
 *             ThemeToolkit::GOOGLEFONTS => $gamajo_google_fonts,
 *             ThemeToolkit::IMAGESIZES  => $gamajo_image_sizes,
 *             ThemeToolkit::WIDGETS     => $gamajo_widgets,
 *         ],
 *     ],
 * ];
 * ```
 *
 * @package Gamajo\ThemeToolkit
 */
class ThemeToolkit
{
    const DEPENDENCIES = 'Dependencies';
    const GOOGLEFONTS = 'GoogleFonts';
    const IMAGESIZES = 'ImageSizes';
    const TEMPLATES = 'Templates';
    const THEMESUPPORT = 'ThemeSupport';
    const WIDGETAREAS = 'WidgetAreas';
    const WIDGETS = 'Widgets';
    const MENUS = 'Menus';

    /**
     * For a given list of bricks, instantiate each brick, pass in the right part of the
     * config, and call the apply() method.
     *
     * This would be applied to an array of brick FQCNs as:
     *
     * ```
     * ThemeToolkit::applyBricks($config, ...$bricks);
     * ```
     *
     * @param ConfigInterface $config  Configuration for the brick class.
     * @param \string[]       $classes Fully qualified class name of brick classes.
     */
    public static function applyBricks(ConfigInterface $config, string...$classes)
    {
        array_walk($classes, function ($brick) use ($config) {
            $splitClassName = explode('\\', $brick);
            $baseClassName  = array_pop($splitClassName);
            if ($config->hasKey($baseClassName)) {
                $brick_object = new $brick($config->getSubConfig($baseClassName));
                $brick_object->apply();
            }
        });
    }
}
