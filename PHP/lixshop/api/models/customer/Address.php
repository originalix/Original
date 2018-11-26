<?php

namespace api\models\customer;

use Yii;
use common\models\CustomerAddress;
use yii\data\ActiveDataProvider;
use yii\web\HttpException;

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

        $this->changeDefaultState($this, "create");

        if (! $this->save()) {
            return array_values($this->getFirstErrors())[0];
        }

        return $this;
    }

    public function getList()
    {
        $id = Yii::$app->user->identity->id;
        $query = static::find()
            ->where(['customer_id' => $id]);
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => [
                'defaultOrder' => [
                    'is_default' => SORT_DESC, 
                    'created_at' => SORT_DESC,
                ]
            ],
        ]);

        return $dataProvider;
    }

    public function getAddress($id)
    {
        return static::findOne($id);
    }

    public function updateAddress($data)
    {
        $address = static::findOne($data['id']);
        if (is_null($address)) {
            throw new HttpException(423, '更新地址失败');
        }

        $address->load($data, '');
        if (! $address->validate()) {
            throw new HttpException(423, array_values($address->getFirstErrors())[0]);
        }

        $this->changeDefaultState($address);

        if (! $address->save()) {
            throw new HttpException(423, array_values($address->getFirstErrors())[0]);
        }
        return $address;
    }

    public function changeDefaultState($address, $type = "update")
    {
        if ($address->is_default == true) {
            $defaultArr = [];
            if ($type === "create") {
                $defaultArr = static::find()
                    ->where(['customer_id' => Yii::$app->user->identity->id])
                    ->andWhere(['is_default' => 1])
                    ->all();    
            } else {
                $defaultArr = static::find()
                ->where(['customer_id' => Yii::$app->user->identity->id])
                ->andWhere(['is_default' => 1])
                ->andWhere(['<>', 'id', $address->id])
                ->all();
            }
            foreach($defaultArr as $model) {
                $model->is_default = 0;
                $model->save();
            }
        }
    }

    public function deleteAddress($id)
    {
        $address = static::findOne($id);
        if (is_null($address)) {
            return true;
        }

        if ($address->is_default == true) {
            $this->selectOtherDefault($id);
        }

        return $address->delete();
    }

    protected function selectOtherDefault($id)
    {
        $address = Address::find()
            ->where(['customer_id' => Yii::$app->user->identity->id])
            ->andWhere(['<>', 'id', $id])
            ->one();
        if (is_null($address)) {
            return;
        }

        $address->is_default = true;
        return $address->save();
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
