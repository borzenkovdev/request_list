<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "request".
 *
 * @property integer $id
 * @property string $status
 * @property string $description
 * @property string $result
 * @property integer $worked_by
 * @property integer $created_by
 * @property string $created_at
 */
class Request extends \yii\db\ActiveRecord
{
    const STATUS_NEW = 'new';
    const STATUS_INWORK  = 'inwork';
    const STATUS_INREVIEW  = 'inreview';
    const STATUS_CLOSED = 'closed';

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'request';
    }

    /**
     * @param bool $insert
     * @return bool
     */
    public function beforeSave($insert)
    {
        if ($insert) {
            $this->created_by = Yii::$app->user->identity->getId();
            $this->status = self::STATUS_NEW;
        }
        return parent::beforeSave($insert);
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'required', 'message' => "Поле название не может быть пустым"],
            [['description'], 'required', 'message' => "Поле описание не может быть пустым"],
            [['description', 'result'], 'string'],
            [['worked_by', 'created_by'], 'integer'],
            [['created_at'], 'safe'],
            [['status'], 'string', 'max' => 50],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'status' => 'Статус',
            'name' => 'Название',
            'description' => 'Описание',
            'result' => 'Результат',
            'worked_by' => 'Исполнитель',
            'created_by' => 'Создано менеджером',
            'created_at' => 'Дата создания',
            'statusformatted' =>  'Статус'
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCreator()
    {
        return $this->hasOne(User::className(), ['id' => 'created_by']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWorkManager()
    {
        return $this->hasOne(User::className(), ['id' => 'worked_by']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStatusformatted()
    {
        switch ($this->status) {
            case self::STATUS_NEW:
                return 'Новая';
                break;
            case self::STATUS_INWORK:
                return 'В работе';
                break;
            case self::STATUS_INREVIEW:
                return 'На проверке';
                break;
            case self::STATUS_CLOSED:
                return 'Закрыта';
                break;
            default:
                return 'Статус не задан';
        }
    }
}
