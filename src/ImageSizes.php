<?php
/**
 * This file contains elements for image sizes in WordPress
 *
 * @package   Gamajo\ThemeTookit
 * @author    Gary Jones
 * @copyright Gamajo
 * @license   MIT
 */

declare(strict_types=1);

namespace Gamajo\ThemeToolkit;

/**
 * Add and remove image sizes.
 *
 * Example config:
 *
 * ```
 * $gamajo_image_sizes = [
 *     ImageSizes::ADD => [
 *         'article-grid'   => [ 480, 320, true ],
 *         'article-header' => [ 1200, 400, true ],
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
 *             ThemeToolkit::IMAGESIZES => $gamajo_image_sizes,
 *         ],
 *     ],
 * ];
 * ```
 *
 * @package Gamajo\ThemeTookit
 */
class ImageSizes extends Brick
{
    const ADD    = 'add';
    const REMOVE = 'remove';

    /**
     * Apply image size customizations.
     */
    public function apply()
    {
        if ($this->config->hasKey(self::REMOVE)) {
            $this->remove($this->config->getSubConfig(self::REMOVE)->getArrayCopy());
        }

        if ($this->config->hasKey(self::ADD)) {
            $this->add($this->config->getSubConfig(self::ADD)->getArrayCopy());
        }
    }

    /**
     * Add image sizes for given keys and values.
     *
     * @param array $image_size_item Keys and their values.
     */
    protected function add(array $image_size_item)
    {
        array_walk($image_size_item, function (array $args, string $name) {
            add_image_size($name, $args[0], $args[1], isset($args[2]) ? $args[2] : false);
        });
    }

    /**
     * Remove image size for given keys.
     *
     * @param array $image_size_item Keys.
     */
    protected function remove(array $image_size_item)
    {
        array_walk($image_size_item, function (string $name) {
            remove_image_size($name);
        });
    }
}
