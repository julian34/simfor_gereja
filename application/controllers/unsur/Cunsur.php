<?php

class Cunsur extends MY_Controller {

    public $data;

    public function __construct() {
        parent::__construct();
        $this->data['halaman']="Data Master Unsur";
        $this->data['js']= null;
        $this->data['tombol_tambah']="<a href='".base_url()."tambahunsur'><button class='btn btn-info'><i class='icon-plus  bigger-125'></i><b> Tambah Data Unsur</b></button></a>";
        $this->data['active_hal'] = array('link'=>'datamaster','sub_link' => 'unsur');
        $this->load->model('unsur/munsur', 'munsur', TRUE);
    }

    public function index($offset = 0) {
        $this->data['main_container'] = 'unsur/index';
        $this->data['js']= 'unsur/vjs';
        // $this->data['form_action'] = 'sekolah';

        $unsur = $this->munsur->cari_semua();

        if ($unsur) {
            $table = $this->munsur->buat_table($unsur);
            $this->data['tabel_data'] = $table;
        } else {
            $this->data['pesan'] = 'Tidak Ada Data Unsur';
        }
        $this->load->view('template/template_backend',$this->data); 
    }

    function get_data()
    {
        $list = $this->munsur->get_datatables();
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
                anchor('editunsur/'.$field->id_unsur,'<button class="btn btn-mini btn-info"><i class="icon-pencil bigger-120"></i></button>')
                .
                anchor('hapusunsur/'.$field->id_unsur,'<button class="btn btn-mini btn-danger"><i class="icon-trash bigger-120"></i></button>',array('onclick'=>"return confirm('Anda yakin akan menghapus data ini?')"))
                .
                '<div>';

            $data[] = $row;
        }
 
        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->munsur->count_all(),
            "recordsFiltered" => $this->munsur->count_filtered(),
            "data" => $data,
        );
        //output dalam format JSON
        echo json_encode($output);
    }


        public function tambah() {
        $this->data['main_container'] = 'unsur/vunsur_form';
        $this->data['form_action'] = 'unsur/cunsur/tambah';
        if ($this->input->post('submit')) {
            if ($this->munsur->validasi_tambah()) {
                if ($this->munsur->tambah()) {
                    $this->session->set_flashdata('pesan', '<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert">&times;</button>Proses tambah data berhasil.</div>');
                    redirect('unsur');
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
        $this->data['main_container'] = 'unsur/vunsur_form';
        $this->data['form_action'] = 'unsur/cunsur/edit/' . $id;
        if (!empty($id)) {
            if ($this->input->post('submit')) {
                if ($this->munsur->validasi_edit() == TRUE) {
                    $this->munsur->edit($this->session->userdata('id_unsur'));
                    $this->session->set_flashdata('pesan', '<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert">&times;</button>Proses update data berhasil.</div>');
                    redirect('unsur');
                } else {
                    $this->load->view('template/template_backend',$this->data);  
                }
            } else {
                $unsur = $this->munsur->cari($id);
                foreach ($unsur as $key => $value) {
                    $this->data['form_value'][$key] = $value;
                }
                $this->session->set_userdata('id_unsur', $unsur->id_unsur);
                $this->session->set_userdata('nama_unsur', $unsur->nama_unsur);
                $this->session->set_userdata('kode_unsur', $unsur->kode_unsur);
                $this->session->set_userdata('keterangan', $unsur->keterangan);
                $this->load->view('template/template_backend',$this->data);  
            }
        } else {
            redirect('unsur');
        }
    }

    function hapus($id) {
        
        if($this->munsur->hapus($id)){
        $this->session->set_flashdata('pesan', '<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert">&times;</button>Proses hapus data berhasil.</div>');
        redirect('unsur');
    }else {
        $this->session->set_flashdata('pesan', '<div class="alert alert-error"><button type="button" class="close" data-dismiss="alert">&times;</button>Proses hapus data gagal.</div>');
        redirect('unsur');
    }
    }        

}

?>
