<?php

/**
 * This is the model class for table "banners".
 *
 * The followings are the available columns in table 'banners':
 * @property integer $id
 * @property string $imagem
 * @property string $link
 * @property integer $ordem
 * @property integer $excluido
 * @property string $datahora_insercao
 * @property string $datahora_ultima_atualizacao
 */
class Banner extends CActiveRecord {
    
    public $imagem_excluida;

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'banners';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        return array(
            array('ordem', 'numerical', 'integerOnly' => true),
            array('imagem, link', 'length', 'max' => 200),
            array('imagem', 'required'),
            array('datahora_insercao, datahora_ultima_atualizacao', 'safe'),
            array('id, imagem, link, ordem, excluido, datahora_insercao, datahora_ultima_atualizacao', 'safe', 'on' => 'search'),
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
            'imagem' => 'Imagem',
            'link' => 'Link',
            'ordem' => 'Ordem',
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
            'ordenados' => array(
                'order' => 'ordem',
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
        $criteria->compare('imagem', $this->imagem, true);
        $criteria->compare('link', $this->link, true);
        $criteria->compare('ordem', $this->ordem);
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
     * @return Banner the static model class
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
    
    public function getImagem() {
        return Yii::app()->request->baseUrl . Yii::app()->params['diretorioImagensBanners'] . $this->imagem;
    }

}
