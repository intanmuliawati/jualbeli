<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Tabel Data User</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <div class="flash-data" data-flashdata="<?= $this->session->flashdata('flash'); ?>"></div>
                <?= form_error('name', '<div class="alert alert-danger pl-2" role="alert">', '</div>'); ?>
                <?= form_error('email', '<div class="alert alert-danger pl-2" role="alert">', '</div>'); ?>
                <?= form_error('alamat', '<div class="alert alert-danger pl-2" role="alert">', '</div>'); ?>
                <?= form_error('no', '<div class="alert alert-danger pl-2" role="alert">', '</div>'); ?>
                <?= form_error('password1', '<div class="alert alert-danger pl-2" role="alert">', '</div>'); ?>
                <?= form_error('role_id', '<div class="alert alert-danger pl-2" role="alert">', '</div>'); ?>
                <?= form_error('name2', '<div class="alert alert-danger pl-2" role="alert">', '</div>'); ?>
                <?= form_error('alamat2', '<div class="alert alert-danger pl-2" role="alert">', '</div>'); ?>
                <?= form_error('no2', '<div class="alert alert-danger pl-2" role="alert">', '</div>'); ?>
                <a href="" class="btn btn-primary mb-3" data-toggle="modal" data-target="#newuserModal"> Tambah User </a>
                <table id="datatable" class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr style="text-align:center">
                            <th>N0</th>
                            <th>Nama </th>
                            <th>Email</th>
                            <th>Alamat</th>
                            <th>No Tlp</th>
                            <th>Posisi</th>
                            <th>Aktif</th>
                            <th>Tanggal Daftar</th>
                            <th>Ubah</th>
                            <th>Hapus</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 1; ?>
                        <?php foreach ($datauser as $us) :
                            $format = date('d F Y', strtotime($us['date_created'])); ?>
                            <tr>
                                <th scope="row"><?= $i; ?></td>
                                <td>
                                    <?= $us['name']; ?>
                                </td>
                                <td>
                                    <?= $us['email']; ?>
                                </td>
                                <td>
                                    <?= $us['alamat']; ?>
                                </td>
                                <td>
                                    <?= $us['no_tlp']; ?>
                                </td>
                                <td>
                                    <?= $us['role']; ?></td>
                                <td><?php if ($us['is_active'] == '1') {
                                            echo (" Aktif");
                                        } else {
                                            echo ("Tidak Aktif");
                                        } ?></td>
                                <td><?= $format; ?></td>
                                <td style="text-align:center">
                                    <a href="" class="btn btn-info btn-icon-split" data-toggle="modal" data-target="#neweditModal<?= $us['id']; ?>">
                                        <span class="icon text-white-0">
                                            <i class="far fa-edit"></i>
                                        </span>
                                    </a>
                                </td>
                                <td style="text-align:center">
                                    <a href="<?= base_url() . 'admin/hapususer/' . $us['id']; ?>" class="btn btn-danger btn-icon-split  tombol-hapus">
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

<!-- Modal tambah data -->
<div class="modal fade" id="newuserModal" tabindex="-1" role="dialog" aria-labelledby="newuserModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="newuserModalLabel">Tambah User</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= base_url('admin/pengaturan_user'); ?>" method="post">
                <div class="modal-body">
                    <div class="form-group">
                        <input type="text" class="form-control" id="name" name="name" placeholder="Nama User" onkeypress="return hanyahuruf(event)">
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" id="email" name="email" placeholder="Email">
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" id="alamat" name="alamat" placeholder="Alamat">
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" id="no" name="no" placeholder="No Telephone" onkeypress="return hanyaAngka(event)">
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-6 mb-3 mb-sm-0">
                            <input type="password" class="form-control form-control-user" id="password1" name="password1" placeholder="Password">
                        </div>
                        <div class="col-sm-6">
                            <input type="password" class="form-control form-control-user" id="password2" name="password2" placeholder="Ulangi Password">
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <select name="role_id" id="role_id" class="form-control">
                            <option value="">-Pilih Posisi User-</option>
                            <?php foreach ($role as $r) : ?>
                                <option value="<?= $r['role_id']; ?>"> <?= $r['role']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="1" name="aktif" id="aktif">
                        <label class="form-check-label" for="aktif">
                            Aktif
                        </label>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-primary">Tambah</button>
                </div>

            </form>
        </div>
    </div>
</div>


<!-- Modal edit data -->
<?php
foreach ($datauser as $us) :
    ?>
    <div class="modal fade" id="neweditModal<?= $us['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="neweditModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="neweditModalLabel">Ubah Data User</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="<?= base_url('admin/ubahuser'); ?>" method="post">
                    <div class="modal-body">
                        <input type="hidden" name="id" value="<?= $us['id']; ?>">
                        <div class="form-group">
                            <label>Email</label>
                            <input type="text" class="form-control" id="email2" name="email2" value="<?= $us['email']; ?>" readonly>
                        </div>
                        <div class="form-group">
                            <label>Nama User </label>
                            <input type="text" class="form-control" id="name2" name="name2" value="<?= $us['name']; ?>" onkeypress="return hanyahuruf(event)">
                        </div>
                        <div class="form-group">
                            <label>Alamat</label>
                            <input type="text" class="form-control" id="alamat2" name="alamat2" value="<?= $us['alamat']; ?>">
                        </div>
                        <div class="form-group">
                            <label>No Tlp</label>
                            <input type="text" class="form-control" id="no2" name="no2" value="<?= $us['no_tlp']; ?>" onkeypress="return hanyaAngka(event)">
                        </div>
                        <label>Posisi User</label>
                        <div class="input-group mb-0">
                            <select name="role_id" id="role_id" class="form-control">
                                <!-- <option value="<?= $us['role_id']; ?>"> <?= $us['role']; ?></option> -->
                                <?php foreach ($role as $r) : ?>
                                    <option value="<?= $r['role_id']; ?>" <?php if ($us['role_id'] == $r['role_id']) {
                                                                                        echo 'selected';
                                                                                    } ?>> <?= $r['role']; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="form-check">
                            <br>
                            <input class="form-check-input" type="checkbox" value="1" name="aktif" id="aktif" <?php if ($us['is_active'] == '1') {
                                                                                                                        echo 'checked';
                                                                                                                    } ?>>
                            <label class="form-check-label" for="aktif">
                                Aktif
                            </label>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn btn-primary tombol-ubah"> Ubah </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
<?php endforeach; ?>