<?php

namespace api\models;

use Yii;
use yii\base\Model;
use yii\web\HttpException;
use yii\db\Exception;
use common\models\Customer;
use common\models\Appointment;
use common\models\Attachment;

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
    public $images_arr = null;

    public function rules()
    {
        return [
            [['platform', 'enter_type', 'clothes_count', 'userName', 'province', 'city', 'county', 'street', 'postal_code', 'tel_number'], 'required', 'message' => '{attribute}不能为空'],
            [['enter_type', 'clothes_count'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['platform', 'code', 'userName', 'county', 'street', 'postal_code', 'tel_number'], 'string', 'max' => 255],
            [['province', 'city'], 'string', 'max' => 32],
            ['images_arr', 'each', 'rule' => ['integer']],
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

        // 开启事务
        $transaction = Yii::$app->db->beginTransaction();

        try {
            if ($this->enter_type == 2) {
                if (is_null($this->images_arr)) {
                    throw new HttpException(432, '未找到上传图片，预约失败');
                }

                foreach($this->images_arr as $id) {
                    $attachment = Attachment::findOne($id);
                    if (is_null($attachment)) {
                        throw new HttpException(431, '未找到对应图片，预约失败');
                    }
                    $attachment->type_id = $id;
                    if (! $attachment->save()) {
                        throw new HttpException(435, '图片保存失败，预约失败');
                    }
                }
            }

            if (! $appointment->save()) {
                throw new HttpException(433, '团购预约失败，请重试');
            }

            // 事务结束
            $transaction->commit();
        } catch (Exception $e) {

            $transaction->rollBack();
            throw new HttpException(421, $e->getMessage());
        }

        return $appointment;
    }
}

