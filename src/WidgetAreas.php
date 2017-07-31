<?php
/**
 * This file contains elements for widget areas in WordPress
 *
 * @package   Gamajo\ThemeToolkit
 * @author    Gary Jones
 * @copyright Gamajo
 * @license   MIT
 */

declare(strict_types=1);

namespace Gamajo\ThemeToolkit;

/**
 * Register or unregister widget areas for a Genesis child theme.
 *
 * The difference between this class and the parent Gamajo\ThemeToolkit\WidgetAreas
 * is that registration is passed through a Genesis function so the new widget area
 * markup is consistent with existing Genesis widget areas.
 *
 * Example config:
 *
 * ```
 * $gamajo_widget_areas = [
 *     WidgetAreas::UNREGISTER => [
 *         'sidebar-alt,
 *     ],
 *     WidgetAreas::REGISTER => [
 *         [
 *             'id'          => 'foobar-footer',
 *             'name'        => __( 'Footer', 'your-text-domain' ),
 *             'description' => __( 'Suggestion: Add footer menu', 'your-text-domain' ),
 *         ],
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
 *             ThemeToolkit::WIDGETAREAS => $gamajo_genesis_widget_areas,
 *         ],
 *     ],
 * ];
 * ```
 *
 * @package Gamajo\ThemeToolkit
 */
class WidgetAreas extends Brick
{
    const REGISTER   = 'register';
    const UNREGISTER = 'unregister';

    /**
     * Apply widget area registrations and unregistrations.
     */
    public function apply()
    {
        if ($this->config->hasKey(self::REGISTER)) {
            $registerConfig = $this->config->getSubConfig(self::REGISTER);
            $this->register($registerConfig->getArrayCopy());
        }

        if ($this->config->hasKey(self::UNREGISTER)) {
            $unregisterConfig = $this->config->getSubConfig(self::UNREGISTER);
            $this->unregister($unregisterConfig->getArrayCopy());
        }
    }

    /**
     * Register widget areas.
     *
     * @param array $widget_areas Arguments for widget areas to be registered.
     */
    public function register(array $widget_areas)
    {
        array_walk($widget_areas, function (array $widget_area) {
            \register_sidebar($widget_area);
        });
    }

    /**
     * Unregister widget areas.
     *
     * @param array $widget_areas List of widget area names to unregister.
     */
    public function unregister(array $widget_areas)
    {
        array_walk($widget_areas, function (string $widget_area) {
            \unregister_sidebar($widget_area);
        });
    }
}
