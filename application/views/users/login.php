<?php $this->load->view('frontend/header'); ?>
</head>
<body>
<?php $this->load->view('frontend/navbar2'); ?>
	<div class="container">
		<!-- <div class="header" style="margin-bottom: 20px">
			<h1>Beyond Phenom <sup><small>3d Shop - Beta</small></sup></h1>
		</div> -->
		<div class="row">
			<div class="col-md-10 col-md-offset-1" style="min-height: 638px;">
				<div class="row">
				<?php if(validation_errors_array())
					{?>
					<div class="container error_message">
						<div class="row">
							<div class="col-md-4 col-md-offset-4 text-center">
								<div class="alert  alert-warning"  style="background:white">
									<?=validation_errors_array()?>
								</div>
							</div>
						</div>
					</div>
					<?php }
				 if($this->session->flashdata('message')){
				?>
					<div class="container error_message">
						<div class="row">
							<div class="col-md-4 col-md-offset-4 text-center">
								<div class="alert  alert-warning"  style="background:white">

									<?php  echo $this->session->flashdata('message'); ?>
								</div>
							</div>
						</div>
					</div>
					<?php }?>
					<div class="col-md-6 col-sm-6 col-xs-12">
						<div class="login_wrapper">
							<div id="register" class="animate form registration_form">
								<section class="login_content">
									<form action="<?=site_url('login/login_action')?><?php if(isset($_GET['redirect'])){ echo '?redirect='.$_GET['redirect'];} ?>" method="post">
										<h1>Login</h1>
										<div class="form-group">
											<label for="username">
												User Name:
											</label>
											<input type="text" id="username" class="form-control" name="username" placeholder="Username" required="" />
										</div>
										<div class="form-group">
											<label for="password">
												Password:
											</label>
											<input type="password" id="password" name="password" class="form-control" placeholder="Password" required="" />
										</div>
										<div class="form-group">
											<button type="submit" class="btn btn-default submit">Log in</button>
											&nbsp;&nbsp;&nbsp;
											<a class="" href="http://beyondphenom.com/wp-login.php?action=register" target="_blank">Create Account</a>
											<?php //echo  base_url('signup'); if(isset($_GET['redirect'])){ echo '?redirect='.$_GET['redirect'];} ?>
										</div>
										<div class="clearfix"></div>
									</form>
								</section>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

<?php $this->load->view('frontend/footer'); ?>

