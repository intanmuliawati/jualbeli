<?php
defined('BASEPATH') or exit('No direct script access allowed');

class pemasok_model extends CI_Model
{
    public function getlist($id)
    {
        $query = "SELECT `penawaran`.*,`subkategori_benang`. `subkategori_nama` 
        FROM `penawaran` JOIN `subkategori_benang`ON `penawaran`.`id_benang` = `subkategori_benang`.`subkategori_id` 
        WHERE `penawaran`.`id_pemasok`= '$id' ORDER BY `penawaran`.`id_penawaran` DESC";
        return $this->db->query($query)->result_array();
    }

    // public function ubahpenawaran($id, $jumlah_tersedia, $harga_satuan, $biaya_kirim, $contoh, $catatan)
    // {
    //     $hasil = $this->db->query("UPDATE penawaran SET jumlah_tersedia='$jumlah_tersedia',harga_satuan = '$harga_satuan',biaya_kirim = '$biaya_kirim', contoh = '$contoh', catatan= '$catatan' WHERE id_penawaran='$id'");
    //     return $hsl;
    // }

    public function getpembelian2($st)
    {
        $query = "SELECT `riwayat`.*, `pembelian`.*,`penawaran`.*,`subkategori_benang`. `subkategori_nama`,`user`.`name`FROM `pembelian` JOIN`riwayat` ON `riwayat`.`id_faktur` = `pembelian`.`id_faktur` JOIN `penawaran`ON `pembelian`.`id_penawaran` = `penawaran`.`id_penawaran` JOIN`subkategori_benang` ON `penawaran`.`id_benang` = `subkategori_benang`.`subkategori_id` JOIN `user`ON `user`.`id` = `penawaran`.`id_pemasok` WHERE `pembelian`.`status_kirim` = $st ORDER BY `pembelian`.`id_pembelian` DESC ";
        return $this->db->query($query)->result_array();
    }

    public function getpesanan($id)
    {
        $query = "SELECT `riwayat`.*, `pembelian`.*,`penawaran`.*,`subkategori_benang`. `subkategori_nama`,`user`.`name`FROM `pembelian` JOIN`riwayat` ON `riwayat`.`id_faktur` = `pembelian`.`id_faktur` JOIN `penawaran`ON `pembelian`.`id_penawaran` = `penawaran`.`id_penawaran` JOIN`subkategori_benang` ON `penawaran`.`id_benang` = `subkategori_benang`.`subkategori_id` JOIN `user`ON `user`.`id` = `penawaran`.`id_pemasok` WHERE `penawaran`.`id_pemasok`= '$id' AND `riwayat`.`status_pay` = 200 AND `pembelian`.`status_kirim` = 0";
        return $this->db->query($query)->result_array();
    }

}
