<?php $this->load->view('frontend/header'); ?>
<!-- <link rel="stylesheet" href="bootstrap.min.css" /> -->
</head>
<body style="min-height: 100vh" xmlns="http://www.w3.org/1999/html">
<div class="container">
	<div class="header" style="margin-bottom: 20px">
		<h1>Beyond Phenom <small>Product Configurator</small></h1>
	</div>
	<div class="row">
		<div class="col-md-10 col-md-offset-1">
			<div class="row">
				<?php
				$valid = validation_errors_array();
				// if( is_array( $valid ) && !empty( $valid ) )
				//{ ?>
				<div class="container error_message">
					<div class="row">
						<div class="col-md-4 col-md-offset-4 text-center">
							<div class="alert  alert-warning"  style="background:white">
								<?php //=current($valid)?>
							</div>
						</div>
					</div>
				</div>
				<?php // } ?>
				<div class="col-md-6 col-sm-6 col-xs-12">
					<div class="login_wrapper">
						<div id="register" class="animate form registration_form">
							<section class="login_content">
								<form action="<?=site_url('login/signup_action')?><?php if(isset($_GET['redirct'])){ echo '?redirct='.$_GET['redirct'];} ?>" method="post" enctype="multipart/form-data">
									<h1>Sign Up</h1>
									<div class="form-group">
										<label for="username">
											User Name:
										</label>
										<input type="text" id="username" class="form-control" name="username" placeholder="Username" required="" />
									</div>
									<div class="form-group">
										<label for="email">
											Email:
										</label>
										<input type="text" id="email" class="form-control" name="email" placeholder="Email" required="" />
									</div>
									<div class="form-group">
										<label for="password">
											Password:
										</label>
										<input type="password" id="password" name="password" class="form-control" placeholder="Password" required="" />
									</div>


									<div class="form-group">
										<label for="userFirstName">
											First Name:
										</label>
										<input type="text" id="userFirstName" class="form-control" name="userFirstName" placeholder="First Name" required="" />
									</div>

									<div class="form-group">
										<label for="userLastName">
											Last Name:
										</label>
										<input type="text" id="userLastName" class="form-control" name="userLastName" placeholder="Last Name" required="" />
									</div>

									<div class="form-group">
										<label for="userDob">
											Date of birth:
										</label>
										<input type="text" id="userDob" class="form-control datepicker" name="userDob" placeholder="YYYY-MM-DD" value="<?php echo date('Y-m-d', strtotime('-18 years'))?>" required="" />
									</div>

									<div class="form-group">
										<label for="userGender">
											Gender:
										</label>
										<select id="userGender" class="form-control" name="userGender">
											<option value="1">Male</option>
											<option value="0">Female</option>
										</select>
									</div>

									<div class="form-group">
										<label for="userInfo">
											User Info:
										</label>
										<textarea id="userInfo" class="form-control" name="userInfo" placeholder="Details"  ></textarea>
									</div>
									<div class="form-group">
										<label for="userAddress">
											Address:
										</label>
										<input type="text" id="userAddress" class="form-control" name="userAddress" placeholder="Address"  />
									</div>
									<div class="form-group">
										<label for="userTelephone">
											Telephone:
										</label>
										<input type="text" id="userTelephone" class="form-control" name="userTelephone" placeholder="Telephone"  />
									</div>
									<div class="form-group">
										<label for="userCity">
											City:
										</label>
										<input type="text" id="userCity" class="form-control" name="userCity" placeholder="City"  />
									</div>
									<div class="form-group">
										<label for="userCountry">
											Country:
										</label>
										<input type="text" id="userCountry" class="form-control" name="userCountry" placeholder="Country"  />
									</div>
									<div class="form-group">
										<label for="userProfilePicture">
											User Profile Picture:
										</label>
										<input type="file" id="userProfilePicture"  name="userProfilePicture"  />
									</div>

									<div class="form-group">
										<button type="submit" class="btn btn-default submit">Submit</button>
										&nbsp;&nbsp;&nbsp;
										<a class="" href="<?= base_url('login')?>">Already a member?</a>
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
<!-- // <script src="../../js/three.js"></script> -->
<script type="text/javascript" src="<?php echo base_url('assets/3d/three.js'); ?>"></script>
<!-- // <script src="../../js/jquery-3.0.0.min.js"></script> -->
<!-- // <script src="../../js/js/loaders/DDSLoader.js"></script> -->
<script type="text/javascript" src="<?php echo base_url('assets/3d/DDSLoader.js'); ?>"></script>
<!-- // <script src="../../js/OBJLoader.js"></script> -->
<script type="text/javascript" src="<?php echo base_url('assets/3d/OBJLoader.js'); ?>"></script>
<!-- // <script src="../../js/js/loaders/MTLLoader.js"></script> -->
<script type="text/javascript" src="<?php echo base_url('assets/3d/MTLLoader.js'); ?>"></script>
<!-- // <script src="../../js/controls/OrbitControls.js"></script> -->
<script type="text/javascript" src="<?php echo base_url('assets/3d/controls/OrbitControls.js'); ?>"></script>
<script src="<?php echo base_url('assets/3d/custom/three-custom.js')?>"></script>
</script>
<script type="text/javascript" src="<?php echo base_url('assets/js/fabric/fabric.min.js'); ?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/js/bootbox.min.js'); ?>"></script>
<!-- // <script src="dist/fabric.min.js"></script> -->
<!-- // <script src="script.js"></script> -->
<script type="text/javascript" src="<?php echo base_url('assets/3d/custom/script.js'); ?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/3d/jquery.noty.packaged.min.js'); ?>"></script>
<link href="<?php echo base_url('assets/3d/animate.css'); ?>" rel="stylesheet" />
<link href="<?php echo base_url('assets/3d/buttons.css'); ?>" rel="stylesheet" />
<script type="text/javascript">
	function noti(type, text) {
// if(type=='default') icon = '<i class="fa fa-bell" aria-hidden="true"></i>';
// if(type=='warning') icon = '<i class="fa fa-exclamation" aria-hidden="true"></i>';
// if(type=='success') icon = '<i class="fa fa-check" aria-hidden="true"></i>';
// if(type=='danger') icon = '<i class="fa fa-exclamation-triangle" aria-hidden="true"></i>';
icon = null;
var n = noty({
text        : '<div class="activity-item"> '+icon+' <div class="activity"> '+text+' </div> </div>',
type        : type,
dismissQueue: true,
layout      : 'topRight',
// closeWith   : ['click'],
timeout: 3000,
theme       : 'relax',
maxVisible  : 10,
animation   : {
open  : 'animated bounceInRight',
close : 'animated bounceOutRight',
easing: 'swing',
speed : 500
}
});
// console.log('html: ' + n.options.id);
}
</script>
</body>
</html>