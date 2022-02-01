<?php 

class Clogin extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->model('login/mlogin','mlogin',true);
        }

    function index() {
            if($this->session->userdata('login_in')==true)
                redirect("dashboard");
            else
                $this->load->view('login/index');
    }

    function aksi_login(){
		$username = $this->input->post('username');
		$password = $this->input->post('password');
		$where = array(
			'username' => $username,
            'password' => md5($password)
    
			);
		$query = $this->mlogin->cek_login("users",$where);

		if($query->num_rows() > 0){
                foreach( $query->result() AS $row) { 
                    if($row->aktif === 1){
                       $banned = true; 
                    }else{
                       $banned = false;
                    }
        			 $data_session = array(
                        'username_aktif'      => $row->username,
        				'nama_lengkap_aktif'  => $row->nama,
                        'gambar_aktif'        => $row->gambar,
                        'banned'        => $banned,
        				'login_in'      => true
        			);    
        }
            $this->session->set_userdata($data_session);
                    redirect("dashboard");

 
		}else{
            $data['error'] = '<div class="alert alert-danger" style="margin-top: 3px">
            <div class="header"><b><i class="fa fa-exclamation-circle"></i> ERROR</b> username atau password salah!</div></div>';
            $this->load->view('login/index',$data);
            
		}
	}

    function logout() {
        $this->session->sess_destroy();
		redirect('login');

    }

}

?>