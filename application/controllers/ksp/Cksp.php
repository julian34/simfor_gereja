<?php

class Cksp extends MY_Controller {

    public $data;

    public function __construct() {
        parent::__construct();
        $this->data['halaman']="Data Master KSP";
        $this->data['js']= null;
        $this->data['active_hal'] = array('link'=>'datamaster','sub_link' => 'ksp');
        $this->load->model('ksp/mksp', 'mksp', TRUE);
    }

    public function index($offset = 0) {
        $this->data['main_container'] = 'ksp/index';
        $this->data['js']= 'ksp/vjs';
        // $this->data['form_action'] = 'sekolah';

        $ksp = $this->mksp->cari_semua();

        if ($ksp) {
            $table = $this->mksp->buat_table($ksp);
            $this->data['tabel_data'] = $table;
        } else {
            $this->data['pesan'] = 'Tidak Ada Data KSP';
        }
        $this->load->view('template/template_backend',$this->data); 
    }

    function get_data()
    {
        $list = $this->mksp->get_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $field) {
            $no++;
            $row = array();
            $row[] = $no;
                 $row[] = $field->nama_ksp;
                 $row[] = $field->id_ksp;
                 $row[] = $field->keterangan;

                $row[] = '<div class="hidden-phone visible-desktop btn-group action-buttons">'.
                anchor('editksp/'.$field->id_ksp,'<button class="btn btn-mini btn-info"><i class="icon-pencil bigger-120"></i></button>')
                .
                anchor('hapusksp/'.$field->id_ksp,'<button class="btn btn-mini btn-danger"><i class="icon-trash bigger-120"></i></button>',array('onclick'=>"return confirm('Anda yakin akan menghapus data ini?')"))
                .
                '<div>';

            $data[] = $row;
        }
 
        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->mksp->count_all(),
            "recordsFiltered" => $this->mksp->count_filtered(),
            "data" => $data,
        );
        //output dalam format JSON
        echo json_encode($output);
    }


        public function tambah() {
        $this->data['main_container'] = 'ksp/vksp_form';
        $this->data['form_action'] = 'ksp/cksp/tambah';
        if ($this->input->post('submit')) {
            if ($this->mksp->validasi_tambah()) {
                if ($this->mksp->tambah()) {
                    $this->session->set_flashdata('pesan', '<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert">&times;</button>Proses tambah data berhasil.</div>');
                    redirect('ksp');
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
        $this->data['main_container'] = 'ksp/vksp_form';
        $this->data['form_action'] = 'ksp/cksp/edit/' . $id;
        if (!empty($id)) {
            if ($this->input->post('submit')) {
                if ($this->mksp->validasi_edit() == TRUE) {
                    $this->mksp->edit($this->session->userdata('id_ksp'));
                    $this->session->set_flashdata('pesan', '<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert">&times;</button>Proses update data berhasil.</div>');
                    redirect('ksp');
                } else {
                    $this->load->view('template/template_backend',$this->data);  
                }
            } else {
                $ksp = $this->mksp->cari($id);
                foreach ($ksp as $key => $value) {
                    $this->data['form_value'][$key] = $value;
                }
                $this->session->set_userdata('id_ksp', $ksp->id_ksp);
                $this->session->set_userdata('nama_ksp', $ksp->nama_ksp);
                $this->session->set_userdata('keterangan', $ksp->keterangan);
                $this->load->view('template/template_backend',$this->data);  
            }
        } else {
            redirect('ksp');
        }
    }

    function hapus($id) {
        
        if($this->mksp->hapus($id)){
        $this->session->set_flashdata('pesan', '<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert">&times;</button>Proses hapus data berhasil.</div>');
        redirect('ksp');
    }else {
        $this->session->set_flashdata('pesan', '<div class="alert alert-error"><button type="button" class="close" data-dismiss="alert">&times;</button>Proses hapus data gagal.</div>');
        redirect('ksp');
    }
    }        

}

?>
