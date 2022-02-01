<?php

class Cuser extends MY_Controller {

    public $data;

    public function __construct() {
        parent::__construct();
        $this->data['halaman']="Data Master User";
        $this->data['js']= null;
        $this->data['active_hal'] = array('link'=>'datamaster','sub_link' => 'user');
        $this->load->model('user/muser', 'muser', TRUE);
        $this->load->model('dropdown/mdropdown', 'dropdown', TRUE);
    }

    public function index($offset = 0) {
        $this->data['main_container'] = 'user/index';
        $this->data['js']= 'user/vjs';
        // $this->data['form_action'] = 'sekolah';

        $user = $this->muser->cari_semua();

        if ($user) {
            $table = $this->muser->buat_table($user);
            $this->data['tabel_data'] = $table;
        } else {
            $this->data['pesan'] = 'Tidak Ada Data Unsur';
        }
        $this->load->view('template/template_backend',$this->data); 
    }

    public function get_data(){
        $list = $this->muser->get_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $field) {
            $no++;
            $row = array();
            $row[] = $no;
                 $row[] = $field->username;
                 $row[] = $field->nama_lengkap;
                 $row[] = $field->nama_grup;
                 $row[] = $field->aktif;
                $row[] = '<div class="hidden-phone visible-desktop btn-group action-buttons">'.
                anchor('edituser/'.$field->id_user,'<button class="btn btn-mini btn-info"><i class="icon-pencil bigger-120"></i></button>')
                .
                anchor('hapususer/'.$field->id_user,'<button class="btn btn-mini btn-danger"><i class="icon-trash bigger-120"></i></button>',array('onclick'=>"return confirm('Anda yakin akan menghapus data ini?')"))
                .
                '<div>';

            $data[] = $row;
        }
 
        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->muser->count_all(),
            "recordsFiltered" => $this->muser->count_filtered(),
            "data" => $data,
        );
        //output dalam format JSON
        echo json_encode($output);
    }

    public function tambah() {
        $this->data['main_container']   = 'user/vuser_form';
        $this->data['form_action']      = 'user/cuser/tambah';
        $this->data['drgrup']           = $this->dropdown->grup(); 
        $this->data['drgrups']          = 0;
        if ($this->input->post('submit')) {
            if ($this->muser->validasi_tambah()) {
                if ($this->muser->tambah()) {
                    $this->session->set_flashdata('pesan', '<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert">&times;</button>Proses tambah data berhasil.</div>');
                    redirect('user');
                } else {
                    $this->data['pesan'] = '<div class="alert alert-error"><button type="button" class="close" data-dismiss="alert">&times;</button>Prose tambah data gagal.</div>';
                    $this->load->view('template/template_backend',$this->data);  
                }
            } else {
                $this->load->view('template/template_backend',$this->data); 
            }
        } else {
            $this->load->view('template/template_backend',$this->data); 
        }
    }

    public function edit($id = NULL) {
        $this->data['main_container']   = 'user/vuser_form';
        $this->data['form_action']      = 'user/cuser/edit/' . $id;
        $this->data['drgrup']           = $this->dropdown->grup();
        $this->data['drgrups']          = $this->dropdown->egrup($id);
        if (!empty($id)) {
            if ($this->input->post('submit')) {
                if ($this->muser->validasi_edit() == TRUE) {
                    $this->muser->edit($this->session->userdata('id_user'));
                    $this->session->set_flashdata('pesan', '<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert">&times;</button>Proses update data berhasil.</div>');
                    redirect('user');
                } else {
                    $this->load->view('template/template_backend',$this->data);  
                }
            } else {
                $user       = $this->muser->cari($id);      
                foreach ($user as $key => $value) {
                    $this->data['form_value'][$key] = $value;
                }
                $this->session->set_userdata('id_user', $user->id_user);
                $this->session->set_userdata('nama_lengkap', $user->nama_lengkap);
                $this->session->set_userdata('username', $user->username);
                $this->session->set_userdata('gambar', $user->gambar);
                $this->session->set_userdata('aktif', $user->aktif);
                $this->load->view('template/template_backend',$this->data);  
            }
        } else {
            redirect('user');
        }
    }

    public function hapus($id) {
        
        if($this->muser->hapus($id)){
        $this->session->set_flashdata('pesan', '<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert">&times;</button>Proses hapus data berhasil.</div>');
        redirect('user');
      }else {
        $this->session->set_flashdata('pesan', '<div class="alert alert-error"><button type="button" class="close" data-dismiss="alert">&times;</button>Proses hapus data gagal.</div>');
        redirect('user');
     }
    }        

}

?>
