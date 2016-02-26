<?php

/**
 * This is the model class for table "financeiro".
 *
 * The followings are the available columns in table 'financeiro':
 * @property integer $id
 * @property string $valor_item
 * @property string $valor_cupom
 * @property string $valor_liquido
 * @property integer $cupom_desconto_id
 * @property integer $produto_pedido_id
 * @property string $datahora_insercao
 * @property string $datahora_ultima_atualizacao
 */
class Financeiro extends CActiveRecord {
    
    public $usuario_id;
    public $pedido_id;

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'financeiro';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        return array(
            array('cupom_desconto_id, produto_pedido_id', 'numerical', 'integerOnly' => true),
            array('valor_item, valor_cupom, valor_liquido', 'length', 'max' => 10),
            array('datahora_insercao, datahora_ultima_atualizacao, usuario_id, pedido_id', 'safe'),
            array('id, valor_item, valor_cupom, valor_liquido, cupom_desconto_id, produto_pedido_id, datahora_insercao, datahora_ultima_atualizacao', 'safe', 'on' => 'search'),
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
            'cupomDesconto' => array(self::BELONGS_TO, 'CupomDesconto', 'cupom_desconto_id'),
            'produtoPedido' => array(self::BELONGS_TO, 'ProdutoPedido', 'produto_pedido_id'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'id' => 'ID',
            'valor_item' => 'Valor Produto',
            'valor_cupom' => 'Valor Cupom',
            'valor_liquido' => 'Valor Líquido',
            'cupom_desconto_id' => 'Cupom de Desconto',
            'produto_pedido_id' => 'Produto',
            'datahora_insercao' => 'Datahora Inserção',
            'datahora_ultima_atualizacao' => 'Datahora Última Atualização',
            'usuario_id' => 'Usuário',
            'pedido_id' => 'Pedido',
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
        $criteria->compare('valor_item', $this->valor_item, true);
        $criteria->compare('valor_cupom', $this->valor_cupom, true);
        $criteria->compare('valor_liquido', $this->valor_liquido, true);
        $criteria->compare('cupom_desconto_id', $this->cupom_desconto_id);
        $criteria->compare('produto_pedido_id', $this->produto_pedido_id);
        $criteria->compare('datahora_insercao', $this->datahora_insercao, true);
        $criteria->compare('datahora_ultima_atualizacao', $this->datahora_ultima_atualizacao, true);
        $criteria->compare('usuario_id', $this->usuario_id, true);
        $criteria->compare('pedido_id', $this->pedido_id, true);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return Financeiro the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

}
