# Shopware5 API Connector

## Description

A Connector for Shopware 5 API in Laravel Applications.

## Installation

Install it through composer:

```
composer require mennen-online/shopware5-api-connector
```

Run:
```
php artisan vendor:publish --provider=Shopware5ApiConnectorServiceProvider
```

## Usage

To connect a single Shop, add to your .env the following Keys:
```
SW5_HOST=<URL TO SHOP>
SW5_USERNAME=<USERNAME>
SW5_PASSWORD=<PASSWORD>
```

It is also Possible to call the connector with following scheme e.g. authentication:

```php
use MennenOnline\Shopware5ApiConnector\Endpoints\Endpoint;
use MennenOnline\Shopware5ApiConnector\Enums\EndpointEnum;

$instance = new Endpoint(
    url: 'http://your-shop.url',
    username: 'your-username',
    password: 'your-password',
    endpoint: EndpointEnum::ARTICLES
);
```

For more flexible usage, it is now possible, to use Facades:

```php
use MennenOnline\Shopware5ApiConnector\Facades\AddressFacade;

$instance = AddressFacade::initialize(
    url: 'http://your-shop.url',
    username: 'your-username',
    password: 'your-password'
)
```

This will return a Instance of Shopware5ApiConnector with loaded Address Endpoint.

## Endpoints

```php
    case ADDRESSES;

    case ARTICLES;

    case CACHE;

    case CATEGORIES;

    case COUNTRIES;

    case CUSTOMERS;

    case CUSTOMER_GROUPS;

    case GENERATE_ARTICLE_IMAGES;

    case MANUFACTURERS;

    case MEDIA;

    case ORDERS;

    case PAYMENT_METHODS;

    case PROPERTY_GROUPS;

    case SHOPS;

    case TRANSLATIONS;

    case USERS;

    case VARIANTS;

    case VERSION;
```

## Facades

```php
use MennenOnline\Shopware5ApiConnector\Facades\AddressFacade;
use MennenOnline\Shopware5ApiConnector\Facades\ArticleFacade;
use MennenOnline\Shopware5ApiConnector\Facades\CacheFacade;
use MennenOnline\Shopware5ApiConnector\Facades\CountryFacade;
use MennenOnline\Shopware5ApiConnector\Facades\CustomerFacade;
use MennenOnline\Shopware5ApiConnector\Facades\CustomerGroupFacade;
use MennenOnline\Shopware5ApiConnector\Facades\GenerateArticleImageFacade;
use MennenOnline\Shopware5ApiConnector\Facades\ManufacturerFacade;
use MennenOnline\Shopware5ApiConnector\Facades\OrderFacade;
use MennenOnline\Shopware5ApiConnector\Facades\PaymentMethodFacade;
use MennenOnline\Shopware5ApiConnector\Facades\PropertyGroupFacade;
use MennenOnline\Shopware5ApiConnector\Facades\ShopFacade;
use MennenOnline\Shopware5ApiConnector\Facades\VariantFacade;
use MennenOnline\Shopware5ApiConnector\Facades\VersionFacade;
```