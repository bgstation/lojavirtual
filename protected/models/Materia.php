<?php

/**
 * This is the model class for table "materias".
 *
 * The followings are the available columns in table 'materias':
 * @property integer $id
 * @property string $titulo
 * @property string $url_amigavel
 * @property integer $excluido
 * @property string $datahora_insercao
 * @property string $datahora_ultima_atualizacao
 */
class Materia extends CActiveRecord {

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'materias';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        return array(
            array('titulo, url_amigavel', 'length', 'max' => 250),
            array('datahora_insercao, datahora_ultima_atualizacao', 'safe'),
            array('titulo, url_amigavel', 'required'),
            array('id, titulo, url_amigavel, excluido, datahora_insercao, datahora_ultima_atualizacao', 'safe', 'on' => 'search'),
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
            'url_amigavel' => 'Url Amigável',
            'excluido' => 'Excluído',
            'datahora_insercao' => 'Datahora Inserção',
            'datahora_ultima_atualizacao' => 'Datahora Última Atualização',
        );
    }
    
    public function scopes() {
        return array(
            'naoExcluido' => array(
                'condition' => 'excluido = false',
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
        $criteria->compare('url_amigavel', $this->url_amigavel, true);
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
     * @return Materia the static model class
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

}
