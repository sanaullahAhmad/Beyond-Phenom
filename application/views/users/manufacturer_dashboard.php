<?php $this->load->view('frontend/header'); ?>
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.12/css/jquery.dataTables.min.css">
</head>
<body>
	<?php $this->load->view('frontend/navbar'); ?>
	<!-- <link rel="stylesheet" href="bootstrap.min.css" /> -->

	<div class="">
		
		<div class="container" style="min-height: 100vh;">
			<h4>Welcome Manufacture <em><a href="<?=site_url('logout')?>">Logout</a></em></h4>
			<hr>
		<!--<div class="col-md-12 ">
			<button class="btn pull-right"> Print</button>
			<button class="btn pull-right"> Download</button>
		</div>-->
		<br>
		<br>
		<div class="col-md-12">
			<table id="table_id" class="display">
				<thead>
					<tr>
						<th>Id</th>
						<th>Ordered Date</th>
						<th>View Order</th>
						<th>Download</th>
						<th>Status</th>
					</tr>
				</thead>
				<tbody>
					<?php /* for ($i=0; $i < 7; $i++) {
						# code...
					?>
					<tr>
						<td>
							Order <?=$i?>
						</td>
						<td>Row 2 Data 1</td>
						<td>Image <?=$i?></td>
						<td><a href="">Download File(s)</a></td>
						<td>
							<div class="form-group">
								<select class="form-control" name="" id="">
									<option value="pending">Pending</option>
									<option value="inprocess">Inprocess</option>
									<option value="compelete">Compelete</option>
								</select>
							</div>
						</td>
					</tr>
					<?php }	*/?>
					
					<?php
						$numm =1;
						foreach ($orders as $order)
						{
						?>
						<tr>
							<td>
								Order # <?=$order->orderId?>
							</td>
							<td><?=date( 'm/d/y g:i A', strtotime( $order->created_date ))?></td>
							<td><a href="<?=site_url('order/'.$order->orderId)?>">Click here to view</a></td>
							<td><a href="<?=site_url('download/'.$order->orderId)?>">Download Files</a></td>
							<td>
								<div class="form-group">
									<select class="form-control" name="" id="" onchange="change_status(this.value, '<?php echo $order->orderId;?>')">
										<option value="Pending" <?php if($order->orderStatus=='Pending'){?>  selected  <?php } ?> >Pending</option>
										<option value="Inprocess" <?php if($order->orderStatus=='Inprocess'){?>  selected  <?php } ?> >Inprocess</option>
										<option value="Compelete" <?php if($order->orderStatus=='Compelete'){?>  selected  <?php } ?> >Compelete</option>
										<option value="Sent" <?php if($order->orderStatus=='Sent'){?>  selected  <?php } ?> >Dispatched</option>
									</select>
								</div>
							</td>
						</tr>
						<?php
							$numm ++;
						}
						?>
				</tbody>
			</table>
		</div>
	</div>
</div>
</body>	
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
<!-- Datatable -->
<script type="text/javascript" src="https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>
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
	function change_status(status, order_id) {
		$.ajax({
			url: '<?php echo base_url();?>login/change_status',
			type: 'POST',
			/*dataType: "json",*/
			data: {
				status:status,
				order_id: order_id
			},
			async: false,
			success: function(res)
			{
			},
			error: function(res){
			},
			beforeSend: function(){
			}
		});
	}
	$(document).ready(function(){
		$('#table_id').DataTable();
	});
</script>

</html>