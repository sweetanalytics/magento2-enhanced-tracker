# Sweet Analytics Tracker for Magento 2

A Magento 2 module for integrating Sweet Analytics tracking functionality.

## Requirements

- **PHP**: 8.1 or higher
- **Magento**: 2.4.7 or higher (compatible with 2.4.8+)
- **Magento Framework**: 103.0.0 or higher

## Installation

### Via Composer (Recommended)

```bash
composer require sweetanalytics/sweet-tracker
```

### Manual Installation

1. Download the module files
2. Place them in `app/code/YelHex/SweetTracker/`
3. Run the following commands:

```bash
php bin/magento module:enable YelHex_SweetTracker
php bin/magento setup:upgrade
php bin/magento setup:di:compile
php bin/magento setup:static-content:deploy
php bin/magento cache:flush
```

## Configuration

1. Go to **Admin Panel** > **Stores** > **Configuration** > **Sweet Analytics**
2. Enable the module
3. Enter your Sweet Analytics tracking ID
4. Save the configuration

## Features

- Tracks e-commerce events
- Supports order success conversion tracking (conversion pixel)

## Version History

- **1.0.8**: Updated for PHP 8.1+ and Magento 2.4.7+ compatibility
- **1.0.7**: Previous version

## Magento Commerce Marketplace

To upload to the AdobeCommerce Marketplace go to https://
commercedeveloper.adobe.com/extensions/ and upload a zip using the
following command:

> zip -r sweetanalytics_sweet-tracker-1.X.X.zip ./ -x './.git/*'

## License

OSL-3.0
