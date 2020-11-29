<html>

<head>
    <title>CETAK STRUK-SURAT JALAN</title>
    <!-- Custom fonts for this template-->
    <link href="<?= base_url('assets/'); ?>vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="<?= base_url('assets/'); ?>css/sb-admin-2.min.css" rel="stylesheet">
    <!-- Custom sweetalert2 for this template-->
    <link href="<?= base_url('assets/'); ?>js/sweetalert2.css" rel="stylesheet">
    <!-- Custom table for this template-->
    <link rel="stylesheet" type="text/css" href="<?= base_url('assets/'); ?>dataTables/datatables.min.css" />
    <!-- <link href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css" rel="stylesheet"> -->
</head>

<body>
            <div class="col-md-12 offset-md-2" id="faktur" style="width:650px;
 height:450px;
 font-family: Arial, Helvetica, sans-serif; 
 font-size:12px;
 padding:5 px;">
                <div id="kop" style="background-color:white;
 width:650px;
 height:70px;
 font-family: Arial, Helvetica, sans-serif; 
 font-size:12px;
 padding:0 px;">

                    <div class="col-md-12">
                        <div class="logo" style="float:left;
 width:75px;
 height:75px;">
 <img class="img-fluid" alt="Responsive image" src=<?= base_url('assets/img/logo.png'); ?>>
 </div>


                        <div class="hurufbesar" style=" font-size:17px; text-align: center;"><b> JUAL - BELI </b></div>
                        <div style=" font-size:12px; text-align: center;"> Aku Jual - Kamu Beli <br>
                           Seluruh Indonesia <br> Email: jualbeli@gmail.com Telp/Fax.0812345678 - (022) 5957689 <br />
                        </div>
                        <hr style="border: 1px solid; margin: auto;">
                        <div class="col-sm-12">
                            <div class="kiri" style=" float:left; margin:10px 10px 5px 5px;">

                                Kepada Yth:<br />Bpk/ibu/sdr. <b><?php echo $user['name']; ?></b> <br />
                                di <?php echo $user['alamat'];
                                    ?>
                            </div>

                            <div class="kanan" style=" float:right;
 margin:45px 10px 5px 10px;">
                                <b>NO Pembelian: </b><?php echo $riwayat['id_faktur']; ?>
                            </div>
                        </div>
                        <div id="bawah" style="float:left;
 background-color:white;
 width:610px;
 height:290px;
 font-family: Arial, Helvetica, sans-serif; 
 font-size:11px;
 padding:0 px;
 margin:2 px;">
                            <div class="isi" style="width:610px;
 height:200px;
 background-color:white;">
                                <table style="font-family: Tahoma; 
	font-size: 9pt;
	border-width: 1px;
	border-style: solid;
	border-color: #000000;
	border-collapse: collapse;
	margin: 0px 0px 0px 10px;">
                                    <tr style="font-family: Tahoma; 
    font-size: 9pt;
    border-width: 1px;
    border-style: solid;
    border-color: #000000;
    border-collapse: collapse;
    margin: 0px 0px 0px 10px;">
                                        <td colspan="2" style="font-family: Tahoma; 
    font-size: 9pt;
    border-width: 1px;
    border-style: solid;
    border-color: #000000;
    border-collapse: collapse;
    margin: 0px 0px 0px 10px;"> Tgl. Order : <?php $format = date('d-m-Y', strtotime($riwayat['tgl_pembelian']));  echo $format; ?> 
                                        </td>
                                    </tr>
                                    <tr style="font-family: Tahoma; 
	font-size: 9pt;
	border-width: 1px;
	border-style: solid;
	border-color: #000000;
	border-collapse: collapse;
	margin: 0px 0px 0px 10px;">
                                        <th style="font-family: Tahoma; 
	width: 100px;
    text-align: center;
    font-size: 9pt;
	border-width: 1px;
	border-style: solid;
	border-color: #000000;
	border-collapse: collapse;
	margin: 0px 0px 0px 10px;">Banyaknya</th>
                                        <th style="width:380px; text-align: center;">Nama Barang</th>

                                        <th style="font-family: Tahoma; 
	width: 100px;
    text-align: center;
    font-size: 9pt;
	border-width: 1px;
	border-style: solid;
	border-color: #000000;
	border-collapse: collapse;
	margin: 0px 0px 0px 10px;">Harga Satuan</th>
                                        <th style="font-family: Tahoma; 
    width: 100px;
    text-align: center;
    font-size: 9pt;
    border-width: 1px;
    border-style: solid;
    border-color: #000000;
    border-collapse: collapse;
    margin: 0px 0px 0px 10px;">Jumlah</th>

                                    </tr>
                                    <?php $i = 1; ?>
                                    <?php $net = 0; ?>
                                    <?php foreach ($pembelian as $s) : ?>
                                        <?php $jum = $s['jumlah'] * $s['harga_satuan']; ?>
                                        <tr style="font-family: Tahoma; 
	font-size: 9pt;
	border-width: 1px;
	border-style: solid;
	border-color: #000000;
	border-collapse: collapse;
	margin: 0px 0px 0px 10px;">
                                            <td style="font-family: Tahoma; 
	font-size: 9pt;
	text-align: center;
    border-width: 1px;
	border-style: solid;
	border-color: #000000;
	border-collapse: collapse;
	margin: 0px 0px 0px 10px;" scope="row"><?= $s['jumlah']; ?></td>
                                            <td style="font-family: Tahoma; 
	font-size: 9pt;
	border-width: 1px;
	border-style: solid;
	border-color: #000000;
	border-collapse: collapse;
	margin: 0px 0px 0px 10px;">
                                                <?= $s['subkategori_nama']; ?>
                                            </td>
                                            <td style="font-family: Tahoma; 
	font-size: 9pt;
	border-width: 1px;
	border-style: solid;
	border-color: #000000;
	border-collapse: collapse;
	margin: 0px 0px 0px 10px;">

                                                <?php $angka_format = number_format($s['harga_satuan'], 0, ",", ".");
                                                echo 'Rp ' . $angka_format;  ?>
                                            </td>
                                            <td style="font-family: Tahoma; 
	font-size: 9pt;
	border-width: 1px;
	border-style: solid;
	border-color: #000000;
	border-collapse: collapse;
	margin: 0px 0px 0px 10px;">

                                                <?php $angka_format = number_format(($s['jumlah'] * $s['harga_satuan']), 0, ",", ".");
                                                echo 'Rp ' . $angka_format;  ?>
                                            </td>

                                        </tr>

                                        <?php $i++; ?>
                                        <?php $net += $s['jumlah'] * $s['harga_satuan']; ?>
                                    <?php endforeach; ?>
                                    <tr style="font-family: Tahoma; 
    font-size: 9pt;
    border-left: none;
    border-bottom: none;
    margin: 0px 0px 0px 10px;">
                                        <td colspan="3" style="font-family: Tahoma; 
    font-size: 9pt;
    text-align: right;
    border-left: none;
    border-bottom: none;
    margin: 0px 0px 0px 10px;"> TOTAL
                                        </td>
                                        <td style="font-family: Tahoma; 
    font-size: 9pt;
    border-width: 1px;
    border-style: solid;
    border-color: #000000;
    border-collapse: collapse;
    margin: 0px 0px 0px 10px;" align='left' width="80"><?php $angka_format = number_format($riwayat['total'], 0, ",", ".");
                                                        echo 'Rp ' . $angka_format;  ?>,-</td>

                                    </tr>
                                    <?php if($riwayat['status_pay']==200){ ?>
                                        <tr style="font-family: Tahoma; 
    font-size: 9pt;
    border-left: none;
    border-bottom: none;
    margin: 0px 0px 0px 10px;">
                                        <td colspan="3" style="font-family: Tahoma; 
    font-size: 9pt;
    text-align: right;
    border-width: 1px;
    border-style: solid;
    border-color: #000000;
    border-collapse: collapse;
    margin: 0px 0px 0px 10px;"> Keterangan
                                        </td>
                                        <td style="font-family: Tahoma; 
    font-size: 9pt;
    border-width: 1px;
    border-style: solid;
    border-color: #000000;
    border-collapse: collapse;
    margin: 0px 0px 0px 10px;" align='left' width="80">  LUNAS</td>

                                    </tr>
                                    <?php }?>

                                </table>
                            </div>
                            <div id="tandatangan" style="background-color:white;
 width:800px;
 height:100px;
 font-family: Arial, Helvetica, sans-serif; 
 font-size:11px;
 padding:0 px;
 display: flex;
 justify-content: center;
 align-items: center;">
                                <div class="perhatian" style="float:left;
  margin:3px 100px 5px 10px;
  font-size:10pt;">Tanda terima,<br /><br /><br />(....................)</div>
                                <div class="hormat" style="float:left;
  margin:3px 250px 5px 20px;
  font-size:10pt;">Hormat kami,<br /><br /><br />(....................)</div>
                            </div>
                        </div>



                    </div>
                </div>

            </div>

            </body>

</html>

<script>
    window.print();
</script>        
