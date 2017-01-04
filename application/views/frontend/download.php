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
					<?//=$this->session->__ci_last_regenerate?>
					</pre>
				</div>		
			</div>
		</div> -->
			<div class="row">
				<div class="col-md-12 col-sm-12 tjs_canvas col-xs-12">
					<div class="row">
						<div class="col-md-12">
						<div><h2>Download Files</h2></div>
							<div class="table-responsive">
							<table class="table table-stripped table-bordered" style="background: white">
								<?php
								if($order_infos )
								{
									foreach ($order_infos as $order_info)
									{
										$db_sizes 		= explode(',', $order_info->sizes);
										$db_quantities  = explode(',', $order_info->quantities);
										?>
								<tr>
									<!-- <td><h3>Name</h3></td> -->
									<td><h3>Product: <?php echo $order_info->name;?>
									<small>Total Sizes Ordered: <?=(count($db_sizes)>0)?count($db_sizes)-1: count($db_sizes)?></small></h3></td>
								</tr>
								
								<!-- <tr>
									<td>base_svg</td>
									<td><?php echo base_url('public/uploads/product_categories').'/'.$order_info->name.'/';echo $order_info->base_svg;?>.svg</td>
								</tr>
								<tr>
									<td>middle_svg</td>
									<td><?php echo base_url('public/uploads/product_categories').'/'.$order_info->name.'/'; echo $order_info->middle_svg;?>.svg</td>
								</tr>
								<tr>
									<td>top_svg</td>
									<td><?php echo base_url('public/uploads/product_categories').'/'.$order_info->name.'/'; echo $order_info->top_svg;?>.svg</td>
								</tr>
								<tr>
									<td>model_obj</td>
									<td><?php echo base_url('public/uploads/product_categories').'/'.$order_info->name.'/'; echo $order_info->model_obj;?>.obj</td>
								</tr>
								<tr>
									<td>model_mtl</td>
									<td><?php echo base_url('public/uploads/product_categories').'/'.$order_info->name.'/'; echo $order_info->model_mtl;?>.mtl</td>
								</tr>
								<tr>
									<td>generate_file_name</td>
									<td><?php echo base_url('public/uploads/product_categories').'/'.$order_info->name.'/'; echo $order_info->generate_file_name;?></td>
								</tr> -->
								<!-- 
THIS IS IMPORTANT <tr>
									<td>img-offset-y</td>
									<td><?php echo $order_info->imgoffsety;?></td>
								</tr>
								<tr>
									<td>img-offset-x</td>
									<td><?php echo $order_info->imgoffsetx;?></td>
								</tr>
								<tr>
									<td>img-angle</td>
									<td><?php echo $order_info->imgangle;?></td>
								</tr>
								<tr>
									<td>img-repeat</td>
									<td><?php echo $order_info->imgrepeat;?></td>
								</tr>
								<tr>
									<td>patteren-used</td>
									<td><?php echo $order_info->patterenused;?></td>
								</tr>
								<tr>
									<td>base_color</td>
									<td><?php echo $order_info->base_color;?></td>
								</tr>
								<tr>
									<td>middle_color</td>
									<td><?php echo $order_info->middle_color;?></td>
								</tr>
								<tr>
									<td>top_color</td>
									<td><?php echo $order_info->top_color;?></td>
								</tr> -->
								<tr>
									<!-- <td>Sizes</td> -->
									<td>
										<table>
											<tr>
												<th>
													Size Name
												</th>
												<th>
													Size value
												</th>
												<th>
													Layers
												</th>
												<th>
													Quantity
												</th>
												<th>
													Download Printable Files
												</th>
											</tr>
											<?php
											$this->load->model('Product_sizes_model');
											$this->load->model('Product_size_pattern_layers_model');
											$obj = new Product_sizes_model();
											$layers = new Product_size_pattern_layers_model();

											$quantity_mockup = '';
											$keyindex =0;
											foreach ($db_sizes as $sizeid )
											{
												$size_det = $obj->get_by_id($sizeid);
												$layerss = $layers->get_by_size_id($sizeid);
												/*$p_width ='';
												$p_height ='';
												if(isset($size_det->output_file_width) && isset($size_det->resize_factor>0) && isset($size_det->output_file_height))
												{
													$p_width =intval($size_det->output_file_width)/intval($size_det->resize_factor);
													$p_height =intval($size_det->output_file_height)/intval($size_det->resize_factor);
												}*/
												if($size_det!='')
												{
													
													echo '  <tr>
																<th>
																	'.$size_det->sizeTitle.'
																</th>
																<th>
																	'.$size_det->size.'
																</th><th><table class="layers" id="layers_'.$sizeid.'"><tr>';
														foreach ($layerss as $layer) {
															echo '<td class="vector" id="'.$layer->vectorId.'"><span class="file_url"><img style="border: 1px solid #777" src="'.base_url('public/uploads/product_size_pattern_layers/'.$layer->vectorFileUrl).'" height="	50px" width="	50px" /></span>'.
																'<span class="hidden file_order">'.$layer->vectorOrderNo.'</span><span class="hidden multiplier" id="'.$sizeid.'">'.intval($size_det->resize_factor).'</span></td>';
														}
														echo '</tr></table></th>';
														echo '<th>'.$db_quantities[$keyindex].'</th>';
														echo '<th><a href="" class="btn btn-primary export_vector" id="'.$sizeid.'">Vector File</a> <a href="" class="btn btn-primary export_image" id="'.$sizeid.'">Image Pattern File</a></th>';
														echo '<th><canvas id="fabric_'.$sizeid.'" width="'.intval($size_det->output_file_width)/intval($size_det->resize_factor).'" height="'.intval($size_det->output_file_height)/intval($size_det->resize_factor).'" style="border: 1px solid black; width: '.intval($size_det->output_file_width)/intval($size_det->resize_factor).'px; height: '.intval($size_det->output_file_height)/intval($size_det->resize_factor).'px; -moz-user-select: none;" class="fabric_canvas lower-canvas"></canvas></th></tr>';
												}
												$keyindex++;
											}
											?>
										</table>
									</td>
								</tr>

								<?php
									}
								}
								?>

							</table>

							<div class="row">
								<div class="col-md-12">
									
								</div>
							</div>

								<?php
								if($this->session->userdata('userId'))
								{
									$back_url = base_url().'welcome_dashboard';
								}
								else
								{
									$back_url = base_url().'manufacturer_dashboard';
								}
								echo '<a href="'.$back_url.'" class="btn btn-primary" >Back</a>';
								?>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
<link href="<?php echo base_url('assets/3d/animate.css'); ?>" rel="stylesheet" />
<link href="<?php echo base_url('assets/3d/buttons.css'); ?>" rel="stylesheet" />
<script type="text/javascript" src="<?php echo base_url('assets/js/fabric/fabric.min.js'); ?>"></script>
<script type="text/javascript">


function load_svg_on_canvas(layer, name, color, num, canvas)
{

	console.log(layer+', '+name+', '+color+', '+num);
	// $(document).data('uploaded', false);
	fabric.loadSVGFromURL(layer, function(objects, options) {
			var obj = fabric.util.groupSVGElements(objects, options);
			obj.set({
				top: 0,
				left: 0,
				scaleY: canvas.height / obj.height,
				scaleX: canvas.width / obj.width,
				lockMovementX     : true,
                lockMovementY	  : true,
                lockRotation 	  : true,
                lockScalingX 	  : true,
                lockScalingY 	  : true,
                hasControls       : false
			});
			obj.setFill(color);
			// console.log(obj);
			canvas.add(obj).renderAll();
			canvas.moveTo(obj, num);
			setTimeout(function() {
				console.log(name+" svg loaded");
			}, 100);
			$(document).data('uploaded', true);
			return true;


			// if($(document).data('uploaded')){

			// 	fabric.loadSVGFromURL(url_slashes + 'public/uploads/product_categories/'+productss+'/'+middle_svg+'.svg', function(objects, options) {
			// 		var obj = fabric.util.groupSVGElements(objects, options);
			// 		obj.set({
			// 			top: 0,
			// 			left: 0,
			// 			scaleY: canvas.height / obj.height,
			// 			scaleX: canvas.width / obj.width
			// 		});

			// 		canvas.add(obj).renderAll();
			// 		console.log("Design svg loaded");

			// 		if(top_svg!=null)
			// 		{
			// 			if($(document).data('uploaded')){

			// 				fabric.loadSVGFromURL(url_slashes + 'public/uploads/product_categories/'+productss+'/'+top_svg+'.svg', function(objects, options) {
			// 					var obj = fabric.util.groupSVGElements(objects, options);
			// 					obj.set({
			// 						top: 0,
			// 						left: 0,
			// 						scaleY: canvas.height / obj.height,
			// 						scaleX: canvas.width / obj.width
			// 					});
			// 					canvas.add(obj).renderAll();
			// 					changeSVGColor1();
			// 					console.log("Logo svg loaded");
			// 				});
			// 			}
			// 		}

			// 	});
			// }
			
		});
}

jQuery(document).ready(function($) {
var color = Array();
var canvases = Array();
color[0] = '<?php echo $order_info->base_color;?>';
color[1] = '<?php echo $order_info->middle_color;?>';
color[2] = '<?php echo $order_info->top_color;?>';

	$('.fabric_canvas').each(function(index, canvs) {
		var _id = $(this).attr('id');
		var id = _id.split('_');
		id = id[1];
		// console.log(id);
		var num = 0;
		// $(document).data('uploaded', false);
		var canvas = new fabric.Canvas(_id);
		canvases.push({id, canvas});
		$('#layers_'+id +' .file_url').each(function(index, layer) {
			load_svg_on_canvas($(this).children('img').attr('src'), $('#layers_'+id+' .vector').attr('id'), color[num], num, canvas);
			num++;
			// console.log($(this).html());
		});

		// sortCanvas(canvas);
		// console.log(print_layers);
		// current_obj = null;
	});
	// console.log(canvases);
	
$('.export_vector').on('click', function(event) {
	event.preventDefault();
	_id = $(this).attr('id');
	// var canvas = new fabric.Canvas('fabric_'+_id);
	$.each(canvases, function(index, cnvs) {
		if(cnvs.id == _id)
		{
	 		window.open('data:image/svg+xml;utf8,' + encodeURIComponent(cnvs.canvas.toSVG()));
		}
	});
  
});

$('.export_image').on('click', function(event) {
	event.preventDefault();
	_id = $(this).attr('id');
	// var canvas = new fabric.Canvas('fabric_'+_id);
	$.each(canvases, function(index, cnvs) {
		if(cnvs.id == _id)
		{
			canvas = cnvs.canvas;

	 if (!fabric.Canvas.supports('toDataURL')) {
	      alert('This browser doesn\'t provide means to serialize canvas to an image');
	    }
	    else {
	    	var multiplier = $('.vector .multiplier#'+_id).text();
	    	// console.log(multiplier);
	      window.open(canvas.toDataURL({ format: 'png', multiplier: multiplier/2 }));
	    }
	}
});
	});

});
//////////////////////////////////////////////////
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
