<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "auto".
 *
 * @property integer $idTs
 * @property string $gosNum
 * @property integer $typeTs
 * @property integer $idMarka
 * @property string $model
 * @property integer $ID объекта
 * @property integer $V
 * @property integer $fil
 * @property integer $pod
 * @property string $comment
 *
 * @property Fil $fil0
 * @property Marka $idMarka0
 * @property Pod $pod0
 * @property Typets $typeTs0
 * @property Inst[] $insts
 */
class Auto extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'auto';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['typeTs', 'V', 'fil', 'pod', 'id_model', 'idMarka'], 'integer'],
            [['comment'], 'string'],
            [['gosNum', 'inv'], 'string', 'max' => 255],
            [['gosNum', 'V'], 'required', 'message' => 'Поле не заполнено'],
            [['fil'], 'exist', 'skipOnError' => true, 'targetClass' => Fil::className(), 'targetAttribute' => ['fil' => 'idfil']],
            [['id_model'], 'exist', 'skipOnError' => true, 'targetClass' => Model::className(), 'targetAttribute' => ['id_model' => 'idmodel']],
            [['idMarka'], 'exist', 'skipOnError' => true, 'targetClass' =>Marka::className(), 'targetAttribute' => ['idMarka' => 'Id']],
            [['pod'], 'exist', 'skipOnError' => true, 'targetClass' => Pod::className(), 'targetAttribute' => ['pod' => 'idpod']],
            [['typeTs'], 'exist', 'skipOnError' => true, 'targetClass' => Typets::className(), 'targetAttribute' => ['typeTs' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'idTs' => 'Id Ts',
            'gosNum' => 'Gos Num',
            'typeTs' => 'Type Ts',
            'id_model' => 'Id Model',
            'model' => 'Model',
            'V' => 'V',
            'fil' => 'Fil',
            'pod' => 'Pod',
            'comment' => 'Comment',
            'inv' => 'Инвентарный номер'
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFil0()
    {
        return $this->hasOne(Fil::className(), ['idfil' => 'fil']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdModel0()
    {
        return $this->hasOne(Model::className(), ['idmodel' => 'id_model']);
    }
    public function getIdMarka0()
    {
        return $this->hasOne(Marka::className(), ['Id' => 'idMarka']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPod0()
    {
        return $this->hasOne(Pod::className(), ['idpod' => 'pod']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTypeTs0()
    {
        return $this->hasOne(Typets::className(), ['id' => 'typeTs']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getInsts()
    {
        return $this->hasMany(Inst::className(), ['idAuto' => 'idTs']);
    }
}
