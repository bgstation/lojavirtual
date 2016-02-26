<?php

/**
 * This is the model class for table "logs_leads_itens".
 *
 * The followings are the available columns in table 'logs_leads_itens':
 * @property integer $id
 * @property integer $lead_id
 * @property integer $log_lead_id
 * @property integer $tipo_item
 * @property integer $item_id
 * @property string $datahora_insercao
 * @property string $datahora_ultima_atualizacao
 */
class LogLeadItem extends CActiveRecord {
    
    const USUARIO = 1;
    const CARRINHO = 2;
    const PEDIDO = 3;

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'logs_leads_itens';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        return array(
            array('lead_id, log_lead_id, tipo_item, item_id', 'numerical', 'integerOnly' => true),
            array('datahora_insercao, datahora_ultima_atualizacao', 'safe'),
            array('id, lead_id, log_lead_id, tipo_item, item_id, datahora_insercao, datahora_ultima_atualizacao', 'safe', 'on' => 'search'),
        );
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
            'lead_id' => 'Lead',
            'log_lead_id' => 'Log Lead',
            'tipo_item' => 'Tipo Item',
            'item_id' => 'Tipo Item',
            'datahora_insercao' => 'Datahora Inserção',
            'datahora_ultima_atualizacao' => 'Datahora Última Atualização',
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
        $criteria->compare('lead_id', $this->lead_id);
        $criteria->compare('log_lead_id', $this->log_lead_id);
        $criteria->compare('tipo_item', $this->tipo_item);
        $criteria->compare('item_id', $this->item_id);
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
     * @return LogLeadItem the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

}
