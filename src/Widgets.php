<?php
/**
 * This file contains elements for widgets in WordPress
 *
 * @package   Gamajo\ThemeTookit
 * @author    Gary Jones
 * @copyright Gamajo
 * @license   MIT
 */

declare(strict_types=1);

namespace Gamajo\ThemeToolkit;

/**
 * Register and unregister widgets classes.
 *
 * Example config:
 *
 * ```
 * $gamajo_widgets = [
 *     Widgets::UNREGISTER => [
 *         \WP_Widget_Search::class,
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
 *             ThemeToolkit::WIDGETS => $gamajo_widgets,
 *         ],
 *     ],
 * ];
 * ```
 *
 * @package Gamajo\ThemeToolkit
 */
class Widgets extends Brick
{
    const REGISTER   = 'register';
    const UNREGISTER = 'unregister';

    /**
     * Apply widget registrations and unregistrations.
     */
    public function apply()
    {
        if ($this->config->hasKey(self::UNREGISTER)) {
            add_action('widgets_init', [$this, 'unregister'], 15);
        }

        if ($this->config->hasKey(self::REGISTER)) {
            add_action('widgets_init', [$this, 'register'], 15);
        }
    }

    /**
     * Register widgets.
     */
    public function register()
    {
        array_map('register_widget', $this->config->getSubConfig(self::REGISTER)->getArrayCopy());
    }

    /**
     * Unregister widgets.
     */
    public function unregister()
    {
        array_map('unregister_widget', $this->config->getSubConfig(self::UNREGISTER)->getArrayCopy());
    }
}
