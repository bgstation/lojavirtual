<?php

/**
 * This is the model class for table "usuarios".
 *
 * The followings are the available columns in table 'usuarios':
 * @property integer $id
 * @property string $nome
 * @property string $email
 * @property string $senha
 * @property integer $tipo_usuario_id
 * @property integer $role_id
 * @property string $facebook_id
 * @property integer $excluido
 * @property string $datahora_insercao
 * @property string $datahora_ultima_atualizacao
 */
class Usuario extends CActiveRecord {
    
    public $confirmar_senha;
    
    const ADMINISTRADOR = 1;
    const CLIENTE = 2;

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'usuarios';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        return array(
            array('tipo_usuario_id, role_id', 'numerical', 'integerOnly' => true),
            array('nome, email', 'length', 'max' => 250),
            array('senha', 'length', 'max' => 100),
            array('facebook_id', 'length', 'max' => 50),
            array('nome, email, senha', 'required'),
            array('email', 'unique'),
            array('datahora_insercao, datahora_ultima_atualizacao', 'safe'),
            array('id, nome, email, senha, tipo_usuario_id, role_id, facebook_id, excluido, datahora_insercao, datahora_ultima_atualizacao', 'safe', 'on' => 'search'),
            array('senha, confirmar_senha', 'required', 'on' => 'cadastro_simplificado'),
            array('senha', 'tratarSenha'),
            array('email', 'validarEmail'),
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
            $oLogLeadItem->tipo_item = LogLeadItem::USUARIO;
            $oLogLeadItem->item_id = $this->id;
        }
        return parent::afterSave();
    }

    public function tratarSenha($attribute, array $params = array()) {
        $isNovoRegistroOuSenhaMudou = ($this->isNewRecord || $this->confirmar_senha);

        if ($isNovoRegistroOuSenhaMudou && $this->validarConfirmacaoSenha()) {
            $this->protegerSenha();
        }
    }

    protected function validarConfirmacaoSenha() {
        $confere = $this->senha == $this->confirmar_senha;
        if (!$confere) {
            $this->addError('confirmar_senha', 'A confirmação de senha deve ser igual a senha.');
        }
        return $confere;
    }

    protected function protegerSenha() {
        $this->senha = md5($this->senha);
        return true;
    }
    
    public function validarEmail($attribute, $params) {
        if (!filter_var($this->email, FILTER_VALIDATE_EMAIL)) {
            $this->addError($attribute, 'Email inválido.');
        }
    }
    
    public function validarNome($attribute, $params) {
        $nome = explode(' ', trim($this->nome));
        if (count($nome) < 2) {
            $this->addError($attribute, 'Você deve preencher seu nome completo.');
        }
        return true;
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        return array(
            'tipoUsuario' => array(self::BELONGS_TO, 'TipoUsuario', 'tipo_usuario_id'),
            'cliente' => array(self::BELONGS_TO, 'Cliente', 'role_id'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'id' => 'ID',
            'nome' => 'Nome',
            'email' => 'Email',
            'senha' => 'Senha',
            'tipo_usuario_id' => 'Tipo Usuário',
            'role_id' => 'Role',
            'facebook_id' => 'Facebook',
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
        $criteria->compare('nome', $this->nome, true);
        $criteria->compare('email', $this->email, true);
        $criteria->compare('senha', $this->senha, true);
        $criteria->compare('tipo_usuario_id', $this->tipo_usuario_id);
        $criteria->compare('role_id', $this->role_id);
        $criteria->compare('facebook_id', $this->facebook_id, true);
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
     * @return Usuario the static model class
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

    public function tratarNome() {
        $nome = preg_replace('/\d/', '', $this->nome);
        $nome = preg_replace('/[\n\t\r]/', ' ', $nome);
        $nome = preg_replace('/\s(?=\s)/', '', $nome);
        $nome = str_replace('-', ' ', $nome);
        $nome = trim($nome);
        return $nome;
    }

    public function verificarCadastroCompleto() {
        $oCliente = $this->cliente;
        if (empty($oCliente->cpf) || empty($oCliente->endereco) || empty($oCliente->cidade) || empty($oCliente->uf)) {
            return false;
        }
        return true;
    }

    public function carregarPermissoes() {
        $oTipoUsuarioRota = TipoUsuarioRota::model()->naoExcluido()->findAllByAttributes(array(
            'tipo_usuario_id' => $this->tipo_usuario_id,
        ));
        $_aPermissoes = array();
        if (!empty($oTipoUsuarioRota)) {
            if (!empty($_SESSION[base64_encode(Yii::app()->params['projeto'] . '_PermissoesAcesso')][base64_encode('PermissoesAcessoUsuario')])) {
                unset($_SESSION[base64_encode(Yii::app()->params['projeto'] . '_PermissoesAcesso')][base64_encode('PermissoesAcessoUsuario')]);
            }
            foreach ($oTipoUsuarioRota as $tipoUsuarioRota) {
                $_aPermissoes[base64_encode(Yii::app()->params['projeto'] . '_PermissoesAcesso')][base64_encode('PermissoesAcessoUsuario')][base64_encode($tipoUsuarioRota->rota->controller)][base64_encode('actions')][] = base64_encode($tipoUsuarioRota->rota->action);
            }
            Yii::app()->user->setState('__' . base64_encode(Yii::app()->params['projeto'] . '_PermissoesAcessoUsuario'), $_aPermissoes);
        }
    }

}
