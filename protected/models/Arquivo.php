<?php

/**
 * This is the model class for table "arquivos".
 *
 * The followings are the available columns in table 'arquivos':
 * @property integer $id
 * @property string $titulo
 * @property string $arquivo
 * @property integer $modulo_id
 * @property integer $tipo_arquivo_id
 * @property string $carga_horaria
 * @property integer $ordem
 * @property integer $excluido
 * @property string $datahora_insercao
 * @property string $datahora_ultima_atualizacao
 */
class Arquivo extends CActiveRecord {

    public $aTipoArquivo = array(
        1 => 'PDF',
        2 => 'Vídeo',
    );

    const PDF = 1;
    const VIDEO = 2;

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'arquivos';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        return array(
            array('modulo_id, tipo_arquivo_id, ordem', 'numerical', 'integerOnly' => true),
            array('titulo', 'length', 'max' => 200),
            array('arquivo', 'length', 'max' => 300),
            array('carga_horaria', 'length', 'max' => 20),
            array('datahora_insercao, datahora_ultima_atualizacao', 'safe'),
            array('id, titulo, arquivo, modulo_id, tipo_arquivo_id, carga_horaria, ordem, excluido, datahora_insercao, datahora_ultima_atualizacao', 'safe', 'on' => 'search'),
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
            'modulo' => array(self::BELONGS_TO, 'Modulo', 'modulo_id'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'id' => 'ID',
            'titulo' => 'Título',
            'arquivo' => 'Arquivo',
            'modulo_id' => 'Módulo',
            'tipo_arquivo_id' => 'Tipo Arquivo',
            'carga_horaria' => 'Carga Horária',
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
            'orderByOrdem' => array(
                'order' => 'ordem',
            ),
            'orderByOrdemDesc' => array(
                'order' => 'ordem DESC',
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
        $criteria->compare('arquivo', $this->arquivo, true);
        $criteria->compare('modulo_id', $this->modulo_id);
        $criteria->compare('tipo_arquivo_id', $this->tipo_arquivo_id);
        $criteria->compare('carga_horaria', $this->carga_horaria, true);
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
     * @return Arquivo the static model class
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

    public static function getUltimaPosicaoOrdemDoArquivoNoModulo($moduloId) {
        $oArquivo = Arquivo::model()->orderByOrdemDesc()->findByAttributes(array(
            'modulo_id' => $moduloId
        ));
        return !empty($oArquivo) ? ($oArquivo->ordem + 1) : 1;
    }

    public function getCaminhoArquivo() {
        $caminhoArquivo = '';
        if ($this->tipo_arquivo_id == 1) {
            $caminhoArquivo = 'http://www.bgstation.com.br/produto/uploads/' . $this->arquivo;
        } else if ($this->tipo_arquivo_id == 2) {
            $servidorVideo = explode('/', $this->arquivo);
            if ($servidorVideo[0] == 'servidor') {
                $contServidor = strlen($this->arquivo);
                $caminhoArquivo = 'http://server.bgstation' . substr($this->arquivo, 8, $contServidor);
            }
        }
        return $caminhoArquivo;
    }

}
