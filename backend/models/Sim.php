<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "sim".
 *
 * @property integer $id
 * @property string $SIM
 * @property string $icc
 *
 * @property Unit[] $units
 * @property Unit[] $units0
 */
class Sim extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'sim';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['SIM'], 'required'],
            [['SIM', 'icc'], 'string'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'SIM' => 'SIM',
            'icc' => 'ICC',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUnits()
    {
        return $this->hasMany(Unit::className(), ['idICC' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUnits0()
    {
        return $this->hasMany(Unit::className(), ['idSim' => 'id']);
    }
}
