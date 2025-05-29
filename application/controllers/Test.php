<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Test extends MY_Controller {

	public function admin() {
		$data['title'] = 'Page Admin';
		$this->loadView('admin', $data);

	}
}
