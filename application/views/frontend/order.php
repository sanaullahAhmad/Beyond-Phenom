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
		<!-- <div class="row">
			<div class="col-md-12">
				<div class="well">
				<pre>
					<?=$this->session->__ci_last_regenerate?>
					</pre>
				</div>		
			</div>
		</div> -->
			<div class="row">
				<div class="col-md-12 col-sm-12 tjs_canvas col-xs-12">
					<div class="row">
						<div class="col-md-12">
							<div class="table-responsive">
							<table class="table">
								<tr>
									<th>Name</th>
									<th>Price</th>
									<th>Quantity</th>
									<th>Total</th>
								</tr>
								<?php if($order_info){
									$grant_total = 0;
									$obj = new Product_sizes_model();
									foreach($order_info as $val){
										$db_sizes 		= explode(',', $val->sizes);
										$db_quantities  = explode(',', $val->quantities);

										$quantities 	= 0;

										$quantity_mockup = '';
										$keyindex =0;
										foreach ($db_sizes as $sizeid )
										{
											$size_det = $obj->get_by_id($sizeid);
											if($size_det!='')
											{
												$quantity_mockup .= $size_det->sizeTitle.' = '.$db_quantities[$keyindex].'<br>';
											}
											$keyindex++;
										}
										//echo $quantity_mockup;


										$cur_tot 		= 0;
										foreach ($db_quantities as $sizeqty)
										{
											$cur_tot += $val->price * $sizeqty;
											$grant_total += $val->price * $sizeqty;
											$quantities += $sizeqty;
										}

										echo '<tr>
													<th>'.$val->name.'</th>
													<th>$'.number_format((float)$val->price, 2, '.', '').'</th>
													<th>'.$quantity_mockup.'</th>
													<th>$'.$cur_tot.'</th>
											  </tr>';
									}
									echo '<tr>
											<th colspan="3" style="text-align: right;">Grand Total:</th>
											<th>$'.$grant_total.'</th>
										  </tr>';
									$address='';



									echo '<tr>
											<th colspan="4">
											<form method="post" action="'.base_url().'check_out">';
                                    if($this->session->userdata('userId'))
                                    {
										$back_url = base_url().'welcome_dashboard';
										$billing_address = $order_details->billing_address;
										$delivery_address = $order_details->delivery_address;

                                    echo ' <div class="row" style="margin-top:15px;">
												<div class="col-md-3">
													Billing Address:
												 </div>
												 <div class="col-md-9">
												 	<input type="text" name="billing_address" value="'.$billing_address.'" class="form-control" readonly >
												 </div>
											</div>
											<div class="row" style="margin-top:15px;">
												<div class="col-md-3">
													Delivery Address:
												 </div>
												 <div class="col-md-9">
												 	<input type="text" name="delivery_address" value="'.$delivery_address.'" class="form-control" readonly>
												 </div>
											</div>';
                                    }
                                    else
									{
										$back_url = base_url().'manufacturer_dashboard';
									}
                                    echo '
												<a href="'.$back_url.'" class="btn btn-primary" >Back</a> 
											</form> 
											</th>
										  </tr>';
								}
								?>
							</table>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
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
