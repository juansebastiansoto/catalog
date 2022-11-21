<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "propertyTemplate".
 *
 * @property string $id ID de la propiedad en el template
 * @property string $name Nombre de la propiedad
 * @property string $valueType Tipo de valor
 * @property string $options Valores admitidos
 *
 * @property Property[] $properties
 */
class PropertyTemplate extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'propertyTemplate';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'valueType'], 'required'],
            [['options'], 'string'],
            [['name'], 'string', 'max' => 30],
            [['valueType'], 'string', 'max' => 1],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Nombre de la propiedad',
            'valueType' => 'Tipo de valor',
            'options' => 'Valores admitidos',
        ];
    }

    /**
     * Gets query for [[Properties]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getProperties()
    {
        return $this->hasMany(Property::class, ['tempate' => 'id']);
    }

    public function beforeSave($insert)
    {

        if (!parent::beforeSave($insert)) {
            return false;
        }

        if ($this->valueType === 'O' && $this->options === '') {
            $this->addError('options', 'Si el valor son opciones, debe ingresarlas.');
            return false;
        }

        if ($insert) {
            $this->id = $this->guidv4();
        }

        return true;

    }

    private function guidv4($data = null)
    {
        // Generate 16 bytes (128 bits) of random data or use the data passed into the function.
        $data = $data ?? random_bytes(16);
        assert(strlen($data) == 16);

        // Set version to 0100
        $data[6] = chr(ord($data[6]) & 0x0f | 0x40);
        // Set bits 6-7 to 10
        $data[8] = chr(ord($data[8]) & 0x3f | 0x80);

        // Output the 36 character UUID.
        return vsprintf('%s%s-%s-%s-%s-%s%s%s', str_split(bin2hex($data), 4));
    }
}