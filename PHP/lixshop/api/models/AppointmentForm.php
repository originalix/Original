<?php

namespace api\models;

use Yii;
use yii\base\Model;
use yii\web\HttpException;
use yii\db\Exception;
use common\models\Customer;
use common\models\Appointment;

class AppointmentForm extends Model
{
    public $platform;
    public $enter_type;
    public $code;
    public $clothes_count;
    public $userName;
    public $province;
    public $city;
    public $county;
    public $street;
    public $postal_code;
    public $tel_number;

    public function rules()
    {
        return [
            [['platform', 'enter_type', 'clothes_count', 'userName', 'province', 'city', 'county', 'street', 'postal_code', 'tel_number'], 'required', 'message' => '{attribute}不能为空'],
            [['enter_type', 'clothes_count'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['platform', 'code', 'userName', 'county', 'street', 'postal_code', 'tel_number'], 'string', 'max' => 255],
            [['province', 'city'], 'string', 'max' => 32],
        ];
    }

    public function saveItem()
    {
        if (! $this->validate()) {
            throw new HttpException(418, array_values($this->getFirstErrors())[0]);
        }

        $appointment = new Appointment();
        $appointment->setAttributes([
            'platform' => $this->platform,
            'enter_type' => $this->enter_type,
            'code' => $this->code,
            'clothes_count' => $this->clothes_count,
            'userName' => $this->userName,
            'province' => $this->province,
            'city' => $this->city,
            'county' => $this->county,
            'street' => $this->street,
            'postal_code' => $this->postal_code,
            'tel_number' => $this->tel_number,
        ]);

        if (! $appointment->save()) {
            throw new HttpException(433, '团购预约失败，请重试');
        }

        return $appointment;
    }
}

