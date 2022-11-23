<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "materialProperties".
 *
 * @property string $id ID del material
 * @property string $property ID de la propiedad
 * @property string $tempate ID del template de la propiedad
 * @property string $value Valor de la propiedad
 *
 * @property Material $id0
 * @property TemplateProperties $tempate0
 */
class MaterialProperties extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'materialProperties';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'property', 'tempate', 'value'], 'required'],
            [['id', 'property', 'tempate'], 'string', 'max' => 36],
            [['value'], 'string', 'max' => 60],
            [['id', 'property'], 'unique', 'targetAttribute' => ['id', 'property']],
            [['id'], 'exist', 'skipOnError' => true, 'targetClass' => Material::class, 'targetAttribute' => ['id' => 'id']],
            [['tempate'], 'exist', 'skipOnError' => true, 'targetClass' => TemplateProperties::class, 'targetAttribute' => ['tempate' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID del material',
            'property' => 'ID de la propiedad',
            'tempate' => 'ID del template de la propiedad',
            'value' => 'Valor de la propiedad',
        ];
    }

    /**
     * Gets query for [[Id0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getId0()
    {
        return $this->hasOne(Material::class, ['id' => 'id']);
    }

    /**
     * Gets query for [[Tempate0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTempate0()
    {
        return $this->hasOne(TemplateProperties::class, ['id' => 'tempate']);
    }
}
