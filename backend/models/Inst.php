<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "inst".
 *
 * @property integer $ID
 * @property string $date
 * @property string $point
 * @property integer $idAuto
 * @property integer $blok
 * @property integer $idInstaller
 * @property integer $V
 * @property integer $dut
 * @property integer $biz
 * @property double $moto
 * @property string $comment
 * @property integer $col
 *
 * @property Col $col0
 * @property Auto $idAuto0
 * @property Installer $idInstaller0
 */
class Inst extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public $fil;
    public static function tableName()
    {
        return 'inst';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['date', 'id_fil', 'id_pod', 'comment', 'blok'], 'safe'],
            [['idAuto', 'idInstaller','blok'], 'required', 'message' => 'Поле не заполнено'],
            [['idAuto', 'idInstaller', 'V', 'dut', 'biz', 'col', 'active'], 'integer'],
            [['moto'], 'number'],
            [['point'], 'string', 'max' => 255],
            [['col'], 'exist', 'skipOnError' => true, 'targetClass' => Col::className(), 'targetAttribute' => ['col' => 'id']],
            [['blok'], 'exist', 'skipOnError' => true, 'targetClass' => Unit::className(), 'targetAttribute' => ['blok' => 'blok']],
            [['idAuto'], 'exist', 'skipOnError' => true, 'targetClass' => Auto::className(), 'targetAttribute' => ['idAuto' => 'idTs']],
            [['idInstaller'], 'exist', 'skipOnError' => true, 'targetClass' => Installer::className(), 'targetAttribute' => ['idInstaller' => 'id']],
            [['id_fil'], 'exist', 'skipOnError' => true, 'targetClass' => Fil::className(), 'targetAttribute' => ['id_fil' => 'idfil']],
            [['id_pod'], 'exist', 'skipOnError' => true, 'targetClass' => Pod::className(), 'targetAttribute' => ['id_pod' => 'idpod']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'ID' => 'ID',
            'date' => 'Дата',
            'point' => 'Город',
            'idAuto' => 'Авто',
            'blok' => 'Блок',
            'idInstaller' => 'Установщик',
            'V' => 'Вольтаж',
            'dut' => 'Dut',
            'biz' => 'Biz',
            'moto' => 'Moto',
            'comment' => 'Comment',
            'col' => 'Статус',
            'id_fil' => 'Fil',
            'id_pod' => 'Pod'
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCol0()
    {
        return $this->hasOne(Col::className(), ['id' => 'col']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdAuto0()
    {
        return $this->hasOne(Auto::className(), ['idTs' => 'idAuto']);
    }

    public function getIdFil0()
    {
        return $this->hasOne(Fil::className(), ['idfil' => 'id_fil']);
    }

     public function getIdPod0()
    {
        return $this->hasOne(Pod::className(), ['idpod' => 'id_pod']);
    }



    public function getBlok0()
    {
        return $this->hasOne(Unit::className(), ['blok' => 'blok']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdInstaller0()
    {
        return $this->hasOne(Installer::className(), ['id' => 'idInstaller']);
    }
}
