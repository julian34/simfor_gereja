<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class CFrontend extends CI_Controller {

    function index() {
        $this->data['main_container'] = 'frontend/index';    	
        $this->load->view('template/template_backend',$this->data);
    }
}
