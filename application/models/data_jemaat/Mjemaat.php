<?php 
class Mjemaat extends CI_Model
{
    public $db_tabel    = 'data_jemaat';
    public $per_halaman = 10;
    public $offset      = 0;
    

    var $column_order = array('nik','nama_jemaat','jenis_kelamin','tempat_lahir','tanggal lahir','alamat','id_wijk','id_ksp','id_unsur','status_baptis','status_sidi','status_nikah','keterangan');
    var $column_search = array('nik','nama_jemaat','nama_wijk','nama_ksp');
    var $order = array('nama_jemaat' => 'asc');

    public function __construct()
    {
        parent::__construct();
        $this->load->library('table');
        // $this->form_validation->CI = &$this;
    }

    public function cari_semua(){
        return $this->db->select('*')
                        ->from($this->db_tabel)
                        ->get()
                        ->result();
    }


    public function buat_table($data)
    {
         $tmpl = array('row_alt_start'  => '<thead>',
         'table_open'     => '<table class="table table-bordered" 
         id="dataTable" width="100%" cellspacing="0;">');
        $this->table->set_template($tmpl);

        $this->table->set_heading('No','NIK','Nama Lengkap','Jenis Kelamin','Tempat Lahir','Tanggal Lahir','Alamat','Wijk','KSP','Unsur','Status Baptis','Status SIDI','Status Nikah','Keterangan');
        $no = 0 + $this->offset;
        foreach ($data as $row)
        {
            $this->table->add_row(
                ++$no,
                $row->nik,
                $row->nama_jemaat,
                $row->jenis_kelamin,
                $row->tempat_lahir,
                $row->tanggal_lahir,
                $row->alamat,
                $row->id_wijk,
                $row->id_ksp,
                $row->id_unsur,
                $row->status_baptis,
                $row->status_sidi,
                $row->status_nikah,
                $row->keterangan,


                '<div class="hidden-phone visible-desktop btn-group action-buttons">'.
                anchor('backend-sekolah-ubah/'.$row->nik,'<button class="btn btn-mini btn-info"><i class="icon-pencil bigger-120"></i></button>')
                .
                anchor('backend-sekolah-hapus/'.$row->nik,'<button class="btn btn-mini btn-danger"><i class="icon-trash bigger-120"></i></button>',array('onclick'=>"return confirm('Anda yakin akan menghapus data ini?')"))
                .
                '<div>'
            );
        }
        $tabel = $this->table->generate();

        return $tabel;
    }

    //datatables server side

    private function _get_datatables_query()
    {

        
        $this->db->from($this->db_tabel)
            ->join('unsur', 'unsur.id_unsur = data_jemaat.id_unsur')
            ->join('wijk', 'wijk.id_wijk = data_jemaat.id_wijk')
            ->join('ksp', 'ksp.id_ksp = data_jemaat.id_ksp');
        $i = 0;

        foreach ($this->column_search as $key ) {
            # code...
            if($_POST['search']['value'])
            {
                if ($i===0)
                {
                    $this->db->group_start(); 
                    $this->db->like($key, $_POST['search']['value']);  
                }
                else{
                    $this->db->or_like($key, $_POST['search']['value']);
                }
                if(count($this->column_search) - 1 == $i) 
                    $this->db->group_end(); 

            }
            $i++;
        }

        if(isset($_POST['order'])) 
        {
            $this->db->order_by($this->column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        } 
        else if(isset($this->order))
        {
            $order = $this->order;
            $this->db->order_by(key($order), $order[key($order)]);
        }

    }

        function get_datatables()
        {
            $this->_get_datatables_query();
            if($_POST['length'] != -1)
            $this->db->limit($_POST['length'], $_POST['start']);
            $query = $this->db->get();
            return $query->result();
        }
     
        function count_filtered()
        {
            $this->_get_datatables_query();
            $query = $this->db->get();
            return $query->num_rows();
        }
     
        public function count_all()
        {
            $this->db->from($this->db_tabel);
            return $this->db->count_all_results();
        }

        private function load_form_rules_tambah()
        {   
        $form = array(
                        array(
                            'field' => 'nik',
                            'label' => 'NIK',
                            'rules' => "required"
                        ),
                        array(
                            'field' => 'nama_jemaat',
                            'label' => 'Nama Jemaat',
                            'rules' => "required"
                        )
                        
        );
        return $form;
        }

        public function validasi_tambah()
        {
        $form = $this->load_form_rules_tambah();
        $this->form_validation->set_rules($form);

        if ($this->form_validation->run())
        {
            return TRUE;
        }
        else
        {
            return FALSE;
        }
    }

            public function tambah()
    {
        $id = array(
            'nik'     => $this->input->post('nik'),
            'nama_jemaat'     => $this->input->post('nama_jemaat'),
            'jenis_kelamin'     => $this->input->post('jenis_kelamin'),
            'tempat_lahir'     => $this->input->post('tempat_lahir'),
            'tanggal_lahir'     => $this->input->post('tanggal_lahir'),
            'alamat'     => $this->input->post('alamat'),
            'id_wijk'     => $this->input->post('id_wijk'),
            'id_ksp'     => $this->input->post('id_ksp'),
            'id_unsur'     => $this->input->post('id_unsur'),
            'status_baptis'     => $this->input->post('status_baptis'),
            'status_sidi'     => $this->input->post('status_sidi'),
            'status_nikah'     => $this->input->post('status_nikah'),
            'keterangan'     => $this->input->post('keterangan')


        );
        $this->db->insert($this->db_tabel, $id);
        if($this->db->affected_rows() > 0)
        {
            return TRUE;
        }
        else
        {
            return FALSE;
        }
    }

    public function validasi_edit()
    {
        $form = $this->load_form_rules_edit();
        $this->form_validation->set_rules($form);

        if ($this->form_validation->run())
        {
            return TRUE;
        }
        else
        {
            return FALSE;
        }
    }

    private function load_form_rules_edit()
    {
         $form = array(
            array(
                'field' => 'nik',
                'label' => 'NIK',
                'rules' => "required"
            ),
            array(
                'field' => 'nama_jemaat',
                'label' => 'Nama Jemaat',
                'rules' => "required"
            ) 
        );
        return $form;
    }

        public function edit($id)
    {
        $id = array(
            'nik'     => $this->input->post('nik'),
            'nama_jemaat'     => $this->input->post('nama_jemaat'),
            'jenis_kelamin'     => $this->input->post('jenis_kelamin'),
            'tempat_lahir'     => $this->input->post('tempat_lahir'),
            'tanggal_lahir'     => $this->input->post('tanggal_lahir'),
            'alamat'     => $this->input->post('alamat'),
            'id_wijk'     => $this->input->post('id_wijk'),
            'id_ksp'     => $this->input->post('id_ksp'),
            'id_unsur'     => $this->input->post('id_unsur'),
            'status_baptis'     => $this->input->post('status_baptis'),
            'status_sidi'     => $this->input->post('status_sidi'),
            'status_nikah'     => $this->input->post('status_nikah'),
            'keterangan'     => $this->input->post('keterangan')
        );
        $this->db->where('nik', $id);
        $this->db->update($this->db_tabel, $id);

        if($this->db->affected_rows() > 0)
        {
            return TRUE;
        }
        else
        {
            return FALSE;
        }
    }

        public function cari($id)
    {
        return $this->db
                    ->where('nik', $id)
                    ->limit(1)
                    ->get($this->db_tabel)
                    ->row();
    }

    public function hapus($id)
    {
        $this->db->where('nik', $id)->delete($this->db_tabel);

        if($this->db->affected_rows() > 0)
        {
            return TRUE;
        }
        else
        {
            return FALSE;
        }
    }            

}    

?>