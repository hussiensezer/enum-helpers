# 🧰 sezer/enum-helpers

>  Elegant and lightweight helpers for PHP enums.
Adds `only()`, `except()`, automatic validation, and custom exceptions
to make working with PHP 8.1+ enums clean and easy.

## Installation
description: Install this package via Composer:
```
composer require sezer/enum-helpers
```

# Usage:
Add the `EnumTrait` to your enum and use the methods:

```php
    use Sezer\EnumHelpers\Traits\EnumTrait;
    
    enum OrderStatus: string {
        use EnumTrait;

        case PENDING  = 'pending';
        case APPROVED = 'approved';
        case REJECTED = 'rejected';
    }
```

# Examples:
- title: Filter with `only()`
  description: Keep only specified cases.

```php
  $result = OrderStatus::only(['PENDING', 'APPROVED']);
  print_r($result);
  output:
      [
      'PENDING'  => OrderStatus::PENDING,
      'APPROVED' => OrderStatus::APPROVED
      ]
```
- Exclude with `except()`
  description: Exclude specified cases.
```php
  $result = OrderStatus::except(['REJECTED']);
  print_r($result);
  output:
  [
  'PENDING'  => OrderStatus::PENDING,
  'APPROVED' => OrderStatus::APPROVED
  ]
```
# Errors:
Invalid keys

> If you pass an invalid case name to `only()` or `except()`,
an `InvalidEnumKeyException` is thrown.
example:
OrderStatus::only(['INVALID']);
> Sezer\EnumHelpers\Exceptions\InvalidEnumKeyException: Invalid enum key: INVALID

## Test
     vendor/bin/phpunit 

## Authors

[@sezer](https://github.com/hussiensezer)

## 🔗 Links

[![linkedin](https://img.shields.io/badge/linkedin-0A66C2?style=for-the-badge&logo=linkedin&logoColor=white)](https://www.linkedin.com/in/hussien-attia/)



## Support

For support, email hussiensezer@gmail.com

