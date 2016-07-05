<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "pod".
 *
 * @property integer $idpod
 * @property string $podcol
 * @property integer $idFil
 *
 * @property Auto[] $autos
 * @property Fil $idFil0
 */
class Pod extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'pod';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['podcol', 'idFil'], 'required'],
            [['idFil'], 'integer'],
            [['podcol'], 'string', 'max' => 45],
            [['idFil'], 'exist', 'skipOnError' => true, 'targetClass' => Fil::className(), 'targetAttribute' => ['idFil' => 'idfil']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'idpod' => 'Idpod',
            'podcol' => 'Подразделение',
            'idFil' => 'Филиал',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAutos()
    {
        return $this->hasMany(Auto::className(), ['pod' => 'idpod']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdFil0()
    {
        return $this->hasOne(Fil::className(), ['idfil' => 'idFil']);
    }
}
