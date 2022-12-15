<?php

namespace MennenOnline\Shopware5ApiConnector\Models\Endpoints\Address;

use MennenOnline\LaravelResponseModels\Models\BaseModel;
use MennenOnline\Shopware5ApiConnector\Models\Endpoints\Country\CountrySingleModel;
use MennenOnline\Shopware5ApiConnector\Models\Endpoints\Customer\CustomerSingleModel;

/**
 * @property int $id
 * @property string $company
 * @property string $department
 * @property string $salutation
 * @property string $firstname
 * @property string $lastname
 * @property string $street
 * @property string $zipcode
 * @property string $city
 * @property string $phone
 * @property string $vat_id
 * @property string $additional_address_line_1
 * @property string $additional_address_line_2
 * @property CountrySingleModel $country
 * @property CustomerSingleModel $customer
 * @property int|null $state
 * @property array $attribute
 */
class AddressSingleModel extends BaseModel
{
    public function getCustomerAttribute(): CustomerSingleModel {
        return new CustomerSingleModel($this->attributes['customer']);
    }
    public function getCountryAttribute() : CountrySingleModel {
        return new CountrySingleModel($this->attributes['country']);
    }
}