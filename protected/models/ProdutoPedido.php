<?php

/**
 * This is the model class for table "produtos_pedidos".
 *
 * The followings are the available columns in table 'produtos_pedidos':
 * @property integer $id
 * @property integer $pedido_id
 * @property integer $produto_id
 * @property integer $pacote_id
 * @property string $valor
 * @property string $data_liberacao
 * @property string $data_expiracao
 * @property string $datahora_insercao
 * @property string $datahora_ultima_atualizacao
 */
class ProdutoPedido extends CActiveRecord {

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'produtos_pedidos';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        return array(
            array('pedido_id, produto_id, pacote_id', 'numerical', 'integerOnly' => true),
            array('valor', 'length', 'max' => 10),
            array('data_liberacao, data_expiracao, datahora_insercao, datahora_ultima_atualizacao', 'safe'),
            array('id, pedido_id, produto_id, pacote_id, valor, data_liberacao, data_expiracao, datahora_insercao, datahora_ultima_atualizacao', 'safe', 'on' => 'search'),
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
            'produto' => array(self::BELONGS_TO, 'Produto', 'produto_id'),
            'pedido' => array(self::BELONGS_TO, 'Pedido', 'pedido_id'),
            'pacote' => array(self::BELONGS_TO, 'Pacote', 'pacote_id'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'id' => 'ID',
            'pedido_id' => 'Pedido',
            'produto_id' => 'Produto',
            'pacote_id' => 'Pacote',
            'valor' => 'Valor',
            'data_liberacao' => 'Data Liberação',
            'data_expiracao' => 'Data Expiração',
            'datahora_insercao' => 'Datahora Inserção',
            'datahora_ultima_atualizacao' => 'Datahora Última Atualização',
        );
    }

    public function scopes() {
        return array(
            'naoExpirado' => array(
                'condition' => 'DATE(data_expiracao) >= NOW()'
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
        $criteria->compare('pedido_id', $this->pedido_id);
        $criteria->compare('produto_id', $this->produto_id);
        $criteria->compare('pacote_id', $this->pacote_id);
        $criteria->compare('valor', $this->valor, true);
        $criteria->compare('data_liberacao', $this->data_liberacao, true);
        $criteria->compare('data_expiracao', $this->data_expiracao, true);
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
     * @return ProdutoPedido the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    public function getValorPacote() {
        $oProdutoPedido = ProdutoPedido::model()->findAllByAttributes(array(
            'pedido_id' => $this->pedido_id,
            'pacote_id' => $this->pacote_id,
        ));
        $valorTotal = 0;
        foreach ($oProdutoPedido as $produtoPedido) {
            $valorTotal += $produtoPedido->valor;
        }
        return $valorTotal;
    }

    public static function getValorTotalPedidoExistente($pedidoId, $colaboradorId = null) {
        $criteria = array();
        if (!empty($colaboradorId)) {
            $criteria['join'] = 'JOIN produtos as p ON (t.produto_id = p.id) '
                    . 'JOIN didatico_biblioteca.bibliotecas b ON b.id = p.biblioteca_id';
            $aCondition[] = 'b.colaborador_id=' . $colaboradorId;
        }

        $aCondition[] = 'pedido_id=' . $pedidoId;
        $criteria['condition'] = implode(' AND ', $aCondition);
        $valorPedido = 0;
        $oProdutoPedido = ProdutoPedido::model()->findAll($criteria);
        foreach ($oProdutoPedido as $produto) {
            $valorPedido += $produto->valor_produto;
        }
        return $valorPedido;
    }

}