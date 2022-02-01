<?php

class Cruangan extends MY_Controller {

    public $data;

    public function __construct() {
        parent::__construct();
        $this->data['halaman']="Data Master Ruangan";
        $this->data['js']= null;
        $this->data['tombol_tambah']="<a href='".base_url()."tambahruangan'><button class='btn btn-info'><i class='icon-plus  bigger-125'></i><b> Tambah Data Ruangan</b></button></a></a>";
        $this->data['active_hal'] = array('link'=>'datamaster','sub_link' => 'ruangan');
        $this->load->model('ruangan/mruangan', 'mruangan', TRUE);
    }

    public function index($offset = 0) {
        $this->data['main_container'] = 'ruangan/index';
        $this->data['js']= 'ruangan/vjs';
        // $this->data['form_action'] = 'sekolah';

        $ruangan = $this->mruangan->cari_semua();

        if ($ruangan) {
            $table = $this->mruangan->buat_table($ruangan);
            $this->data['tabel_data'] = $table;
        } else {
            $this->data['pesan'] = 'Tidak Ada Data Ruangan';
        }
        $this->load->view('template/template_backend',$this->data); 
    }

    function get_data()
    {
        $list = $this->mruangan->get_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $field) {
            $no++;
            $row = array();
            $row[] = $no;
                 $row[] = $field->nama_ruangan;
                 $row[] = $field->id_ruangan;
                 $row[] = $field->keterangan;

                $row[] = '<div class="hidden-phone visible-desktop btn-group action-buttons">'.
                anchor('editruangan/'.$field->id_ruangan,'<button class="btn btn-mini btn-info"><i class="icon-pencil bigger-120"></i></button>')
                .
                anchor('hapusruangan/'.$field->id_ruangan,'<button class="btn btn-mini btn-danger"><i class="icon-trash bigger-120"></i></button>',array('onclick'=>"return confirm('Anda yakin akan menghapus data ini?')"))
                .
                '<div>';

            $data[] = $row;
        }
 
        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->mruangan->count_all(),
            "recordsFiltered" => $this->mruangan->count_filtered(),
            "data" => $data,
        );
        //output dalam format JSON
        echo json_encode($output);
    }


        public function tambah() {
        $this->data['main_container'] = 'ruangan/vruangan_form';
        $this->data['form_action'] = 'ruangan/cruangan/tambah';
        if ($this->input->post('submit')) {
            if ($this->mruangan->validasi_tambah()) {
                if ($this->mruangan->tambah()) {
                    $this->session->set_flashdata('pesan', '<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert">&times;</button>Proses tambah data berhasil.</div>');
                    redirect('ruangan');
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
        $this->data['main_container'] = '/vruangan_form';
        $this->data['form_action'] = 'ruangan/cruangan/edit/' . $id;
        if (!empty($id)) {
            if ($this->input->post('submit')) {
                if ($this->mruangan->validasi_edit() == TRUE) {
                    $this->mruangan->edit($this->session->userdata('id_ruangan'));
                    $this->session->set_flashdata('pesan', '<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert">&times;</button>Proses update data berhasil.</div>');
                    redirect('ruangan');
                } else {
                    $this->load->view('template/template_backend',$this->data);  
                }
            } else {
                $ruangan = $this->mruangan->cari($id);
                foreach ($ruangan as $key => $value) {
                    $this->data['form_value'][$key] = $value;
                }
                $this->session->set_userdata('id_ruangan', $ruangan->id_ruangan);
                $this->session->set_userdata('nama_ruangan', $ruangan->nama_ruangan);
                $this->session->set_userdata('keterangan', $ruangan->keterangan);
                $this->load->view('template/template_backend',$this->data);  
            }
        } else {
            redirect('ruangan');
        }
    }

    function hapus($id) {
        
        if($this->mruangan->hapus($id)){
        $this->session->set_flashdata('pesan', '<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert">&times;</button>Proses hapus data berhasil.</div>');
        redirect('ruangan');
    }else {
        $this->session->set_flashdata('pesan', '<div class="alert alert-error"><button type="button" class="close" data-dismiss="alert">&times;</button>Proses hapus data gagal.</div>');
        redirect('ruangan');
    }
    }        

}

?>
