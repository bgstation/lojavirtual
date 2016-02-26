<?php

/**
 * This is the model class for table "pacotes_itens".
 *
 * The followings are the available columns in table 'pacotes_itens':
 * @property integer $id
 * @property integer $pacote_id
 * @property integer $produto_id
 * @property integer $excluido
 * @property string $datahora_insercao
 * @property string $datahora_ultima_atualizacao
 */
class PacoteItem extends CActiveRecord {

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'pacotes_itens';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        return array(
            array('pacote_id, produto_id, excluido', 'numerical', 'integerOnly' => true),
            array('datahora_insercao, datahora_ultima_atualizacao', 'safe'),
            array('id, pacote_id, produto_id, excluido, datahora_insercao, datahora_ultima_atualizacao', 'safe', 'on' => 'search'),
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
            'pacote' => array(self::BELONGS_TO, 'Pacote', 'pacote_id'),
            'produto' => array(self::BELONGS_TO, 'Produto', 'produto_id'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'id' => 'ID',
            'pacote_id' => 'Pacote',
            'produto_id' => 'Produto',
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
        $criteria->compare('pacote_id', $this->pacote_id);
        $criteria->compare('produto_id', $this->produto_id);
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
     * @return PacoteItem the static model class
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

    public function getValorProduto() {
        $valorProduto = $this->produto->getPreco();
        $valor = $valorProduto * (1 - ($this->pacote->desconto / 100));
        return $valor;
    }

}