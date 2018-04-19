<?php

namespace api\models\customer;

use Yii;
use common\models\CustomerAddress;

class Address extends CustomerAddress
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['customer_id', 'name', 'telephone', 'province', 'city', 'district', 'street'], 'required', 'message' => '{attribute}不能为空'],
            [['customer_id'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['name', 'province'], 'string', 'max' => 100],
            [['telephone'], 'string', 'max' => 11],
            [['city', 'district', 'street'], 'string', 'max' => 255],
            [['is_default'], 'boolean'],
        ];
    }

    public function create()
    {
        if (! $this->validate()) {
            return array_values($this->getFirstErrors())[0];
        }

        if (! $this->save()) {
            return array_values($this->getFirstErrors())[0];
        }

        return $this;
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
