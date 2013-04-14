<?php

class Custom_Validate_UserEmailNotExists extends Zend_Validate_Abstract {
  const EXISTS = 'exists';
   
  protected $_messageTemplates = array(
    self::EXISTS => "Пользователь с адресом %value% уже зарегистрирован в системе"
  );


  public function isValid($email) {
    $users_table = new Application_Model_DbTable_Users();
    if ($users_table->emailExists($email)) {
      $this->_setValue($email);
      $this->_error(self::EXISTS);
      return false;
    }
    return true;
  }
}
