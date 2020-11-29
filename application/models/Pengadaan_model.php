<?php
defined('BASEPATH') or exit('No direct script access allowed');

class pengadaan_model extends CI_Model
{
    public function getlist()
    {
        // $query = "SELECT `penawaran`.*,`subkategori_benang`. `subkategori_nama` ,`user`.`name`,`user`.`nilai_preferensi`
        $query = "SELECT `penawaran`.*,`subkategori_benang`. `subkategori_nama` ,`user`.`name`
        FROM `penawaran` JOIN `subkategori_benang`ON `penawaran`.`id_benang` = `subkategori_benang`.`subkategori_id` JOIN `user` ON `penawaran`.`id_pemasok` = `user`.`id` 
        WHERE `penawaran`.`jumlah_tersedia` != 0 ORDER BY `penawaran`.`id_penawaran` DESC";
        return $this->db->query($query)->result_array();
    }

    public function updatesisa($id, $sisa)
    {
        $hasil = $this->db->query("UPDATE penawaran SET  jumlah_tersedia = $sisa WHERE id_penawaran='$id'");
        return $hasil;
    }
    public function getpembelian($id)
    {
        $query = "SELECT `pembelian`.*,`penawaran`.*,`subkategori_benang`. `subkategori_nama`,`user`.`name`
        FROM `pembelian` JOIN `penawaran`ON `pembelian`.`id_penawaran` = `penawaran`.`id_penawaran` JOIN`subkategori_benang` ON `penawaran`.`id_benang` = `subkategori_benang`.`subkategori_id` JOIN `user`ON `user`.`id` = `penawaran`.`id_pemasok` WHERE `pembelian`.`status` = '0' AND `pembelian`.`id`= $id ORDER BY `pembelian`.`id_pembelian` DESC ";
        return $this->db->query($query)->result_array();
    }   
    public function getdetail($faktur)
    {
        $query = "SELECT `pembelian`.*,`penawaran`.*,`subkategori_benang`. `subkategori_nama`,`user`.`name`
        FROM `pembelian` JOIN `penawaran`ON `pembelian`.`id_penawaran` = `penawaran`.`id_penawaran` JOIN`subkategori_benang` ON `penawaran`.`id_benang` = `subkategori_benang`.`subkategori_id` JOIN `user`ON `user`.`id` = `penawaran`.`id_pemasok` WHERE `pembelian`.`id_faktur` = $faktur ORDER BY `pembelian`.`id_pembelian` DESC ";
        return $this->db->query($query)->result_array();
    }
    public function getriwayat($id)
    {
        $query = "SELECT `riwayat`.*,`pembelian`.`id_faktur`,`pembelian`.`id`,`user`.`name`
        FROM `riwayat` LEFT outer JOIN `pembelian`ON `riwayat`.`id_faktur` = `pembelian`.`id_faktur` JOIN `user`ON `user`.`id` = `pembelian`.`id` WHERE `riwayat`.`id_user`= $id ORDER BY `riwayat`.`id_faktur` DESC ";
        return $this->db->query($query)->result_array();
    }
    public function getcetak($id)
    {
        $query = "SELECT `pembelian`.*,`penawaran`.*,`riwayat`.* , `subkategori_benang`. `subkategori_nama`,`user`.`name` FROM `pembelian` JOIN `penawaran`ON `pembelian`.`id_penawaran` = `penawaran`.`id_penawaran` JOIN`subkategori_benang` ON `penawaran`.`id_benang` = `subkategori_benang`.`subkategori_id` JOIN `user`ON `user`.`id` = `penawaran`.`id_pemasok` JOIN `riwayat` ON`pembelian`.`id_faktur`= `riwayat`.`id_faktur` WHERE `riwayat`.`id_faktur`= $id ";
        return $this->db->query($query)->result_array();
    }

    public function hapuspembelian($id)
    {
        $hasil = $this->db->query("DELETE FROM pembelian WHERE id_pembelian='$id'");
        return $hasil;
    }

    public function getpengiriman($id)
    {
        $query = "SELECT * FROM pengiriman WHERE id_pembelian = '$id'";
        return $this->db->query($query)->result_array();
    }

    public function getpenjualan()
    {
        $query = "SELECT `datapenjualan`.*,`subkategori_benang`. `subkategori_nama`
        FROM `datapenjualan` JOIN `subkategori_benang`ON `datapenjualan`.`id_benang` = `subkategori_benang`.`subkategori_id` ORDER BY `subkategori_benang`. `subkategori_nama` ASC ";
        return $this->db->query($query)->result_array();
    }

    
}
