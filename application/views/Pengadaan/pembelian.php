<!-- Begin Page Content -->
<div class="container-fluid">

  <!-- Page Heading -->
  <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

  <!-- DataTales Example -->
  <div class="card shadow mb-4">
    <div class="card-header py-3">
      <h6 class="m-0 font-weight-bold text-primary"> Tabel Riwayat Pembelian</h6>
    </div>
    <div class="card-body">
      <div class="table-responsive">
        <div class="flash-data" data-flashdata="<?= $this->session->flashdata('flash'); ?>"></div>
        <!-- < ?= form_open('pembelian') ?>
        <div class="form-row">
          <div class="form-group col-md-4">
            <select class="custom-select mr-sm-4" id="status" name="status">
              <option value="0"> -- Pilih Status Pembelian -- </option>
              <option value="0">Pemesanan</option>
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
              <th>N0 Order</th>
              <th>Tanggal Pesanan</th>
              <th>Total Pembelian</th>
              <th>Jenis Pembayaran</th>
              <!-- <th>Bank</th>
              <th>No VA</th> -->
              <th>Status</th>
              <th>Invoice</th>
              <th>Detail</th>
              <!-- <?php if ($status == 1) { ?>
                <th>Info Pengiriman</th>
                <th>Selesai</th>
              <?php } ?>
              <?php if ($status == 0) { ?>
                <th>Checkout</th>
              <?php } ?> -->
            </tr>
          </thead>
          <tbody>
            <?php $i = 1; ?>
            <?php foreach ($riwayat as $rw) :
              $format = date('d-m-Y', strtotime($rw['tgl_pembelian'])); ?>
              <tr>
                <th><?= $rw['id_faktur']; ?></td>
                <td><?= $format ?></td>
                <td><?php  
                 $angka = $rw['total'];
                 $angka_format = number_format($angka, 0, ",", ".");
                 echo 'Rp. ' . $angka_format; ?></td>
                <td><?= $rw['payment_type']; ?></td>
                <!-- <td>< ?= $rw['bank']; ?></td>
                <td>< ?= $rw['va_number']; ?></td> -->
                <td>
                <?php if ($rw['status_pay'] == 201) { echo 'Pending'; } 
                else if ($rw['status_pay'] == 200) { echo 'Success'; } ?>
                </td>
                <td  style="text-align:center">
                    <a href="<?= base_url() . 'pembelian/cetakinvoice/' . $rw['id_faktur']; ?>" class="btn btn-success btn-icon-split ">
                      <span class="icon text-white-0">
                      <i class="fas fa-print"></i>
                      </span>
                    </a>
                </td>
                <td  style="text-align:center">
                    <a href="<?= base_url() . 'pembelian/detail/' . $rw['id_faktur']; ?>" class="btn btn-info btn-icon-split ">
                      <span class="icon text-white-0">
                      <i class="fas fa-info"></i>
                      </span>
                    </a>
                </td>
                <!-- <td>< ?php
                    $angka = $rw['jumlah'];
                    $angka_format = number_format($angka, 2, ",", ".");
                    echo $angka_format . ' kg';
                    ?></td>
                <td>< ?php
                    $angka = $rw['total'];
                    $angka_format = number_format($angka, 0, ",", ".");
                    echo 'Rp ' . $angka_format;
                    ?></td> -->
                <!-- < ?php if ($rw['status'] == 0) { ?>
                  <td style="text-align:center">
                    <a href="" class="btn btn-secondary btn-icon-split" data-toggle="modal" data-target="#ceksuratModal< ?= $rw['id_pembelian']; ?>">
                      <span class="icon text-white-0">
                        <i class="far fa-envelope"></i>
                      </span>
                    </a>
                  </td>
                < ?php } ?>
                < ?php if ($rw['status'] == 1) { ?>
                  <td style="text-align:center">
                    <a href="" class="btn btn-info btn-icon-split" data-toggle="modal" data-target="#cekkirimModal< ?= $rw['id_pembelian']; ?>">
                      <span class="icon text-white-0">
                        <i class="fas fa-truck"></i>
                      </span>
                    </a>
                  </td>
                  <td style="text-align:center">
                    <a href="< ?= base_url() . 'pembelian/ubahstatus/' . $rw['id_pembelian']; ?>" class="btn btn-success btn-icon-split ">
                      <span class="icon text-white-0">
                        <i class="fas fa-check"></i>
                      </span>
                    </a>
                  </td>
                < ?php } ?> -->
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

