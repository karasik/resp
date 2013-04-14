<?php

class IndexController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
    }

    public function indexAction()
    {
      $this->view->title = "Главная";
    }

    public function registerAction()
    {
      $this->view->title = "Регистрация";
      $form = new Application_Form_RegisterUser();
      if ($this->getRequest()->isPost()) {
        $formData = $this->getRequest()->getPost();
        if ($form->isValid($formData)) {
          $table = new Application_Model_DbTable_Users();
          $table->addUser(
            $form->getValue('email'), 
            $form->getValue('password'),
            "1",
            $form->getValue('first_name'), 
            $form->getValue('last_name')
          );

          $this->_helper->redirector('index');
        } else {
          $form->populate($formData);
        }
      }
      $this->view->form = $form;
    }


}



