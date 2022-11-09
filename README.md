# Shopware5 API Connector

## Description

A Connector for Shopware 5 API in Laravel Applications.

All Endpoints from Shopware 5 API are available as Enum, which is needed to Initialize the Connector

## Installation

Install it through composer:

```
composer require mennen-online/shopware5-api-connector
```

Run:
```
php artisan vendor:publish --provider=Shopware5ApiConnectorServiceProvider
```

To connect a single Shop, add to your .env the following Keys:
```
SW5_HOST=<URL TO SHOP>
SW5_CLIENT_ID=<CLIENT ID>
SW5_CLIENT_SECRET=<CLIENT SECRET>
```

It is also Possible to call the connector with following scheme e.g. authentication:

```php
use MennenOnline\Shopware6ApiConnector\Endpoints\Endpoint;
use MennenOnline\Shopware6ApiConnector\Enums\EndpointEnum;

$instance = new Endpoint(
    url: 'http://your-shop.url',
    client_id: 'your-username',
    client_secret: 'your-password',
    endpoint: EndpointEnum::ARTICLES
);
```

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