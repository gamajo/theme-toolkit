# Change Log for Theme Toolkit

All notable changes to this project will be documented in this file.
This project adheres to [Semantic Versioning](http://semver.org/).

## [Unreleased]

_Nothing yet._

## [0.6.0] - 2017-07-31
### Added
- Add ObjectCalisthenics checks.

### Changed
- **Bump minimum PHP to 7.1**

## [0.5.0] - 2017-07-22
### Added
- Add Dependencies brick which uses `brightnucleus/dependencies`. Props [Craig Simpson].

### Fixed
- Replace use of `UNSET` class constant with `UNREGISTER`. Props [Craig Simpson].
- Fix spelling of "Toolkit" in file header comment. Props [Craig Simpson].

## [0.4.0] - 2017-06-28
### Changed
- Introduce ThemeToolkit::applyBricks() method.

## [0.3.0] - 2017-06-26

### Added
- Add static method for when walking through bricks array.

## [0.2.0] - 2017-06-26

### Fixed
- Don't use UNSET as Templates constant (reserved word).
- Fix change log links.

### Changed
- Use `self::` instead of `static::` for referencing constants inside classes.

## 0.1.0 - 2017-06-26

* Initial release.

[Craig Simpson]: https://github.com/craigsimps

[Unreleased]: https://github.com/gamajo/theme-toolkit/compare/0.5.0...HEAD
[0.5.0]: https://github.com/gamajo/theme-toolkit/compare/0.4.0...0.5.0
[0.4.0]: https://github.com/gamajo/theme-toolkit/compare/0.3.0...0.4.0
[0.3.0]: https://github.com/gamajo/theme-toolkit/compare/0.2.0...0.3.0
[0.2.0]: https://github.com/gamajo/theme-toolkit/compare/0.1.0...0.2.0
