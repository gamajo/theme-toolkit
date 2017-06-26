<?php
/**
 * Example theme configuration
 *
 * @package   Gamajo\ExampleTheme
 * @author    Gary Jones
 * @copyright 2017 Gamajo
 * @license   MIT
 */

declare( strict_types=1 );

namespace Gamajo\ExampleTheme;

use Gamajo\ThemeToolkit\ImageSizes;
use Gamajo\ThemeToolkit\Templates;
use Gamajo\ThemeToolkit\ThemeSupport;
use Gamajo\ThemeToolkit\ThemeToolkit;
use Gamajo\ThemeToolkit\WidgetAreas;
use Gamajo\ThemeToolkit\Widgets;

$gamajo_theme_support = [
	ThemeSupport::ADD => [
		'html5' => [
			'caption',
			'comment-form',
			'comment-list',
			'gallery',
			'search-form',
		],
	],
];

$gamajo_image_sizes = [
	ImageSizes::ADD => [
		'article-grid'   => [ 480, 320, true ],
		'article-header' => [ 1200, 400, true ],
	],
];

$gamajo_google_fonts = [

	/*
	 * Translators: If there are characters in your language that are not
	 * supported by this font, translate this to 'off'. Do not translate
	 * into your own language.
	 */
	'Roboto:300,400,500,700' => _x( 'on', 'Roboto font: on or off', 'gamajo' ),
];

$gamajo_templates = [
	Templates::UNREGISTER => [
		'page-foobar.php',
	],
];

$gamajo_widget_areas = [
	WidgetAreas::UNREGISTER => [
		'sidebar-alt',
	],
	WidgetAreas::REGISTER   => [
		[
			'id'          => 'foobar-footer',
			'name'        => __( 'Footer', 'your-text-domain' ),
			'description' => __( 'Suggestion: Add footer menu', 'your-text-domain' ),
		],
	],
];

$gamajo_widgets = [
	Widgets::UNREGISTER => [
		\WP_Widget_Search::class,
	],
];

return [
	'Gamajo' => [
		'ExampleTheme' => [
			ThemeToolkit::IMAGESIZES   => $gamajo_image_sizes,
			ThemeToolkit::GOOGLEFONTS  => $gamajo_google_fonts,
			ThemeToolkit::TEMPLATES    => $gamajo_templates,
			ThemeToolkit::THEMESUPPORT => $gamajo_theme_support,
			ThemeToolkit::WIDGETAREAS  => $gamajo_widget_areas,
			ThemeToolkit::WIDGETS      => $gamajo_widgets,
		],
	],
];
