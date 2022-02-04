<?php 
class Mdropdown extends CI_Model
{

    // public $db_tabel    = 'unsur';
    
    public function grup(){
            $query = $this->db->select('id_grup,nama_grup')
                        ->from('grup')
                        ->get()
                        ->result();

            foreach ($query as $row){
                $arr[$row->id_grup] = $row->nama_grup; 
            }

            return $arr;
    }

    public function egrup($id_user = null){
        if($id_user != null){
        $query = $this->db->select()
                        ->from('auth_grup_users')
                        ->where('id_user',$id_user)
                        ->get()
                        ->row();
            return $query->id_grup;
        }
    }

    public function dd_wijk(){
        $query = $this->db->select('id_grup,nama_grup')
                    ->from('grup')
                    ->get()
                    ->result();

        foreach ($query as $row){
            $arr[$row->id_grup] = $row->nama_grup; 
        }

        return $arr;
}

}