<?php

/**
 * This is the model class for table "rotas".
 *
 * The followings are the available columns in table 'rotas':
 * @property integer $id
 * @property string $titulo
 * @property string $controller
 * @property string $action
 * @property string $categoria
 * @property string $descricao
 * @property integer $exibir
 * @property integer $excluido
 * @property integer $rota_id
 * @property string $datahora_insercao
 * @property string $datahora_ultima_atualizacao
 */
class Rota extends CActiveRecord {

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'rotas';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        return array(
            array('rota_id', 'numerical', 'integerOnly' => true),
            array('titulo', 'length', 'max' => 200),
            array('controller, action, categoria', 'length', 'max' => 50),
            array('descricao, datahora_insercao, datahora_ultima_atualizacao, exibir', 'safe'),
            array('id, titulo, controller, action, categoria, descricao, excluido, rota_id, datahora_insercao, datahora_ultima_atualizacao', 'safe', 'on' => 'search'),
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
            'titulo' => 'Título',
            'controller' => 'Controller',
            'action' => 'Action',
            'categoria' => 'Categoria',
            'descricao' => 'Descrição',
            'exibir' => 'Exibir',
            'excluido' => 'Excluído',
            'rota_id' => 'Rota',
            'datahora_insercao' => 'Datahora Inserção',
            'datahora_ultima_atualizacao' => 'Datahora Ultima Atualização',
        );
    }
    
    public function scopes() {
        return array(
            'exibir' => array(
                'condition' => 't.exibir = true',
            ),
            'naoExibir' => array(
                'condition' => 't.exibir = false'
            ),
            'naoExcluido' => array(
                'condition' => 't.excluido = false',
            ),
            'ordenarCategoriaTitulo' => array(
                'order' => 't.categoria, t.titulo ASC'
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
        $criteria->compare('titulo', $this->titulo, true);
        $criteria->compare('controller', $this->controller, true);
        $criteria->compare('action', $this->action, true);
        $criteria->compare('categoria', $this->categoria, true);
        $criteria->compare('descricao', $this->descricao, true);
        $criteria->compare('exibir', $this->exibir);
        $criteria->compare('excluido', $this->excluido);
        $criteria->compare('rota_id', $this->rota_id);
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
     * @return Rota the static model class
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
    
    public function getAclRotasArray() {
        $aRotas = array();
        $oRotas = self::model()->naoExcluido()->exibir()->ordenarCategoriaTitulo()->findAll();
        $i = 0;
        if (!empty($oRotas))
            foreach ($oRotas as $oRotas) {
                $aRotas[$oRotas->categoria][$i]['titulo'] = $oRotas->titulo;
                $aRotas[$oRotas->categoria][$i]['id'] = $oRotas->id;
                $i++;
            }
        return $aRotas;
    }

}
