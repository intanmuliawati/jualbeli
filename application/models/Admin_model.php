<?php
defined('BASEPATH') or exit('No direct script access allowed');

class admin_model extends CI_Model
{
    public function getrole()
    {
        $query = "SELECT * FROM `user_role`";
        return $this->db->query($query)->result_array();
    }
    public function getuser()
    {
        $query = "SELECT `user`.*,`user_role`. * 
        FROM `user` JOIN `user_role`ON `user`.`role_id` = `user_role`.`role_id`";
        return $this->db->query($query)->result_array();
    }
    public function hapususer($where, $table)
    {
        $this->db->where($where);
        $this->db->delete($table);
    }

    public function ubahuser($id, $nama, $email, $alamat, $no_tlp, $role_id, $active)
    {
        $hasil = $this->db->query("UPDATE user SET name='$nama', email = '$email' ,alamat = '$alamat', no_tlp = '$no_tlp', role_id = '$role_id', is_active = '$active' WHERE id='$id'");
        return $hasil;
    }
}
