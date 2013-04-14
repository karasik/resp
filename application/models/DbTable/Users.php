<?php

class Application_Model_DbTable_Users extends Zend_Db_Table_Abstract {
  protected $_name = 'users';

  public function addUser($email, $password, $userpic, $first_name, $last_name) {
    $data = array(
      'email' => $email,
      'password_hash' => sha1(PASSWORD_SALT . $email),
      'test_email' => $email,
      'userpic' => 'http://smartresponder.ru/imgs/db/12709/1339622972/sergey-vsehsv%20copy.png',
      'first_name' => $first_name,
      'last_name' => $last_name,
      'register_date' => date('Y-m-d H:i:s', time())
    );
    $this->insert($data);
  }

  public function getUser($id) {
    $id = (int)$id;
    $row = $this->fetchRow('id=' . $id);
    if (!$row) {
      throw new Exception('Could not find row ' . $id);
    }
    return $row->toArray();
  }

  public function emailExists($email) {
    $row = $this->fetchRow("email='".$email."'");
    return $row ? true : false;
  }
}
