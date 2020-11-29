<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary"><?= $tabel; ?></h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <?= form_open('informasipenjualan') ?>
                <div class="form-row">
                    <div class="form-group col-md-4">
                        <select class="custom-select mr-sm-4" id="status" name="status">
                            <option value="1"> -- Pilih Status Pembelian -- </option>
                            <!-- <option value="0">Pemesanan</option> -->
                            <option value="1">Pengiriman</option>
                            <option value="2">Selesai</option>
                        </select>
                    </div>
                    <div class="form-group col-md-2">
                        <button type="submit" class="btn btn-primary">
                            Terapkan
                        </button>
                    </div>
                </div>
                <?= form_close() ?>
                <table id="datatable" class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr style="text-align:center">
                            <th>N0</th>
                            <th>Nama Benang</th>
                            <th>Jumlah (Kg)</th>
                            <th>Total Pembelian</th>
                            <th>Tanggal Pesanan</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 1; ?>
                        <?php foreach ($pembelian as $pm) :
                            $format = date('d F Y', strtotime($pm['tgl_pembelian'])); ?>
                            <?php if ($pm['id_pemasok'] == $user['id']) { ?>
                                <tr>
                                    <th scope="row"><?= $i; ?></td>
                                    <td><?= $pm['subkategori_nama']; ?></td>
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
                                </tr>
                            <?php } ?>
                            <?php $i++; ?>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>
<!-- /.container-fluid -->

</div>