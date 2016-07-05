<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "marka".
 *
 * @property integer $Id
 * @property string $marka
 *
 * @property Auto[] $autos
 */
class Marka extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'marka';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['marka'], 'required', 'message' => 'Поле не заполнено'],
            [['marka'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'Id' => 'ID',
            'marka' => 'Marka',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getModel0()
    {
        return $this->hasMany(Model::className(), ['idMarka' => 'Id']);
    }
}
