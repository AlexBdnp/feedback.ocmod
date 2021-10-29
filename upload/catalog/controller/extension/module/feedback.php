<?php

use function PHPSTORM_META\type;

class ControllerExtensionModuleFeedback extends Controller
{
	public function index()
	{
    $this->load->language('extension/module/feedback');

    return $this->load->view('extension/module/feedback');
	}

  public function storeFeedback()
  {
    $this->load->model('extension/module/feedback');
    $feedback = [
      'name' => $this->db->escape($this->request->post['name']),
      'email' => $this->db->escape($this->request->post['email']),
      'phone' => $this->db->escape($this->request->post['phone'])
    ];

    $this->model_extension_module_feedback->storeFeedback($feedback);

    return "Feedback added OK";
  }
}