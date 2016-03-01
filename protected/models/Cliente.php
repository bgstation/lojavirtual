<?php

/**
 * This is the model class for table "clientes".
 *
 * The followings are the available columns in table 'clientes':
 * @property integer $id
 * @property string $cpf
 * @property string $telefone
 * @property string $celular
 * @property string $sexo
 * @property string $uf
 * @property string $cidade
 * @property string $cep
 * @property string $numero
 * @property string $complemento
 * @property string $bairro
 * @property string $endereco
 * @property string $data_nascimento
 * @property integer $excluido
 * @property string $datahora_insercao
 * @property string $datahora_ultima_atualizacao
 */
class Cliente extends CActiveRecord {

    public $aSexo = array(
        'f' => 'Feminino',
        'm' => 'Masculino',
    );

    const FEMININO = 'f';
    const MASCULINO = 'm';

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'clientes';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        return array(
            array('cpf', 'length', 'max' => 20),
            array('telefone, celular', 'length', 'max' => 50),
            array('sexo', 'length', 'max' => 1),
            array('uf', 'length', 'max' => 2),
            array('cidade', 'length', 'max' => 150),
            array('cep, numero', 'length', 'max' => 30),
            array('complemento, bairro, endereco', 'length', 'max' => 250),
            array('cpf, celular', 'required', 'on' => 'insert, update', 'except' => 'cadastro_simplificado'),
            array('cpf', 'unique'),
            array('cpf', 'validarCPF', 'except' => 'cadastro_simplificado'),
            array('uf', 'validarUF', 'except' => 'cadastro_simplificado'),
            array('celular', 'validarCelular'),
            array('telefone', 'validarTelefone'),
            array('data_nascimento', 'validarDataNascimento'),
            array('data_nascimento, datahora_insercao, datahora_ultima_atualizacao', 'safe'),
            array('id, cpf, telefone, celular, sexo, uf, cidade, cep, numero, complemento, bairro, endereco, data_nascimento, excluido, datahora_insercao, datahora_ultima_atualizacao', 'safe', 'on' => 'search'),
        );
    }

    public function beforeSave() {
        if ($this->isNewRecord) {
            $this->datahora_insercao = new CDbExpression('NOW()');
        }
        $this->datahora_ultima_atualizacao = new CDbExpression('NOW()');
        return parent::beforeSave();
    }

    public function validarCPF($attribute, $params) {
        if (!self::calculoCPF($this->cpf)) {
            $this->addError($attribute, 'CPF inválido');
        }
    }

    public function validarDataNascimento($attribute, $params) {
        if (!empty($this->data_nascimento)) {
            if (!preg_match("/[0-9]{4}\-[0-9]{2}\-[0-9]{2}/", $this->data_nascimento)) {
                $this->addError($attribute, 'Data de nascimento inválida');
            } else {
                $aData = explode('-', $this->data_nascimento);
                if ($aData[2] > 31 || $aData[1] > 12 || $aData[0] > 2015 || $aData[0] < 1900) {
                    $this->addError($attribute, 'Data de nascimento inválida');
                }
            }
        }
    }

    public function validarTelefone($attribute, $params) {
        if (!empty($this->telefone)) {
            $valido = true;
            if (preg_match('^\(+[0-9]{2}\)[0]{4}-[0]{4}$^', $this->telefone)) {
                $valido = false;
            }
            if (!preg_match('^\(+[1-9]{2}\)[0-9]{4}-[0-9]{4}$^', $this->telefone) && !preg_match('^\(+[1-9]{2}\)[0-9]{5}-[0-9]{4}$^', $this->telefone) && !preg_match('^\(+[1-9]{2}\)[0-9]{5}-[0-9]{3}$^', $this->telefone)) {
                $valido = false;
            }
            for ($i = 0; $i < 10; $i++) {
                if (preg_match('^\(+[' . $i . ']{2}\)[' . $i . ']{4}-[' . $i . ']{4}$^', $this->celular)) {
                    $valido = false;
                }
                if (preg_match('^\(+[0-9]{2}\)[0]{1}[0-9]{3}-[0-9]{4}$^', $this->celular)) {
                    $valido = false;
                }
            }
            if (!$valido) {
                $this->addError($attribute, 'Telefone Inválido');
            }
        }
    }

    public function validarCelular($attribute, $params) {
        if (!empty($this->celular)) {
            $valido = true;
            if (preg_match('^\(+[0-9]{2}\)[0]{4}-[0]{4}$^', $this->celular) || preg_match('^\(+[0-9]{2}\)[0]{5}-[0]{4}$^', $this->celular)) {
                $valido = false;
            }
            if (!preg_match('^\(+[1-9]{2}\)[0-9]{5}-[0-9]{4}$^', $this->celular) && !preg_match('^\(+[1-9]{2}\)[0-9]{4}-[0-9]{4}$^', $this->celular) && !preg_match('^\(+[1-9]{2}\)[0-9]{5}-[0-9]{3}$^', $this->celular)) {
                $valido = false;
            }
            for ($i = 0; $i < 10; $i++) {
                if (preg_match('^\(+[' . $i . ']{2}\)[' . $i . ']{5}-[' . $i . ']{3}$^', $this->celular) ||
                        preg_match('^\(+[' . $i . ']{2}\)[' . $i . ']{5}-[' . $i . ']{4}$^', $this->celular) ||
                        preg_match('^\(+[0-9]{2}\)[' . $i . ']{5}-[' . $i . ']{3}$^', $this->celular) ||
                        preg_match('^\(+[0-9]{2}\)[' . $i . ']{5}-[' . $i . ']{4}$^', $this->celular)) {
                    $valido = false;
                }
                if (preg_match('^\(+[0-9]{2}\)[0]{1}[0-9]{4}-[0-9]{3}$^', $this->celular) ||
                        preg_match('^\(+[0-9]{2}\)[0]{1}[0-9]{4}-[0-9]{4}$^', $this->celular)) {
                    $valido = false;
                }
            }
            if (!$valido) {
                $this->addError($attribute, 'Celular Inválido');
            }
        }
    }

    public function validarUF($attribute, $params) {
        if (!empty($this->uf) && !preg_match('{^A[CLMP]|BA|CE|DF|ES|[GT]O|M[AGST]|P[ABEIR]|R[JNORS]' . '|S[CEP]$}', $this->uf)) {
            $this->addError($attribute, 'UF Inválido');
        }
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
            'cpf' => 'CPF',
            'telefone' => 'Telefone',
            'celular' => 'Celular',
            'sexo' => 'Sexo',
            'uf' => 'UF',
            'cidade' => 'Cidade',
            'cep' => 'Cep',
            'numero' => 'Número',
            'complemento' => 'Complemento',
            'bairro' => 'Bairro',
            'endereco' => 'Endereço',
            'data_nascimento' => 'Data Nascimento',
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
        $criteria->compare('cpf', $this->cpf, true);
        $criteria->compare('telefone', $this->telefone, true);
        $criteria->compare('celular', $this->celular, true);
        $criteria->compare('sexo', $this->sexo, true);
        $criteria->compare('uf', $this->uf, true);
        $criteria->compare('cidade', $this->cidade, true);
        $criteria->compare('cep', $this->cep, true);
        $criteria->compare('numero', $this->numero, true);
        $criteria->compare('complemento', $this->complemento, true);
        $criteria->compare('bairro', $this->bairro, true);
        $criteria->compare('endereco', $this->endereco, true);
        $criteria->compare('data_nascimento', $this->data_nascimento, true);
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
     * @return Cliente the static model class
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

    public static function calculoCPF($cpf) {
        $cpf = str_pad(preg_replace('/[^0-9_]/', '', $cpf), 11, '0', STR_PAD_LEFT);
        for ($x = 0; $x < 10; $x++) {
            if ($cpf == str_repeat($x, 11)) {
                return false;
            }
        }
        if (strlen($cpf) != 11) {
            return false;
        } else {
            for ($t = 9; $t < 11; $t++) {
                for ($d = 0, $c = 0; $c < $t; $c++) {
                    $d += $cpf{$c} * (($t + 1) - $c);
                }
                $d = ((10 * $d) % 11) % 10;

                if ($cpf{$c} != $d) {
                    return false;
                }
            }
            return true;
        }
    }

    public function tratarDataNascimento() {
        $aDataNascimento = explode('/', $this->data_nascimento);
        return $aDataNascimento[2] . '-' . $aDataNascimento[1] . '-' . $aDataNascimento[0];
    }

    public function getCodigoCelular() {
        if (empty($this->celular)) {
            return null;
        }
        $aCelular = explode(')', $this->celular);
        $celular = str_replace('(', '', $aCelular[0]);
        return $celular;
    }

    public function getCelular() {
        if (empty($this->celular)) {
            return null;
        }
        $aCelular = explode(')', $this->celular);
        $celular = str_replace('-', '', $aCelular[1]);
        return $celular;
    }

    public function tratarCPF() {
        return str_replace(array('.', '-'), '', $this->cpf);
    }

}
