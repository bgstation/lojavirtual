<?php

/**
 * This is the model class for table "configuracoes".
 *
 * The followings are the available columns in table 'configuracoes':
 * @property integer $id
 * @property string $codigo
 * @property string $valor
 * @property string $descricao
 * @property integer $exibir
 * @property integer $excluido
 * @property integer $tipo
 * @property string $datahora_insercao
 * @property string $datahora_ultima_atualizacao
 */
class Configuracao extends CActiveRecord {

    public $aTipo = array(
        0 => 'Texto',
//        1 => 'Número',
//        2 => 'Arquivo',
//        3 => 'Condição',
//        4 => 'Cor',
    );

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'configuracoes';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        return array(
            array('tipo', 'numerical', 'integerOnly' => true),
            array('codigo', 'length', 'max' => 50),
            array('valor', 'required'),
            array('valor, descricao, datahora_insercao, datahora_ultima_atualizacao', 'safe'),
            array('id, codigo, valor, descricao, exibir, excluido, tipo, datahora_insercao, datahora_ultima_atualizacao', 'safe', 'on' => 'search'),
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
            'codigo' => 'Código',
            'valor' => 'Valor',
            'descricao' => 'Descrição',
            'exibir' => 'Exibir',
            'excluido' => 'Excluído',
            'tipo' => 'Tipo',
            'datahora_insercao' => 'Datahora Inserção',
            'datahora_ultima_atualizacao' => 'Datahora Ultima Atualização',
        );
    }
    
    public function scopes() {
        return array(
            'naoExcluido' => array(
                'condition' => 't.excluido = false',
            ),
            'exibir' => array(
                'condition' => 't.exibir = true',
            ),
            'pagseguroEmail' => array(
                'condition' => 't.codigo = "PAGSEGURO_EMAIL"',
            ),
            'pagseguroToken' => array(
                'condition' => 't.codigo = "PAGSEGURO_TOKEN"',
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
        $criteria->compare('codigo', $this->codigo, true);
        $criteria->compare('valor', $this->valor, true);
        $criteria->compare('descricao', $this->descricao, true);
        $criteria->compare('exibir', $this->exibir);
        $criteria->compare('excluido', $this->excluido);
        $criteria->compare('tipo', $this->tipo);
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
     * @return Configuracao the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

}
