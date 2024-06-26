<?php $this->template->title->set('Reset Password'); ?>
<?php

// echo "<pre>";
// print_r($this->session->userdata());
// echo "</pre>";

?>

<div class="form-body without-side">
	<div class="row">
		<div class="form-holder">
			<div class="form-content" style="padding-top: 5%;">
				<center>
					<div class="form-items mt-3">
						<center>
							<a href="<?php echo site_url() ?>" title="PT. MBA - Minema Berkah Abadi">
								<img src="<?php echo base_url('assets/logo-auth.png'); ?>" alt="PT. MBA - Minema Berkah Abadi" style="max-width: 180px;">
							</a>
						</center>

						<br>
						<div class="alert alert-danger text-center" role="alert">
							Kode Reset Password Anda telah kedaluwarsa atau tidak diketahui, silakan kirim ulang kode.
						</div>
						<?php echo form_open('', array('id' => 'resetpass-form')); ?>
						<div class="form-group">
							<label for="">Username</label>
							<input type="text" class="form-control" placeholder="Username" autocomplete="off" name="username">
						</div>
						<div class="form-group">
							<label for="">Alamat Email</label>
							<input type="text" class="form-control" placeholder="Alamat Email" autocomplete="off" name="email">
						</div>
						<div class="form-button">
							<button id="btn01" type="submit" class="ibtn btn-block">RESET PASSWORD</button>
							<button id="btn02" type="button" class="processlogin btn-block" disabled>PROCESS RESET PASSWORD</button>
						</div>
						<?php echo form_close(); ?>

						<div class="page-links mt-3 text-center">
							Sudah memiliki akun? <a href="<?php echo site_url('login') ?>" title="Login Sekarang">Login Sekarang</a>
						</div>
					</div>
				</center>
			</div>
			<script type="text/javascript">
				jQuery(document).ready(function($) {
					$('#btn02').hide();
					$('#resetpass-form').submit(function(event) {
						event.preventDefault();
						$('#btn01').hide();
						$('#btn02').show();

						$('#resetpass-form').loading();

						$.ajax({
								url: '<?php echo site_url('postdata/public_post/auth/do_forgotpass') ?>',
								type: 'post',
								dataType: 'json',
								data: $('#resetpass-form').serialize(),
							})
							.done(function(data) {

								updateCSRF(data.csrf_data);
								// grecaptcha.reset();
								swal(
									data.heading,
									data.message,
									data.type
								).then(function() {
									if (data.status) {
										location.href = '<?php echo site_url('login') ?>';
									}
								});

							})

							.always(function() {
								$('#resetpass-form').loading('stop');
							});
						$('#btn01').show();
						$('#btn02').hide();


					});

				});
			</script>
		</div>
	</div>
</div>