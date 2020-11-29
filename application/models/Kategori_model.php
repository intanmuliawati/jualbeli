<?php
defined('BASEPATH') or exit('No direct script access allowed');

class kategori_model extends CI_Model
{

	function get_kategori()
	{
		$hasil = $this->db->query("SELECT * FROM kategori_benang ORDER BY kategori_nama ASC");
		return $hasil;
	}

	function getnobenang()
	{
		$hasil = $this->db->query("SELECT * FROM subkategori_benang ORDER BY subkategori_nama ASC");
		return $hasil->result();
	}

	function get_subkategori($id)
	{
		$this->db->order_by('subkategori_nama', 'ASC');
		$hasil = $this->db->query("SELECT * FROM subkategori_benang WHERE kategori_id='$id' ORDER BY subkategori_nama ASC");
		return $hasil->result();
	}

	public function hapusdatakategori($where, $table)
	{
		$this->db->where($where);
		$this->db->delete($table);
	}

	public function ubahkat($kategori_id, $kategori_nama)
	{
		$hasil = $this->db->query("UPDATE kategori_benang SET kategori_nama = '$kategori_nama' WHERE kategori_id='$kategori_id'");
		return $hsl;
	}

	public function getkategori()
	{
		$query = "SELECT `subkategori_benang`.*,`kategori_benang`. `kategori_nama` 
        FROM `subkategori_benang` JOIN `kategori_benang`ON `subkategori_benang`.`kategori_id` = `kategori_benang`.`kategori_id`";
		return $this->db->query($query)->result_array();
	}

	public function hapusdatasubkategori($where, $table)
	{
		$this->db->where($where);
		$this->db->delete($table);
	}

	public function ubahsubkat($subkategori_id, $subkategori_nama, $kategori_id)
	{
		$hasil = $this->db->query("UPDATE subkategori_benang SET kategori_id='$kategori_id', subkategori_nama = '$subkategori_nama' WHERE subkategori_id='$subkategori_id'");
		return $hsl;
	}
}
