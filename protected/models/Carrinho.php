<?php

/**
 * This is the model class for table "carrinho".
 *
 * The followings are the available columns in table 'carrinho':
 * @property integer $id
 * @property integer $usuario_id
 * @property integer $produto_id
 * @property integer $pacote_id
 * @property string $valor
 * @property integer $excluido
 * @property string $datahora_insercao
 * @property string $datahora_ultima_atualizacao
 */
class Carrinho extends CActiveRecord {

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'carrinho';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        return array(
            array('usuario_id, produto_id, pacote_id', 'numerical', 'integerOnly' => true),
            array('valor', 'length', 'max' => 10),
            array('datahora_insercao, datahora_ultima_atualizacao', 'safe'),
            array('id, usuario_id, produto_id, pacote_id, valor, excluido, datahora_insercao, datahora_ultima_atualizacao', 'safe', 'on' => 'search'),
        );
    }

    public function beforeSave() {
        if ($this->isNewRecord && empty($this->datahora_insercao)) {
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
            $oLogLeadItem->tipo_item = LogLeadItem::CARRINHO;
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
            'produto' => array(self::BELONGS_TO, 'Produto', 'produto_id'),
            'pacote' => array(self::BELONGS_TO, 'Pacote', 'pacote_id'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'id' => 'ID',
            'usuario_id' => 'Usuário',
            'produto_id' => 'Produto',
            'pacote_id' => 'Pacote',
            'valor' => 'Valor',
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
            'itemProduto' => array(
                'condition' => 't.pacote_id is null',
            ),
            'itemPacote' => array(
                'condition' => 't.pacote_id is not null',
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
        $criteria->compare('usuario_id', $this->usuario_id);
        $criteria->compare('produto_id', $this->produto_id);
        $criteria->compare('pacote_id', $this->pacote_id);
        $criteria->compare('valor', $this->valor, true);
        $criteria->compare('excluido', $this->excluido);
        $criteria->compare('datahora_insercao', $this->datahora_insercao, true);
        $criteria->compare('datahora_ultima_atualizacao', $this->datahora_ultima_atualizacao, true);

        $criteria->addCondition('excluido = false');

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return Carrinho the static model class
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

    public function getValorPacote() {
        $valor = 0;
        $oCarrinho = Carrinho::model()->naoExcluido()->findAllByAttributes(array(
            'usuario_id' => $this->usuario_id,
            'pacote_id' => $this->pacote_id,
        ));
        foreach ($oCarrinho as $carrinho) {
            $valor += $carrinho->valor;
        }
        return $valor;
    }

    public static function getValorPacoteSession($pacoteId) {
        $valorTotal = 0;
        foreach ($_SESSION['pacote_carrinho'] as $key => $pacote) {
            if ($_SESSION['pacote_carrinho'][$key]['id'] == $pacoteId) {
                $valorTotal += $_SESSION['pacote_carrinho'][$key]['valor'];
            }
        }
        return $valorTotal;
    }

    public function getValorTotal() {
        $valor = 0;
        $oCarrinho = Carrinho::model()->naoExcluido()->findAllByAttributes(array(
            'usuario_id' => $this->usuario_id,
        ));
        foreach ($oCarrinho as $carrinho) {
            $valor += $carrinho->valor;
        }
        return $valor;
    }

    public static function adicionarProdutosFromSession() {
        if (!empty($_SESSION['prod_carrinho'])) {
            Carrinho::model()->deleteAll(array(
                'condition' => 'usuario_id = ' . Yii::app()->user->getId() . ' AND excluido = false AND pacote_id is null'
            ));
            foreach ($_SESSION['prod_carrinho'] as $index => $value) {
                $oCarrinho = new Carrinho();
                $oCarrinho->produto_id = $value['id'];
                $oCarrinho->usuario_id = Yii::app()->user->getId();
                $oCarrinho->valor = !empty($value['valor']) ? $value['valor'] : 0;
                $oCarrinho->datahora_insercao = $value['datahora_insercao'];
                $oCarrinho->excluido = false;
                if (!$oCarrinho->save()) {
                    return false;
                }
            }
        }
        return true;
    }

    public static function adicionarPacoteFromSession() {
        if (!empty($_SESSION['pacote_carrinho'])) {
            Carrinho::model()->deleteAll(array(
                'condition' => 'usuario_id = ' . Yii::app()->user->getId() . ' AND excluido = false AND pacote_id is not null'
            ));
            foreach ($_SESSION['pacote_carrinho'] as $index => $value) {
                $oCarrinho = new Carrinho();
                $oCarrinho->pacote_id = $value['id'];
                $oCarrinho->produto_id = $value['produto_id'];
                $oCarrinho->usuario_id = Yii::app()->user->getId();
                $oCarrinho->valor = $value['valor'];
                $oCarrinho->datahora_insercao = $value['datahora_insercao'];
                $oCarrinho->excluido = false;
                if (!$oCarrinho->save()) {
                    return false;
                }
            }
        }
        return true;
    }

    public static function finalizar($pedidoId = null, $pedidoExistente = false) {
        $url = 'https://ws.pagseguro.uol.com.br/v2/checkout';

        $data['email'] = Yii::app()->params['email_pagseguro'];
        $data['token'] = Yii::app()->params['token_pagseguro'];

        $pedidoId = Pedido::getPedido($pedidoId);
        $oPedido = Pedido::model()->findByPk($pedidoId);

        $usuarioId = $pedidoExistente ? $oPedido->usuario_id : Yii::app()->user->getId();
        $oUsuario = Usuario::model()->findByPk($usuarioId);
        $oCliente = Cliente::model()->findByPk($oUsuario->role_id);

        if ($pedidoExistente) {
            $oCupomDesconto = CupomDescontoPorUsuario::retornarCupomDeDescontoDoPedido($oPedido->id);
            $valorPedido = ProdutoPedido::getValorTotalPedidoExistente($oPedido->id);
        } else {
            $oCupomDesconto = CupomDescontoPorUsuario::retornarCupomDeDescontoUsuarioUtilizando();
            if (!empty($oCupomDesconto->cupom->titulo)) {
                CupomDescontoPorUsuario::desutilizarCupom();
            }
        }

        if (empty($oPedido->produtos)) {
            $oPedido->AdicionarProdutos();
        }
        $valorPedido = $oPedido->getValorTotal();

        $data['reference'] = $oPedido->id;
        $data['currency'] = 'BRL';
        $data['itemId1'] = '0001';
        $data['itemDescription1'] = 'Pedido ' . $oPedido->id;
        $data['itemAmount1'] = $valorPedido;
        $data['itemQuantity1'] = '1';
        $data['senderName'] = utf8_decode($oUsuario->tratarNome());
        $data['senderAreaCode'] = $oCliente->getCodigoCelular();
        $data['senderPhone'] = $oCliente->getCelular();
        $data['senderEmail'] = utf8_decode($oUsuario->email);
        $data['senderCPF'] = $oCliente->tratarCpf();
        $data['shippingType'] = '3';
        $data['shippingAddressStreet'] = utf8_decode($oCliente->endereco);
        $data['shippingAddressNumber'] = utf8_decode($oCliente->numero);
        $data['shippingAddressComplement'] = utf8_decode($oCliente->complemento);
        $data['shippingAddressDistrict'] = utf8_decode($oCliente->bairro);
        $data['shippingAddressPostalCode'] = utf8_decode($oCliente->cep);
        $data['shippingAddressCity'] = utf8_decode($oCliente->cidade);
        $data['shippingAddressState'] = utf8_decode($oCliente->uf);
        $data['shippingAddressCountry'] = 'BRA';

        $data = http_build_query($data);
        $curl = curl_init($url);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
        $xml = curl_exec($curl);

        $oDidaticoEmail = new Email();
        $oDidaticoEmail->destinatarios = Yii::app()->params['emailTecnico'];
        $oDidaticoEmail->mensagem = '';

        if ($xml == 'Unauthorized') {
            $oDidaticoEmail->assunto = 'PagSeguro - Erro de autenticação';
            $oDidaticoEmail->mensagem = 'Projeto : ' . Yii::app()->name . '<br/>';
            $oDidaticoEmail->mensagem .= 'Pedido: ' . $oPedido->id . '<br/>';
            $oDidaticoEmail->mensagem .= 'Cliente: ' . $oCliente->id . '<br/>';
            $oDidaticoEmail->enviar();
            echo 'unauthorized';
        } else {
            curl_close($curl);
            $xml = simplexml_load_string($xml);
            if (count($xml->error) > 0) {
                $oDidaticoEmail->assunto = 'PagSeguro - Erro na validação dos dados';
                $oDidaticoEmail->mensagem = 'Projeto : ' . Yii::app()->name . '<br/>';
                $oDidaticoEmail->mensagem .= 'Erro: ' . json_encode($xml->error) . '<br/>';
                $oDidaticoEmail->mensagem .= 'Pedido: ' . $oPedido->id . '<br/>';
                $oDidaticoEmail->mensagem .= 'Cliente: ' . $oCliente->id . '<br/>';
                $oDidaticoEmail->enviar();
                echo 'error';
            } else {
                unset($_SESSION['prod_carrinho']);
                unset($_SESSION['pacote_carrinho']);
                unset($_SESSION['cupom_desconto']);
                echo $xml->code . '|||' . $oPedido->id;
            }
        }
    }

}
