<?php
/**
 * This file contains elements for nav menus in WordPress
 *
 * @package   Gamajo\ThemeToolkit
 * @author    Gary Jones
 * @copyright Gamajo
 * @license   MIT
 */

declare( strict_types=1 );

namespace Gamajo\ThemeToolkit;

/**
 * Register or unregister nav menus for a WordPress theme.
 * *
 * Example config:
 *
 * ```
 * $gamajo_menus = [
 *     Menus::UNREGISTER => [
 *         'main-nav',
 *     ],
 *     Menus::REGISTER => [
 *         [
 *             'location'    => 'new-main-nav',
 *             'description' => __( 'Primary navigation menu', 'your-text-domain' ),
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
 *             ThemeToolkit::MENUS => $gamajo_menus,
 *         ],
 *     ],
 * ];
 * ```
 *
 * @package Gamajo\ThemeToolkit
 */
class Menus extends Brick {

	const REGISTER = 'register';
	const UNREGISTER = 'unregister';

	/**
	 * Apply nav menu registrations and unregistrations.
	 */
	public function apply() {
		if ( $this->config->hasKey( self::REGISTER ) ) {
			$registerConfig = $this->config->getSubConfig( self::REGISTER );
			$this->register( $registerConfig->getArrayCopy() );
		}

		if ( $this->config->hasKey( self::UNREGISTER ) ) {
			$unregisterConfig = $this->config->getSubConfig( self::UNREGISTER );
			$this->unregister( $unregisterConfig->getArrayCopy() );
		}
	}

	/**
	 * Register nav menus.
	 *
	 * @param array $menus Arguments for nav menus to be registered.
	 */
	public function register( array $menus ) {
		array_walk( $menus, function ( array $menu ) {
			\register_nav_menus( $menu );
		} );
	}

	/**
	 * Unregister nav menus.
	 *
	 * @param array $menus Array of nav menu names to unregister.
	 */
	public function unregister( array $menus ) {
		array_walk( $menus, function ( string $menu ) {
			\unregister_nav_menu( $menu );
		} );
	}
}
