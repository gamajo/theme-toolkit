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
 * Register and enqueue Google Fonts.
 *
 * Example config:
 *
 * ```
 * $gamajo_google_fonts = [
 *     // Translators: If there are characters in your language that are not supported by this font, translate this to
 *     // 'off'. Do not translate into your own language.
 *     'Roboto:300,400,500,700' => _x( 'on', 'Roboto font: on or off', 'your-text-domain' ),
 *
 *     // Translators: If there are characters in your language that are not supported by this font, translate this to
 *     // 'off'. Do not translate into your own language.
 *     'Lobster:500,700' => _x( 'on', 'Lobster font: on or off', 'your-text-domain' ),
 * ];
 * ```
 *
 * And then:
 *
 * ```
 * return [
 *     'Gamajo' => [
 *         'Theme' => [
 *             ThemeToolkit::GOOGLEFONTS => $gamajo_google_fonts,
 *         ],
 *     ],
 * ];
 * ```
 *
 * @package Gamajo\ThemeTookit
 */
class GoogleFonts extends Brick
{
    /**
     * Registry items.
     *
     * @var array
     */
    protected $fonts = [];

    /**
     * Apply Google Font customizations.
     */
    public function apply()
    {
        $fonts = $this->getOnFonts($this->config->getArrayCopy());
        $url = $this->fontsUrl($fonts);
        $this->enqueue($url);
    }

    /**
     * Filter out fonts that are not considered to be on for this locale.
     *
     * @param array $fonts Array of all configured fonts
     * @return array Fonts considered valid by translators.
     */
    protected function getOnFonts(array $fonts): array
    {
        return \array_filter($fonts, function (string $font_on_switch) {
            return 'on' === $font_on_switch;
        });
    }

    /**
     * Build the fonts URL.
     *
     * @return string URL for Google Fonts.
     */
    protected function fontsUrl($fonts): string
    {
        $font_families = \array_keys($fonts);

        $query_args = [
            'family' => \rawurlencode(\implode('|', $font_families)),
            'subset' => \rawurlencode('latin,latin-ext'),
        ];

        return \add_query_arg($query_args, 'https://fonts.googleapis.com/css');
    }

    /**
     * Enqueue Google fonts styles.
     */
    protected function enqueue($url)
    {
        \wp_enqueue_style('themetoolkit-googlefonts', $url, [], null);
    }
}
