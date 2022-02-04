<?php

class Cjemaat extends MY_Controller {

    public $data;

    public function __construct() {
        parent::__construct();
        $this->data['halaman']="Data Jemaat";
        $this->data['js']= null;
        $this->data['tombol_tambah']="<a href='".base_url()."tambahjemaat'><button class='btn btn-info'><i class='icon-plus  bigger-125'></i><b> Tambah Data Jemaat</b></button></a>";
        // $this->data['active_hal'] = array('link'=>'datamaster','sub_link' => 'jemaat');
        $this->load->model('data_jemaat/mjemaat', 'mjemaat', TRUE);
    }

    public function index($offset = 0) {
        $this->data['main_container'] = 'data_jemaat/index';
        $this->data['js']= 'data_jemaat/vjs';
        // $this->data['form_action'] = 'sekolah';

        $id = $this->mjemaat->cari_semua();

        if ($id) {
            $table = $this->mjemaat->buat_table($id);
            $this->data['tabel_data'] = $table;
        } else {
            $this->data['pesan'] = 'Tidak Ada Data Jemaat';
        }
        $this->load->view('template/template_backend',$this->data); 
    }

    function get_data()
    {
        $list = $this->mjemaat->get_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $field) {
            $no++;
            $row = array();
            $row[] = $no;
                 $row[] = $field->nik;
                 $row[] = $field->nama_jemaat;
                 $row[] = $field->jenis_kelamin;
                 $row[] = $field->tempat_lahir;
                 $row[] = $field->tanggal_lahir;
                 $row[] = $field->alamat;
                 $row[] = $field->nama_wijk;
                 $row[] = $field->nama_ksp;
                 $row[] = $field->nama_unsur;
                 $row[] = $field->status_baptis;
                 $row[] = $field->status_sidi;
                 $row[] = $field->status_nikah;
                 $row[] = $field->keterangan;


                $row[] = '<div class="hidden-phone visible-desktop btn-group action-buttons">'.
                anchor('editjemaat/'.$field->nik,'<button class="btn btn-mini btn-info"><i class="icon-pencil bigger-120"></i></button>')
                .
                anchor('hapusjemaat/'.$field->nik,'<button class="btn btn-mini btn-danger"><i class="icon-trash bigger-120"></i></button>',array('onclick'=>"return confirm('Anda yakin akan menghapus data ini?')"))
                .
                '<div>';

            $data[] = $row;
        }
 
        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->mjemaat->count_all(),
            "recordsFiltered" => $this->mjemaat->count_filtered(),
            "data" => $data,
        );
        //output dalam format JSON
        echo json_encode($output);
    }


        public function tambah() {
        $this->data['main_container'] = 'data_jemaat/vjemaat_form';
        $this->data['form_action'] = 'data_jemaat/cjemaat/tambah';
        if ($this->input->post('submit')) {
            if ($this->mjemaat->validasi_tambah()) {
                if ($this->mjemaat->tambah()) {
                    $this->session->set_flashdata('pesan', '<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert">&times;</button>Proses tambah data berhasil.</div>');
                    redirect('jemaat');
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
        $this->data['main_container'] = 'data_jemaat/vjemaat_form';
        $this->data['form_action'] = 'data_jemaat/cjemaat/edit/' . $id;
        if (!empty($id)) {
            if ($this->input->post('submit')) {
                if ($this->mjemaat->validasi_edit() == TRUE) {
                    $this->mjemaat->edit($this->session->userdata('id_unsur'));
                    $this->session->set_flashdata('pesan', '<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert">&times;</button>Proses update data berhasil.</div>');
                    redirect('jemaat');
                } else {
                    $this->load->view('template/template_backend',$this->data);  
                }
            } else {
                $id = $this->mjemaat->cari($id);
                foreach ($id as $key => $value) {
                    $this->data['form_value'][$key] = $value;
                }
                $this->session->set_userdata('nik', $id->nik);
                $this->session->set_userdata('nama_jemaat', $id->nama_jemaat);
                $this->session->set_userdata('jenis_kelamin', $id->jenis_kelamin);
                $this->session->set_userdata('tempat_lahir', $id->tempat_lahir);
                $this->session->set_userdata('tanggal_lahir', $id->tanggal_lahir);
                $this->session->set_userdata('alamat', $id->alamat);
                $this->session->set_userdata('id_wijk', $id->id_wijk);
                $this->session->set_userdata('id_ksp', $id->id_ksp);
                $this->session->set_userdata('id_unsur', $id->id_unsur);
                $this->session->set_userdata('status_baptis', $id->status_baptis);
                $this->session->set_userdata('status_sidi', $id->status_sidi);
                $this->session->set_userdata('status_nikah', $id->status_nikah);
                $this->session->set_userdata('keterangan', $id->keterangan);
                $this->load->view('template/template_backend',$this->data);  
            }
        } else {
            redirect('jemaat');
        }
    }

    function hapus($id) {
        
        if($this->mjemaat->hapus($id)){
        $this->session->set_flashdata('pesan', '<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert">&times;</button>Proses hapus data berhasil.</div>');
        redirect('jemaat');
    }else {
        $this->session->set_flashdata('pesan', '<div class="alert alert-error"><button type="button" class="close" data-dismiss="alert">&times;</button>Proses hapus data gagal.</div>');
        redirect('jemaat');
    }
    }        

}

?>
