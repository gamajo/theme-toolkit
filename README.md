# Theme Toolkit

Building blocks to develop a config-based WordPress theme.

When building a theme, wouldn't it be nice to separate out the implementation-specific config, from the reusable logic? This is the premise upon which the [Using a Config to Write Reusable Code](https://www.alainschlesser.com/config-files-for-reusable-code/) series articles are written, and which this package enables.

It uses the [BrightNucleus\Config](https://github.com/brightnucleus/config) package for managing the configuration objects, while the classes in this package consumes them to provide an easy way to:

- Register and enqueue Google Fonts.
- Add and remove image sizes.
- Unset (inherited) page templates.
- Add theme support.
- Register and unregister widget areas (sidebars).
- Register and unregister widgets.
- Manage script and style dependencies.

## Installation

In a terminal, browse to the directory with your theme in and then:

~~~sh
composer require gamajo/theme-toolkit
~~~

You can then autoload (PSR-4) or require the files as needed.

## Usage

See the [example-config.php](docs/example-config.php). This would typically live in your theme, at `config/defaults.php`.

Your theme would then contain a function, in the `functions.php`, to pull in this config, and load up the individual components, which are referred to as _bricks_:

```php
// functions.php

namespace Gamajo\ExampleTheme;

use BrightNucleus\Config\ConfigFactory;
use Gamajo\ThemeToolkit\Dependencies;
use Gamajo\ThemeToolkit\GoogleFonts;
use Gamajo\ThemeToolkit\ImageSizes;
use Gamajo\ThemeToolkit\Templates;
use Gamajo\ThemeToolkit\ThemeSupport;
use Gamajo\ThemeToolkit\Widgets;
use Gamajo\ThemeToolkit\WidgetAreas;

add_action( 'after_setup_theme', __NAMESPACE__ . '\setup' );
/**
 * Theme setup.
 *
 * Compose the theme toolkit bricks.
 */
function setup() {
	$config_file = __DIR__ . '/config/defaults.php';
	$config = ConfigFactory::createSubConfig( $config_file, 'Gamajo\ExampleTheme' );

	// These bricks are run in admin and front-end.
	$bricks = [
		Dependencies::class,
		ImageSizes::class,
		Templates::class,
		ThemeSupport::class,
		Widgets::class,
		WidgetAreas::class,
	];

	// Apply logic in bricks, with configuration defined in config/defaults.php.
	ThemeToolkit::applyBricks($config, ...$bricks);


	if ( ! is_admin() ) {
		// Only front-end bricks.
		$bricks = [
			GoogleFonts::class,
		];

		ThemeToolkit::applyBricks($config, ...$bricks);

	}
}
```

The `'Gamajo\ExampleTheme'` string matches the two keys in the `return` at the bottom of the config file. Change this in the config and the function to be your company name and theme name.

You don't have to use all of the bricks in this package; pick and choose.

You can add your own bricks to your theme (in your `src/` or similar directory), and then make use of them in the function above.

For Genesis Framework users, see the [Genesis Theme Toolkit](https://github.com/gamajo/genesis-theme-toolkit) which has extra bricks for registering layouts, breadcrumbs args etc.

## Change Log

Please see [CHANGELOG.md](CHANGELOG.md).

## Credits

Built by [Gary Jones](https://twitter.com/GaryJ)  
Copyright 2017 [Gamajo](https://gamajo.com)
