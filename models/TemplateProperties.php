<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "templateProperties".
 *
 * @property string $id ID de la propiedad en el template
 * @property string $property ID de la propiedad
 * @property string $name Nombre de la propiedad
 * @property string $valueType Tipo de valor
 * @property string $options Valores admitidos
 *
 * @property Template $id0
 * @property MaterialProperties[] $materialProperties
 * @property ValueTypes $valueType0
 */
class TemplateProperties extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'templateProperties';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'valueType'], 'required'],
            [['options'], 'string'],
            [['id', 'property'], 'string', 'max' => 36],
            [['name'], 'string', 'max' => 30],
            [['shortname'], 'string', 'max' => 6],
            [['valueType'], 'string', 'max' => 1],
            [['id', 'property'], 'unique', 'targetAttribute' => ['id', 'property']],
            [['id'], 'exist', 'skipOnError' => true, 'targetClass' => Template::class, 'targetAttribute' => ['id' => 'id']],
            [['valueType'], 'exist', 'skipOnError' => true, 'targetClass' => ValueTypes::class, 'targetAttribute' => ['valueType' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID del Template',
            'property' => 'ID de la propiedad',
            'name' => 'Nombre de la propiedad',
            'shortname' => 'Texto para el nombre',
            'valueType' => 'Tipo de valor',
            'options' => 'Valores admitidos',
        ];
    }

    /**
     * Gets query for [[Id0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getId0()
    {
        return $this->hasOne(Template::class, ['id' => 'id']);
    }

    /**
     * Gets query for [[MaterialProperties]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getMaterialProperties()
    {
        return $this->hasMany(MaterialProperties::class, ['tempate' => 'id']);
    }

    /**
     * Gets query for [[ValueType0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getValueType0()
    {
        return $this->hasOne(ValueTypes::class, ['id' => 'valueType']);
    }

    public function beforeSave($insert) {
        
        // Paso el texto a un array, lo ordeno y lo vuelvo a pasar a texto              
        $options = explode("\n", $this->options);
        sort($options, SORT_STRING);
        $this->options = implode($options);

        return parent::beforeSave($insert);
    }  
    
}
