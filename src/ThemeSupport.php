<?php
/**
 * This file contains elements for theme support in WordPress
 *
 * @package   Gamajo\ThemeToolkit
 * @author    Gary Jones
 * @copyright Gamajo
 * @license   MIT
 */

declare(strict_types=1);

namespace Gamajo\ThemeToolkit;

/**
 * Add and remove theme support items.
 *
 * Example config:
 *
 * ```
 * $gamajo_theme_support = [
 *     ThemeSupport::ADD => [
 *         'html5' => [
 *             'caption',
 *             'comment-form',
 *             'comment-list',
 *             'gallery',
 *             'search-form',
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
 *             ThemeToolkit::THEMESUPPORT => $gamajo_theme_support,
 *         ],
 *     ],
 * ];
 * ```
 *
 * @package Gamajo\ThemeToolkit
 */
class ThemeSupport extends Brick
{
    const ADD    = 'add';
    const REMOVE = 'remove';

    /**
     * Apply theme support items.
     */
    public function apply()
    {
        if ($this->config->hasKey(self::REMOVE)) {
            $removeConfig = $this->config->getSubConfig(self::REMOVE);
            $this->remove($removeConfig->getArrayCopy());
        }

        if ($this->config->hasKey(self::ADD)) {
            $addConfig = $this->config->getSubConfig(self::ADD);
            $this->add($addConfig->getArrayCopy());
        }
    }

    /**
     * Add theme support for given keys and values.
     *
     * @param array $items Keys and their values.
     */
    protected function add(array $items)
    {
        array_walk($items, function ($value, string $key) {
            add_theme_support($key, $value);
        });
    }

    /**
     * Remove theme support for given keys.
     *
     * @param array $items Keys.
     */
    protected function remove(array $items)
    {
        array_walk($items, function (string $value) {
            remove_theme_support($value);
        });
    }
}
