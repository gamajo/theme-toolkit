<?php
/**
 * This file contains elements for templates in WordPress
 *
 * @package   Gamajo\ThemeTookit
 * @author    Gary Jones
 * @copyright Gamajo
 * @license   MIT
 */

declare(strict_types=1);

namespace Gamajo\ThemeToolkit;

/**
 * Unset page templates.
 *
 * Example config:
 *
 * ```
 * $gamajo_templates = [
 *     Templates::UNSET => [
 *         'page_blog.php',
 *     ],
 * ];
 * ```
 *
 * And then:
 *
 * ```
 * return [
 *     'Gamajo' => [
 *         'Theme' => [
 *             ThemeToolkit::TEMPLATES => $gamajo_templates,
 *         ],
 *     ],
 * ];
 * ```
 *
 * @package Gamajo\ThemeTookit
 */
class Templates extends Brick
{
    const UNSET = 'unset';

    /**
     * Apply image size customizations.
     */
    public function apply()
    {
        if ($this->config->hasKey(static::UNSET)) {
            add_filter('theme_page_templates', [$this, 'unset']);
        }
    }

    /**
     * Unset page templates for given keys.
     *
     * @param array $image_size_item Keys.
     */
    public function unset(array $page_templates)
    {
        return array_diff_key($page_templates, array_flip($this->config->getSubConfig(static::UNSET)->getArrayCopy()));
    }
}
