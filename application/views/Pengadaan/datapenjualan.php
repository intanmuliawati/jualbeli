<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Tabel Data Penjualan</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">

                <?= form_error('harga', '<div class="alert alert-danger pl-3" role="alert">', '</div>'); ?>
                <!-- <?= form_error('warna', '<div class="alert alert-danger pl-3" role="alert">', '</div>'); ?> -->
                <?= form_error('jumlah', '<div class="alert alert-danger pl-3" role="alert">', '</div>'); ?>
                <div class="flash-data" data-flashdata="<?= $this->session->flashdata('flash'); ?>"></div>
                <a href="" class="btn btn-primary mb-3" data-toggle="modal" data-target="#newpenjualanModal"> Tambah Data Penjualan </a>
                <table id="datatable" class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr style="text-align:center">
                            <th>N0</th>
                            <th>Nama benang</th>
                            <th>Warna</th>
                            <th>Jumlah</th>
                            <th>Total</th>
                            <th width="120px">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 1; ?>
                        <?php foreach ($penjualan as $pm) : ?>
                            <tr>
                                <th scope="row"><?= $i; ?></td>
                                <td><?= $pm['subkategori_nama']; ?></td>
                                <td><?= $pm['warna']; ?></td>
                                <td><?= $pm['jumlah']; ?></td>
                                <td><?= $pm['total']; ?></td>
                                <td style="text-align:center">
                                    <a href="" class="btn btn-info btn-icon-split" data-toggle="modal" data-target="#neweditModal<?= $pm['id_penjualan']; ?>">
                                        <span class="icon text-white-0">
                                            <i class="far fa-edit"></i>
                                        </span>
                                    </a>
                                    <a href="<?= base_url() . 'datapenjualan/hapuspenjualan/' . $pm['id_penjualan']; ?>" class="btn btn-danger btn-icon-split tombol-hapus">
                                        <span class="icon text-white-0">
                                            <i class="fas fa-trash"></i>
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

</div>
<!-- End of Main Content -->


<!-- Modal untuk tambah-->
<div class="modal fade" id="newpenjualanModal" tabindex="-1" role="dialog" aria-labelledby="newpenjualanModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="newpenjualanModalLabel">Masukan Data Penjualan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= base_url('datapenjualan'); ?>" method="post">
                <div class="modal-body">
                    <div class="input-group mb-3">
                        <select name="kategori_jenis" id="kategori_jenis" class="form-control">
                            <option value="0">-Pilih Jenis Benang-</option>
                            <?php foreach ($kategori->result() as $row) : ?>
                                <option value="<?= $row->kategori_id; ?>"><?= $row->kategori_nama; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="input-group mb-3">
                        <select name="subkategori" class="subkategori form-control">
                            <option value="0">-Pilih No Benang-</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <div class="input-group">
                            <input placeholder="Warna" type="text" class="form-control" id="warna" name="warna">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="input-group">
                            <input placeholder="Jumlah/Kg" type="text" class="form-control" id="jumlah" name="jumlah">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="input-group ">
                            <input placeholder="Harga " type="text" class="form-control" id="harga" name="harga" onkeypress="return hanyaAngka(event)">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-primary tombol-ubah"> Simpan </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal untuk edit -->
<?php
foreach ($penjualan as $pm) :
    ?>
    <div class="modal fade" id="neweditModal<?= $pm['id_penjualan']; ?>" tabindex="-1" role="dialog" aria-labelledby="neweditModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="newpesanModalLabel">Ubah Penjualan</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="<?= base_url('datapenjualan/ubahpenjualan'); ?>" method="post">
                    <div class="modal-body">
                        <input type="hidden" name="id" value="<?= $pm['id_penjualan'] ?>">
                        <input type="hidden" name="id_benang" value="<?= $pm['id_benang'] ?>">
                        <input type="hidden" name="total" value="<?= $pm['total'] ?>">
                        <div class="input-group mb-3">
                            <label>Warna </label>
                            <input type="text" class="form-control" id="benang" name="benang" value="<?= $pm['subkategori_nama']; ?>">
                        </div>
                        <div class="form-group">
                            <label>Warna </label>
                            <input type="text" class="form-control" id="warna" name="warna" value="<?= $pm['warna']; ?>">
                        </div>
                        <div class="form-group">
                            <label>Jumlah (kg)</label>
                            <input type="text" class="form-control" id="jumlah" name="jumlah" value="<?= $pm['jumlah']; ?>">
                        </div>
                        <div class="form-group">
                            <label>Harga</label>
                            <input type="text" class="form-control" id="harga" name="harga" value="<?= $pm['harga']; ?>">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn btn-primary"> Ubah </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
<?php endforeach; ?>

<script type="text/javascript">
    $(document).ready(function() {
        $('#kategori_jenis').change(function() {
            var id = $(this).val();
            $.ajax({
                url: "<?php echo base_url(); ?>pengajuanpengadaan/get_subkategori",
                method: "POST",
                data: {
                    id: id
                },
                async: false,
                dataType: 'json',
                success: function(data) {
                    var html = '';
                    var i;
                    html += '<option>-Pilih No Benang-</option>';
                    for (i = 0; i < data.length; i++) {
                        html += '<option value="' + data[i].subkategori_id + '">' + data[i].subkategori_nama + '</option>';
                    }

                    $('.subkategori').html(html);
                }
            });
        });
    });
</script>