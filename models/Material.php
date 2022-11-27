<?php

namespace app\models;

use Yii;

use app\models\MaterialProperties;
use app\models\Template;
use app\models\TemplateProperties;

/**
 * This is the model class for table "material".
 *
 * @property string $id ID del Material
 * @property string $template Template utilizado
 * @property string $name Nombre
 *
 * @property MaterialProperties[] $materialProperties
 * @property Template $template0
 */
class Material extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'material';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['template'], 'required'],
            [['id', 'template'], 'string', 'max' => 36],
            [['name'], 'string', 'max' => 60],
            [['template'], 'exist', 'skipOnError' => true, 'targetClass' => Template::class, 'targetAttribute' => ['template' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID del Material',
            'template' => 'Template utilizado',
            'name' => 'Nombre',
        ];
    }

    /**
     * Gets query for [[MaterialProperties]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getMaterialProperties()
    {
        return $this->hasMany(MaterialProperties::class, ['id' => 'id']);
    }

    /**
     * Gets query for [[Template0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTemplate0()
    {
        return $this->hasOne(Template::class, ['id' => 'template']);
    }

    public function beforeSave($insert) {
        
        if ($insert) {
            $this->id = Yii::$app->myClass->guidv4();
        }

        return parent::beforeSave($insert);
    }
    
    public function generateName($properties) {

        $template = Template::findOne($this->template);
        $templateProperties = TemplateProperties::findAll($template);
        $i = 0;

        $name = $template->namePattern;

        foreach($properties as $property) {

            $i++;
            $value = false;

            foreach($templateProperties as $templateProperty) {

                if ($templateProperty->property === $property->template) {

                    $value = $templateProperty->shortname . $property->value;

                }

            }

            if ($value) {

                $replace = '{p' . $i . '}';
                $name = str_replace($replace, $value, $name);

            }

        }

        return $name;
    }

}
