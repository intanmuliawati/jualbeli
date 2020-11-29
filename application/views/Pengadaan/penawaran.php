<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

    <!-- DataTales Example -->

    <div class="card shadow mb-4">
        <div class="card-header py-3 mb-3">
            <h6 class="m-0 font-weight-bold text-primary">List Penawaran</h6>
        </div>
        <div class="flash-data" data-flashdata="<?= $this->session->flashdata('flash'); ?>"></div>

        <div class="container">
            <?= form_error('jumlah', '<div class="alert alert-danger pl-3" role="alert">', '</div>'); ?>
            <div class="row">
                <!-- <div class="col-auto">
                    <a href="" class="btn btn-primary col-auto mb-3 sm-5 " data-toggle="modal" data-target="#newpenawaranModal"> Tambah Penawaran </a>
                </div> -->
                <div class="col-auto ">
                    <?= form_open('penawaran/search') ?>
                    <div class="input-group">
                        <input type="text" name="keyword" class="form-control" placeholder="Search">
                        <div class="input-group-append md-4">
                            <button class="btn btn-info" type="submit">
                                <i class="fas fa-search fa-sm"></i>
                            </button>
                            <a href="<?= base_url('penawaran'); ?> " class="btn btn-warning mr-6 ">
                                <i class="fas fa-undo"></i> </a>
                        </div>
                    </div>
                    <?= form_close() ?>
                </div>
            </div>
            <br>
            <div class="row">
                <?php
                foreach ($penawaran as $p) : ?>
                    <div class="col-md-4">
                        <div class="card mb-4 shadow-sm">
                            <div class="card-body">
                                <div class="panel-body" style="text-align: center; overflow: hidden; padding: 0;">
                                    <img style="height: 170px; " src="<?= base_url('assets/upload/contohbenang/') . $p['contoh'] ?>" class="img-thumbnail rounded mx-auto d-block">
                                </div>
                                <!-- <div style="max-width:950px;max-height:950px;" img src="<?= base_url('assets/upload/contohbenang/') . $p['contoh'] ?>" class="img-thumbnail col-md-10 rounded mx-auto d-block"></div> -->
                                <br>
                                <small> Benang = <?= $p['subkategori_nama']; ?></small>
                                <br>
                                <small> Pemasok = <?= $p['name']; ?>
                                    <!-- < ?php
                                        $max = 0;
                                        foreach ($rekomendasi as $r) {
                                            if ($r['nilai_preferensi'] > $max) {
                                                $max = $r['nilai_preferensi'];
                                                // $name = $r['id'];
                                            }
                                        }
                                        if ($p['nilai_preferensi'] == $max) { ?>
                                        <i class="far fa-check-circle"></i>
                                    < ?php } ?> -->
                                    </small>
                                <br>
                                <small> Warna = <?= $p['warna']; ?></small>
                                <br>
                                <small> Jumlah Tersedia = <?php
                                                                $angka = $p['jumlah_tersedia'];
                                                                $angka_format = number_format($angka, 2, ",", ".");
                                                                echo $angka_format . ' kg';
                                                                ?></small>
                                <br>
                                <small> Harga Satuan = <?php
                                                            $angka = $p['harga_satuan'];
                                                            $angka_format = number_format($angka, 0, ",", ".");
                                                            echo 'Rp ' . $angka_format;
                                                            ?> </small><br>
                                <small> Catatan = <?= $p['catatan']; ?></small><br><br>
                                <div>
                                    <a href="" class="btn btn-info btn-icon-split" data-toggle="modal" data-target="#myModal<?= $p['id_penawaran']; ?>">
                                        <span class="icon text-white-0">
                                            <i class="far fa-images"> </i>
                                        </span>
                                    </a>
                                    <a href="" class="btn btn-secondary btn-icon-split ml-6" data-toggle="modal" data-target="#newbuyModal<?= $p['id_penawaran']; ?>">
                                        <span class="icon text-white-0">
                                            <i class="fas fa-shopping-cart"></i>
                                        </span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach ?>
            </div>
        </div>
    </div>
</div>
<!-- /.container-fluid -->
</div>
<!-- End of Main Content -->


<!-- Modal Untuk beli -->
<?php
foreach ($penawaran as $p) :
    ?>
    <div class="modal fade " id="newbuyModal<?= $p['id_penawaran']; ?>" tabindex="-1" role="dialog" aria-labelledby="newbuyModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="newbuyModalLabel">Pembelian Benang</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="<?= base_url('penawaran'); ?>" method="post">
                    <div class="modal-body ">
                        <input type="hidden" name="id_penawaran" value="<?= $p['id_penawaran']; ?>">
                        <input type="hidden" id="harga" name="harga" class="a2" value="<?= $p['harga_satuan']; ?>">
                        <input type="hidden" id="biaya" name="biaya" class="a2" value="<?= $p['biaya_kirim']; ?>">
                        <input type="hidden" id="jumlahter" name="jumlahter" value="<?= $p['jumlah_tersedia']; ?>">
                        <div class="form-group">
                            <label>Benang</label>
                            <input type="text" class="form-control" id="benang" name="benang" value="<?= $p['subkategori_nama']; ?> " readonly>
                        </div>
                        <div class="form-group">
                            <label>Pemasok</label>
                            <input type="text" class="form-control" id="pemasok" name="pemasok" value="<?= $p['name']; ?> " readonly>
                        </div>
                        <div class="form-group">
                            <label>Jumlah Benang/Kg </label>
                            <input type="text" class="form-control b2" id="jumlah" name="jumlah" onkeypress="return hanyadecimal(event)">
                        </div>
                        <!--  -->
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn btn-primary"> Beli </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
<?php endforeach; ?>


<!-- Modal untuk view -->
<?php
foreach ($penawaran as $p) :
    ?>
    <div class="modal fade" id="myModal<?= $p['id_penawaran']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="neweditModalLabel">Contoh Benang</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <center>
                        <img src="<?= base_url('assets/upload/contohbenang/') . $p['contoh'] ?>" alt="" class="img-thumbnail  rounded mx-auto d-block">
                    </center>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>
<?php endforeach; ?>