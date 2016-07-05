<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "doc".
 *
 * @property integer $iddoc
 * @property string $doc_name
 * @property integer $id_inst
 * @property string $size
 *
 * @property Inst $idInst
 */
class Doc extends \yii\db\ActiveRecord
{

    public $doc_file;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'doc';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_inst'], 'required'],
            [['id_inst'], 'integer'],
            [['doc_name', 'size'], 'string', 'max' => 250],
            [['doc_file'], 'file'],
            [['id_inst'], 'exist', 'skipOnError' => true, 'targetClass' => Inst::className(), 'targetAttribute' => ['id_inst' => 'ID']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'iddoc' => 'Iddoc',
            'doc_name' => 'Doc Name',
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
