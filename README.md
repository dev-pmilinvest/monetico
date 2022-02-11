# Connecteur Laravel Monetico

[![Latest Version on Packagist](https://img.shields.io/packagist/v/pmilinvest/monetico.svg?style=flat-square)](https://packagist.org/packages/pmilinvest/monetico)
[![Total Downloads](https://img.shields.io/packagist/dt/pmilinvest/monetico.svg?style=flat-square)](https://packagist.org/packages/pmilinvest/monetico)
![GitHub Actions](https://github.com/pmilinvest/monetico/actions/workflows/main.yml/badge.svg)

Facilite l'utilisation de l'API Monetico sous Laravel

## Installation

Vous pouvez installer le package avec composer:

```bash
composer require pmilinvest/monetico
```

## Configuration
Vous devez renseigner les identifiants API grâce aux fichier .env de votre application.


```php
MONETICO_EPT_CODE=
MONETICO_SECURITY_KEY=
MONETICO_COMPAGNY_CODE=
```

Certains parametres optionels peuvent être spécifiés.

```php
MONETICO_SERVICE_VERSION=
MONETICO_MAIN_REQUEST_URL=
MONETICO_MISC_REQUEST_URLL=
```

## Crédits

-   [PMIL Invest](https://github.com/pmilinvest)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
