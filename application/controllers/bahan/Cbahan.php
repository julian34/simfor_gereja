<?php

class Cbahan extends MY_Controller {

    public $data;

    public function __construct() {
        parent::__construct();
        $this->data['halaman']="Data Master Bahan";
        $this->data['js']= null;
        $this->data['tombol_tambah']="<a href='base_url()/tambahbahan'><button class='btn btn-info'><i class='icon-plus  bigger-125'></i><b> Tambah Data Bahan</b></button></a></a>";
        $this->data['active_hal'] = array('link'=>'datamaster','sub_link' => 'bahan');
        $this->load->model('bahan/mbahan', 'mbahan', TRUE);
    }

    public function index($offset = 0) {
        $this->data['main_container'] = 'bahan/index';
        $this->data['js']= 'bahan/vjs';
        // $this->data['form_action'] = 'sekolah';

        $bahan = $this->mbahan->cari_semua();

        if ($bahan) {
            $table = $this->mbahan->buat_table($bahan);
            $this->data['tabel_data'] = $table;
        } else {
            $this->data['pesan'] = 'Tidak Ada Data Bahan';
        }
        $this->load->view('template/template_backend',$this->data); 
    }

    function get_data()
    {
        $list = $this->mbahan->get_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $field) {
            $no++;
            $row = array();
            $row[] = $no;
                 $row[] = $field->nama_bahan;
                 $row[] = $field->id_bahan;
                 $row[] = $field->keterangan;

                $row[] = '<div class="hidden-phone visible-desktop btn-group action-buttons">'.
                anchor('editbahan/'.$field->id_bahan,'<button class="btn btn-mini btn-info"><i class="icon-pencil bigger-120"></i></button>')
                .
                anchor('hapusbahan/'.$field->id_bahan,'<button class="btn btn-mini btn-danger"><i class="icon-trash bigger-120"></i></button>',array('onclick'=>"return confirm('Anda yakin akan menghapus data ini?')"))
                .
                '<div>';

            $data[] = $row;
        }
 
        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->mbahan->count_all(),
            "recordsFiltered" => $this->mbahan->count_filtered(),
            "data" => $data,
        );
        //output dalam format JSON
        echo json_encode($output);
    }


        public function tambah() {
        $this->data['main_container'] = 'bahan/vbahan_form';
        $this->data['form_action'] = 'bahan/cbahan/tambah';
        if ($this->input->post('submit')) {
            if ($this->mbahan->validasi_tambah()) {
                if ($this->mbahan->tambah()) {
                    $this->session->set_flashdata('pesan', '<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert">&times;</button>Proses tambah data berhasil.</div>');
                    redirect('bahan');
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
        $this->data['main_container'] = 'bahan/vbahan_form';
        $this->data['form_action'] = 'bahan/cbahan/edit/' . $id;
        if (!empty($id)) {
            if ($this->input->post('submit')) {
                if ($this->mbahan->validasi_edit() == TRUE) {
                    $this->mbahan->edit($this->session->userdata('id_bahan'));
                    $this->session->set_flashdata('pesan', '<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert">&times;</button>Proses update data berhasil.</div>');
                    redirect('bahan');
                } else {
                    $this->load->view('template/template_backend',$this->data);  
                }
            } else {
                $bahan = $this->mbahan->cari($id);
                foreach ($bahan as $key => $value) {
                    $this->data['form_value'][$key] = $value;
                }
                $this->session->set_userdata('id_bahan', $bahan->id_bahan);
                $this->session->set_userdata('nama_bahan', $bahan->nama_bahan);
                $this->session->set_userdata('keterangan', $bahan->keterangan);
                $this->load->view('template/template_backend',$this->data);  
            }
        } else {
            redirect('bahan');
        }
    }

    function hapus($id) {
        
        if($this->mbahan->hapus($id)){
        $this->session->set_flashdata('pesan', '<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert">&times;</button>Proses hapus data berhasil.</div>');
        redirect('bahan');
    }else {
        $this->session->set_flashdata('pesan', '<div class="alert alert-error"><button type="button" class="close" data-dismiss="alert">&times;</button>Proses hapus data gagal.</div>');
        redirect('bahan');
    }
    }        

}

?>
