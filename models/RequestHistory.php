<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "request_history".
 *
 * @property integer $id
 * @property integer $request_id
 * @property string $description
 * @property string $created_at
 */
class RequestHistory extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'request_history';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['request_id'], 'integer'],
            [['created_at'], 'safe'],
            [['description'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'Ид',
            'request_id' => 'Request ID',
            'description' => 'Описание',
            'created_at' => 'Дата изменения',
            'managerFormatted' => 'Кто поменял статус'
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getManager()
    {
        return $this->hasOne(User::className(), ['id' => 'worked_by']);
    }

    public function getManagerFormatted()
    {
        if ($this->manager) {
            return $this->manager->surname . ' ' . $this->manager->name . ' ' . $this->manager->middle_name;
        } else {
            return 'Не задан';
        }
    }
}
