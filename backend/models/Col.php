<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "col".
 *
 * @property integer $id
 * @property string $status
 * @property string $comment
 *
 * @property Inst[] $insts
 */
class Col extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'col';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['status', 'comment', 'color'], 'string', 'max' => 255],
            [['color'], 'required', 'message' => 'Цвет не выбран'],
            [['comment'], 'required', 'message' => 'Поле не заполнено'],

        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'status' => 'Status',
            'comment' => 'Статус',
            'color' => 'Цвет'
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getInsts()
    {
        return $this->hasMany(Inst::className(), ['col' => 'id']);
    }

}
