<?php

class ModelExtensionModuleFeedback extends Model {
  public function storeFeedback($data)
  {
    $sql = "INSERT INTO `" . DB_PREFIX . "feedback` SET 
             name ='" . $data['name']
       . "', email = '" . $data['email'] 
       . "', phone = '" . $data['phone'] . "'";
       $this->db->query($sql);
    }
}