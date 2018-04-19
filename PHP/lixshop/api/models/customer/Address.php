<?php

namespace api\models\customer;

use Yii;
use common\models\CustomerAddress;

class Address extends CustomerAddress
{
    public function create()
    {
        if (! $this->validate()) {
            return array_values($this->getFirstErrors())[0];
        }

        if (! $address = $this->save()) {
            return array_values($this->getFirstErrors())[0];
        }

        return $address;
    }

    public function fields()
    {
        return [
            'id',
            'customer_id',
            'name',
            'telephone',
            'province',
            'city',
            'district',
            'street',
            'is_default',
        ];
    }
}
