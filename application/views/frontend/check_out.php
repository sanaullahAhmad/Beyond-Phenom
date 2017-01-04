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
							<h3>Thank You. Your order is saved now.</h3>
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
