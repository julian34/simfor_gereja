<?php

class Cjenis_barang extends MY_Controller {

    public $data;

    public function __construct() {
        parent::__construct();
        $this->data['halaman']="Data Master Jenis Barang";
        $this->data['js']= null;
        $this->data['tombol_tambah']="<a href='".base_url()."tambahjenis_barang'>><button class='btn btn-info'><i class='icon-plus  bigger-125'></i><b> Tambah Data Jenis Barang</b></button></a></a>";
        $this->data['active_hal'] = array('link'=>'datamaster','sub_link' => 'jenis_barang');
        $this->load->model('jenis_barang/mjenis_barang', 'mjenis_barang', TRUE);
    }

    public function index($offset = 0) {
        $this->data['main_container'] = 'jenis_barang/index';
        $this->data['js']= 'jenis_barang/vjs';
        // $this->data['form_action'] = 'sekolah';

        $jenis_barang = $this->mjenis_barang->cari_semua();

        if ($jenis_barang) {
            $table = $this->mjenis_barang->buat_table($jenis_barang);
            $this->data['tabel_data'] = $table;
        } else {
            $this->data['pesan'] = 'Tidak Ada Data Jenis Barang';
        }
        $this->load->view('template/template_backend',$this->data); 
    }

    function get_data()
    {
        $list = $this->mjenis_barang->get_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $field) {
            $no++;
            $row = array();
            $row[] = $no;
                 $row[] = $field->nama_jenisbarang;
                 $row[] = $field->keterangan;

                $row[] = '<div class="hidden-phone visible-desktop btn-group action-buttons">'.
                anchor('editjenis_barang/'.$field->id_jenisbarang,'<button class="btn btn-mini btn-info"><i class="icon-pencil bigger-120"></i></button>')
                .
                anchor('hapusjenis_barang/'.$field->id_jenisbarang,'<button class="btn btn-mini btn-danger"><i class="icon-trash bigger-120"></i></button>',array('onclick'=>"return confirm('Anda yakin akan menghapus data ini?')"))
                .
                '<div>';

            $data[] = $row;
        }
 
        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->mjenis_barang->count_all(),
            "recordsFiltered" => $this->mjenis_barang->count_filtered(),
            "data" => $data,
        );
        //output dalam format JSON
        echo json_encode($output);
    }


        public function tambah() {
        $this->data['main_container'] = 'jenis_barang/vjenis_barangform';
        $this->data['form_action'] = 'jenis_barang/cjenis_barang/tambah';
        if ($this->input->post('submit')) {
            if ($this->mjenis_barang->validasi_tambah()) {
                if ($this->mjenis_barang->tambah()) {
                    $this->session->set_flashdata('pesan', '<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert">&times;</button>Proses tambah data berhasil.</div>');
                    redirect('jenis_barang');
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
        $this->data['main_container'] = 'jenis_barang/vjenis_barangform';
        $this->data['form_action'] = 'jenis_barang/cjenis_barang/edit/' . $id;
        if (!empty($id)) {
            if ($this->input->post('submit')) {
                if ($this->mjenis_barang->validasi_edit() == TRUE) {
                    $this->mjenis_barang->edit($this->session->userdata('id_jenis_barang'));
                    $this->session->set_flashdata('pesan', '<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert">&times;</button>Proses update data berhasil.</div>');
                    redirect('jenis_barang');
                } else {
                    $this->load->view('template/template_backend',$this->data);  
                }
            } else {
                $jenis_barang = $this->mjenis_barang->cari($id);
                foreach ($jenis_barang as $key => $value) {
                    $this->data['form_value'][$key] = $value;
                }
                $this->session->set_userdata('id_jenisbarang', $jenis_barang->id_jenisbarang);
                $this->session->set_userdata('nama_jenisbarang', $jenis_barang->nama_jenisbarang);
                $this->session->set_userdata('keterangan', $jenis_barang->keterangan);
                $this->load->view('template/template_backend',$this->data);  
            }
        } else {
            redirect('jenis_barang');
        }
    }

    function hapus($id) {
        
        if($this->mjenis_barang->hapus($id)){
        $this->session->set_flashdata('pesan', '<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert">&times;</button>Proses hapus data berhasil.</div>');
        redirect('jenis_barang');
    }else {
        $this->session->set_flashdata('pesan', '<div class="alert alert-error"><button type="button" class="close" data-dismiss="alert">&times;</button>Proses hapus data gagal.</div>');
        redirect('jenis_barang');
    }
    }        

}

?>
