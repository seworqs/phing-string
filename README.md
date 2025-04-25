# SEworqs Phing String

A collection of Phing tasks for string casing, namespaces, path conversion, and random string generation. Useful for manipulating and transforming strings within your Phing build process.

## Installation

Install via Composer:

```bash
composer require seworqs/phing-string
```

## Usage

Import the SEworqs task library in your `build.xml`:

```xml
<import file="vendor/seworqs/phing-string/resources/phing/import.xml"/>
```

This will register all available tasks so you can use them directly:

```xml
<camelcase input="convert me to camel" />
<snakecase input="ConvertMeToSnake" />
<namespace input="src/Helper/StringHelper.php" />
<path input="App\Helper\StringHelper" />
<random length="16" />
```

> Prefer to manage task registration yourself?  
> You can also define tasks individually using `<taskdef>`. See `examples/example.xml`.

> For more examples, see [examples.xml](resources/phing/examples.xml)

## Features

- [x] Convert strings to multiple casing formats
- [x] Normalize namespaces from file paths
- [x] Generate PSR-4 style file paths from namespaces
- [x] Generate secure random strings
- [x] Easy integration via `import.xml`, or define tasks manually

## Tasks Overview

| Namespace                    | Task Class             | Purpose                               |
|------------------------------|------------------------|---------------------------------------|
| Seworqs\Phing\Task\Casing    | LowerCaseTask          | Converts to lowercase                 |
|                              | UpperCaseTask          | Converts to uppercase                 |
|                              | CamelCaseTask          | Converts to `camelCase`               |
|                              | PascalCaseTask         | Converts to `PascalCase`              |
|                              | SnakeCaseTask          | Converts to `snake_case`              |
|                              | KebabCaseTask          | Converts to `kebab-case`              |
|                              | ScreamingSnakeCaseTask | Converts to `SCREAMING_SNAKE_CASE`    |
|                              | ScreamingKebabCaseTask | Converts to `SCREAMING-SNAKE-CASE`    |
|                              | TitleCaseTask          | Converts to `Title Case`              |
| Seworqs\Phing\Task\Namespace | NamespaceTask          | Extracts namespace from file path     |
| Seworqs\Phing\Task\Path      | PathTask               | Converts namespace to PSR-4 file path |
| Seworqs\Phing\Task\Random    | RandomTask             | Generates a random string             |

## License

Apache-2.0 — see [LICENSE](./LICENSE)

## About SEworqs

SEworqs builds clean, reusable modules for PHP and Mendix developers.

Learn more at [github.com/seworqs](https://github.com/seworqs)

## Badges

[![Latest Version](https://img.shields.io/packagist/v/seworqs/phing-string.svg?style=flat-square)](https://packagist.org/packages/seworqs/phing-string)  
[![Total Downloads](https://img.shields.io/packagist/dt/seworqs/phing-string.svg?style=flat-square)](https://packagist.org/packages/seworqs/phing-string)  
[![License](https://img.shields.io/packagist/l/seworqs/phing-string?style=flat-square)](https://packagist.org/packages/seworqs/phing-string)  
[![PHP Version](https://img.shields.io/packagist/php-v/seworqs/phing-string.svg?style=flat-square)](https://packagist.org/packages/seworqs/phing-string)  
[![Made by SEworqs](https://img.shields.io/badge/made%20by-SEworqs-002d74?style=flat-square)](https://github.com/seworqs)
