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
            'id' => 'ID',
            'request_id' => 'Request ID',
            'description' => 'Description',
            'created_at' => 'Created At',
        ];
    }
}
