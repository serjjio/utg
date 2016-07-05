<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "installer".
 *
 * @property string $integrator
 * @property integer $id
 *
 * @property Inst[] $insts
 */
class Installer extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'installer';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['integrator'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'integrator' => 'Установщик',
            'id' => 'ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getInsts()
    {
        return $this->hasMany(Inst::className(), ['idInstaller' => 'id']);
    }
}
