<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="table-responsive">
                <div class="flash-data" data-flashdata="<?= $this->session->flashdata('flash'); ?>"></div>
                <div class="form-group row">
                    <h4 class="col-sm-7 font-weight text-success">Total Belanja </h4>
                    <div class="col-sm-5">
                        <h4 style="text-align: right" class=" total text-success">Rp.0 </h4>
                    </div>
                </div>
                <table class="table table-bordered" cellspacing="0">
                    <thead>
                        <tr style="text-align:center">
                            <th>N0</th>
                            <th >Nama Benang</th>
                            <th >Nama Pemasok</th>
                            <th >Jumlah</th>
                            <th >Harga</th>
                            <th >Total Pembelian</th>
                            <th >Hapus</th>
                        </tr>
                    </thead>
                    <tbody id="show_data">
                    </tbody>
                </table>              
            </div>
            <div>
            <form id="payment-form" method="post" action="<?=site_url()?>/snap/finish">
                <input type="hidden" name="result_type" id="result-type" value="">
                 <input type="hidden" name="result_data" id="result-data" value="">
            </form>
            <button  id="pay-button" class="btn btn-warning col-sm-2 mt-5" style="text-align: center">
                        <span class="icon text-white-0">
                            CheckOut
                        </button>
                        <input type="hidden" id="total2" value="">
            </div>
        </div>
    </div>

</div>
<!-- /.container-fluid -->

</div>

<!--MODAL HAPUS-->
<div class="modal fade" id="ModalHapus" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">X</span></button>
                <!-- <h4 class="modal-title" id="myModalLabel">Hapus Item Pembelian</h4> -->
            </div>
            <form class="form-horizontal">
                <div class="modal-body">

                    <input type="hidden" name="kode" id="textkode" value="">
                    <div class="alert alert-warning">
                        <p>Apakah Anda yakin mau menghapus item ini?</p>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
                    <button class="btn_hapus btn btn-danger" id="btn_hapus">Hapus</button>
                </div>
            </form>
            </div>
    </div>
  </div>

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->
<script>
 $('#pay-button').click(function(event) {
      event.preventDefault();
      $(this).attr("disabled", "disabled");
      var tot = $("#total2").val();
      $.ajax({
        type: 'POST',
        url: '<?= site_url() ?>/snap/token',
        data : 
        {tot : tot},
        cache: false,

        success: function(data) {
          //location = data;

          console.log('token = ' + data);

          var resultType = document.getElementById('result-type');
          var resultData = document.getElementById('result-data');

          function changeResult(type, data) {
            $("#result-type").val(type);
            $("#result-data").val(JSON.stringify(data));
            //resultType.innerHTML = type;
            //resultData.innerHTML = JSON.stringify(data);
          }

          snap.pay(data, {

            onSuccess: function(result) {
              changeResult('success', result);
              console.log(result.status_message);
              console.log(result);
              $("#payment-form").submit();
            },
            onPending: function(result) {
              changeResult('pending', result);
              console.log(result.status_message);
              $("#payment-form").submit();
            },
            onError: function(result) {
              changeResult('error', result);
              console.log(result.status_message);
              $("#payment-form").submit();
            }
          });
        }
      });
    });
    $(document).ready(function() {
        hitungtotal();
        tampil_data_barang();

        function tampil_data_barang() {
            $.ajax({
                type: 'GET',
                url: '<?= base_url('keranjang/data_pembelian') ?> ',
                async: true,
                dataType: 'json',
                success: function(data) {
                    var html = '';
                    var i;
                    for (i = 0; i < data.length; i++) {
                        html += '<tr>' +
                            '<td scope="row">' + (i + 1) + '</td>' +
                            '<td>' + data[i].subkategori_nama + '</td>' +
                            '<td>' + data[i].name + '</td>' +
                            '<td>' + data[i].jumlah + ' kg' + '</td>' +
                            '<td> Rp. ' + data[i].harga_satuan + '</td>' +
                            '<td> Rp. ' + (data[i].jumlah * data[i].harga_satuan) + '</td>' +
                            '<td style="text-align:right;">' +
                            '<a href="javascript:;" class="btn btn-danger btn-xs item_hapus" data="' + data[i].id_pembelian + '"><i class="fas fa-trash"></i></a>' +
                            '</td>' +
                            '</tr>';
                    }
                    $('#show_data').html(html);
                    // get_pelanggan();
                }

            });
        }

        function hitungtotal() {
            $.ajax({
                type: 'GET',
                url: '<?= base_url('keranjang/data_pembelian') ?> ',
                async: true,
                dataType: 'json',
                success: function(data) {
                    var html = '';
                    var i;
                    var total = 0;
                    for (i = 0; i < data.length; i++) {
                        total += data[i].jumlah * data[i].harga_satuan;
                    }
                    // console.log(total);
                    html = 'Rp. ' + total;
                    $('.total').text(html);
                    $('#total2').val(total);
                }

            });
        }
        //GET HAPUS
        $('#show_data').on('click', '.item_hapus', function() {
            var id = $(this).attr('data');
            $('#ModalHapus').modal('show');
            $('[name="kode"]').val(id);
        });
        //Hapus Barang
        $('#btn_hapus').on('click', function() {
            var kode = $('#textkode').val();
            $.ajax({
                type: "POST",
                url: "<?= base_url('keranjang/hapus_barang') ?>",
                dataType: "JSON",
                data: {
                    kode: kode
                },
                success: function(data) {
                    $('#ModalHapus').modal('hide');
                    tampil_data_barang();
                    hitungtotal();

                }
            });
            return false;
        });

    })
</script>