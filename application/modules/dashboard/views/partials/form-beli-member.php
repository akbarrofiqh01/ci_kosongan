<?php
$userdata         = userdata();
$diskon         = 0;
$this->db->where('paketmitra_label', $userdata->user_status);
$gettttttdisc = $this->db->get('tb_paketmitra');
if ($gettttttdisc->num_rows() != 0) {
    $diskon         = (int)$gettttttdisc->row()->paketmitra_disc;
}

?>
<?php echo form_open('', array('id' => 'form-order')); ?>
<div class="row">
    <div class="col-sm-12 col-md-6 col-lg-6">
        <div class="form-group">
            <label for="">Provinsi</label>
            <select class="form-control" name="order_provinsi" id="provinsi_id" onchange="getkabkota()" required>
                <option selected disabled>PROVINSI</option>
                <?php
                $getprov = $this->db->get('tb_provinsi');
                foreach ($getprov->result() as $provinsi) {
                    $this->db->where('user_status', 'agen');
                    $this->db->where('pin_status', 'available');
                    $this->db->where('user_provinsi', $provinsi->id);
                    $this->db->join('tb_users_pin', 'pin_userid = id');
                    $cekpinnn = $this->db->get('tb_users');
                    if ($cekpinnn->num_rows() != 0) {
                ?>
                        <option value="<?php echo $provinsi->id ?>"><?php echo $provinsi->name ?></option>
                    <?php } ?>
                <?php } ?>
            </select>
        </div>
    </div>
    <div class="col-sm-12 col-md-6 col-lg-6">
        <div class="form-group">
            <label for="">Kota / Kab</label>
            <select class="form-control" name="order_kota" id="kabkota_id" onchange="getkecamatan()" required>
                <option selected disabled>KOTA / KAB</option>
            </select>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-sm-12 col-md-6 col-lg-6">
        <div class="form-group">
            <label for="">Kecamatan</label>
            <select class="form-control" name="order_kecamatan" id="kecamatan_id" onchange="getkelurahan()" required>
                <option selected disabled>KECAMATAN</option>
            </select>
        </div>
    </div>
    <div class="col-sm-12 col-md-6 col-lg-6">
        <div class="form-group">
            <label for="">Kelurahan</label>
            <select class="form-control" name="order_kelurahan" id="kelurahan_id" onchange="getpenjual()" required>
                <option selected disabled>KELURAHAN / DESA</option>
            </select>
        </div>
    </div>
</div>
<div class="form-group">
    <label for="">Penjual PIN & Serial</label>
    <select class="form-control" name="order_penjualcode" id="penjual_id" onchange="getpaket()" required>
        <option selected disabled>PILIH PENJUAL</option>
    </select>
</div>
<div class="row">
    <div class="col-sm-12 col-md-6 col-lg-6">
        <div class="form-group">
            <label for="">Jenis PIN & Serial</label>
            <select class="form-control" name="order_paketcode" id="paket_id" onchange="getharga()" required>
                <option selected disabled>PILIH PAKET</option>
            </select>
            <input type="hidden" id="harga_paket">
        </div>
    </div>
    <div class="col-sm-12 col-md-6 col-lg-6">
        <div class="form-group">
            <label for="">Total Order</label>
            <input min="1" type="number" class="form-control" placeholder="Total Order" name="order_total" value="1" id="jmlpin" autocomplete="off">
        </div>
    </div>
</div>
<div class="form-group">
    <label for="">SubTotal Bayar</label>
    <input type="text" class="form-control" placeholder="SubTotal Bayar" id="subtotal" readonly>
</div>
<script>
    function getharga() {
        var paket_id = $('#paket_id').val();
        $("#harga_paket").val('');
        $.ajax({
            url: '<?php echo site_url('getdata/user_get/getdaerah/getdetailpaket') ?>',
            type: 'GET',
            dataType: 'json',
            data: {
                paket_id: paket_id,
            }
        }).done(function(data) {
            document.getElementById("harga_paket").value = data.harga;
            var diskon = <?php echo $diskon; ?>;
            var valharga = data.harga - diskon;
            var setharga = valharga.toString().split('').reverse().join(''),
                hargaaaaa = setharga.match(/\d{1,3}/g);
            hargaaaaa = hargaaaaa.join('.').split('').reverse().join('');

            document.getElementById("subtotal").value = "Rp. " + hargaaaaa;
        })
    }

    $(document).ready(function() {
        $("#jmlpin").keyup(function() {
            var jmlpin = $('#jmlpin').val();
            var harga_pin = $('#harga_paket').val();
            var paket_id = $('#paket_id').val();
            $.ajax({
                url: '<?php echo site_url('getdata/user_get/getdaerah/hitungharga') ?>',
                type: 'GET',
                dataType: 'json',
                data: {
                    paket_id: paket_id,
                    jmlpin: jmlpin,
                    harga_pin: harga_pin,
                }
            }).done(function(data) {
                var diskon = <?php echo $diskon; ?>;
                var valharga = data.harga - diskon;
                var setharga = valharga.toString().split('').reverse().join(''),
                    hargaaaaa = setharga.match(/\d{1,3}/g);
                hargaaaaa = hargaaaaa.join('.').split('').reverse().join('');

                document.getElementById("subtotal").value = "Rp. " + hargaaaaa;
            })
        });
    });

    function getkabkota() {
        var provinsi_id = $('#provinsi_id').val();

        $.ajax({
            url: '<?php echo site_url('getdata/user_get/getdaerah/getkab_member') ?>',
            type: 'GET',
            dataType: 'json',
            data: {
                provinsi_id: provinsi_id,
            }
        }).done(function(data) {
            $('#kabkota_id').empty();
            $('#kabkota_id').append('<option disabled selected>KOTA / KAB</option>');
            $.each(data.result, function(index, val) {
                $('#kabkota_id').append('<option value="' + val.id + '">' + val.name + '</option>');
            });
        })
    }

    function getkecamatan() {
        var kabkota_id = $('#kabkota_id').val();

        $.ajax({
            url: '<?php echo site_url('getdata/user_get/getdaerah/getkec_member') ?>',
            type: 'GET',
            dataType: 'json',
            data: {
                kabkota_id: kabkota_id,
            }
        }).done(function(data) {
            $('#kecamatan_id').empty();
            $('#kecamatan_id').append('<option disabled selected>KECAMATAN</option>');
            $.each(data.result, function(index, val) {
                $('#kecamatan_id').append('<option value="' + val.id + '">' + val.name + '</option>');
            });
        })
    }


    function getkelurahan() {
        var kecamatan_id = $('#kecamatan_id').val();

        $.ajax({
            url: '<?php echo site_url('getdata/user_get/getdaerah/getkel_member') ?>',
            type: 'GET',
            dataType: 'json',
            data: {
                kecamatan_id: kecamatan_id,
            }
        }).done(function(data) {
            $('#kelurahan_id').empty();
            $('#kelurahan_id').append('<option disabled selected>KELURAHAN / DESA</option>');
            $.each(data.result, function(index, val) {
                $('#kelurahan_id').append('<option value="' + val.id + '">' + val.name + '</option>');
            });
        })
    }


    function getpenjual() {
        var kelurahan_id = $('#kelurahan_id').val();

        $.ajax({
            url: '<?php echo site_url('getdata/user_get/getdaerah/get_agen') ?>',
            type: 'GET',
            dataType: 'json',
            data: {
                kelurahan_id: kelurahan_id,
            }
        }).done(function(data) {
            $('#penjual_id').empty();
            $('#penjual_id').append('<option disabled selected>PILIH PENJUAL</option>');
            $.each(data.result, function(index, val) {
                $('#penjual_id').append('<option value="' + val.user_code + '">' + val.user_fullname + '</option>');
            });
        })
    }


    function getpaket() {
        var penjual_id = $('#penjual_id').val();

        $.ajax({
            url: '<?php echo site_url('getdata/user_get/getdaerah/get_datapin') ?>',
            type: 'GET',
            dataType: 'json',
            data: {
                penjual_id: penjual_id,
            }
        }).done(function(data) {
            $('#paket_id').empty();
            $('#paket_id').append('<option disabled selected>PILIH PAKET</option>');
            $.each(data.result, function(index, val) {
                var disabledddd = '';
                if (val.stockpin == 0) {
                    var disabledddd = 'disabled';
                }
                var showstock = '';
                if (val.statusshow) {
                    var showstock = '( ' + val.stockpin + ' PAKET )';
                }

                $('#paket_id').append('<option value="' + val.paket_code + '" ' + disabledddd + '>' + val.paket + showstock + '</option>');
            });
        })
    }
</script>
<div class="form-group">
    <button type="submit" id="btn01" class="btn btn-block btn-primary">ORDER SEKARANG</button>
    <button type="button" id="btn02" class="btn btn-block btn-primary" disabled>PROSES ORDER</button>
</div>
<?php echo form_close(); ?>
<script type="text/javascript">
    $(document).ready(function() {
        $('#btn02').hide();
        $('#form-order').submit(function(event) {
            event.preventDefault();
            $('#btn01').hide();
            $('#btn02').show();
            $.ajax({
                    url: '<?php echo site_url('postdata/user_post/invoice/member_order') ?>',
                    type: 'post',
                    dataType: 'json',
                    data: $('#form-order').serialize(),
                })
                .done(function(data) {

                    myCSRF(data.csrf_data);
                    updateCSRF(data.csrf_data);
                    Swal.fire(
                        data.heading,
                        data.message,
                        data.type
                    ).then(function() {
                        if (data.status) {
                            location.reload();
                        }
                    });

                    $('#btn01').show();
                    $('#btn02').hide();

                })
        });
    });
</script>