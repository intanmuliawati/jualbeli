<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Tabel Data Riwayat Permintaan Pengadaan</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table id="datatable" class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr style="text-align:center">
                            <th>N0</th>
                            <th>Nama benang</th>
                            <th>Warna</th>
                            <th>Jumlah (Kg)</th>
                            <th>Tanggal Valid</th>
                            <th>Catatan</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 1; ?>
                        <?php foreach ($pemesanan as $pm) :
                            $format = date('d F Y', strtotime($pm['tanggal_valid']));
                            if ($pm['status'] == '0' || $pm['status'] == '1') { ?>
                                <tr>
                                    <th scope="row"><?= $i; ?></td>
                                    <td><?= $pm['subkategori_nama']; ?></td>
                                    <td><?= $pm['warna']; ?></td>
                                    <td><?php
                                                $angka = $pm['jumlah'];
                                                $angka_format = number_format($angka, 2, ",", ".");
                                                echo $angka_format . ' kg';
                                                ?></td>
                                    <td><?= $format; ?></td>
                                    <td><?= $pm['catatan']; ?></td>
                                    <td><?php
                                                $tanggalnow = date("Y-m-d");
                                                if ($pm['tanggal_valid'] < $tanggalnow && $pm['status'] == '0') {
                                                    echo ("Penawaran Berakhir");
                                                } else if ($pm['status'] == '0' && $pm['tanggal_valid'] >= $tanggalnow) {
                                                    echo ("Diajukan Penawaran");
                                                } else if ($pm['status'] == '1') {
                                                    echo ("Ditolak");
                                                }  ?></td>
                                </tr>
                            <?php }
                                $i++; ?>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->