<!DOCTYPE html>
<html lang="en">
<head>
	<title>Beyondphenom - 3d Shop</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0">
	<link href="https://fonts.googleapis.com/css?family=Lobster|Open+Sans+Condensed:300" rel="stylesheet"> 
	<style>
		body {
			font-family: Monospace;
			background-color: #C1C5C7;
			background: #C1C5C7 url('<?=base_url("assets/3d/images/bg.png")?>')  no-repeat; 
			background-size: 100% 100%;
			color: #fff;
			margin: 0px;
			min-height: 650px;
		}
		/* #tjs{background: #fff;} */
		#info {
			color: #fff;
			position: absolute;
			top: 10px;
			width: 100%;
			text-align: center;
			z-index: 100;
			display:block;
		}
		#info a, .button { color: #f00; font-weight: bold; text-decoration: underline; cursor: pointer; }
		#loading{

			text-align: center;
			width: 100%;
			height: 100%;
			margin: 0 auto;
			position: absolute;
			vertical-align: middle;
			top: 0;
			left: 0;
			background: rgba(255,255,255,0.9);
			z-index: 1000;
			padding-top: 21%;
			font-size: 32px!important;
			font-weight: bold;
			position: absolute;


		}
		.header h1 {font-family: 'Lobster', cursive;}
		.header h1 small{font-family: 'Open Sans Condensed', sans-serif;}

		/*New Header Css Starts here*/



		/* body{min-height: 600px} */
		#fabric{}
	</style>
	<link href="<?php echo base_url('assets/css/bootstrap.css'); ?>" rel="stylesheet">
	<link href="<?php echo base_url('assets/font-awesome/css/font-awesome.min.css'); ?>" rel="stylesheet">
	<link href="<?php echo base_url('assets/css/custom.css'); ?>" rel="stylesheet">
		        
	<script type="text/javascript" src="<?php echo base_url('assets/js/jquery.js'); ?>"></script>
	<script type="text/javascript" src="<?php echo base_url('assets/js/bootstrap.js'); ?>"></script>
	<script>

		jQuery(document).ready(function($) {

			if (typeof(Storage) !== "undefined") 
			{
				// alert('anything?');
				var base = sessionStorage.getItem('base');
				// alert(base);
				if (base != 'undefined') {$('#color_svg_1').val(base);}

				var middle = sessionStorage.getItem('middle');
				if (middle != 'undefined') $('#color_svg_2').val(middle);

				var top = sessionStorage.getItem('top');
				if (top != 'undefined') $('#color_svg_3').val(top);
			}
			else alert('Local Storage Not Found. Please use chrome or firefox for best experience.');

			});
	</script>


