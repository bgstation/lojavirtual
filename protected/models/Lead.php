<?php

/**
 * This is the model class for table "leads".
 *
 * The followings are the available columns in table 'leads':
 * @property integer $id
 * @property string $titulo
 * @property string $data_inicio
 * @property string $data_fim
 * @property string $url_destino
 * @property integer $excluido
 * @property string $datahora_insercao
 * @property string $datahora_ultima_atualizacao
 */
class Lead extends CActiveRecord {

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'leads';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        return array(
            array('titulo, url_destino', 'length', 'max' => 200),
            array('titulo, data_inicio, data_fim, url_destino', 'required'),
            array('data_inicio, data_fim, datahora_insercao, datahora_ultima_atualizacao', 'safe'),
            array('id, titulo, data_inicio, data_fim, url_destino, excluido, datahora_insercao, datahora_ultima_atualizacao', 'safe', 'on' => 'search'),
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
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'id' => 'ID',
            'titulo' => 'Título',
            'data_inicio' => 'Data Início',
            'data_fim' => 'Data Fim',
            'url_destino' => 'Url Destino',
            'excluido' => 'Excluído',
            'datahora_insercao' => 'Datahora Inserção',
            'datahora_ultima_atualizacao' => 'Datahora Última Atualização',
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
        $criteria->compare('titulo', $this->titulo, true);
        $criteria->compare('data_inicio', $this->data_inicio, true);
        $criteria->compare('data_fim', $this->data_fim, true);
        $criteria->compare('url_destino', $this->url_destino, true);
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
     * @return Lead the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }
    
    public function marcarComoExcluido() {
        $transaction = Yii::app()->db->beginTransaction();
        $this->excluido = true;
        $return = $this->save();
        if ($return) {
            $transaction->commit();
        } else {
            $transaction->rollback();
        }
        return $return;
    }

}
