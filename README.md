# Laravel - Tripay

[![Latest Version on Packagist](https://img.shields.io/packagist/v/ibnuhalimm/laravel-tripay.svg?style=flat-square)](https://packagist.org/packages/ibnuhalimm/laravel-tripay)
[![Total Downloads](https://img.shields.io/packagist/dt/ibnuhalimm/laravel-tripay.svg?style=flat-square)](https://packagist.org/packages/ibnuhalimm/laravel-tripay)

Laravel wrapper for [Tripay](https://tripay.co.id/) payment gateway.

## Contents
- [Installation](#installation)
- [Setting Up](#setting-up)
- [Usage](#usage)
- [Testing](#testing)
- [Changelog](#changelog)
- [Contributing](#contributing)
- [Security](#security)
- [Credits](#credits)
- [License](#license)


## Installation

You can install the package via composer:

```bash
composer require ibnuhalimm/laravel-tripay
```

Optionally, you can publish the config file of this package with this command:
```bash
php artisan vendor:publish --tag="laravel-tripay-config"
```

## Setting up
Put some environment variable to `.env` file:
```bash
TRIPAY_MERCHANT_CODE=
TRIPAY_API_KEY=
TRIPAY_PRIVATE_KEY=
TRIPAY_PRODUCTION_MODE=
```
** Valid value for `TRIPAY_PRODUCTION_MODE` is `true` or `false`

## Usage
You can directly use the `Tripay` Facade (the alias or class itself):

#### Payment Channels
```php
use Ibnuhalimm\LaravelTripay\Facades\Tripay;

// Get all available payment channels
Tripay::paymentChannels();

// Or get single payment channels by specifying the code
Tripay::paymentChannels('BRIVA');
```

#### Get Fee of Payment Channel
```php
use Ibnuhalimm\LaravelTripay\Facades\Tripay;

$amount = 12000;
$paymentChannelCode = 'BRIVA';
Tripay::feeCalculator($amount, $paymentChannelCode);
```

#### Fetch the Transactions
```php
use Ibnuhalimm\LaravelTripay\Facades\Tripay;

Tripay::transactions();
```

#### Get Transaction Details
```php
use Ibnuhalimm\LaravelTripay\Facades\Tripay;

$reference = 'DEV-T11958501451EJYV'; // Get from create transaction response / Transaction list
Tripay::transactionDetails($reference);
```

#### Create a Transaction
```php
use Ibnuhalimm\LaravelTripay\Facades\Tripay;

// All required parameters
$params = [
    'method'            => 'MANDIRIVA',
    'merchant_ref'      => 'INV-123456',
    'amount'            => 25000,
    'customer_name'     => 'Your Customer Name',
    'customer_email'    => 'customer.email@domain.com',
    'customer_phone'    => '081234567890',
    'order_items'       => [
        [
            'name'        => 'Product Name 1',
            'price'       => 6000,
            'quantity'    => 2
        ],
        [
            'name'        => 'Product Name 2',
            'price'       => 13000,
            'quantity'    => 1
        ]
    ]
];

// You can override the callback URL
// By adding the `callback_url` parameter
$params = [
    ...
    'callback_url' => 'https://yourdomain.tld/callback',
    ...
];

// By default, expired time will be set for 24 hours
// You can change it by adding 'expired_time'
$params = [
    ...
    'expired_time' => 1582855837 // Should be in integer value as unix format
    ...
];

// Add more info of ordered items
$params = [
    ...
    'order_items'    => [
        [
            'sku'         => 'FB-01',
            'name'        => 'Product Name',
            'price'       => 20000,
            'quantity'    => 1,
            'product_url' => 'https://yourstore.com/product/product-01',
            'image_url'   => 'https://yourstore.com/product/product-01.jpg',
        ],
        [
            'sku'         => 'FB-07',
            'name'        => 'Product Name 2',
            'price'       => 5000,
            'quantity'    => 1,
            'product_url' => 'https://yourstore.com/product/product-02',
            'image_url'   => 'https://yourstore.com/product/product-02.jpg',
        ]
    ],
    ...
];


Tripay::createTransaction($params);
```

## Testing

```bash
composer test
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information what has changed recently.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

## Security

If you discover any security related issues, please email **ibnuhalim@pm.me** instead of using the issue tracker.

## Credits

-   [Ibnu Halim Mustofa](https://github.com/ibnuhalimm)
-   [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
