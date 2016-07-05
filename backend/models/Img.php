<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "img".
 *
 * @property integer $idimg
 * @property string $img_small
 * @property string $img_big
 * @property integer $id_inst
 *
 * @property Inst $idInst
 */
class Img extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */

    public $img_file;


    public static function tableName()
    {
        return 'img';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_inst'], 'required'],
            [['id_inst'], 'integer'],
            [['img_small', 'img_big', 'size'], 'string', 'max' => 250],
            [['id_inst'], 'exist', 'skipOnError' => true, 'targetClass' => Inst::className(), 'targetAttribute' => ['id_inst' => 'ID']],
            [['img_file'], 'file', 'extensions' => ['png', 'jpg']],

        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'idimg' => 'Idimg',
            'img_small' => 'Img Small',
            'img_big' => 'Img Big',
            'id_inst' => 'Id Inst',
            'size' => 'Size',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdInst()
    {
        return $this->hasOne(Inst::className(), ['ID' => 'id_inst']);
    }
}
