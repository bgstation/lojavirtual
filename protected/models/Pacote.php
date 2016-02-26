<?php

/**
 * This is the model class for table "pacotes".
 *
 * The followings are the available columns in table 'pacotes':
 * @property integer $id
 * @property string $titulo
 * @property string $descricao
 * @property string $url_amigavel
 * @property string $desconto
 * @property string $video_apresentacao
 * @property string $imagem
 * @property integer $destaque
 * @property integer $quantidade_visualizacao
 * @property integer $periodo_visualizacao
 * @property integer $excluido
 * @property string $datahora_insercao
 * @property string $datahora_ultima_atualizacao
 */
class Pacote extends CActiveRecord {
    
    public $imagem_excluida;

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'pacotes';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        return array(
            array('destaque, quantidade_visualizacao, periodo_visualizacao', 'numerical', 'integerOnly' => true),
            array('titulo, url_amigavel', 'length', 'max' => 250),
            array('desconto', 'length', 'max' => 10),
            array('titulo, url_amigavel', 'required'),
            array('video_apresentacao, imagem', 'length', 'max' => 100),
            array('descricao, datahora_insercao, datahora_ultima_atualizacao', 'safe'),
            array('id, titulo, descricao, url_amigavel, desconto, video_apresentacao, imagem, destaque, quantidade_visualizacao, periodo_visualizacao, excluido, datahora_insercao, datahora_ultima_atualizacao', 'safe', 'on' => 'search'),
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
            'produtos' => array(self::HAS_MANY, 'PacoteItem', 'pacote_id'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'id' => 'ID',
            'titulo' => 'Título',
            'descricao' => 'Descrição',
            'url_amigavel' => 'Url Amigável',
            'desconto' => 'Desconto',
            'video_apresentacao' => 'Video Apresentação',
            'imagem' => 'Imagem',
            'destaque' => 'Destaque',
            'quantidade_visualizacao' => 'Quantidade de Visualizações',
            'periodo_visualizacao' => 'Periodo Visualização',
            'excluido' => 'Excluído',
            'datahora_insercao' => 'Datahora Inserção',
            'datahora_ultima_atualizacao' => 'Datahora Ultima Atualização',
        );
    }
    
    public function scopes() {
        return array(
            'destaque' => array(
                'condition' => 't.destaque = true',
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
        $criteria->compare('titulo', $this->titulo, true);
        $criteria->compare('descricao', $this->descricao, true);
        $criteria->compare('url_amigavel', $this->url_amigavel, true);
        $criteria->compare('desconto', $this->desconto, true);
        $criteria->compare('video_apresentacao', $this->video_apresentacao, true);
        $criteria->compare('imagem', $this->imagem, true);
        $criteria->compare('destaque', $this->destaque);
        $criteria->compare('quantidade_visualizacao', $this->quantidade_visualizacao);
        $criteria->compare('periodo_visualizacao', $this->periodo_visualizacao);
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
     * @return Pacote the static model class
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

    public function getPreco() {
        $valor = 0;
        foreach ($this->produtos as $produto) {
            $valor += $produto->produto->getPreco();
        }
        if (!empty($this->desconto) || $this->desconto > 0) {
            return $valor * (1 - ($this->desconto/100));
        }
        return $valor;
    }

    public function getImagem() {
        return Yii::app()->request->baseUrl . Yii::app()->params['diretorioImagensPacotes'] . $this->imagem;
    }

}
