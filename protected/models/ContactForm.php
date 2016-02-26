<?php

/**
 * ContactForm class.
 * ContactForm is the data structure for keeping
 * contact form data. It is used by the 'contact' action of 'SiteController'.
 */
class ContactForm extends CFormModel {

    public $nome;
    public $email;
    public $assunto;
    public $mensagem;

    /**
     * Declares the validation rules.
     */
    public function rules() {
        return array(
            array('nome, email, assunto, mensagem', 'required'),
            array('email', 'email'),
        );
    }

    /**
     * Declares customized attribute labels.
     * If not declared here, an attribute would have a label that is
     * the same as its nome with the first letter in upper case.
     */
    public function attributeLabels() {
        return array(
            'nome' => 'Nome',
            'email' => 'Email',
            'assunto' => 'Assunto',
            'mensagem' => 'Mensagem',
        );
    }

}
