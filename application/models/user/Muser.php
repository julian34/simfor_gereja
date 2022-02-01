<?php 
class Muser extends CI_Model
{
    public $db_tabel    = 'users';
    public $per_halaman = 10;
    public $offset      = 0;

    var $column_order = array(null,'username','nama_lengkap','aktif',null);
    var $column_search = array('username','nama_lengkap','aktif');
    var $order = array('nama_lengkap' => 'asc');

    public function __construct(){
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

    public function buat_table($data){
         $tmpl = array('row_alt_start'  => '<thead>',
                      'table_open'     => '<table class="table table-bordered" 
                                id="dataTable" width="100%" cellspacing="0;">');
        $this->table->set_template($tmpl);

        $this->table->set_heading('No','Username','Nama Lengkap','Aktif','Aksi');
        $no = 0 + $this->offset;
        foreach ($data as $row)
        {
            $this->table->add_row(
                ++$no,
                $row->username,
                $row->nama_lengkap,
                $row->aktif,

                '<div class="hidden-phone visible-desktop btn-group action-buttons">'.
                anchor('backend-sekolah-ubah/'.$row->id_user,'<button class="btn btn-mini btn-info"><i class="icon-pencil bigger-120"></i></button>')
                .
                anchor('backend-sekolah-hapus/'.$row->id_user,'<button class="btn btn-mini btn-danger"><i class="icon-trash bigger-120"></i></button>',array('onclick'=>"return confirm('Anda yakin akan menghapus data ini?')"))
                .
                '<div>'
            );
        }
        $tabel = $this->table->generate();

        return $tabel;
    }

    //datatables server side

    private function _get_datatables_query(){

        //join tabel
        $this->db->select('users.id_user as id_user, nama_lengkap, username, aktif ,nama_grup')
                  ->from($this->db_tabel)
                  ->join('auth_grup_users', 'auth_grup_users.id_user = users.id_user')
                  ->join('grup', 'grup.id_grup = auth_grup_users.id_grup');
        //join tabel
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
                            'field' => 'username',
                            'label' => 'Username',
                            'rules' => "required"
                        ),
                        array(
                            'field' => 'nama_lengkap',
                            'label' => 'Nama Lengkap',
                            'rules' => "required"
                        ),
                        array(
                            'field' => 'password',
                            'label' => 'Password',
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

    public function tambah(){

        $data = array(
            'username'      => $this->input->post('username'),
            'nama_lengkap'  => $this->input->post('nama_lengkap'),
            'password'      => md5($this->input->post('password')),
            'aktif'         => 1,

        );

        $this->db->insert($this->db_tabel, $data);

       $data_grup   = array(
           'id_grup' => $this->input->post('grup'),
           'id_user' => $this->db->insert_id()
       );

       $this->db->insert('auth_grup_users',$data_grup);

        if($this->db->affected_rows() > 0)
        {
            return TRUE;
        }
        else
        {
            return FALSE;
        }
    }

    public function validasi_edit(){
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

    private function load_form_rules_edit(){
         $form = array(
                        array(
                            'field' => 'username',
                            'label' => 'Username',
                            'rules' => "required"
                        ),
                        array(
                            'field' => 'nama_lengkap',
                            'label' => 'Nama Lengkap',
                            'rules' => "required"
                        ),
                        array(
                            'field' => 'password',
                            'label' => 'Password',
                            'rules' => "required"
                        )                        
        );
        return $form;
    }

    public function edit($id){
        
        $data = array(
            'username'      => $this->input->post('username'),
            'nama_lengkap'  => $this->input->post('nama_lengkap'),
        );

        if($this->input->post('password') != null){
            $data['password'] = md5($this->input->post('password'));
        }

        $this->db->where('id_user', $id);
        $this->db->update($this->db_tabel, $data);


        if($this->db->affected_rows() > 0)
        {   
            $grupdata = array('id_grup' => $this->input->post('grup'));
            $this->db->where('id_user', $id);
            $this->db->update('auth_grup_users', $grupdata);
            if($this->db->affected_rows() > 0){
                    return TRUE;
            }else{
                        return FALSE;
            }
        }
        else
        {
            return FALSE;
        }
    }

    public function cari($id){
        return $this->db
                    ->where('id_user', $id)
                    ->limit(1)
                    ->get($this->db_tabel)
                    ->row();
    }

    public function hapus($id){
        $this->db->where('id_user', $id)->delete($this->db_tabel);

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