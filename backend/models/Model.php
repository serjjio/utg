<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "model".
 *
 * @property integer $idmodel
 * @property string $name_model
 * @property integer $id_marka
 *
 * @property Marka $idMarka
 */
class Model extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'model';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name_model'], 'required', 'message' => 'Поле не заполнено'],
            [['id_marka'], 'required', 'message' => 'Необходимо выбрать марку'],
            [['name_model'], 'string', 'max' => 45],
            [['id_marka'], 'exist', 'skipOnError' => true, 'targetClass' => Marka::className(), 'targetAttribute' => ['id_marka' => 'Id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'idmodel' => 'Idmodel',
            'name_model' => 'Модель',
            'id_marka' => 'Марка',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdMarka()
    {
        return $this->hasOne(Marka::className(), ['Id' => 'id_marka']);
    }
}
