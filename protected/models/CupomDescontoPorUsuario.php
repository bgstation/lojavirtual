<?php

/**
 * This is the model class for table "cupons_desconto_por_usuario".
 *
 * The followings are the available columns in table 'cupons_desconto_por_usuario':
 * @property integer $id
 * @property integer $cupom_desconto_id
 * @property integer $pedido_id
 * @property integer $utilizando
 * @property integer $excluido
 * @property string $datahora_insercao
 * @property string $datahora_ultima_atualizacao
 */
class CupomDescontoPorUsuario extends CActiveRecord {

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'cupons_desconto_por_usuario';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        return array(
            array('cupom_desconto_id, pedido_id, utilizando, excluido', 'numerical', 'integerOnly' => true),
            array('datahora_insercao, datahora_ultima_atualizacao', 'safe'),
            array('id, cupom_desconto_id, pedido_id, utilizando, excluido, datahora_insercao, datahora_ultima_atualizacao', 'safe', 'on' => 'search'),
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
            'cupom' => array(self::BELONGS_TO, 'CupomDesconto', 'cupom_desconto_id'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'id' => 'ID',
            'cupom_desconto_id' => 'Cupom Desconto',
            'pedido_id' => 'Pedido',
            'utilizando' => 'Utilizando',
            'excluido' => 'Excluído',
            'datahora_insercao' => 'Datahora Inserção',
            'datahora_ultima_atualizacao' => 'Datahora Última Atualização',
        );
    }

    public function scopes() {
        return array(
            'utilizando' => array(
                'condition' => 't.utilizando = true',
            ),
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
        $criteria->compare('cupom_desconto_id', $this->cupom_desconto_id);
        $criteria->compare('pedido_id', $this->pedido_id);
        $criteria->compare('utilizando', $this->utilizando);
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
     * @return CupomDescontoPorUsuario the static model class
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

    public static function retornarCupomDeDescontoDoPedido($pedidoId) {
        $oCupomPorUsuario = self::model()->findByAttributes(array(
            'pedido_id' => $pedidoId,
        ));
        return $oCupomPorUsuario;
    }

    public static function retornarCupomDeDescontoUsuarioUtilizando() {
        $oCupomDesconto = self::model()->utilizando()->find(array(
            'join' => 'JOIN pedidos p ON p.id = t.pedido_id',
            'condition' => 'p.usuario_id = ' . Yii::app()->user->getId()
        ));
        if (!empty($oCupomDesconto) && $oCupomDesconto->cupom->data_expiracao >= date('Y-m-d H:i:s')) {
            return $oCupomDesconto;
        }
        return null;
    }

    public static function desutilizarCupom() {
        $oCupomDescontoPorUsuario = self::model()->utilizando()->find(array(
            'join' => 'JOIN pedidos p ON p.id = t.pedido_id',
            'condition' => 'p.usuario_id = ' . Yii::app()->user->getId()
        ));
        $oCupomDescontoPorUsuario->utilizando = false;
        $oCupomDescontoPorUsuario->save();
        return true;
    }

}
