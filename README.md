# 🧰 sezer/enum-helpers

>  Elegant and lightweight helpers for PHP enums.
Adds only(), except(), onlyList(), exceptList(), automatic validation, and custom exceptions —
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
  case COMPLETE = 'complete';
  case RETURNED = 'returned';
}
```

# Examples:
- Filter with `only()`
   Keep only specified cases.

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
   Exclude specified cases.
```php
  $result = OrderStatus::except(['REJECTED']);
  print_r($result);
  output:
  [
  'PENDING'  => OrderStatus::PENDING,
  'APPROVED' => OrderStatus::APPROVED
  ]
```
- 📜 Get just the values as plain array `onlyList();`
```php
  OrderStatusEnum::onlyList(['PENDING', 'APPROVED']);
  
    output: ['pending', 'approved']
```
-  `exceptList()`
```php
OrderStatusEnum::exceptList(['COMPLETE']);
output: ['pending', 'approved', 'rejected', 'returned']
```
# 🎯 With Laravel
> ### ✨ If your model has Enum cast:
```php
protected $casts = [
    'order_status' => OrderStatusEnum::class,
];
```
_You can pass Enum cases directly in queries:_
```php
Order::whereIn(
    'order_status',
    OrderStatusEnum::except(['COMPLETE'])
)->get();
```
```bladehtml
<select name="status">
@foreach (OrderStatusEnum::except(['COMPLETE']) as $key => $status)
    <option value="{{ $status->value }}">{{ ucfirst(strtolower($key)) }}</option>
@endforeach
</select>
```
_In Validation:_

```php
use Illuminate\Validation\Rule;

$request->validate([
    'status' => [
        'required',
        Rule::in(OrderStatusEnum::exceptList(['COMPLETE']))
    ]
]);
```
# ✨ If your model does NOT have Enum cast:
> You need the ->value of each case:
```php
Order::whereIn(
    'order_status',
    OrderStatusEnum::exceptList(['COMPLETE'])
)->get();
```
_In Blade:_
```bladehtml
<select name="status">
@foreach (OrderStatusEnum::exceptList(['COMPLETE']) as $status)
    <option value="{{ $status }}">{{ ucfirst($status) }}</option>
@endforeach
</select>
```
_In Validation:_

```php
$request->validate([
    'status' => [
        'required',
        Rule::in(OrderStatusEnum::exceptList(['COMPLETE']))
    ]
]);
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

