<?php $this->load->view('frontend/header'); ?>
<!-- <link rel="stylesheet" href="bootstrap.min.css" /> -->
</head>
<body style="min-height: 100vh">

<?php $this->load->view('frontend/navbar');?>

<div class="container">

	<div class="row">
		<div class="col-md-12">
			<h4>Orders</h4>
			<!-- <pre>
				<?print_r($orders)?>
			</pre> -->
			<div class="table-responsive">
				<table id="table_id" class="table table-stripped table-hover table-bordered display table" style="background: white;">
					<thead>
						<tr>
							<th>Id</th>
							<th>Ordered Date</th>
							<th>Price</th>
							<th>View Order</th>
							<th>Status</th>
						</tr>
					</thead>
					<tbody>
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
							<td>$<?php echo $order->order_price;?></td>
							<td><a href="<?=site_url('order/'.$order->orderId)?>">Click here to view</a></td>
							<td>
								<div class="form-group">
									<!-- <select class="form-control" name="" id=""> -->
										<?php if($order->orderStatus=='Pending'){?>  Pending  <?php } ?>
										<?php if($order->orderStatus=='Inprocess'){?>  Inprocess  <?php } ?>
										<?php if($order->orderStatus=='Compelete'){?>  Compelete  <?php } ?>
									<!-- </select> -->
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