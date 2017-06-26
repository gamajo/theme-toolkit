<?php
/**
 * This file contains class name definitions for bricks in the ThemeToolkit
 *
 * @package   Gamajo\ThemeTookit
 * @author    Gary Jones
 * @copyright Gamajo
 * @license   MIT
 */

declare(strict_types=1);

namespace Gamajo\ThemeToolkit;

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
 * @package Gamajo\ThemeTookit
 */
class ThemeToolkit
{
    const GOOGLEFONTS = 'GoogleFonts';
    const IMAGESIZES = 'ImageSizes';
    const TEMPLATES = 'Templates';
    const THEMESUPPORT = 'ThemeSupport';
    const WIDGETAREAS = 'WidgetAreas';
    const WIDGETS = 'Widgets';
}
