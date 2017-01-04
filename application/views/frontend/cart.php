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
<?php $this->load->view('frontend/navbar2');?>
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
				<div class="col-md-12 col-sm-12 tjs_canvas col-xs-12" style=" min-height: 650px;">
					<div class="row">
						<div class="col-md-12">
							<?php if($this->session->flashdata('warning'))
							{
								?>
								<div class="alert alert-danger">
									<?php echo $this->session->flashdata('warning');?>
								</div>
								<?php
							}
								?>
							<div class="table-responsive">
							<table class="table">
								<tr>
									<th>Name</th>
									<th>Price</th>
									<th>Quantity</th>
									<th>Total</th>
								</tr>
								<?php if($this->session->userdata('cart') && $this->session->userdata('cart')!=""){
									//echo "<pre>";print_r($this->session->userdata('cart'));echo "</pre>";
									$grant_total = 0;
									$obj = new Product_sizes_model();
									foreach($this->session->userdata('cart') as $val){
										$cur_tot = 0;
										$quantities = 0;

										$quantity_mockup = '';
										$keyindex =0;
										foreach ($val['size_qty'] as $sizeid => $sizeqty)
										{
											$size_det = $obj->get_by_id($sizeid);
											if($size_det!='')
											{
												$quantity_mockup .= $size_det->sizeTitle.' = '.$sizeqty.'<br>';
											}
											$keyindex++;

											$cur_tot += $val['price'] * $sizeqty;
											$grant_total += $val['price'] * $sizeqty;
											$quantities += $sizeqty;
										}
										echo '<tr>
													<th>'.$val['product_name'].'</th>
													<th>$'.$val['price'].'</th>
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
											<form method="post" action="'.base_url().'check_out" class="form-horizontal">';
											if($this->session->userdata('userId'))
											{
												$address = '';
												if(isset($user_info[0]['billing_address_1'])){ $address.=$user_info[0]['billing_address_1'].' '; }
												if(isset($user_info[0]['billing_city'])){ $address.=$user_info[0]['billing_city'].' '; }
												if(isset($user_info[0]['billing_country'])){ $address.=$user_info[0]['billing_country']; }

											/*echo ' <div class="row" style="margin-top:15px;">
														<div class="col-md-3">
															Billing Address:
														 </div>
														 <div class="col-md-9">
															<input type="text" name="billing_address" value="'.$address.'" class="form-control" required>
														 </div>
													</div>
													<div class="row" style="margin-top:15px;">
														<div class="col-md-3">
															Delivery Address:
														 </div>
														 <div class="col-md-9">
															<input type="text" name="delivery_address" value="'.$address.'" class="form-control" required>
														 </div>
													</div>
													<div class="row" style="margin-top:15px;">
														<div class="col-md-3">
															Card Number:
														 </div>
														 <div class="col-md-9">
															<input type="text" name="cardNumber"  class="form-control" required>
														 </div>
													</div>
													<div class="row" style="margin-top:15px;">
														<div class="col-md-3">
															CCVV:
														 </div>
														 <div class="col-md-9">
															<input type="text" name="ccvv"  class="form-control" required>
														 </div>
													</div>
													<div class="row" style="margin-top:15px;">
														<div class="col-md-3">
															Expiry Date:
														 </div>
														 <div class="col-md-9">
															<input type="text" name="expiryDate"  class="form-control" placeholder="Month Year like 0219" required>
														 </div>
													</div>';*/
												?><div class="form-group">
												<div class="col-sm-3"> Billing Country: </div><div class="col-sm-6"><input class="form-control" type="text" name="billing_country" value=""></div>
								</div>
								<div class="form-group">
												<div class="col-sm-3"> First Name: </div><div class="col-sm-6"><input  class="form-control" type="text" name="billing_first_name" value=""></div>
								</div>
								<div class="form-group">
												<div class="col-sm-3"> Last Name: </div><div class="col-sm-6"><input  class="form-control" type="text" name="billing_last_name" value=""></div>
								</div>
								<div class="form-group">
												<div class="col-sm-3"> Company Name: </div><div class="col-sm-6"><input  class="form-control" type="text" name="billing_company" value=""></div>
								</div>
								<div class="form-group">
												<div class="col-sm-3"> Address: </div><div class="col-sm-6"><input  class="form-control" type="text" name="billing_address_1" value="<?php echo $address;?>"></div>
								</div>
								<div class="form-group">
												<div class="col-sm-3"> Address2: </div><div class="col-sm-6"><input  class="form-control" type="text" name="billing_address_2" value=""></div>
								</div>
								<div class="form-group">
												<div class="col-sm-3"> Town/city: </div><div class="col-sm-6"><input  class="form-control" type="text" name="billing_city" value=""></div>
								</div>
								<div class="form-group">
												<div class="col-sm-3"> State / County : </div><div class="col-sm-6"><input  class="form-control" type="text" name="billing_state" value=""></div>
								</div>
								<div class="form-group">
												<div class="col-sm-3"> Postcode / Zip * : </div><div class="col-sm-6"><input  class="form-control" type="text" name="billing_postcode" value=""></div>
								</div>
								<div class="form-group">
												<div class="col-sm-3"> Email Address  : </div><div class="col-sm-6"><input  class="form-control" type="text" name="billing_email" value=""></div>
								</div>
								<div class="form-group">
												<div class="col-sm-3"> Phone  : </div><div class="col-sm-6"><input  class="form-control" type="text" name="billing_phone" value=""></div><br>
								</div>
								<div class="form-group">

												<div class="col-sm-3"> Account Number: </div><div class="col-sm-6"><input  class="form-control" type="text" name="firstdata-account-number" value=""></div>
								</div>
								<div class="form-group">
												<div class="col-sm-3">cvv:</div><div class="col-sm-6"><input type="text"  class="form-control" name="firstdata-cvv" value=""></div>
								</div>
								<div class="form-group">
												<div class="col-sm-3">Exp Month: </div><div class="col-sm-6">
										<select class="form-control"  name=" firstdata-exp-month">
											<option value="1">01</option>
											<option value="2">02</option>
											<option value="3">03</option>
											<option value="4">04</option>
											<option value="5">05</option>
											<option value="6">06</option>
											<option value="7">07</option>
											<option value="8">08</option>
											<option value="9">09</option>
											<option value="10">10</option>
											<option value="11">11</option>
											<option value="12">12</option>
										</select>
									</div>
								</div>
								<div class="form-group">
												<div class="col-sm-3">Exp Year:</div><div class="col-sm-6">
										<select class="form-control"  name="firstdata-exp-year">
											<option value="2016">2016</option>
											<option value="2017" selected>2017</option>
											<option value="2018">2018</option>
											<option value="2019">2019</option>
											<option value="2020">2020</option>
											<option value="2021">2021</option>
										</select>
									</div>
								</div>
								<div class="form-group">
												<div class="col-sm-3">total:</div><div class="col-sm-6"><input  class="form-control" type="text" name="get_total" value="<?php echo $grant_total;?>"></div>
								</div>
								<div class="form-group">
												<div class="col-sm-3">shipping:</div><div class="col-sm-6"><input  class="form-control" type="text" name="get_total_shipping" value=""></div>
								</div>
												<?php
											}
                                    echo '
												<input type="submit" class="btn btn-primary" name="order" value="Order Now"> 
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

<?php $this->load->view('frontend/footer'); ?>
