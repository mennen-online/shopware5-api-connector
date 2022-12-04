<?php

namespace MennenOnline\Shopware5ApiConnector\Enums;

enum EndpointEnum
{
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

    public static function convertEndpointToUrl(EndpointEnum $endpoint): string
    {
        $url = str($endpoint->name);

        $url = $url->replace('_', '-');

        return $url->lower()->camel()->toString();
    }
}
