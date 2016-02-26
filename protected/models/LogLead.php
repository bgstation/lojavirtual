<?php

/**
 * This is the model class for table "logs_leads".
 *
 * The followings are the available columns in table 'logs_leads':
 * @property integer $id
 * @property integer $lead_id
 * @property integer $utm_source_id
 * @property integer $utm_medium_id
 * @property integer $usuario_id
 * @property string $ip
 * @property string $datahora_insercao
 * @property string $datahora_ultima_atualizacao
 */
class LogLead extends CActiveRecord {
    
    public $total;

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'logs_leads';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        return array(
            array('lead_id, utm_source_id, utm_medium_id, usuario_id', 'numerical', 'integerOnly' => true),
            array('ip', 'length', 'max' => 20),
            array('datahora_insercao, datahora_ultima_atualizacao, total', 'safe'),
            array('id, lead_id, utm_source_id, utm_medium_id, usuario_id, ip, datahora_insercao, datahora_ultima_atualizacao', 'safe', 'on' => 'search'),
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
            'lead_id' => 'Lead',
            'utm_source_id' => 'UTM Source',
            'utm_medium_id' => 'UTM Medium',
            'usuario_id' => 'Usuário',
            'ip' => 'IP',
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
        $criteria->compare('utm_source_id', $this->utm_source_id);
        $criteria->compare('utm_medium_id', $this->utm_medium_id);
        $criteria->compare('usuario_id', $this->usuario_id);
        $criteria->compare('ip', $this->ip, true);
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
     * @return LogLead the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }
    
    public static function montarGrafico($dataInicio, $dataFim, $aDados) {
        $aDias = array();
        $dataInicio = date("Y-m-d", strtotime($dataInicio));
        $dataFim = date("Y-m-d", strtotime($dataFim));

        $cont = 0;
        $aDataHora = explode(' ', $dataInicio);
        $aData = explode('-', $aDataHora[0]);
        
        $total = self::verificaTotalDados($aDados, $aDataHora[0]);
        
        $aDias[$cont]['dia'] = $aData[2];
        $aDias[$cont]['mes'] = ($aData[1] - 1);
        $aDias[$cont]['ano'] = $aData[0];
        $aDias[$cont]['total'] = $total;

        $dataAtual = $dataInicio;

        while ($dataAtual < $dataFim) {
            $cont++;
            $dataAtual = date("Y-m-d", strtotime("+1 day", strtotime($dataAtual)));
            $aData = explode('-', $dataAtual);
            
            $total = self::verificaTotalDados($aDados, $dataAtual);
            
            $aDias[$cont]['dia'] = $aData[2];
            $aDias[$cont]['mes'] = ($aData[1] - 1);
            $aDias[$cont]['ano'] = $aData[0];
            $aDias[$cont]['total'] = $total;
        }
        
        return $aDias;
    }

    public static function getDadosCampanha($id) {
        $oLead = Lead::model()->findByPk($id);
        $oLogLead = self::model()->findAll(array(
            'select' => 'date(datahora_insercao) as datahora_insercao, count(*) as total',
            'condition' => 'date(datahora_insercao) between "' . $oLead->data_inicio . '" AND "' . $oLead->data_fim . '"',
            'group' => 'date(datahora_insercao)',
        ));
        $aReturn = array();
        $cont = 0;
        foreach ($oLogLead as $log) {
            $aReturn[$cont]['data_hora'] = $log->datahora_insercao;
            $aReturn[$cont]['total'] = $log->total;
            $cont++;
        }
        $aRetorno = self::montarGrafico($oLead->data_inicio, $oLead->data_fim, $aReturn);
        $dadosGrafico = '';
        foreach ($aRetorno as $retorno) {
            $dadosGrafico .= '[new Date(' . $retorno['ano'] . ', ' . $retorno['mes'] . ', ' . $retorno['dia'] . '), ' . $retorno['total'] . '],';
        }
        return $dadosGrafico;
    }
    
    public static function verificaTotalDados($aDados, $data) {
        foreach ($aDados as $dados) {
            if ($dados['data_hora'] == $data) {
                return $dados['total'];
            }
        }
        return 0;
    }

}
