<?php
class ControllerExtensionModuleFeedback extends Controller
{
	private $error = array();

	public function index()
	{
    $this->load->language('extension/module/feedback');
	  $this->document->setTitle($this->language->get('heading_title'));
    $this->load->model('extension/module/feedback');

    $data = [];
    //____________Header, Column Left, Footer, Cancel, Save, Breadcrumbs____________________
		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');
		$data['cancel'] = $this->url->link('marketplace/extension', 'user_token=' . $this->session->data['user_token'] . '&type=module', true);
    
    if (!isset($this->request->get['module_id'])) {
      $data['action'] = $this->url->link('extension/module/feedback', 'user_token=' . $this->session->data['user_token'], true);
    } else {
      $data['action'] = $this->url->link('extension/module/feedback', 'user_token=' . $this->session->data['user_token'] . '&module_id=' . $this->request->get['module_id'], true);
    }
    
    $data['breadcrumbs'] = array();
		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_home'),
			'href' => $this->url->link('common/dashboard', 'user_token=' . $this->session->data['user_token'], true)
		);
		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_extension'),
			'href' => $this->url->link('marketplace/extension', 'user_token=' . $this->session->data['user_token'] . '&type=module', true)
		);
		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('heading_title'),
			'href' => $this->url->link('extension/module/feedback', 'user_token=' . $this->session->data['user_token'], true)
		);
    
    if (isset($this->request->post['module_feedback_status'])) {
      $data['module_feedback_status'] = $this->request->post['module_feedback_status'];
      $this->model_setting_setting->editSetting('module_feedback', ['module_feedback_status' => (boolean)$data['module_feedback_status']]);
		} else {
			$data['module_feedback_status'] = $this->config->get('module_feedback_status');
		}

    //pass feedbacks to view
    $data['feedbacks'] = $this->model_extension_module_feedback->getFeedbacks();

    $this->response->setOutput($this->load->view('extension/module/feedback', $data));
  }

	protected function validate()
	{ }

	public function install()
	{
    $this->load->model('setting/setting');
    $this->load->model('extension/module/feedback');

	  $this->model_setting_setting->editSetting('module_feedback', ['module_feedback_status' => 1]);
	  $this->model_extension_module_feedback->createFeedbackTable();

  }

	public function uninstall()
	{
    $this->load->model('setting/setting');
    $this->load->model('extension/module/feedback');
    
	  $this->model_setting_setting->editSetting('module_feedback', ['module_feedback_status' => 0]);
	  $this->model_extension_module_feedback->deleteFeedbackTable();
  }
}