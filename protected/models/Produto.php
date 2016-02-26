<?php

/**
 * This is the model class for table "produtos".
 *
 * The followings are the available columns in table 'produtos':
 * @property integer $id
 * @property string $titulo
 * @property string $descricao
 * @property string $url_amigavel
 * @property string $imagem
 * @property string $video_apresentacao
 * @property string $valor
 * @property string $desconto
 * @property string $carga_horaria
 * @property integer $quantidade_visualizacao
 * @property integer $periodo_visualizacao
 * @property integer $tipo_produto 
 * @property integer $materia_id
 * @property integer $destaque
 * @property integer $excluido
 * @property string $datahora_insercao
 * @property string $datahora_ultima_atualizacao
 */
class Produto extends CActiveRecord {

    public $imagem_excluida;
    public $finalizar_cadastro;
    public $aTipoProduto = array(
        1 => 'Apostila',
        2 => 'Vídeo',
    );

    const APOSTILA = 1;
    const VIDEO = 2;

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'produtos';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        return array(
            array('quantidade_visualizacao, periodo_visualizacao, materia_id, destaque', 'numerical', 'integerOnly' => true),
            array('titulo, url_amigavel', 'length', 'max' => 250),
            array('imagem, video_apresentacao', 'length', 'max' => 100),
            array('valor, desconto, carga_horaria', 'length', 'max' => 10),
            array('titulo, url_amigavel, valor, tipo_produto', 'required'),
            array('descricao, datahora_insercao, datahora_ultima_atualizacao, imagem_excluida, finalizar_cadastro', 'safe'),
            array('id, titulo, descricao, url_amigavel, imagem, video_apresentacao, valor, desconto, carga_horaria, quantidade_visualizacao, periodo_visualizacao, materia_id, tipo_produto, destaque, excluido, datahora_insercao, datahora_ultima_atualizacao', 'safe', 'on' => 'search'),
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
            'materia' => array(self::BELONGS_TO, 'Materia', 'materia_id'),
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
            'imagem' => 'Imagem',
            'video_apresentacao' => 'Video Apresentação',
            'valor' => 'Valor',
            'desconto' => 'Desconto',
            'carga_horaria' => 'Carga Horária',
            'quantidade_visualizacao' => 'Quantidade Visualização',
            'periodo_visualizacao' => 'Período Visualização',
            'tipo_produto' => 'Tipo',
            'materia_id' => 'Matíria',
            'destaque' => 'Destaque',
            'excluido' => 'Excluído',
            'datahora_insercao' => 'Datahora Inserção',
            'datahora_ultima_atualizacao' => 'Datahora Última Atualização',
        );
    }
    
    public function scopes() {
        return array(
            'apostila' => array(
                'condition' => 't.tipo_produto = ' . self::APOSTILA,
            ),
            'videoAula' => array(
                'condition' => 't.tipo_produto = ' . self::VIDEO,
            ),
            'destaque' => array(
                'condition' => 't.destaque = true',
            ),
            'naoExcluido' => array(
                'condition' => 't.excluido = false',
            ),
            'exibeTres' => array(
                'limit' => 3,
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
        $criteria->compare('imagem', $this->imagem, true);
        $criteria->compare('video_apresentacao', $this->video_apresentacao, true);
        $criteria->compare('valor', $this->valor, true);
        $criteria->compare('desconto', $this->desconto, true);
        $criteria->compare('carga_horaria', $this->carga_horaria, true);
        $criteria->compare('quantidade_visualizacao', $this->quantidade_visualizacao);
        $criteria->compare('periodo_visualizacao', $this->periodo_visualizacao);
        $criteria->compare('tipo_produto', $this->tipo_produto);
        $criteria->compare('materia_id', $this->materia_id);
        $criteria->compare('destaque', $this->destaque);
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
     * @return Produto the static model class
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

    public function setDadosGerais($post, $files) {
        $transaction = $this->getDbConnection()->beginTransaction();

        $this->attributes = $post['Produto'];

        if (!empty($files['Produto']['name']['imagem'])) {
            $this->imagem = CUploadedFile::getInstance($this, 'imagem');
            $imagem = date('Ymdhis') . '_' . FormatHelper::tratarNomeImagem($this->imagem);
            $diretorioUpload = Yii::getPathOfAlias('webroot') . Yii::app()->params['diretorioImagensProdutos'];

            if (!is_dir($diretorioUpload)) {
                mkdir($diretorioUpload, 0755);
            }
            chmod($diretorioUpload, 0755);
            $this->imagem->saveAs($diretorioUpload . $imagem);
            $this->imagem = $imagem;
        } else {
            $this->imagem = NULL;
        }
        if ($this->save()) {
            $transaction->commit();
            return true;
        }
        $transaction->rollback();
        return false;
    }

    public function getPreco() {
        $valor = $this->valor;
        if (!empty($this->desconto) || $this->desconto > 0) {
            $valor = $this->valor * (1 - ($this->desconto/100));
        }
        return $valor;
    }

    public function getImagem() {
        return Yii::app()->request->baseUrl . Yii::app()->params['diretorioImagensProdutos'] . $this->imagem;
    }

}
