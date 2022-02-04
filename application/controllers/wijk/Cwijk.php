<?php

class Cwijk extends MY_Controller {

    public $data;

    public function __construct() {
        parent::__construct();
        $this->data['halaman']="Data Master Wijk";
        $this->data['js']= null;
        $this->data['tombol_tambah']="<a href='".base_url()."tambahwijk'><button class='btn btn-info'><i class='icon-plus  bigger-125'></i><b> Tambah Data Wijk</b></button></a></a>";
        $this->data['active_hal'] = array('link'=>'datamaster','sub_link' => 'wijk');
        $this->load->model('wijk/mwijk', 'mwijk', TRUE);
    }

    public function index($offset = 0) {
        $this->data['main_container'] = 'wijk/index';
        $this->data['js']= 'wijk/vjs';
        // $this->data['form_action'] = 'sekolah';

        $wijk = $this->mwijk->cari_semua();

        if ($wijk) {
            $table = $this->mwijk->buat_table($wijk);
            $this->data['tabel_data'] = $table;
        } else {
            $this->data['pesan'] = 'Tidak Ada Data Wijk';
        }
        $this->load->view('template/template_backend',$this->data); 
    }

    function get_data()
    {
        $list = $this->mwijk->get_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $field) {
            $no++;
            $row = array();
            $row[] = $no;
                 $row[] = $field->nama_wijk;
                 $row[] = $field->keterangan;

                $row[] = '<div class="hidden-phone visible-desktop btn-group action-buttons">'.
                anchor('editwijk/'.$field->id_wijk,'<button class="btn btn-mini btn-info"><i class="icon-pencil bigger-120"></i></button>')
                .
                anchor('hapuswijk/'.$field->id_wijk,'<button class="btn btn-mini btn-danger"><i class="icon-trash bigger-120"></i></button>',array('onclick'=>"return confirm('Anda yakin akan menghapus data ini?')"))
                .
                '<div>';

            $data[] = $row;
        }
 
        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->mwijk->count_all(),
            "recordsFiltered" => $this->mwijk->count_filtered(),
            "data" => $data,
        );
        //output dalam format JSON
        echo json_encode($output);
    }


        public function tambah() {
        $this->data['main_container'] = 'wijk/vwijk_form';
        $this->data['form_action'] = 'wijk/cwijk/tambah';
        if ($this->input->post('submit')) {
            if ($this->mwijk->validasi_tambah()) {
                if ($this->mwijk->tambah()) {
                    $this->session->set_flashdata('pesan', '<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert">&times;</button>Proses tambah data berhasil.</div>');
                    redirect('wijk');
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
        $this->data['main_container'] = 'wijk/vwijk_form';
        $this->data['form_action'] = 'wijk/cwijk/edit/' . $id;
        if (!empty($id)) {
            if ($this->input->post('submit')) {
                if ($this->mwijk->validasi_edit() == TRUE) {
                    $this->mwijk->edit($this->session->userdata('id_wijk'));
                    $this->session->set_flashdata('pesan', '<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert">&times;</button>Proses update data berhasil.</div>');
                    redirect('wijk');
                } else {
                    $this->load->view('template/template_backend',$this->data);  
                }
            } else {
                $wijk = $this->mwijk->cari($id);
                foreach ($wijk as $key => $value) {
                    $this->data['form_value'][$key] = $value;
                }
                $this->session->set_userdata('id_wijk', $wijk->id_wijk);
                $this->session->set_userdata('nama_wijk', $wijk->nama_wijk);
                $this->session->set_userdata('keterangan', $wijk->keterangan);
                $this->load->view('template/template_backend',$this->data);  
            }
        } else {
            redirect('wijk');
        }
    }

    function hapus($id) {
        
        if($this->mwijk->hapus($id)){
        $this->session->set_flashdata('pesan', '<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert">&times;</button>Proses hapus data berhasil.</div>');
        redirect('wijk');
    }else {
        $this->session->set_flashdata('pesan', '<div class="alert alert-error"><button type="button" class="close" data-dismiss="alert">&times;</button>Proses hapus data gagal.</div>');
        redirect('wijk');
    }
    }        

}

?>
