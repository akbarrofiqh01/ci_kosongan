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
            <label for="">Jenis PIN & Serial</label>
            <select class="form-control" name="order_paketcode" id="paket_id" onchange="getharga()" required>
                <option selected disabled>PILIH PAKET</option>
                <?php
                $gettttttt = $this->db->get('tb_packages');
                foreach ($gettttttt->result() as $show) {
                ?>
                    <option value="<?php echo $show->package_code ?>"><?php echo $show->package_name ?></option>
                <?php } ?>
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
                    url: '<?php echo site_url('postdata/user_post/invoice/grand_distributor_order') ?>',
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