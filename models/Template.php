<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "template".
 *
 * @property string $id ID del template
 * @property string $name Nombre del template
 * @property string $namePattern Patrón de nombrado
 *
 * @property Material[] $materials
 * @property TemplateProperties[] $templateProperties
 */
class Template extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'template';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'namePattern'], 'required'],
            [['namePattern'], 'string'],
            [['id'], 'string', 'max' => 36],
            [['name'], 'string', 'max' => 60],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID del template',
            'name' => 'Nombre de la plantilla',
            'namePattern' => 'Patrón de nombrado',
        ];
    }

    /**
     * Gets query for [[Materials]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getMaterials()
    {
        return $this->hasMany(Material::class, ['template' => 'id']);
    }

    /**
     * Gets query for [[TemplateProperties]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTemplateProperties()
    {
        return $this->hasMany(TemplateProperties::class, ['id' => 'id']);
    }

    public function beforeSave($insert) {
        
        if ($insert) {
            $this->id = Yii::$app->myClass->guidv4();
        }

        return parent::beforeSave($insert);
    }

}
