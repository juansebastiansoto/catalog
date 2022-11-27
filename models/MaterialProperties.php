<?php

namespace app\models;

use Yii;

use app\models\TemplateProperties;

/**
 * This is the model class for table "materialProperties".
 *
 * @property string $id ID del material
 * @property string $property ID de la propiedad
 * @property string $template ID del template de la propiedad
 * @property string $value Valor de la propiedad
 *
 * @property Material $id0
 * @property TemplateProperties $template0
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
            [['template', 'value'], 'required'],
            [['id', 'property', 'template'], 'string', 'max' => 36],
            [['value'], 'string', 'max' => 60],
            [['id', 'property'], 'unique', 'targetAttribute' => ['id', 'property']],
            [['id'], 'exist', 'skipOnError' => true, 'targetClass' => Material::class, 'targetAttribute' => ['id' => 'id']],
            //[['template'], 'exist', 'skipOnError' => true, 'targetClass' => TemplateProperties::class, 'targetAttribute' => ['template' => 'id']],
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
            'template' => 'Propiedad',
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
     * Gets query for [[Template0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTemplate0()
    {
        return $this->hasOne(TemplateProperties::class, ['property' => 'template']);
    }

    public function beforeSave($insert)
    {

        $templateProperty = TemplateProperties::find()->where(['property' => $this->template])->one();

        $valid = false;

        switch ($templateProperty->valueType) {
            case 'I': // Numérico

                $valid = $this->validateNumeric($this->value);
                break;

            case 'O': // Opciones

                $valid = $this->validateOption($this->value, $templateProperty->options);
                break;

            case 'T': // Texto libre

                $valid = true;
                break;
        }

        if (!$valid) {
            $this->addError('value', 'El valor no es correcto para la propiedad');
        }

        return parent::beforeSave($insert) && $valid;
    }

    protected function validateNumeric($value)
    {
        return is_numeric($value);
    }

    protected function validateOption($value, $options)
    {
        if (stripos($options, $value) === false) {
            return false;
        }

        return true;
    }
}
