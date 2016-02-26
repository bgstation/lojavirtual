<?php

/**
 * This is the model class for table "tipos_usuarios_rotas".
 *
 * The followings are the available columns in table 'tipos_usuarios_rotas':
 * @property integer $id
 * @property integer $tipo_usuario_id
 * @property integer $rota_id
 * @property integer $excluido
 * @property string $datahora_insercao
 * @property string $datahora_ultima_atualizacao
 */
class TipoUsuarioRota extends CActiveRecord {

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'tipos_usuarios_rotas';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        return array(
            array('tipo_usuario_id, rota_id', 'numerical', 'integerOnly' => true),
            array('datahora_insercao, datahora_ultima_atualizacao', 'safe'),
            array('id, tipo_usuario_id, rota_id, excluido, datahora_insercao, datahora_ultima_atualizacao', 'safe', 'on' => 'search'),
        );
    }
    
    public function beforeSave() {
        if ($this->isNewRecord) {
            $this->datahora_insercao = new CDbExpression('NOW()');
        }
        $this->datahora_ultima_atualizacao = new CDbExpression('NOW()');
        return parent::beforeSave();
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        return array(
            'rota' => array(self::BELONGS_TO, 'Rota', 'rota_id'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'id' => 'ID',
            'tipo_usuario_id' => 'Tipo Usuário',
            'rota_id' => 'Rota',
            'excluido' => 'Excluído',
            'datahora_insercao' => 'Datahora Inserção',
            'datahora_ultima_atualizacao' => 'Datahora Ultima Atualização',
        );
    }

    public function scopes() {
        return array(
            'naoExcluido' => array(
                'condition' => 't.excluido = false',
            ),
        );
    }

    /**
     * Retrieves a list of models based on the current search/filter conditions.
     *
     * Typical usecase:
     * - Initialize the model fields with values from filter form.
     * - Execute this method to get CActiveDataProvider instance which will filter
     * models according to data in model fields.
     * - Pass data provider to CGridView, CListView or any similar widget.
     *
     * @return CActiveDataProvider the data provider that can return the models
     * based on the search/filter conditions.
     */
    public function search() {
        // @todo Please modify the following code to remove attributes that should not be searched.

        $criteria = new CDbCriteria;

        $criteria->compare('id', $this->id);
        $criteria->compare('tipo_usuario_id', $this->tipo_usuario_id);
        $criteria->compare('rota_id', $this->rota_id);
        $criteria->compare('excluido', $this->excluido);
        $criteria->compare('datahora_insercao', $this->datahora_insercao, true);
        $criteria->compare('datahora_ultima_atualizacao', $this->datahora_ultima_atualizacao, true);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return TipoUsuarioRota the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }
    
    public function marcarComoExcluido() {
        if (!empty($this->tipo_usuario_id)) {
            $oModels = self::model()->naoExcluido()->findAllByAttributes(array(
                'tipo_usuario_id' => $this->tipo_usuario_id,
            ));
            if (!empty($oModels))
                foreach ($oModels as $model) {
                    $model->excluido = 1;
                    $model->save();
                }
        }
    }
    
    public function retornaRotasPorTipoUsuario() {
        $aTipoUsuarioRotas = array();
        if (!empty($this->tipo_usuario_id)) {
            $oModels = self::model()->naoExcluido()->findAllByAttributes(array(
                'tipo_usuario_id' => $this->tipo_usuario_id,
            ));
            foreach ($oModels as $model) {
                $aTipoUsuarioRotas[] = $model->acl_rota_id;
            }
        }
        return $aTipoUsuarioRotas;
    }

    public function excluirRotas() {
        if (!empty($this->tipo_usuario_id)) {
            self::model()->deleteAllByAttributes(array(
                'tipo_usuario_id' => $this->tipo_usuario_id,
            ));
        }
    }
    
    public function salvarTipoUsuarioRotas($post) {
        $this->excluirRotas();
        if (!empty($post['TipoUsuarioRotas'])) {
            foreach ($post['TipoUsuarioRotas'] as $value) {
                $model = new self;
                $model->tipo_usuario_id = $this->tipo_usuario_id;
                $model->rota_id = $value;
                $model->save();
                $this->salvarRotasFilhas($value);
            }
        }
    }

    public function salvarRotasFilhas($aRotaPaiId) {
        $oRotas = Rota::model()->naoExcluido()->naoExibir()->findAllByAttributes(array(
            'rota_id' => $aRotaPaiId
        ));
        if (!empty($oRotas)) {
            foreach ($oRotas as $aRota) {
                $model = new self;
                $model->tipo_usuario_id = $this->tipo_usuario_id;
                $model->acl_rota_id = $aRota->id;
                $model->save();
            }
        }
    }

}
