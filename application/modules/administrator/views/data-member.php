<?php
$this->template->title->set('Member Data');
$this->template->label->set('ADMIN');
$this->template->sublabel->set('Member Data');
?>
<div class="page-wrapper">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Member Data</h3>
        </div>
        <div class="card-body">
            <form action="<?php echo site_url('admin/data-member') ?>" method="GET">
                <div class="form-group">
                    <label for="">Pecarian</label>
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" placeholder="USERNAME MEMBER" aria-label="NAMA MEMBER" aria-describedby="button-addon2" autocomplete="off" name="search" style="border:2px solid #2949ef">
                        <button class="btn btn-primary" type="submit" id="button-addon2" style="border:2px solid #2949ef">CARI DATA</button>
                    </div>
                </div>
            </form>
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th width="5%">#</th>
                            <th>Userdata</th>
                            <th>Rank</th>
                            <th>Kontak</th>
                            <th>Sponsor</th>
                            <th>Tgl Gabung</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $limit       = 15;
                        $offset      = ($this->input->get('page')) ? $this->input->get('page') : 0;
                        $no          = $offset + 1;

                        $this->db->order_by('created_on', 'DESC');
                        $this->db->where('id !=', 1);
                        if ($this->input->get('search')) {
                            $this->db->like('username', $this->input->get('search'));
                            $this->db->or_like('user_fullname', $this->input->get('search'));
                        }
                        $getdata = $this->db->get('tb_users', $limit, $offset);

                        $this->db->where('id !=', 1);
                        if ($this->input->get('search')) {
                            $this->db->like('username', $this->input->get('search'));
                            $this->db->or_like('user_fullname', $this->input->get('search'));
                        }
                        $Gettotal = $this->db->get('tb_users')->num_rows();
                        foreach ($getdata->result() as $show) {
                            $refdata    = userdata(['id' => $show->referral_id]);
                            $updata    = userdata(['id' => $show->upline_id]);

                            $this->db->where('referral_id', $show->id);
                            $getreff = $this->db->get('tb_users');

                            $tot = $getreff->num_rows();

                            if ($tot >= 0 && $tot < 9) {
                                $keterangan = "<span class='badge bg-primary'>AGEN</span>";
                            } elseif ($tot >= 10 && $tot < 19) {
                                $keterangan = "<span class='badge bg-primary'>CONSULTANT</span>";
                            } elseif ($tot >= 20 && $tot < 49) {
                                $keterangan = "<span class='badge bg-primary'>SUPERVISOR</span>";
                            } elseif ($tot >= 50 && $tot < 99) {
                                $keterangan = "<span class='badge bg-primary'>MANAGER</span>";
                            } elseif ($tot >= 100 && $tot < 199) {
                                $keterangan = "<span class='badge bg-primary'>DIRECTOR</span>";
                            } elseif ($tot >= 299) {
                                $keterangan = "<span class='badge bg-primary'>PRESIDENT</span>";
                            }

                            if ($show->id != 1) {
                        ?>
                                <tr>
                                    <th><?php echo $no++ ?></th>
                                    <td>
                                        <?php echo $show->user_fullname ?>
                                        <br>
                                        <small>@<?php echo $show->username; ?></small>
                                    </td>
                                    <td><?= $keterangan ?></td>
                                    <td>
                                        <?php echo $show->user_phone ?>
                                        <br>
                                        <?php echo $show->email ?>
                                    </td>
                                    <td><?php echo $refdata->user_fullname ?>
                                        <br>
                                        <small>@<?php echo $refdata->username; ?></small>
                                    </td>
                                    <td>
                                        <?php if ($show->user_pelunasan == 'yes') { ?>
                                            <span class="badge bg-success" style="min-width: 80px;">LUNAS</span>
                                        <?php } else { ?>
                                            <span class="badge bg-danger" style="min-width: 80px;">BELUM LUNAS</span>
                                        <?php } ?>
                                        <br>
                                        <?php echo date('d-M-Y', $show->created_on) ?>
                                    </td>
                                    <td>
                                        <?php if ($show->user_pelunasan == 'yes') { ?>
                                            <a href="javascript:void(0)" onclick="setSTATUS('<?php echo $show->user_code ?>','no')" class="btn btn-sm btn-danger text-white" title="Tidak Lunas">
                                                Belum Lunas
                                            </a>
                                        <?php } else { ?>
                                            <a href="javascript:void(0)" onclick="setSTATUS('<?php echo $show->user_code ?>','yes')" class="btn btn-sm btn-success text-white mb-1" title="Lunas">
                                                Lunas
                                            </a>
                                        <?php } ?>
                                        <a data-href="<?php echo site_url('modal/admin/member-update?code=' . $show->user_code) ?>" data-bs-title="UPDATE MEMBER" data-bs-remote="false" data-bs-toggle="modal" data-bs-target="#dinamicModal" data-bs-backdrop="static" data-bs-keyboard="false" title="UPDATE MEMBER" class="btn btn-sm btn-primary text-white mb-1">
                                            Update
                                        </a>
                                        <a data-id="<?php echo $show->id ?>" class="btn btn-sm btn-danger text-white login_as_user  mb-1" href="#" role="button" title="LOGIN" style="min-width: 65px;">Login</a>

                                    </td>
                                </tr>
                            <?php } ?>
                        <?php } ?>
                    </tbody>
                </table>
                <?php echo $this->paginationmodel->paginate('data-member', $Gettotal, $limit) ?>
            </div>
        </div>
    </div>
</div>

<?php echo form_hidden('csrf_cadangan', $this->security->get_csrf_hash()); ?>
<script>
    function setSTATUS(code, status) {
        Swal.fire({
            allowOutsideClick: false,
            title: 'Apakah Anda Yakin?',
            text: "Status Akan Diperbarui!",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'YA, Perbarui',
            cancelButtonText: 'Batal',
        }).then((result) => {
            if (result.value) {

                $.ajax({
                        url: '<?php echo site_url('postdata/admin_post/userlist/LUNASorTIDAK') ?>',
                        type: 'post',
                        dataType: 'json',
                        data: {
                            status: status,
                            code: code,
                            <?php echo $this->security->get_csrf_token_name(); ?>: '<?php echo $this->security->get_csrf_hash(); ?>'
                        }
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
                    })
            }
        });
    }
</script>
<script>
    jQuery(document).ready(function($) {

        $('.login_as_user').click(function(event) {

            $('body').loading();
            $.ajax({
                    url: '<?php echo site_url('postdata/admin_post/userlist/login_as_user') ?>',
                    type: 'post',
                    dataType: 'json',
                    data: {
                        user_id: $(this).data('id'),
                        csrf_myapp: $('input[name=csrf_cadangan]').val()
                    },
                })
                .done(function(result) {

                    $('input[name=csrf_cadangan]').val(result.csrf_data);

                    if (result.status) {
                        Swal.fire(
                            'Berhasil',
                            result.heading,
                            result.type
                        ).then(function() {
                            location.href = '<?php echo site_url('dashboard') ?>';
                        });

                    } else {
                        Swal.fire({
                            title: result.heading,
                            text: result.message,
                            type: 'warning',
                            showCancelButton: true,
                            allowOutsideClick: false,
                            confirmButtonColor: '#3085d6',
                            cancelButtonColor: '#d33',
                            confirmButtonText: 'YA, Logout',
                            cancelButtonText: 'Batal',
                        }).then((result) => {
                            if (result.value) {
                                location.href = '<?php echo site_url('authentication/logout') ?>';
                            }
                        })
                    }

                })
                .always(function() {
                    $('body').loading('stop');
                });

        });

    });
</script>