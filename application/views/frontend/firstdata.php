<?php $this->load->view('frontend/header'); ?>
<style>
	.more_settings, #more_settings{
		background:  #fff;
		display: none;
		position: absolute;
		right: 10px;
		top: 34px;
		box-shadow: 0px 4px 4px gray;
	}
	.more_settings label, #more_settings label{
		font-size: 14px;
	}
	.more_settings input, #more_settings input{
		font-size: 14px;
	}
</style>
<!-- <link rel="stylesheet" href="bootstrap.min.css" /> -->
</head>
<body style="min-height: 960px;">
<?php $this->load->view('frontend/navbar');?>
	<div class="container">
		<div class="">
			<div class="row">
				<div class="col-md-12 col-sm-12 tjs_canvas col-xs-12">
					<form method="post" class="form-horizental">
						<div class="col-sm-3"> Billing Country: </div><div class="col-sm-9"><input type="text" name="billing_country" value="Pakistan"></div>
						<div class="col-sm-3"> First Name: </div><div class="col-sm-9"><input type="text" name="billing_first_name" value="sana"></div>
						<div class="col-sm-3"> Last Name: </div><div class="col-sm-9"><input type="text" name="billing_last_name" value="Ullah"></div>
						<div class="col-sm-3"> Company Name: </div><div class="col-sm-9"><input type="text" name="billing_company" value="Pakipreneurs"></div>
						<div class="col-sm-3"> Address: </div><div class="col-sm-9"><input type="text" name="billing_address_1" value="house no "></div>
						<div class="col-sm-3"> Address2: </div><div class="col-sm-9"><input type="text" name="billing_address_2" value="town"></div>
						<div class="col-sm-3"> Town/city: </div><div class="col-sm-9"><input type="text" name="billing_city" value="town"></div>
						<div class="col-sm-3"> State / County : </div><div class="col-sm-9"><input type="text" name="billing_state" value="Pakistan"></div>
						<div class="col-sm-3"> Postcode / Zip * : </div><div class="col-sm-9"><input type="text" name="billing_postcode" value="44000"></div>
						<div class="col-sm-3"> Email Address  : </div><div class="col-sm-9"><input type="text" name="billing_email" value="email"></div>
						<div class="col-sm-3"> Phone  : </div><div class="col-sm-9"><input type="text" name="billing_phone" value="phone"></div><br>
						<div class="col-sm-12"><p>&nbsp;</p></div>

						<div class="col-sm-3"> account-number: </div><div class="col-sm-9"><input type="text" name="firstdata-account-number" value="4111111111111111"></div>
						<div class="col-sm-3">cvv:</div><div class="col-sm-9"><input type="text" name="firstdata-cvv" value="1122"></div>
						<div class="col-sm-3">exp-month: </div><div class="col-sm-9"><input type="text" name="firstdata-exp-month" value="12"></div>
						<div class="col-sm-3">number:</div><div class="col-sm-9"><input type="text" name="firstdata-exp-year" value="2017"></div>
						<div class="col-sm-3">total:</div><div class="col-sm-9"><input type="text" name="get_total" value="1"></div>
						<div class="col-sm-3">shipping:</div><div class="col-sm-9"><input type="text" name="get_total_shipping" value="1"></div>
						<div class="col-sm-3"></div><div class="col-sm-9"><input type="submit"></div>
					</form>
				</div>
			</div>
		</div>
	</div>
<link href="<?php echo base_url('assets/3d/animate.css'); ?>" rel="stylesheet" />
<link href="<?php echo base_url('assets/3d/buttons.css'); ?>" rel="stylesheet" />

    </body>
    </html>
