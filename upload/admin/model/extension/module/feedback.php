<?php

class ModelExtensionModuleFeedback extends Model{
  /**
   * Get all records from `feedback` table
   */
  public function getFeedbacks()
  {
    $sql = "SELECT * FROM " . DB_PREFIX . "feedback ORDER BY date DESC";
    
    $result = $this->db->query($sql);
    return $result->rows;
  }

  public function createFeedbackTable()
  {
    $sql = "CREATE TABLE " . DB_PREFIX . "feedback (
      id INT PRIMARY KEY AUTO_INCREMENT,
      name VARCHAR(100),
      email VARCHAR(80),
      phone VARCHAR(20),
      date DATETIME DEFAULT CURRENT_TIMESTAMP,
      was_dialog TINYINT DEFAULT 0
    )";

    $this->db->query($sql);
    
    $sql = "INSERT INTO " . DB_PREFIX . "feedback (name, email, phone)
    VALUES
    ('Тарас Бульбенко', 't.bulba@ukr.net', '380987117171'),
    ('Дмитро Вишневецький', 'otaman@i.ua', '380986441492'),
    ('Еней Троянович', 'eneida@litera.ua', '380988901234');
    ";

    $this->db->query($sql);
  }

  public function deleteFeedbackTable()
  {
    $sql = "DROP TABLE IF EXISTS " . DB_PREFIX . "feedback";
    $this->db->query($sql);
  }
}