<?php

namespace wo\settings\models;

use Yii;
use yii\helpers\ArrayHelper;

class Settings extends \yii\db\ActiveRecord
{
    public static function tableName()
    {
        return '{{settings}}';
    }

    public function rules()
    {
        return [
            [['value'], 'string'],
            [['type', 'section', 'key'], 'string', 'max' => 255],
            [['type','section','key'],'required'],
            [['type'],'in','range' => ['string','integer','boolean','float','null']],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'type' => 'Type',
            'section' => 'Section',
            'key' => 'Key',
            'value' => 'Value',
        ];
    }

    public function getSettings()
    {
        $settings = static::find()->asArray()->all();
        return array_merge_recursive(
            ArrayHelper::map($settings, 'key', 'value', 'section'),
            ArrayHelper::map($settings, 'key', 'type', 'section')
        );
    }

    public function setSetting($section, $key, $value, $type = null)
    {
        $model = static::findOne(['section' => $section, 'key' => $key]);
        if ($model === null) {
            $model = new static();
        }
        $model->section = $section;
        $model->key = $key;
        $model->value = strval($value);
        if ($type !== null) {
            $model->type = $type;
        } else {
            $model->type = gettype($value);
        }
        return $model->save();
    }

    public function deleteSetting($section, $key)
    {
        $model = static::findOne(['section' => $section, 'key' => $key]);
        if ($model) {
            return $model->delete();
        }
        return true;
    }
    
    public function deleteAllSettings()
    {
        return static::deleteAll();
    }

}
