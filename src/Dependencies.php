<?php
/**
 * This file contains elements for dependency management.
 *
 * @package   Gamajo\ThemeTookit
 * @author    Gary Jones
 * @copyright Gamajo
 * @license   MIT
 */

declare( strict_types=1 );

namespace Gamajo\ThemeToolkit;

use BrightNucleus\Dependency\DependencyManager;

/**
 * Manage script and style dependencies.
 *
 * This brick makes use of the `brightnucleus/dependencies` library allowing you to
 * define script and style dependencies through a config file. The dependencies
 * defined in this way will then get registered and enqueued automatically.
 *
 * Example config:
 *
 * ```
 * $gamajo_dependencies_config = [
 *      'scripts' => [
 *          [
 *              'handle'    => 'example-script-handle',
 *              'src'       => get_stylesheet_directory_uri() . '/js/example-script.js',
 *              'deps'      => [ 'jquery' ],
 *              'ver'       => '1.2.1',
 *              'in_footer' => true,
 *              'localize'  => [
 *                  'name' => 'ExampleData',
 *                  'data' => function( $context ) {
 *                      return [
 *                          'ajaxurl' => admin_url( 'admin-ajax.php' ),
 *                          'context' => $context,
 *                      ];
 *                  },
 *              ],
 *          ],
 *      ],
 * ];
 * ```
 *
 * And then:
 *
 * ```
 * return [
 *     'Gamajo' => [
 *         'Theme' => [
 *             ThemeToolkit::DEPENDENCIES => $gamajo_dependencies_config,
 *         ],
 *     ],
 * ];
 * ```
 *
 * @package Gamajo\ThemeToolkit
 */
class Dependencies extends Brick
{

	/**
	 * Initialize DependencyManager and hook it up to WordPress.
	 */
	public function apply()
	{
		$dependencies = new DependencyManager($this->config);
		add_action( 'init', [$dependencies, 'register'] );
	}
}
