<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "unit".
 *
 * @property integer $blok
 * @property string $IMEI
 * @property integer $idSim
 * @property integer $idConfig
 * @property integer $idICC
 * @property integer $name_block
 * @property integer $idFw
 *
 * @property Inst[] $insts
 * @property Sim $idICC0
 * @property Sim $idSim0
 */
class Unit extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'unit';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['comment', 'idSim'], 'safe'],
            [['IMEI', 'idConfig', 'idICC', 'idFw'], 'integer'],
            [['name_block'], 'unique', 'message' => 'Номер блока уже существует'],
            [['name_block', 'IMEI', 'idSim'], 'required', 'message' => 'Заполните поле'],
            [['idICC'], 'exist', 'skipOnError' => true, 'targetClass' => Sim::className(), 'targetAttribute' => ['idICC' => 'id']],
            [['idSim'], 'exist', 'skipOnError' => true, 'targetClass' => Sim::className(), 'targetAttribute' => ['idSim' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'blok' => 'Blok',
            'IMEI' => 'Imei',
            'idSim' => 'SIM',
            'idConfig' => 'Config',
            'idICC' => 'ICC',
            'name_block' => 'Name Block',
            'idFw' => 'Firmware',
            'comment' => 'Comment',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getInsts()
    {
        return $this->hasMany(Inst::className(), ['blok' => 'blok']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdICC0()
    {
        return $this->hasOne(Sim::className(), ['id' => 'idICC']);
    }


    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdSim0()
    {
        return $this->hasOne(Sim::className(), ['id' => 'idSim']);
    }
}
