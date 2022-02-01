<?php 
class Cdashboard extends MY_Controller {
    public function __construct() {
        parent::__construct();
        $this->data['halaman']="Dashboard";
        $this->data['active_hal'] = array('link'=>'dashboard','sub_link' => '');
        $this->data['tombol_tambah'] = '';
    }
    function index() {
        $this->data['main_container'] = 'dashboard/index';    	
        $this->load->view('template/template_backend',$this->data);
    }
}

?>