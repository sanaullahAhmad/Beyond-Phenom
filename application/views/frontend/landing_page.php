<?php $this->load->view('frontend/header'); ?>


<?php
/*$this->session->sess_destroy();
echo '<pre>';
print_r($this->session);
echo '</pre>';
exit;
*/
$original_products = $this->allProd;
//$this->session->sess_destroy();
//exit;
if(!$this->session->userdata('sid'))
{
	$uid = time();
	$this->session->set_userdata('sid', $uid);
	$sid=$this->session->userdata('sid');
}
else
{
	$sid=$this->session->userdata('sid');
}
//create current product id
$data_cat = $this->Product_categories_model->get_by_id($indexx);
$product_from_url = intval($indexx);
//echo $product_from_url;exit;
//get current product
$product = array('product_name'=>$data_cat->categoryTitle,
	'base_svg'=>pathinfo($data_cat->categoryBase, PATHINFO_FILENAME),
	'middle_svg'=>pathinfo($data_cat->categoryMiddle, PATHINFO_FILENAME),
	'top_svg'=>pathinfo($data_cat->categoryTop, PATHINFO_FILENAME),
	'model_obj'=>pathinfo($data_cat->categoryObjFile, PATHINFO_FILENAME),
	'model_mtl' =>pathinfo($data_cat->categoryMTLFile, PATHINFO_FILENAME),
	'generate_file_name'=>$data_cat->categoryModelPatternFile);
//check if the product is in session
if(isset($this->session->userdata('product')[$product_from_url])){
	//echo "success";
//do nothing
}else{
	$file_url = './public/uploads/product_categories/'.$product["product_name"].'/';
	copy($file_url.$product["model_mtl"].'.mtl', './public/uploads/product_categories/'.$product['product_name'].'/session_'.$sid.'.mtl');
	$data = file_get_contents($file_url.'session_'.$sid.'.mtl');
	$data = str_replace($product['generate_file_name'], 'session_'.$sid.'.jpg', $data);
	write_file($file_url.'session_'.$sid.'.mtl', $data);
	copy($file_url.$product['generate_file_name'], './public/uploads/product_categories/'.$product['product_name'].'/session_'.$sid.'.jpg');
	//$current_prod[$product_from_url]=$original_products[$product_from_url];
	$current_prod[$product_from_url]=$product;
// create session products
	push_session_array('product',$current_prod);
}
/*echo '<pre>';
print_r($this->session);
echo '</pre>';*/
$session_product = Array(['product_name'=>$product['product_name'],
	'base_svg'=>$product['base_svg'],
	'middle_svg'=>$product['middle_svg'],
	'top_svg'=>$product['top_svg'],

	'model_obj'=>$product['model_obj'],
	'model_mtl' =>'session_'.$sid,
	'generate_file_name'=>'session_'.$sid.'.jpg']);
$product = $session_product[0];
// print_r($product);
?>
<script>
	var site_url = '<?=site_url()?>';
	var url_slashes = '<?=$url_slashes?>';
	var base_url = '<?=base_url()?>';
	base_svg = "<?=$product['base_svg']?>";
	middle_svg = "<?=$product['middle_svg']?>";
	top_svg = "<?=$product['top_svg']?>";
	model_obj = "<?=$product['model_obj']?>";
	model_mtl = "<?=$product['model_mtl']?>";
	generate_file_name = "<?=$product['generate_file_name']?>";
	productss = "<?=$product['product_name']?>";
</script>
<style type="text/css">
#btn-baseColor{
    background-color: #000000; 
    width: 25px;
    height: 25px;
    border:1px solid #fff;
    color:#000000;
    box-shadow: 2px 2px 2px black;
}
#baseColor{
	padding: 3px;
	max-height: 300px;
	overflow-y: scroll;
}
#baseColor{
	padding: 3px;
}
#btn-baseColor:hover{
    border:1px solid #000;
    /*box-shadow: 2px 2px 2px black;*/
}
.btn-color{
	width: 20px;
    height: 20px;
    border:0px;
    margin: 1px;
    display: inline-block;
    cursor: pointer;
}
.btn-color:hover{
    border:1px solid #000;
    /*box-shadow: 2px 2px 2px black;*/
}

.s25{
	width: 25px;
	height: 25px;
}
</style>
<style type="text/css">
	.bootstrap-colorpalette {

    padding-left:4px;

    padding-right:4px;

    white-space: normal;

    line-height:1;

}



.bootstrap-colorpalette div {

    line-height:0;

}



.bootstrap-colorpalette .btn-color {

    width: 20px;

    height: 20px;

    border: 1px solid #fff;

    margin: 0;

    padding: 0;

}



.bootstrap-colorpalette .btn-color:hover {

    border: 1px solid #000;

}

</style>


<style>
	.more_settings, .more_settings_design, #more_settings{
		background:  #fff;
		display: none;
		position: absolute;
		right: 10px;
		top: 34px;
		box-shadow: 0px 4px 4px gray;
	}
	.more_settings label, .more_settings_design, #more_settings label{
		font-size: 14px;
	}
	.more_settings input, .more_settings_design, #more_settings input{
		font-size: 14px;
	}
</style>

<!-- <link rel="stylesheet" href="bootstrap.min.css" /> -->


</head>

<body>
	<?php $this->load->view('frontend/navbar2');?>
	
	<div class="container">
		<div class="">

					<?php //echo $this->session->__ci_last_regenerate?>

			<div class="row">
				<div class="col-md-9 col-sm-9 tjs_canvas col-xs-12">
					<div id="loading">Loading...</div>
					<canvas id="tjs" style="width: 100%; height:400px;"></canvas>
					<div class="row">
						<div class="col-md-12">
							<div>
								<canvas id="fabric" width="521px" height="521px" style="border:1px solid black; display:none;"></canvas>

							</div>
						</div>
					</div>
				</div>
				<div class="col-md-3 col-sm-3 col-xs-12">
					<div style="padding: 20px; border: 1px solid #ccc; background: rgba(255,255,255,0.5);width: auto; margin-top: 20px; font-size:18px; line-height:40px;" id="mytable">
						<div class="div-baseColor" style="display: inline-block;">
    					  	<!-- <input id="selected-color1"> -->
    					  	<div id="btn-baseColor" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false"></div>
    					  	<ul class="dropdown-menu" style=" top: 65px; left: -65px; width:265px;">
    					  	  	<li>
    					  	  		<div id="baseColorInitial">
									  	<center style="margin-bottom:-11px">
									  	  	<div>
									  	  	  	<div class="btn-color s25" style="background-color:#ED174B;margin: 0px" data-value="#ED174B" title="#ED174B"></div>
									  	  	  	<div class="btn-color s25" style="background-color:#FFFFFF;margin: 0px" data-value="#FFFFFF" title="#FFFFFF"></div>
									  	  	  	<div class="btn-color s25" style="background-color:#000000;margin: 0px" data-value="#000000" title="#000000"></div>
									  	  	  	<div class="btn-color s25" style="background-color:#B3B5B8;margin: 0px" data-value="#B3B5B8" title="#B3B5B8"></div>
									  	  	  	<div class="btn-color s25" style="background-color:#006940;margin: 0px" data-value="#006940" title="#006940"></div>
									  	  	  	<div class="btn-color s25" style="background-color:#00AB54;margin: 0px" data-value="#00AB54" title="#00AB54"></div>
									  	  	  	<div class="btn-color s25" style="background-color:#393996;margin: 0px" data-value="#393996" title="#393996"></div>
									  	  	  	<div class="btn-color s25" style="background-color:#70205E;margin: 0px" data-value="#70205E" title="#70205E"></div>
									  	  	  	<div class="btn-color s25" style="background-color:#F8991D;margin: 0px" data-value="#F8991D" title="#F8991D"></div>
									  	  	</div>
									  	</center>
									  	<center style="margin-bottom:-11px">
									  	  	<div>
									  	  	  	<div class="btn-color s25" style="background-color:#C5AA02;margin: 0px" data-value="#C5AA02" title="#C5AA02"></div>
									  	  	  	<div class="btn-color s25" style="background-color:#FFF200;margin: 0px" data-value="#FFF200" title="#FFF200"></div>
									  	  	  	<div class="btn-color s25" style="background-color:#009ADA;margin: 0px" data-value="#009ADA" title="#009ADA"></div>
									  	  	  	<div class="btn-color s25" style="background-color:#886F00;margin: 0px" data-value="#886F00" title="#886F00"></div>
									  	  	  	<div class="btn-color s25" style="background-color:#900028;margin: 0px" data-value="#900028" title="#900028"></div>
									  	  	  	<div class="btn-color s25" style="background-color:#FED5AA;margin: 0px" data-value="#FED5AA" title="#FED5AA"></div>
									  	  	  	<div class="btn-color s25" style="background-color:#ECD4E6;margin: 0px" data-value="#ECD4E6" title="#ECD4E6"></div>
									  	  	  	<div class="btn-color s25" style="background-color:#DA81B6;margin: 0px" data-value="#DA81B6" title="#DA81B6"></div>
									  	  	  	<div class="btn-color s25" style="background-color:#00A3B4;margin: 0px" data-value="#00A3B4" title="#00A3B4"></div>
									  	  	</div>
									  	</center>
									</div>
								</li>
    					  	</ul>
    					</div>

    					<div style="display: inline-block;">
    					<div id="MoreColors" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-expanded="false">More Colors</div>
    					  	<ul class="dropdown-menu" style=" top: 65px; left: -65px; width:252px;">
    					  	  	<li>
    					  	  		<div id="baseColor">
									</div>
								</li>
    					  	</ul>
    					</div>
    					  	<br>
						Base Color: <input type="color" id="color_svg_1" value="" oninput="changeSVGColor1()" /> 
						<i class="fa fa-spinner fa-pulse fa-1x fa-fw"  id="color_svg_1_loading" style="display: none"></i>
						<button id="0" class="base_settings settings btn btn-primary" onclick="update_current_obj(0)"><i class="fa fa-settings fa-cog"></i></button>
						<br>
						Design Color: <input type="color" id="color_svg_2" value=""  oninput="changeSVGColor2()" />
						<i class="fa fa-spinner fa-pulse fa-1x fa-fw"  id="color_svg_2_loading" style="display: none"></i>
						<button class="design_settings settings btn btn-primary" id="1" onclick="update_current_obj(1)"><i class="fa fa-settings fa-cog"></i></button>
						<br>
						Logo Color: <input type="color" id="color_svg_3" value="" oninput="changeSVGColor3()" />
						<i class="fa fa-spinner fa-pulse fa-1x fa-fw"  id="color_svg_3_loading" style="display: none"></i>
						<br>
						<div class="more_settings row">
							<div class="col-md-12">
								<div class="">
									<strong><span class="title"></span> Pattern Options</strong>
									<button class="settings_close btn btn-danger pull-right" style="margin-top: 8px;" id="settings_close"> <i class="fa fa-times"></i> </button>
								</div>
								<div class="pattern_design_toolbox">
									<div class="row" style="margin-bottom: 10px;">
										<div class="col-md-12">
											<div id="patterns_div">
												<div></div>
												<?php
												if($patterns)
												{
													foreach ($patterns as $pattern)
													{
														?>
														<img class="pattern_click" id="<?php echo "pattern_".$pattern->patternId?>"
															 src="<?php echo base_url();?>public/uploads/patterns/<?php echo $pattern->patternImage; ?>" width="50px" height="50px">&nbsp;
														<?php
													}
												}
												?>

											</div>
										</div>
									</div>
									<span style="display: none" id="patteren_used"><img src="<?php if($patterns){ echo base_url()."public/uploads/patterns/".$patterns{0}->patternImage ; } ?>" width="50px" height="50px" /></span>
									<div class="row">
										<div class="col-md-4">
											<label>
												Width
											</label>
										</div>
										<div class="col-md-8" align="left">
											<input id="myRange" min="50" max="1000" value="200" style="width: 130px" type="range" align="left">
										</div>
									</div>
									<div class="row">
										<div class="col-md-4">
											<label>
												Angle
											</label>
										</div>
										<div class="col-md-8">
											<input id="img-angle" min="50" max="1000" value="200" style="width: 130px" type="range">
										</div>
									</div>
									<div class="row">
										<div class="col-md-4">
											<label>
												Move <small>(Horizontal)</small>
											</label>
										</div>
										<div class="col-md-8">
											<input id="img-offset-x" min="50" max="1000" value="200" style="width: 130px" type="range">
										</div>
									</div>
									<div class="row">
										<div class="col-md-4">
											<label>
												Move <small>(Vertical) </small>
											</label>
										</div>
										<div class="col-md-8">
											<input id="img-offset-y" min="50" max="1000" value="200" style="width: 130px" type="range">
										</div>
									</div>
									<div class="row" style="margin-top: 6px;">
										<div class="col-md-3">
											<label for="test5d">Repeat Patteren</label>
										</div>
										<div class="col-md-9">
											<input id="img-repeat" name="vehicle"  type="checkbox">
										</div>
									</div>
									<div class="row">
										<div class="col-md-12">
											<button type="button" class="btn btn-danger" id="removepattern" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Remove Pattern"><i class="fa fa-trash" aria-hidden="true"></i></button>
											<button type="button" class="btn btn-primary" id="browse-pattern"><i class="fa fa-upload"></i> Upload Pattern</button>
											<input id="hidden-input-pattern" style="display:none;" type="file">
											<button type="button" class="btn btn-primary update_pattern">Apply Changes</button>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="more_settings_design row">
							<div class="col-md-12">
								<div class="">
									<strong><span class="title"></span> Design Pattern Options</strong>
									<button class="settings_close_design btn btn-danger pull-right" style="margin-top: 8px;" id="settings_close_design"> <i class="fa fa-times"></i> </button>
								</div>
								<div class="pattern_design_toolbox">
									<div class="row" style="margin-bottom: 10px;">
										<div class="col-md-12">
											<div id="patterns_div">
												<div></div>
												<?php
												if($patterns)
												{
													foreach ($patterns as $pattern)
													{
														?>
														<img class="pattern_click_design" id="<?php echo "pattern_".$pattern->patternId?>" style="border:2px solid transparent"
															 src="<?php echo base_url();?>public/uploads/patterns/<?php echo $pattern->patternImage; ?>" width="50px" height="50px">&nbsp;
														<?php
													}
												}
												?>

											</div>
										</div>
									</div>
									<span style="display: none" id="patteren_used_design"><?php if($patterns){ echo base_url()."public/uploads/patterns/".$patterns{0}->patternImage ; } ?></span>
									<div class="row">
										<div class="col-md-4">
											<label>
												Width
											</label>
										</div>
										<div class="col-md-8" align="left">
											<input id="myRange_design" min="50" max="1000" value="200" style="width: 130px" type="range" align="left">
										</div>
									</div>
									<div class="row">
										<div class="col-md-4">
											<label>
												Angle
											</label>
										</div>
										<div class="col-md-8">
											<input id="img-angle_design" min="50" max="1000" value="200" style="width: 130px" type="range">
										</div>
									</div>
									<div class="row">
										<div class="col-md-4">
											<label>
												Move <small>(Horizontal)</small>
											</label>
										</div>
										<div class="col-md-8">
											<input id="img-offset-x_design" min="50" max="1000" value="200" style="width: 130px" type="range">
										</div>
									</div>
									<div class="row">
										<div class="col-md-4">
											<label>
												Move <small>(Vertical) </small>
											</label>
										</div>
										<div class="col-md-8">
											<input id="img-offset-y_design" min="50" max="1000" value="200" style="width: 130px" type="range">
										</div>
									</div>
									<div class="row" style="margin-top: 6px;">
										<div class="col-md-3">
											<label for="test5d">Repeat Patteren</label>
										</div>
										<div class="col-md-9">
											<input id="img-repeat_design" name="vehicle"  type="checkbox">
										</div>
									</div>
									<div class="row">
										<div class="col-md-12">
											<input id="hidden-input-pattern" style="display:none;" type="file">
											<button type="button" class="btn btn-danger" id="removepattern" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Remove Pattern"><i class="fa fa-trash" aria-hidden="true"></i></button>
											<button type="button" class="btn btn-primary" id="browse-pattern"><i class="fa fa-upload"></i>Upload Pattern </button>
											<button type="button" class="btn btn-primary update_pattern">Apply Changes</button>
										</div>
									</div>
								</div>
							</div>
						</div>
						
						Sizes:
                        <?php
                        if($product_sizes)
                        {
                            foreach ($product_sizes as $size)
                            {
                                ?>
                                <label style="font-weight: normal; font-size: 16px;" class="product_sizes" data-index="<?php echo $size->sizeId?>">
                                    <?php echo $size->sizeTitle?> <input type="checkbox" name="sizes" class="sizes" value="xs" id="size_checkbox_<?php echo $size->sizeId?>">
                                    <input type="number" class="quntity_xs" id="input_quantity_<?php echo $size->sizeId?>" value="0" min="0" max="20" style="width:45px; font-size: 14px; height: 20px;">
                                </label>
                                <?php
                            }
                        }
                        /* ?>
						<label style="font-weight: normal; font-size: 16px;" class="product_sizes" data-index="1">XS <input type="checkbox" name="sizes" class="sizes" value="xs" id="size_checkbox_1"> <input type="number" class="quntity_xs" id="input_quantity_1" value="0" min="0" max="20" style="width:45px; font-size: 14px; height: 20px;"></label>
						<label style="font-weight: normal; font-size: 16px;" class="product_sizes" data-index="2">SM <input type="checkbox" name="sizes" class="sizes" value="sm" id="size_checkbox_2"> <input type="number" class="quntity_sm" id="input_quantity_2" value="0"  min="0" max="20" style="width:45px; font-size: 14px; height: 20px;"></label>
						<label style="font-weight: normal; font-size: 16px;" class="product_sizes" data-index=3">M <input type="checkbox" name="sizes" class="sizes" value="md" id="size_checkbox_3"> <input type="number" class="quntity_md" id="input_quantity_3" value="0"  min="0" max="20" style="width:45px; font-size: 14px; height: 20px;"></label>
						<label style="font-weight: normal; font-size: 16px;" class="product_sizes" data-index="4">LG <input type="checkbox" name="sizes" class="sizes" value="lg" id="size_checkbox_4"> <input type="number" class="quntity_lg" id="input_quantity_4" value="0"  min="0" max="20" style="width:45px; font-size: 14px; height: 20px;"></label>
						<label style="font-weight: normal; font-size: 16px;" class="product_sizes" data-index="5">XL <input type="checkbox" name="sizes" class="sizes" value="xl" id="size_checkbox_5"> <input type="number" class="quntity_xl" id="input_quantity_5" value="0"  min="0" max="20" style="width:45px; font-size: 14px; height: 20px;"></label>
						<label  style="font-weight: normal; font-size: 16px;" class="product_sizes"data-index="6">XXL <input type="checkbox" name="sizes" class="sizes" value="xxl" id="size_checkbox_6"> <input type="number" class="quntity_xxl" id="input_quantity_6"  min="0" max="20"  value="0" style="width:45px; font-size: 14px; height: 20px;"></label>

						<label  style="font-weight: normal; font-size: 16px;">XXXL <input type="checkbox" name="sizes" class="sizes" value="xxxl" id="xxxl"> <input type="number" class="quntity_xxxl" id="quantity_xxxl" value="0" style="width:45px; font-size: 14px; height: 20px;"></label>
                        <?php */?>
						<br>

						<button class="btn btn-success" id="clear">Clear</button>
						<a href='javascript:void(0);' id="add_to_cart" class="btn btn-primary">Add to Cart</a>
						<a href="<?php echo base_url();?>cart" class="btn btn-primary" id="export_JPEG_image">Check out</a>

						<div style="display: none;" id="jsn"><?=json_encode($this->session->userdata('jsn'))?></div>
					</div>
					<div id="json" style="display: none"></div>
				</div>
			</div>
		</div>
	</div>


	<?php $this->load->view('frontend/footer'); ?>
