<div class="container dash-unit">
    <h2 style="margin-top:0px">Users Orders  <small>Read</small></h2>
        <table class="table">
			<tr><td>Order Price</td><td>$<?php echo $order_price; ?></td></tr>
			<tr><td>Billing Address</td><td><?php echo $billing_address; ?></td></tr>
			<tr><td>Delivery Address</td><td><?php echo $delivery_address; ?></td></tr>
			<tr><td>Billing Method</td><td><?php echo $billing_method; ?></td></tr>
			<tr><td>Delivery Method</td><td><?php echo $delivery_method; ?></td></tr>
			<tr><td>username</td><td><?php echo $username; ?></td></tr>
			<tr><td>Created Date</td><td><?php echo $created_date; ?></td></tr>
		</table>

	<h2 style="margin-top:0px">Order Details  <small></small></h2>
	<div class="table-responsive">
		<table class="table" style="background-color: #1f1d1d">
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

			}
			?>

		</table>
		<a href="<?php echo site_url('user_orders') ?>" class="btn btn-default">Cancel</a>
	</div>


</div>