<?php

namespace app\models;

use Yii;
use app\components\PseudoCrypt;

/**
 * This is the model class for table "links".
 *
 * @property integer $link_id
 * @property string $full_address
 * @property string $link_hash
 */
class Links extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'links';
    }

    /**
     * Return link by hash
     * @param $hash
     * @return array|null|\yii\db\ActiveRecord
     */
    public static function getFullLinkByHash($hash){
        return Links::find()->where(['link_hash'=>$hash])->one();
    }

    /**
     * return hash string
     *
     * @param string $link
     * @return string
     */
    public static function generateHash($link){
        $link = crc32($link);
        return PseudoCrypt::hash($link);
    }

    /**
     *
     * Правила для валидации
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['full_address'], 'required', 'message'=>'{attribute} не может быть пустой!'],
            [['full_address'], 'filter', 'filter' => 'trim'],
            [['full_address'], 'string', 'max' => 2048],
            [['link_hash'], 'string', 'max' => 32],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'link_id' => 'Link ID',
            'full_address' => 'Ссылка',
            'link_hash' => 'Link Hash',
        ];
    }
}
