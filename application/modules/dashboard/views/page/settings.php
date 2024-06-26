<?php
$userdata = userdata();
$this->template->title->set('Settings');
$this->template->label->set('PROFILE');
$this->template->sublabel->set('Settings');
?>
<link rel="stylesheet" href="<?php echo base_url("assets/datepicker/css/bootstrap-datepicker.min.css") ?>">
<script src="<?php echo base_url("assets/datepicker/js/bootstrap-datepicker.min.js") ?>"></script>
<script src="<?php echo base_url("assets/datepicker/locales/bootstrap-datepicker.id.min.js") ?>"></script>

<script>
    $(function() {
        $("#tgl_lahir").datepicker({
            autoclose: true,
            todayHighlight: true,
            format: 'dd-mm-yyyy',
            language: 'id'
        });
    });
</script>
<style>
    .datepicker {
        z-index: 9999999 !important;
    }

    .ui-datepicker-div {
        z-index: 9999999 !important;
    }
</style>
<div class="row">
    <div class="col-sm-12 col-md-6 col-lg-6">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Update Profile</h3>
            </div>
            <div class="card-body">
                <?php echo form_open('', 'id="updateprofile"'); ?>
                <div class="form-group">
                    <label class="form-label">Nomor Induk Kependudukan (NIK)</label>
                    <input type="text" class="form-control" value="<?php echo $userdata->user_nik ?>" placeholder="Nomor Induk Kependudukan (NIK)" disabled>
                </div>
                <div class="row">
                    <div class="col-sm-12 col-md-6 col-lg-6">
                        <div class="form-group">
                            <label class="form-label">Nama Lengkap</label>
                            <input type="text" class="form-control" value="<?php echo $userdata->user_fullname ?>" name="user_fullname" autocomplete="off" placeholder="Nama Lengkap">
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-6 col-lg-6">
                        <div class="form-group">
                            <label class="form-label">Jenis Kelamin</label>
                            <select name="user_jeniskelamin" id="" class="form-control">
                                <option selected disabled>Pilih Jenis Kelamin</option>
                                <?php
                                $array_jenis = array(
                                    array(
                                        'label'     => 'Laki  - Laki',
                                        'value'     => 'l',
                                    ),
                                    array(
                                        'label'     => 'Perempuan',
                                        'value'     => 'p',
                                    ),
                                );

                                foreach ($array_jenis as $jenis_kelamin) {
                                    $status_checked = '';
                                    if ($userdata->user_jeniskelamin == $jenis_kelamin['value']) {
                                        $status_checked = 'selected';
                                    }
                                ?>
                                    <option value="<?php echo $jenis_kelamin['value'] ?>" <?php echo $status_checked; ?>><?php echo $jenis_kelamin['label'] ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-12 col-md-6 col-lg-6">
                        <div class="form-group">
                            <label class="form-label">Alamat Email</label>
                            <input type="text" class="form-control" value="<?php echo $userdata->email ?>" placeholder="Alamat Email" disabled>
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-6 col-lg-6">
                        <div class="form-group">
                            <label class="form-label">No WhatsApp</label>
                            <input type="text" class="form-control" value="<?php echo $userdata->user_phone ?>" placeholder="No WhatsApp" name="user_phone">
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-12 col-md-6 col-lg-6">
                        <div class="form-group">
                            <label class="form-label">Tempat Lahir</label>
                            <input type="text" class="form-control" value="<?php echo $userdata->user_tmptLahir ?>" placeholder="Tempat Lahir" name="user_tmptLahir">
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-6 col-lg-6">
                        <div class="form-group">
                            <label class="form-label">Tanggal Lahir</label>
                            <input type="text" class="form-control" value="<?php echo $userdata->user_tglLahir ?>" placeholder="Tanggal Lahir" name="user_tglLahir" id="tgl_lahir">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12 col-md-6 col-lg-6">
                        <div class="form-group">
                            <label class="form-label">Provinsi</label>
                            <select class="form-control" name="user_provinsi" id="provinsi_id" onchange="getkabkota()" required>
                                <option selected disabled>Provinsi</option>
                                <?php
                                $getprov = $this->db->query('SELECT * FROM wilayah WHERE CHAR_LENGTH(kode) = 2');
                                foreach ($getprov->result() as $provinsi) {
                                    $status_prov = '';
                                    if ($provinsi->kode == $userdata->user_provinsi) {
                                        $status_prov = 'selected';
                                    }
                                ?>
                                    <option value="<?php echo $provinsi->kode ?>" <?php echo $status_prov ?>><?php echo $provinsi->nama ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-6 col-lg-6">
                        <div class="form-group">
                            <label class="form-label">Kota / Kabupaten</label>
                            <select class="form-control" name="user_kota" id="kabkota_id" onchange="getkecamatan()" required>
                                <option selected disabled>Kota / Kabupaten</option>
                                <?php
                                $getkab = $this->db->query('SELECT * FROM wilayah WHERE CHAR_LENGTH(kode) = 5 AND LEFT(kode,2)="' . $userdata->user_provinsi . '"');
                                foreach ($getkab->result() as $kabkota) {
                                    $status_kabkota = '';
                                    if ($kabkota->kode == $userdata->user_kota) {
                                        $status_kabkota = 'selected';
                                    }
                                ?>
                                    <option value="<?php echo $kabkota->kode ?>" <?php echo $status_kabkota ?>><?php echo $kabkota->nama ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12 col-md-6 col-lg-6">
                        <div class="form-group">
                            <label class="form-label">Kecamatan</label>
                            <select class="form-control" name="user_kecamatan" id="kecamatan_id" onchange="getkelurahan()" required>
                                <option selected disabled>Kecamatan</option>
                                <?php
                                $getkec = $this->db->query('SELECT * FROM wilayah WHERE CHAR_LENGTH(kode) = 8 AND LEFT(kode,5)="' . $userdata->user_kota . '"');
                                foreach ($getkec->result() as $kecamatan) {
                                    $status_kec = '';
                                    if ($kecamatan->kode == $userdata->user_kecamatan) {
                                        $status_kec = 'selected';
                                    }
                                ?>
                                    <option value="<?php echo $kecamatan->kode ?>" <?php echo $status_kec ?>><?php echo $kecamatan->nama ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-6 col-lg-6">
                        <div class="form-group">
                            <label class="form-label">Kelurahan / Desa</label>
                            <select class="form-control" name="user_kelurahan" id="kelurahan_id" required>
                                <option selected disabled>Kelurahan / Desa</option>
                            </select>
                        </div>
                    </div>
                </div>
                <script>
                    function getkabkota() {
                        var provinsi_id = $('#provinsi_id').val();

                        $.ajax({
                            url: '<?php echo site_url('getdata/user_get/getother/getwilayahKabKota') ?>',
                            type: 'GET',
                            dataType: 'json',
                            data: {
                                provinsi_id: provinsi_id,
                            }
                        }).done(function(data) {
                            $('#kabkota_id').empty();
                            $('#kabkota_id').append('<option disabled selected>Kota / Kabupaten</option>');
                            $.each(data.result, function(index, val) {
                                $('#kabkota_id').append('<option value="' + val.kode + '">' + val.nama + '</option>');
                            });
                        })
                    }

                    function getkecamatan() {
                        var kabkota_id = $('#kabkota_id').val();

                        $.ajax({
                            url: '<?php echo site_url('getdata/user_get/getother/getwilayahKec') ?>',
                            type: 'GET',
                            dataType: 'json',
                            data: {
                                kabkota_id: kabkota_id,
                            }
                        }).done(function(data) {
                            $('#kecamatan_id').empty();
                            $('#kecamatan_id').append('<option disabled selected>Kecamatan</option>');
                            $.each(data.result, function(index, val) {
                                $('#kecamatan_id').append('<option value="' + val.kode + '">' + val.nama + '</option>');
                            });
                        })
                    }

                    function getkelurahan() {
                        var kecamatan_id = $('#kecamatan_id').val();

                        $.ajax({
                            url: '<?php echo site_url('getdata/user_get/getother/getwilayahKel') ?>',
                            type: 'GET',
                            dataType: 'json',
                            data: {
                                kecamatan_id: kecamatan_id,
                            }
                        }).done(function(data) {
                            $('#kelurahan_id').empty();
                            $('#kelurahan_id').append('<option disabled selected>Kelurahan / Desa</option>');
                            $.each(data.result, function(index, val) {
                                $('#kelurahan_id').append('<option value="' + val.kode + '">' + val.nama + '</option>');
                            });
                        })
                    }
                </script>
                <div class="form-group">
                    <label class="form-label">Alamat Lengkap</label>
                    <textarea name="user_alamat" cols="3" rows="3" class="form-control" style="resize: none;" placeholder="Alamat Lengkap"><?php echo $userdata->user_alamat ?></textarea>
                    <small>Jalan, Blok, RW atau RW</small>
                </div>

                <div class="form-group">
                    <label class="form-label">Konfirmasi Password</label>
                    <div class="input-group" id="show_hide_passwordddd">
                        <input type="password" class="form-control" placeholder="Konfirmasi Password" aria-label="Konfirmasi Password" aria-describedby="basic-addon2" autocomplete="off" name="user_pass" style="border:1px solid #6c5ffc!important">
                        <div class="input-group-append">
                            <button style="border-top-left-radius: 0;border-bottom-left-radius: 0;" class="btn btn-outline-primary" type="button" id=""><i class="fa fa-eye-slash" aria-hidden="true"></i></button>
                        </div>
                    </div>
                </div>
                <script>
                    $(document).ready(function() {
                        $("#show_hide_passwordddd button").on('click', function(event) {
                            event.preventDefault();
                            if ($('#show_hide_passwordddd input').attr("type") == "text") {
                                $('#show_hide_passwordddd input').attr('type', 'password');
                                $('#show_hide_passwordddd i').addClass("fa-eye-slash");
                                $('#show_hide_passwordddd i').removeClass("fa-eye");
                            } else if ($('#show_hide_passwordddd input').attr("type") == "password") {
                                $('#show_hide_passwordddd input').attr('type', 'text');
                                $('#show_hide_passwordddd i').removeClass("fa-eye-slash");
                                $('#show_hide_passwordddd i').addClass("fa-eye");
                            }
                        });
                    });
                </script>
                <div class="form-group">
                    <button id='btn010' style="font-weight:bold;color:#fff" type="submit" class="btn btn-primary btn-block">UPDATE PROFILE</button>
                    <button id='btn020' style="font-weight:bold;color:#fff" type="button" class="btn btn-primary btn-block" disabled>PROSES UPDATE</button>
                </div>
                <?php echo form_close(); ?>
                <script>
                    $('#btn020').hide();
                    $('#updateprofile').submit(function(event) {
                        event.preventDefault();
                        $('#btn010').hide();
                        $('#btn020').show();

                        $.ajax({
                                url: '<?php echo site_url('postdata/user_post/profile/updateprofile') ?>',
                                type: 'POST',
                                dataType: 'json',
                                data: $('#updateprofile').serialize(),
                            })
                            .done(function(data) {

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
                                $('#btn010').show();
                                $('#btn020').hide();
                            })
                    });
                </script>
            </div>
        </div>
        <?php
        $user_group     = $this->ion_auth->get_users_groups()->row();

        if ($user_group->id != 1) {
        ?>
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Update Bank</h3>
                </div>
                <?php
                $banklock = '';
                if ($userdata->user_bank_account != null) {
                    $banklock = 'disabled';
                }
                ?>
                <div class="card-body">
                    <?php echo form_open('', 'id="updatebank"'); ?>
                    <?php if ($userdata->user_bank_account != null) { ?>
                        <div class="alert alert-danger" role="alert" style="background-color: #f3545d;color:#fff;border-left: 4px solid blue!important;">
                            Hubungi Admin Untuk Update Data Bank Anda
                        </div>
                    <?php } ?>
                    <div class="form-group">
                        <label for="">Rekening Atasnama</label>
                        <input type="text" class="form-control" placeholder="Rekening Atasnama" value="<?php echo $userdata->user_bank_account ?>" name="user_bank_account" autocomplete="off" <?php echo $banklock ?>>
                    </div>
                    <div class="row">
                        <div class="col-sm-12 col-md-6 col-lg-6">
                            <div class="form-group">
                                <label for="">Nama Bank</label>
                                <input type="text" class="form-control" placeholder="Nama Bank" name="user_bank_name" value="<?php echo $userdata->user_bank_name; ?>" autocomplete="off" <?php echo $banklock ?>>
                                <small>Contoh: BCA, BNI, BRI</small>
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-6 col-lg-6">
                            <div class="form-group">
                                <label for="">Nomor Rekening</label>
                                <input type="text" class="form-control" placeholder="Nomor Rekening" name="user_bank_number" value="<?php echo $userdata->user_bank_number; ?>" autocomplete="off" <?php echo $banklock ?>>
                            </div>
                        </div>
                    </div>
                    <?php if ($user_group->id != 1) { ?>
                        <?php if ($userdata->user_bank_account == null) { ?>
                            <div class="form-group">
                                <label>Konfirmasi Password</label>
                                <div class="input-group" id="show_hide_password">
                                    <input type="password" class="form-control" placeholder="Konfirmasi Password" aria-label="Konfirmasi Password" aria-describedby="basic-addon2" autocomplete="off" name="bank_pass" style="border:1px solid #6c5ffc!important">
                                    <div class="input-group-append">
                                        <button style="border-top-left-radius: 0;border-bottom-left-radius: 0;" class="btn btn-outline-primary" type="button" id=""><i class="fa fa-eye-slash" aria-hidden="true"></i></button>
                                    </div>
                                </div>
                            </div>
                            <script>
                                $(document).ready(function() {
                                    $("#show_hide_password button").on('click', function(event) {
                                        event.preventDefault();
                                        if ($('#show_hide_password input').attr("type") == "text") {
                                            $('#show_hide_password input').attr('type', 'password');
                                            $('#show_hide_password i').addClass("fa-eye-slash");
                                            $('#show_hide_password i').removeClass("fa-eye");
                                        } else if ($('#show_hide_password input').attr("type") == "password") {
                                            $('#show_hide_password input').attr('type', 'text');
                                            $('#show_hide_password i').removeClass("fa-eye-slash");
                                            $('#show_hide_password i').addClass("fa-eye");
                                        }
                                    });
                                });
                            </script>
                            <div class="form-group">
                                <button id='btn01bank' style="font-weight:bold;color:#fff" type="submit" class="btn btn-primary btn-block">UPDATE BANK</button>
                                <button id='btn02bank' style="font-weight:bold;color:#fff" type="button" class="btn btn-primary btn-block" disabled>PROSES BANK</button>
                            </div>
                        <?php } ?>
                    <?php } ?>
                    <?php echo form_close(); ?>
                </div>
                <script>
                    $('#btn02bank').hide();
                    $('#updatebank').submit(function(event) {
                        event.preventDefault();
                        $('#btn01bank').hide();
                        $('#btn02bank').show();

                        $.ajax({
                                url: '<?php echo site_url('postdata/user_post/profile/updatebank') ?>',
                                type: 'POST',
                                dataType: 'json',
                                data: $('#updatebank').serialize(),
                            })
                            .done(function(data) {

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
                                $('#btn01bank').show();
                                $('#btn02bank').hide();
                            })
                    });
                </script>
            </div>
        <?php } ?>
    </div>

    <div class="col-sm-12 col-md-6 col-lg-6">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Update Password</h3>
            </div>
            <div class="card-body">
                <?php echo form_open('', 'id="updatepass"'); ?>
                <div class="form-group">
                    <label>Password Lama</label>
                    <div class="input-group" id="old_password">
                        <input type="password" class="form-control" placeholder="Password Lama" aria-label="Password Lama" aria-describedby="basic-addon2" autocomplete="off" name="current_password" style="border:1px solid #6c5ffc!important">
                        <div class="input-group-append">
                            <button style="border-top-left-radius: 0;border-bottom-left-radius: 0;" class="btn btn-outline-primary" type="button" id=""><i class="fa fa-eye-slash" aria-hidden="true"></i></button>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label>Password Baru</label>
                    <div class="input-group" id="new_password">
                        <input type="password" class="form-control" placeholder="Password Baru" aria-label="Password Baru" aria-describedby="basic-addon2" autocomplete="off" name="new_password" style="border:1px solid #6c5ffc!important">
                        <div class="input-group-append">
                            <button style="border-top-left-radius: 0;border-bottom-left-radius: 0;" class="btn btn-outline-primary" type="button" id=""><i class="fa fa-eye-slash" aria-hidden="true"></i></button>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label>Ulangi Password Baru</label>
                    <div class="input-group" id="repeatnew_password">
                        <input type="password" class="form-control" placeholder="Ulangi Password Baru" aria-label="Ulangi Password Baru" aria-describedby="basic-addon2" autocomplete="off" name="confirm_password" style="border:1px solid #6c5ffc!important">
                        <div class="input-group-append">
                            <button style="border-top-left-radius: 0;border-bottom-left-radius: 0;" class="btn btn-outline-primary" type="button" id=""><i class="fa fa-eye-slash" aria-hidden="true"></i></button>
                        </div>
                    </div>
                </div>
                <script>
                    $(document).ready(function() {
                        $("#old_password button").on('click', function(event) {
                            event.preventDefault();
                            if ($('#old_password input').attr("type") == "text") {
                                $('#old_password input').attr('type', 'password');
                                $('#old_password i').addClass("fa-eye-slash");
                                $('#old_password i').removeClass("fa-eye");
                            } else if ($('#old_password input').attr("type") == "password") {
                                $('#old_password input').attr('type', 'text');
                                $('#old_password i').removeClass("fa-eye-slash");
                                $('#old_password i').addClass("fa-eye");
                            }
                        });

                        $("#new_password button").on('click', function(event) {
                            event.preventDefault();
                            if ($('#new_password input').attr("type") == "text") {
                                $('#new_password input').attr('type', 'password');
                                $('#new_password i').addClass("fa-eye-slash");
                                $('#new_password i').removeClass("fa-eye");
                            } else if ($('#new_password input').attr("type") == "password") {
                                $('#new_password input').attr('type', 'text');
                                $('#new_password i').removeClass("fa-eye-slash");
                                $('#new_password i').addClass("fa-eye");
                            }
                        });

                        $("#repeatnew_password button").on('click', function(event) {
                            event.preventDefault();
                            if ($('#repeatnew_password input').attr("type") == "text") {
                                $('#repeatnew_password input').attr('type', 'password');
                                $('#repeatnew_password i').addClass("fa-eye-slash");
                                $('#repeatnew_password i').removeClass("fa-eye");
                            } else if ($('#repeatnew_password input').attr("type") == "password") {
                                $('#repeatnew_password input').attr('type', 'text');
                                $('#repeatnew_password i').removeClass("fa-eye-slash");
                                $('#repeatnew_password i').addClass("fa-eye");
                            }
                        });
                    });
                </script>

                <div class="form-group">
                    <button id='btn01' type="submit" style="font-weight:bold;color:#fff" class="btn btn-primary btn-block">UPDATE PASSWORD</button>
                    <button id='btn02' type="button" style="font-weight:bold;color:#fff" class="btn btn-primary btn-block" disabled>PROSES UPDATE</button>
                </div>
                <?php echo form_close(); ?>
            </div>
            <script>
                $('#btn02').hide();
                $('#updatepass').submit(function(event) {
                    event.preventDefault();
                    $('#btn01').hide();
                    $('#btn02').show();

                    $.ajax({
                            url: '<?php echo site_url('postdata/user_post/profile/changepass') ?>',
                            type: 'POST',
                            dataType: 'json',
                            data: $('#updatepass').serialize(),
                        })
                        .done(function(data) {

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
            </script>
        </div>
    </div>
</div>