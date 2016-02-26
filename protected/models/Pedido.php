<?php

/**
 * This is the model class for table "pedidos".
 *
 * The followings are the available columns in table 'pedidos':
 * @property integer $id
 * @property integer $status_pagamento
 * @property integer $usuario_id
 * @property string $datahora_insercao
 * @property string $datahora_ultima_atualizacao
 */
class Pedido extends CActiveRecord {

    public $valor_total;
    
    public $aStatus = array(
        '' => 'Não Finalizado',
        1 => 'Aguardando Pagamento',
        3 => 'Pago',
        4 => 'Disponível',
        7 => 'Cancelado',
    );

    const AGUARDANDO_PAGAMENTO = 1;
    const PAGO = 3;
    const DISPONIVEL = 4;
    const CANCELADO = 7;

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'pedidos';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        return array(
            array('status_pagamento, usuario_id', 'numerical', 'integerOnly' => true),
            array('datahora_insercao, datahora_ultima_atualizacao, valor_total', 'safe'),
            array('id, status_pagamento, usuario_id, datahora_insercao, datahora_ultima_atualizacao', 'safe', 'on' => 'search'),
        );
    }

    public function beforeSave() {
        if ($this->isNewRecord) {
            $this->datahora_insercao = new CDbExpression('NOW()');
        }
        $this->datahora_ultima_atualizacao = new CDbExpression('NOW()');
        return parent::beforeSave();
    }
    
    public function afterSave() {
        if ($this->isNewRecord && !empty($_COOKIE['log_lead_id']) && !empty($_COOKIE['lead_id'])) {
            $oLogLeadItem = new LogLeadItem();
            $oLogLeadItem->lead_id = $_COOKIE['lead_id'];
            $oLogLeadItem->log_lead_id = $_COOKIE['log_lead_id'];
            $oLogLeadItem->tipo_item = LogLeadItem::PEDIDO;
            $oLogLeadItem->item_id = $this->id;
        }
        return parent::afterSave();
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        return array(
            'usuario' => array(self::BELONGS_TO, 'Usuario', 'usuario_id'),
            'cupomDescontoUsuario' => array(self::HAS_ONE, 'CupomDescontoPorUsuario', 'pedido_id'),
            'produtos' => array(self::HAS_MANY, 'ProdutoPedido', 'pedido_id')
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'id' => 'ID',
            'status_pagamento' => 'Status do Pagamento',
            'usuario_id' => 'Usuário',
            'datahora_insercao' => 'Datahora Inserção',
            'datahora_ultima_atualizacao' => 'Datahora Ultima Atualização',
        );
    }

    public function scopes() {
        return array(
            'ultimoPedido' => array(
                'order' => 'id DESC',
                'limit' => '1',
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
        $criteria->compare('status_pagamento', $this->status_pagamento);
        $criteria->compare('usuario_id', $this->usuario_id);
        $criteria->compare('datahora_insercao', $this->datahora_insercao, true);
        $criteria->compare('datahora_ultima_atualizacao', $this->datahora_ultima_atualizacao, true);
        
        $criteria->order = 'datahora_insercao DESC';

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return Pedido the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    public function getValorTotal() {
        $valorTotal = 0;
        $desconto = !empty($this->cupomDescontoUsuario) ? $this->cupomDescontoUsuario->cupom->percentual : 0;
        foreach ($this->produtos as $produtoPedido) {
            $valorTotal += $produtoPedido->valor;
        }
        return $valorTotal * (1 - ($desconto / 100));
    }

    public function AdicionarProdutos() {
        $oCarrinho = Carrinho::model()->naoExcluido()->findAllByAttributes(array(
            'usuario_id' => $this->usuario_id
        ));
        
        foreach ($oCarrinho as $carrinho) {
            $oProdutoPedido = new ProdutoPedido;
            $oProdutoPedido->pedido_id = $this->id;
            $oProdutoPedido->produto_id = $carrinho->produto_id;
            $oProdutoPedido->pacote_id = !empty($carrinho->pacote_id) ? $carrinho->pacote_id : NULL;
            $oProdutoPedido->valor = $carrinho->valor;
            $oProdutoPedido->save();
            
            $carrinho->excluido = true;
            $carrinho->save();
        }
        return true;
    }

    public static function getPedido($pedidoId = null, $usuarioId = null) {
        if (!empty($pedidoId)) {
            $oPedido = Pedido::model()->findByPk($pedidoId);
            $pedidoId = $oPedido->id;
        } else {
            $usuarioId = !empty($usuarioId) ? $usuarioId : Yii::app()->user->getId();
            $oCupomPorUsuario = CupomDescontoPorUsuario::model()->utilizando()->naoExcluido()->find(array(
                'join' => 'JOIN pedidos p ON p.id = t.pedido_id',
                'condition' => 'p.usuario_id = ' . $usuarioId
            ));
            if (empty($oCupomPorUsuario)) {
                $oPedido = self::model()->ultimoPedido()->find();
                $pedidoId = !empty($oPedido) ? $oPedido->id : 150000;
                $pedidoId += 1;
                $oUsuario = Usuario::model()->findByPk($usuarioId);
                $oPedido = new Pedido();
                $oPedido->id = $pedidoId;
                $oPedido->usuario_id = $oUsuario->id;
                $oPedido->save();
            } else {
                $pedidoId = $oCupomPorUsuario->pedido_id;
            }
        }
        return $pedidoId;
    }

    public static function tratarValorPedido($valorPedido, $percentualCupom) {
        $valorPedido = $valorPedido * ((100 - $percentualCupom) / 100);
        $valorPedido = number_format($valorPedido, 2);
        $valorPedido = str_replace(array(','), '', $valorPedido);
        return $valorPedido;
    }

}
