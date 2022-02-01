<?php 
class Mbahan extends CI_Model
{
    public $db_tabel    = 'bahan';
    public $per_halaman = 10;
    public $offset      = 0;

    var $column_order = array(null, 'nama_bahan','keterangan',null);
    var $column_search = array('nama_bahan','keterangan');
    var $order = array('nama_bahan' => 'asc');

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

        $this->table->set_heading('No','Nama Bahan','Keterangan','Aksi');
        $no = 0 + $this->offset;
        foreach ($data as $row)
        {
            $this->table->add_row(
                ++$no,
                $row->nama_bahan,
                $row->keterangan,

                '<div class="hidden-phone visible-desktop btn-group action-buttons">'.
                anchor('backend-sekolah-ubah/'.$row->id_bahan,'<button class="btn btn-mini btn-info"><i class="icon-pencil bigger-120"></i></button>')
                .
                anchor('backend-sekolah-hapus/'.$row->id_bahan,'<button class="btn btn-mini btn-danger"><i class="icon-trash bigger-120"></i></button>',array('onclick'=>"return confirm('Anda yakin akan menghapus data ini?')"))
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
        $this->db->from($this->db_tabel);
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
                            'field' => 'nama_bahan',
                            'label' => 'Nama Bahan',
                            'rules' => "required"
                        ),
                        array(
                            'field' => 'keterangan',
                            'label' => 'Keterangan',
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
        $bahan = array(
            'nama_bahan'     => $this->input->post('nama_bahan'),
            'keterangan'     => $this->input->post('keterangan')

        );
        $this->db->insert($this->db_tabel, $bahan);
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
                            'field' => 'nama_bahan',
                            'label' => 'Nama Bahan',
                            'rules' => "required"
                        ),
                        array(
                            'field' => 'keterangan',
                            'label' => 'Keterangan',
                            'rules' => "required"
                        ) 
        );
        return $form;
    }

        public function edit($id)
    {
        $bahan = array(
            'nama_bahan'     => $this->input->post('nama_bahan'),
            'keterangan'     => $this->input->post('keterangan')

        );
        $this->db->where('id_bahan', $id);
        $this->db->update($this->db_tabel, $bahan);

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
                    ->where('id_bahan', $id)
                    ->limit(1)
                    ->get($this->db_tabel)
                    ->row();
    }

    public function hapus($id)
    {
        $this->db->where('id_bahan', $id)->delete($this->db_tabel);

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