<?php

class Cdata_jemaat extends MY_Controller {

    public $data;

    public function __construct() {
        parent::__construct();
        $this->data['halaman']="Data Jemaat";
        $this->data['js']= null;
        $this->data['tombol_tambah']="<a href='".base_url()."tambahdata_jemaat'><button class='btn btn-info'><i class='icon-plus  bigger-125'></i><b> Tambah Data Jemaat</b></button></a>";
        $this->data['active_hal'] = array('link'=>'datamaster','sub_link' => 'data_jemaat');
        $this->load->model('data_jemaat/mdata_jemaat', 'mdata_jemaat', TRUE);
    }

    public function index($offset = 0) {
        $this->data['main_container'] = 'data_jemaat/index';
        $this->data['js']= 'data_jemaat/vjs';
        // $this->data['form_action'] = 'sekolah';

        $id = $this->mdata_jemaat->cari_semua();

        if ($id) {
            $table = $this->mdata_jemaat->buat_table($id);
            $this->data['tabel_data'] = $table;
        } else {
            $this->data['pesan'] = 'Tidak Ada Data Jemaat';
        }
        $this->load->view('template/template_backend',$this->data); 
    }

    function get_data()
    {
        $list = $this->mdata_jemaat->get_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $field) {
            $no++;
            $row = array();
            $row[] = $no;
                 $row[] = $field->nama_unsur;
                 $row[] = $field->kode_unsur;
                 $row[] = $field->keterangan;

                $row[] = '<div class="hidden-phone visible-desktop btn-group action-buttons">'.
                anchor('editdata_jemaat/'.$field->id_unsur,'<button class="btn btn-mini btn-info"><i class="icon-pencil bigger-120"></i></button>')
                .
                anchor('hapusdata_jemaat/'.$field->id_unsur,'<button class="btn btn-mini btn-danger"><i class="icon-trash bigger-120"></i></button>',array('onclick'=>"return confirm('Anda yakin akan menghapus data ini?')"))
                .
                '<div>';

            $data[] = $row;
        }
 
        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->mdata_jemaat->count_all(),
            "recordsFiltered" => $this->mdata_jemaat->count_filtered(),
            "data" => $data,
        );
        //output dalam format JSON
        echo json_encode($output);
    }


        public function tambah() {
        $this->data['main_container'] = 'data_jemaat/vdata_jemaat_form';
        $this->data['form_action'] = 'data_jemaat/cdata_jemaat/tambah';
        if ($this->input->post('submit')) {
            if ($this->mdata_jemaat->validasi_tambah()) {
                if ($this->mdata_jemaat->tambah()) {
                    $this->session->set_flashdata('pesan', '<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert">&times;</button>Proses tambah data berhasil.</div>');
                    redirect('data_jemaat');
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
        $this->data['main_container'] = 'data_jemaat/vdata_jemaat_form';
        $this->data['form_action'] = 'data_jemaat/cdata_jemaat/edit/' . $id;
        if (!empty($id)) {
            if ($this->input->post('submit')) {
                if ($this->mdata_jemaat->validasi_edit() == TRUE) {
                    $this->mdata_jemaat->edit($this->session->userdata('id_unsur'));
                    $this->session->set_flashdata('pesan', '<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert">&times;</button>Proses update data berhasil.</div>');
                    redirect('data_jemaat');
                } else {
                    $this->load->view('template/template_backend',$this->data);  
                }
            } else {
                $id = $this->mdata_jemaat->cari($id);
                foreach ($id as $key => $value) {
                    $this->data['form_value'][$key] = $value;
                }
                $this->session->set_userdata('id_unsur', $id->id_unsur);
                $this->session->set_userdata('nama_unsur', $id->nama_unsur);
                $this->session->set_userdata('kode_unsur', $id->kode_unsur);
                $this->session->set_userdata('keterangan', $id->keterangan);
                $this->load->view('template/template_backend',$this->data);  
            }
        } else {
            redirect('data_jemaat');
        }
    }

    function hapus($id) {
        
        if($this->mdata_jemaat->hapus($id)){
        $this->session->set_flashdata('pesan', '<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert">&times;</button>Proses hapus data berhasil.</div>');
        redirect('data_jemaat');
    }else {
        $this->session->set_flashdata('pesan', '<div class="alert alert-error"><button type="button" class="close" data-dismiss="alert">&times;</button>Proses hapus data gagal.</div>');
        redirect('data_jemaat');
    }
    }        

}

?>
