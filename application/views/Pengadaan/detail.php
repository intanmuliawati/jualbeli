
<!-- Begin Page Content -->
<div class="container-fluid">

  <!-- Page Heading -->
  <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

  <!-- DataTales Example -->
  <div class="card shadow mb-4">
    <div class="card-header py-3">
      <h6 class="m-0 font-weight-bold text-primary">Tabel Detail Pembelian </h6>
    </div>
    <div class="card-body">
      <div class="table-responsive">
        <div class="flash-data" data-flashdata="<?= $this->session->flashdata('flash'); ?>"></div>
        <!-- < ?= form_open('pembelian') ?>
        <div class="form-row">
          <div class="form-group col-md-4">
            <select class="custom-select mr-sm-4" id="status" name="status">
              <option value="1"> -- Pilih Status Pembelian -- </option>
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
        < ?= form_close() ?> -->
        <table id="datatable" class="table table-bordered" id="dataTable" cellspacing="0">
          <thead>
            <tr style="text-align:center">
              <th>N0</th>
              <th>Nama Benang</th>
              <th >Nama Pemasok</th>
              <th >Jumlah</th>
              <th >Total Pembelian</th>
                <th>Selesai</th>
                <th>Bukti</th>
                <th>Info Pengiriman</th>
            </tr>
          </thead>
          <tbody>
            <?php $i = 1; ?>
            <?php foreach ($detail as $pm) : ?>
              <tr>
                <th scope="row"><?= $i; ?></td>
                <td><?= $pm['subkategori_nama']; ?></td>
                <td><?= $pm['name']; ?></td>
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
                <!-- < ?php if ($pm['status_kirim'] == 1) { ?> -->
                  <td style="text-align:center">
                  <?php if ($pm['status_kirim'] == 1) { ?>
                    <a href="<?= base_url() . 'pembelian/ubahstatus/' . $pm['id_pembelian']; ?>" class="btn btn-success btn-icon-split ">
                      <span class="icon text-white-0">
                        <i class="fas fa-check"></i>
                      </span>                   
                    </a>
                    <?php } else if($pm['status_kirim'] == 2) { ?> selesai 
                    <?php } ?>
                  </td>
                  <td style="text-align:center">
                  <?php if ($pm['status_kirim'] == 1) { ?>
                    <a href="" class="btn btn-secondary btn-icon-split" data-toggle="modal" data-target="#ceksuratModal<?= $pm['id_pembelian']; ?>">
                      <span class="icon text-white-0">
                        <i class="far fa-envelope"></i>
                      </span>
                    </a>
                      <?php } ?>
                  </td>
                  </td>
                  <td style="text-align:center">
                  <?php if ($pm['status_kirim'] == 1) { ?>
                    <a href="" class="btn btn-info btn-icon-split" data-toggle="modal" data-target="#cekkirimModal<?= $pm['id_pembelian']; ?>">
                      <span class="icon text-white-0">
                        <i class="fas fa-truck"></i>
                      </span>
                    </a>
                    <?php } ?>
                  </td>
                  <!-- <td style="text-align:center">
                    <a href="" class="btn btn-info btn-icon-split" data-toggle="modal" data-target="#cekkirimModal<?= $pm['id_pembelian']; ?>">
                      <span class="icon text-white-0">
                        <i class="fas fa-truck"></i>
                      </span>
                    </a>
                  </td> -->
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


<!-- Modal edit data -->
<?php
foreach ($pengiriman as $pn) :
  $format = date('d F Y', strtotime($pn['tgl_kirim']));
  ?>
  <div class="modal fade md-2" id="cekkirimModal<?= $pn['id_pembelian']; ?>" tabindex="-1" role="dialog" aria-labelledby="cekkirimModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="cekkirimModalLabel">Informasi Pengiriman</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <label> Tanggal Pengiriman </label>
          <div class="input-group">
            <div class="input-group-prepend">
              <div class="input-group-text"> <i class="far fa-calendar-alt"></i></div>
            </div>
            <input type="text" class="form-control" value="<?= $format; ?>" readonly>
          </div>
          <br>
          <label> Jasa Pengiriman </label>
          <div class="input-group">
            <div class="input-group-prepend">
              <div class="input-group-text"> <i class="fas fa-truck"></i></div>
            </div>
            <input type="text" class="form-control" value="<?= $pn['pengiriman']; ?>" readonly>
          </div>
          <br>
          <label> No Resi </label>
          <div class="input-group">
            <div class="input-group-prepend">
              <div class="input-group-text"><i class="fas fa-mobile-alt"></i></div>
            </div>
            <input type="text" class="form-control" value="<?= $pn['resi_pengiriman']; ?>" readonly>
          </div>
          <br>
          <label> Catatan </label>
          <div class="input-group">
            <div class="input-group-prepend">
              <div class="input-group-text"><i class="far fa-sticky-note"> </i></div>
            </div>
            <input type="text" class="form-control" value=" <?= $pn['cat']; ?>" readonly>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
        </div>
      </div>
    </div>
  </div>
<?php endforeach; ?>


<!-- Modal untuk view -->
<?php
foreach ($pengiriman as $p) :
  ?>
  <div class="modal fade" id="ceksuratModal<?= $p['id_pembelian']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="neweditModalLabel">Bukti Pengiriman</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <center>
            <img src="<?= base_url('assets/upload/suratjalan/') . $p['bukti'] ?>" class="img-thumbnail col-md-10 rounded mx-auto d-block">
          </center>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
        </div>
      </div>
    </div>
  </div>
<?php endforeach; ?>
