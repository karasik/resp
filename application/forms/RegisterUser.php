<?php

class Application_Form_RegisterUser extends Zend_Form
{

    public function init()
    {
      $email = new Zend_Form_Element_Text('email');
      $email->setLabel('Email')
        ->setRequired(true)
        ->addFilter('StripTags')
        ->addFilter('StringTrim')
        ->addValidator('EmailAddress')
        ->addValidator(new Custom_Validate_UserEmailNotExists());

      $password = new Zend_Form_Element_Password('password');
      $password->setLabel('Введите пароль')
        ->setRequired(true)
        ->addValidator('NotEmpty');

      $confirm_password = new Zend_Form_Element_Password('confirm_password');
      $confirm_password->setLabel('Подтвердите пароль')
        ->setRequired(true)
        ->addValidator(new Zend_Validate_Identical('password'));

      $first_name = new Zend_Form_Element_Text('first_name');
      $first_name->setLabel('Имя')
        ->setRequired(true)
        ->addFilter('StripTags')
        ->addFilter('StringTrim')
        ->addValidator('NotEmpty');

      $last_name = new Zend_Form_Element_Text('last_name');
      $last_name->setLabel('Фамилия')
        ->setRequired(true)
        ->addFilter('StripTags')
        ->addFilter('StringTrim')
        ->addValidator('NotEmpty');

      // Using single captcha key:
      $captcha = new Zend_Form_Element_Captcha('captcha', array(
          'label' => "Введите символы, указанные ниже",
          'captcha' => array(
              'captcha' => 'Figlet',
              'wordLen' => 6,
              'timeout' => 300,
          ),
      ));


      $submit = new Zend_Form_Element_Submit('submit');
      $submit->setLabel('Зарегистрироваться');

      $this->addElements(array($email, $password, $confirm_password, $first_name, $last_name, $captcha, $submit));

    }
    
}

