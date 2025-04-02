# Filament Hashids

Filament Hashids is a Laravel package that automatically encodes and decodes model IDs using [vinkla/hashids](https://github.com/vinkla/hashids). By replacing numerical IDs with obfuscated Hashids, this package not only improves the aesthetics of your URLs but also provides an extra layer of security.

## Table of Contents

- [Features](#features)
- [Installation](#installation)
- [Configuration](#configuration)
- [Usage](#usage)
  - [Using the Model Trait](#using-the-model-trait)
  - [Blade Directive](#blade-directive)
  - [Setup the Middleware](#setup-the-middleware)
- [Testing](#testing)
- [Contributing](#contributing)
- [Licence](#licence)

## Features

- **Automatic Hashid Encoding**: Transform model IDs in your URLs (e.g. `/admin/users/1/edit` becomes `/admin/users/0l8q7xpnm4k63jo9/edit`).
- **Automatic Hashid Decoding**: Middleware decodes Hashids back to real IDs when processing requests.
- **Model Trait (`HasHashid`)**: Easily apply Hashids to any Filament model.
- **Filament Plugin (`HashidsPlugin.php`)**: Seamlessly integrate with Filament, overriding resource routes and actions.
- **Customisable Hashid Config**: Configure custom salts, minimum length, and alphabet via `filament-hashids.php`.
- **Blade Directive (`@hashid($model)`)**: Helper directive for generating Hashids in your Blade templates.
- **Artisan Command (`install:hashids`)**: Simplifies setup by publishing configuration files and verifying dependencies.

## Installation

Install the package via Composer:

```bash
composer config repositories.swindon/filament-hashids vcs "https://github.com/swindon/filament-hashids" && composer require swindon/filament-hashids:dev-main
```

If you wish to customise the configuration, run the install command:

```bash
php artisan install:filament-hashids
```

This command will publish the configuration file (`config/filament-hashids.php`) to your Laravel application.

## Configuration

After installation, you can adjust your settings in the `config/filament-hashids.php` file. You may set:

- **salt**: A custom salt value (defaults to your `APP_KEY`).
- **min_length**: The minimum length for the generated Hashid.
- **alphabet**: The alphabet used to generate the Hashid.

## Usage

### Using the Model Trait

Simply include the `HasHashid` trait in your model to enable Hashid functionality:

```php
use Swindon\FilamentHashids\Traits\HasHashid;

class User extends Authenticatable
{
    use HasHashid;
    
    // ...
}
```

You can then retrieve the Hashid for a model instance:

```php
$user = User::find(1);
echo $user->getHashid();
```

You can query by Hashid for a model:

```php
$user = User::findHashId($hashId);
$users = User::whereHashId($hashId)->get();
```

### Blade Directive

In your Blade templates, generate a Hashid easily with the provided directive:

```blade
@hashid($user)
```

This will output the encoded ID of the model.

### Setup the Middleware

Middleware ensures that incoming requests with Hashids are automatically decoded into their corresponding numerical IDs. You can set it up in two ways:

#### Via Panels

To apply the middleware globally to a Filament panel, include it in the panel's middleware stack:

```php
use Filament\Panel;
use Filament\PanelProvider;
use Swindon\FilamentHashids\Middleware\FilamentHashidsMiddleware;

class AdminPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        return $panel
            ->middleware([
                FilamentHashidsMiddleware::class, // Decodes Hashids for all routes in this panel
                // ...existing code...
            ]);
    }
}
```

#### Via Specific Resources

If you want to apply the middleware to specific resources only, you can define it in the resource's `$routeMiddleware` property:

```php
use Filament\Resources\Resource;

class UserResource extends Resource
{
    public static array|string $routeMiddleware = [
        'filament-hashids', // Ensures Hashids are decoded for this resource's routes
    ];
}
```

## Testing

The package includes a suite of tests to cover its key functionality:

- **Feature Tests**: Validate that URLs are correctly rewritten and that routes work as expected.
- **Unit Tests**: Ensure that the `HashidsManager`, middleware, and helper functions behave correctly.

To run the tests, simply execute:

```bash
vendor/bin/phpunit
```

## Contributing

Contributions are welcome! Feel free to open issues or submit pull requests if you have suggestions or improvements.

## Licence

This package is open-sourced software licensed under the [MIT licence](LICENSE).

---

Enjoy building secure and aesthetically pleasing URLs with Filament Hashids!