<?php
/**
 * A brick is a class that uses an config to determine how a theme is built
 *
 * @package   Gamajo\ThemeTookit
 * @author    Gary Jones
 * @copyright Gamajo
 * @license   MIT
 */

declare(strict_types=1);

namespace Gamajo\ThemeToolkit;

use BrightNucleus\Config\ConfigInterface;
use BrightNucleus\Config\ConfigTrait;
use BrightNucleus\Config\Exception\FailedToProcessConfigException;

/**
 * The theme is built from concrete implementations of this abstract Brick class.
 *
 * Typically, the only entry point is the `apply()` method. This is where actions
 * and filter callbacks are hooked in, or the configuration data is parsed before
 * being passed to protected methods to be acted upon.
 *
 * Each object from a subclass has a configuration object passed in that just contains
 * the config values for that object. Typically, this is stored in config/defaults.php
 * in the theme.
 *
 * @package Gamajo\ThemeToolkit
 */
abstract class Brick
{
    use ConfigTrait;

    /**
     * Initialise Brick object.
     *
     * @param ConfigInterface $config Config to parametrize the object.
     *
     * @throws FailedToProcessConfigException  If the Config could not be parsed correctly.
     */
    public function __construct(ConfigInterface $config)
    {
        $this->processConfig($config);
    }

    /**
     * Apply filters and hooks, or construct an aspect of the theme.
     */
    abstract public function apply();
}
