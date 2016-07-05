<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "fil".
 *
 * @property integer $idfil
 * @property string $fil
 *
 * @property Auto[] $autos
 * @property Pod[] $pods
 */
class Fil extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'fil';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['fil'], 'required'],
            [['fil'], 'string', 'max' => 45],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'idfil' => 'Idfil',
            'fil' => 'Филиал',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAutos()
    {
        return $this->hasMany(Auto::className(), ['fil' => 'idfil']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPods()
    {
        return $this->hasMany(Pod::className(), ['idFil' => 'idfil']);
    }
}
