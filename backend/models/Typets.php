<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "typets".
 *
 * @property integer $id
 * @property string $typeTs
 *
 * @property Auto[] $autos
 */
class Typets extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'typets';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['typeTs'], 'required'],
            [['typeTs'], 'string', 'max' => 45],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'typeTs' => 'Тип ТС',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAutos()
    {
        return $this->hasMany(Auto::className(), ['typeTs' => 'id']);
    }
}
