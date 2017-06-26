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
 * Unregister page templates.
 *
 * Example config:
 *
 * ```
 * $gamajo_templates = [
 *     Templates::UNREGISTER => [
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
    const UNREGISTER = 'unregister';

    /**
     * Apply template unregistrations.
     */
    public function apply()
    {
        if ($this->config->hasKey(static::UNREGISTER)) {
            add_filter('theme_page_templates', [$this, 'unregister']);
        }
    }

    /**
     * Unregister page templates for given keys.
     *
     * @param array $image_size_item Keys.
     */
    public function unregister(array $page_templates)
    {
        return array_diff_key($page_templates, array_flip($this->config->getSubConfig(static::UNSET)->getArrayCopy()));
    }
}
