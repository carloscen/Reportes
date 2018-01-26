<?php

namespace backend\models;

use Yii;
use common\models\User;

/**
 * This is the model class for table "estado".
 *
 * @property int $id
 * @property string $estado_nombre
 * @property int $estado_valor
 *
 * @property User[] $users
 */
class Estado extends \yii\db\ActiveRecord {

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'estado';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['estado_nombre', 'estado_valor'], 'required'],
            [['estado_valor'], 'integer'],
            [['estado_nombre'], 'string', 'max' => 45],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'id' => 'ID',
            'estado_nombre' => 'Estado Nombre',
            'estado_valor' => 'Estado Valor',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUsers() {
        return $this->hasMany(User::className(), ['estado_id' => 'id']);
    }

    /**
     * relación get estado
     *
     */
    public function getEstado() {
        return $this->hasOne(Estado::className(), ['id' => 'estado_id']);
    }

    /**
     * * get estado nombre
     *
     */
    public function getEstadoNombre() {
        return $this->estado ? $this->estado->estado_nombre : '- sin estado -';
    }

    /**
     * get lista de estados para lista desplegable
     */
    public static function getEstadoLista() {
        $dropciones = Estado::find()->asArray()->all();
        return ArrayHelper::map($dropciones, 'id', 'estado_nombre');
    }

}
