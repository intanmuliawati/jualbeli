<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Tabel Data List Pemesanan</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <div class="flash-data" data-flashdata="<?= $this->session->flashdata('flash'); ?>"></div>
                <?= form_error('tanggal', '<div class="alert alert-danger pl-3" role="alert">', '</div>'); ?>
                <?= form_error('contoh', '<div class="alert alert-danger pl-3" role="alert">', '</div>'); ?>
                <table id="datatable" class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr style="text-align:center">
                            <th>N0</th>
                            <th>Nama benang</th>
                            <th>Warna</th>
                            <th>Jumlah Pembelian</th>
                            <th>Total Pembelian Benang</th>
                            <th>Tanggal Pemesanan</th>
                            <th>Masukan Pengiriman</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 1; ?>
                        <?php foreach ($pemesanan as $pm) :
                            $format = date('d F Y', strtotime($pm['tgl_pembelian']));
                            ?>
                            <tr>
                                <th scope="row"><?= $i; ?></td>
                                <td><?= $pm['subkategori_nama']; ?></td>
                                <td><?= $pm['warna']; ?></td>
                                <td><?php
                                        $angka = $pm['jumlah'];
                                        $angka_format = number_format($angka, 2, ",", ".");
                                        echo $angka_format . ' kg';
                                        ?></td>
                                <td><?php
                                        $angka = $pm['total'];
                                        $angka_format = number_format($angka, 0, ",", ".");
                                        echo 'Rp ' . $angka_format;
                                        ?></td>
                                <td><?= $format ?></td>
                                <td style="text-align:center">
                                    <a href="" class="btn btn-info btn-icon-split" data-toggle="modal" data-target="#newpengirimanModal<?= $pm['id_pembelian']; ?>">
                                        <span class="icon text-white-0">
                                            <i class="fas fa-truck"></i>
                                        </span>
                                    </a>
                                </td>
                            </tr>
                            <?php $i++; ?>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>
<!-- /.container-fluid -->


<!-- Modal edit data -->
<?php
foreach ($pemesanan as $pm) :
    ?>
    <div class="modal fade" id="newpengirimanModal<?= $pm['id_pembelian']; ?>" tabindex="-1" role="dialog" aria-labelledby="newpengirimanModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="newpengirimanModalLabel">Masukan Data Pengiriman</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <?= form_open_multipart('pemesanan'); ?>
                <div class="modal-body">
                    <input type="hidden" id="id_pemasok" name="id_pemasok" value="<?= $user['id']; ?>">
                    <input type="hidden" id="id_pembelian" name="id_pembelian" value="<?= $pm['id_pembelian']; ?>">
                    <div class="form-group">
                        <label> Tanggal Pengiriman </label>
                        <div class="input-group date">
                            <input placeholder="Masukan Tanggal" type="date" class="form-control" id="tanggal" name="tanggal">
                        </div>
                    </div>
                    <div class="form-group">
                        <label> Opsi Pengiriman </label>
                        <div class="input-group ">
                            <input type="text" class="form-control" id="pengiriman" name="pengiriman">
                        </div>
                    </div>
                    <div class="form-group">
                        <label> No Resi Pengiriman </label>
                        <div class="input-group ">
                            <input type="text" class="form-control" id="resi" name="resi" >
                        </div>
                    </div>
                    <div class="form-group">
                        <label> Bukti Pengiriman </label>
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" id="contoh" name="contoh">
                            <label class="custom-file-label" for="contoh">Pilih Gambar</label>
                        </div>
                    </div>
                    <div class="form-group">
                        <label> Catatan </label>
                        <div class="input-group ">
                            <input placeholder="Catatan" type="text" class="form-control" id="catatan" name="catatan">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-primary"> Tambah </button>
                </div>
                <?= form_close() ?>
            </div>
        </div>
    </div>
<?php endforeach; ?>