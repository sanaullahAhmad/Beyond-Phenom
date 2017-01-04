<footer id="footer">
	<div class="container">

		<div class="row" style="margin-bottom: 75px;">
			<div class="span12">
				<div class="bottom fixclear">
					<ul class="social-icons  "><li class="title">GET SOCIAL</li><li class="social-facebook">
							<a href="http://www.facebook.com/BeyondPhenom" target="_blank">facebook</a></li>
						<li class="social-twitter"><a href="http://twitter.com/BeyondPhenom" target="_blank">twitter</a></li>
						<li class="social-linkedin"><a href="https://www.linkedin.com/company/beyond-phenom" target="_blank">LinkedIn</a></li><li class="social-instagram"><a href="http://www.instagram.com/thebestgobeyond" target="_blank">instagram</a></li></ul>

					<div class="copyright">		<a href="<?php echo base_url()?>"><img src="http://beyondphenom.com/wp-content/themes/mystile/images/logo2.png" alt=""></a><p>© 2015 BEYOND PHENOM. All Rights Reserved.<br>
							Designed by <a href="http://www.seocorporation.net">SEOCORPORATION Pvt. Ltd.</a></p>

					</div><!-- end copyright -->

				</div><!-- end bottom -->
			</div>
		</div><!-- end row -->

	</div>
</footer>

<link href="<?php echo base_url('assets/3d/animate.css'); ?>" rel="stylesheet" />
<link href="<?php echo base_url('assets/3d/buttons.css'); ?>" rel="stylesheet" />
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
	$(document).ready(function(){
		$('#add_to_cart').on('click', function(event){
			var prodID='<?php echo $indexx; ?>';

			var checked = $('#mytable').find(':checked').length;

			if (!checked)
			{
				bootbox.alert('Please select product size to continue!');
				return false;
			}
			else{
				//alert(checked + ' checkboxes are checked!');
			}
			var imgoffsety	=	$('#img-offset-y').val();
			var imgoffsetx	=	$('#img-offset-x').val();
			var imgangle	=	$('#img-angle').val();
			var myRange		=	$('#myRange').val();
			var imgrepeat	=	$('#img-repeat').is(':checked');//true, false
			var patterenused=	$('#patteren_used').html();

			var imgoffsety_design	=	$('#img-offset-y_design').val();
			var imgoffsetx_design	=	$('#img-offset-x_design').val();
			var imgangle_design		=	$('#img-angle_design').val();
			var myRange_design		=	$('#myRange_design').val();
			var imgrepeat_design	=	$('#img-repeat_design').is(':checked');//true, false
			var patterenused_design	=	$('#patteren_used_design').html();


			var base_color =$('#color_svg_1').val();
			var middle_color=$('#color_svg_2').val();
			var top_color =$('#color_svg_3').val();

			//alert ('base_color= '+base_color+' middle_color= '+middle_color+' top_color= '+top_color);

			var size_qty = new Array();

			$('label[class="product_sizes"]').each(function(index,item){
				index = parseInt($(item).data('index'));
				var checking = $('#size_checkbox_' + index).is(':checked');
				if(checking){
					//alert(index);

					keyValuePair = {};
					keyValuePair[index]= $('#input_quantity_' + index).val(); // set your dynamic values
					size_qty.push(keyValuePair);

				}
			});
			//console.log(size_qty);

			$.ajax({
				url:'<?php echo base_url(); ?>design/cart',
				type : 'POST',
				data: {
					"cart":prodID,
					imgoffsety	:imgoffsety,
					imgoffsetx	:imgoffsetx,
					imgangle	:imgangle,
					myRange		:myRange,
					imgrepeat	:imgrepeat,
					patterenused:patterenused,

					imgoffsety_design	:imgoffsety_design,
					imgoffsetx_design	:imgoffsetx_design,
					imgangle_design		:imgangle_design,
					myRange_design		:myRange_design,
					imgrepeat_design	:imgrepeat_design,
					patterenused_design:patterenused_design,

					size_qty	:size_qty,
					base_color	:base_color,
					middle_color:middle_color,
					top_color	:top_color,
					generate_file_name	:generate_file_name,

				},
				success:function(result){
					window.location.href = "<?php echo base_url(); ?>design/<?php echo $indexx; ?>";
				},
				error: function () {
					alert('Some error!');
				}
			});
		});
		$('#empty_cart').on('click', function(event){
			//var prodID='<?php echo $indexx; ?>';
			var prodID='all';
			$.ajax({
				url:'<?php echo base_url(); ?>design/emptycart',
				type : 'POST',
				data: {"emptycart":prodID},
				success:function(result){
					window.location.href = "<?php echo base_url(); ?>design/<?php echo $indexx; ?>";
				},
				error: function () {
					alert('Some error!');
				}
			});
		});
	});
	$('#mytable label input[type=checkbox]').on('change', function(event) {
		event.preventDefault();
		_id = $(this).attr('id');
		_res = _id.split('_');
		_id = _res[2];
		if($(this).length>0)
		{
			if($('#input_quantity_'+_id).val()<1)
				$('#input_quantity_'+_id).val(1);
		}

		if ( $(this).prop('checked')!=true )
			$('#input_quantity_'+_id).val(0);
	});
	$('#mytable label input[type=number]').on('change', function(event) {
		event.preventDefault();
		_val = $(this).val();
		_id = $(this).attr('id');
		_res = _id.split('_');
		// console.log(_res);

		if(_val<1)
		{
			$('#mytable label #size_checkbox_'+_res[2]).attr('checked', false);
		}
		else{
			$('#mytable label #size_checkbox_'+_res[2]).attr('checked', true);
		}

	});
</script>
<script type="text/javascript">
	//************************************************************************************
	var optionsMore = [
		['#FFFFFF','#FFF200','#FFC810','#F79239','#F15C30','#EE3B33','#ED037C','#E0078C','#9D3C96','#353E99'],
		['#094FA3','#0053A0','#009ADA','#00A886','#000000','#FFF200','#EC008C','#00AEEF','#000000','#FFF200'],
		['#F26227','#EC008C','#00AEEF','#00AB54','#000000','#FFF797','#FFF452','#FFF200','#FFF200','#DCCC00'],
		['#C0B400','#948B00','#FFF466','#FFF452','#FFF200','#FFE01A','#F2D11A','#C5AA02','#AD9500','#FFE96D'],
		['#FFE965','#FFE152','#FFD51D','#DEB406','#C4A006','#927F00','#FFEA8A','#FFE36C','#FFD046','#FDB827'],
		['#F0B510','#C39809','#B48D05','#FFFBC8','#FFECA3','#FFD87D','#FDBF57','#D5A10E','#B38807','#916D00'],
		['#FFEB93','#FFE375','#FFD65A','#FEBE10','#E9AF10','#BC9307','#886F00','#FFE5A1','#FFD27C','#FDBF50'],
		['#FCB131','#C88912','#C88912','#FFE198','#FFE198','#FFD283','#FDB950','#FAAB53','#E48E1A','#A86D0A'],
		['#754E00','#FFE198','#FEC658','#FDB945','#F8991D','#E48E1A','#B1790B','#6E5200','#FFE2A8','#FED38C'],
		['#FCBA65','#F9A13A','#F7921E','#D28815','#B0730D','#FEC980','#FCBA65','#FAAB53','#F79239','#DC6D1D'],
		['#A7630C','#4E2700','#FFE7BF','#FED49A','#FAAB53','#F5822B','#E06F1D','#AD5C0F','#6B3C00','#FED5AA'],
		['#FBB482','#F9A259','#F68938','#E87C1E','#B66611','#9C5708','#FEE4CD','#FCBC8B','#F89A51','#F58220'],
		['#F47920','#CE6E19','#7C4300','#FBBD9A','#FAAD85','#F89C6C','#F47937','#F37121','#B55413','#9B4709'],
		['#FCD6C6','#FAAD85','#F7945C','#F4793E','#E66C1F','#A44C0E','#723908','#FBCDC6','#F79C85','#F4846B'],
		['#F15C30','#F15C2B','#D95936','#933F22','#F7A5A6','#F59695','#F3726C','#EF492F','#EE3124','#BF2E1A'],
		['#8A1B04','#FAC5C9','#F48583','#F2635D','#EE3B33','#E12F29','#B12A1C','#5D1F04','#F9C6CC','#F5969F'],
		['#F16C74','#EE3A43','#E2383F','#BF2C37','#92342F','#F8B0BD','#F48C9A','#F16378','#EE2E4E','#D73347'],
		['#A9233E','#82302F','#F9C0CF','#F6A7C0','#F16D96','#EE2C5D','#E0144C','#C70C47','#B2324E','#F9C6D2'],
		['#F69FB4','#F05D7A','#ED174B','#CD1041','#A80532','#900028','#F8B9D4','#F287B7','#F0649D','#ED1262'],
		['#C70752','#A21F4B','#8B2842','#F6A7C0','#F38EB2','#F06DA2','#ED0C6E','#DA0862','#B71955','#922C46'],
		['#F8C1D9','#F27CB1','#EE4699','#ED037C','#C80067','#A90056','#7A003C','#F498C0','#F174AD','#EF519E'],
		['#EC008C','#BE0071','#99135E','#72103D','#F8B9D4','#F27CB1','#EF5DA2','#E0078C','#D60D8C','#A80069'],
		['#92005A','#E8ADCE','#E57AB1','#DC61A5','#CA2D92','#B92F93','#AB2888','#810E55','#F8C1D9','#DA81B6'],
		['#CA4F9D','#AD3293','#9D3494','#8F3594','#892388','#EABCD8','#E1ABCE','#D17FB5','#B43B96','#A63293'],
		['#8A2981','#70205E','#ECD4E6','#D39DC7','#C183B9','#9D3C96','#963C97','#8F3594','#67226D','#E2C8E0'],
		['#D3A7CD','#9B5BA4','#6A207F','#5E0F68','#590258','#4F0845','#C0A9D1','#A986BD','#926CAF','#703895'],
		['#6B2C91','#572786','#522575','#B196C6','#926CAF','#7E459A','#5E2E91','#5A2A8A','#552684','#4B186E'],
		['#A091C6','#7E71B3','#6352A3','#4E2F91','#472987','#432580','#451F77','#DED5E9','#B7AED6','#7C77B7'],
		['#393996','#393996','#342A7B','#2B135E','#AFB1D9','#9396CB','#7A7EBC','#5255A5','#353E99','#263997'],
		['#161E69','#AEB7DD','#929DCF','#7082C0','#243690','#1B2777','#161E69','#251C5C','#929DCF','#7082C0'],
		['#4D5FAB','#263997','#263997','#223289','#18226E','#CCD6ED','#899BCF','#356AB3','#2C4A9F','#1C449C'],
		['#183C8E','#102B72','#B5CEEC','#9BB2DC','#0073BB','#094FA3','#084897','#053B80','#00205A','#A2CCED'],
		['#4A82C3','#005BAB','#094FA3','#02458D','#013474','#011B58','#B4D2EE','#99BFE5','#4B90CD','#0053A0'],
		['#004990','#003876','#00275D','#A1D2F1','#68AEE0','#007CC3','#0061AA','#00529C','#004785','#003263'],
		['#B4D8F3','#7FBFE9','#2F99D4','#006BB7','#005A9C','#004B85','#002D57','#88CBF0','#36B6E9','#0096D7'],
		['#0075BF','#0070AF','#00578E','#00345B','#69CEF6','#00AFE7','#009DDC','#007AC3','#0068A6','#005983'],
		['#004361','#9FDDF9','#0CBFF2','#00A2E5','#0083C6','#007CB7','#00688F','#00536D','#ACE0EE','#59CAEA'],
		['#00BBE7','#009ADA','#0079AA','#00688F','#004E5F','#88D4E5','#35C2DE','#00ACD4','#0094C3','#007EA3'],
		['#006C86','#004D56','#89D4E1','#39C2D2','#00B5C8','#00A4CA','#0093B2','#008393','#00717C','#CEEBE9'],
		['#99D7DB','#74CCD4','#00A3B4','#008C9A','#008285','#006B6E','#B7E2E4','#58C5C4','#00ADA8','#00958E'],
		['#00817B','#006A65','#005954','#9AD7D5','#77CBC4','#14BBB0','#00A9A2','#009D96','#006F66','#004D41'],
		['#A5DBD6','#84CEBF','#2CBDA8','#00AE9C','#00A994','#00907F','#006553','#8DD2CC','#5CC4B8','#00B09C'],
		['#00A88E','#00907F','#007662','#00483A','#CFEADD','#C3E5D7','#9DD6C5','#00A886','#009C7C','#008066'],
		['#006A53','#B0DFD6','#78CBBF','#00AD8E','#009470','#008061','#006F53','#005941','#A7DACD','#8FD2BF'],
		['#6DC6A9','#0AB285','#009366','#007550','#005838','#BAE0CD','#9FD5B8','#63C29B','#009B67','#008457'],
		['#006940','#00461B','#D7ECDD','#C4E4CE','#9FD5B8','#00AB67','#009E58','#008349','#046330','#BDDEB1'],
		['#A3D39A','#6CC069','#30B457','#2EA443','#26923C','#1E772D','#E4EFC1','#D5E6A0','#B8DA89','#60BB46'],
		['#58AD40','#549534','#496915','#E9F0BA','#DDE8A0','#CAE088','#9ACD66','#7CC242','#7DA52E','#566C11'],
		['#ECED86','#E9EA6B','#DAE23C','#BDD73E','#B8BE19','#A6AA12','#8A831A','#F2F08E','#E9E961','#E9E959'],
		['#D9E252','#D0D61B','#B3B20F','#948F03','#F2F198','#F3EE5F','#EEEB4C','#EAE827','#D3D112','#C5BD08'],
		['#A49A00','#EEE4E0','#E0D3CE','#C5BAB1','#A6988D','#696053','#4B5142','#42513D','#D7DFDB','#BFC7C3'],
		['#A4AFAF','#8B9596','#5D6967','#4F5650','#000000','#D6CCC3','#C2BAB2','#B3A49F','#99877D','#887468'],
		['#59432F','#000000','#D6D6CE','#BDBCB2','#A2A297','#929284','#6F6E5C','#5A5944','#000000','#DCDDDE'],
		['#C3C4C6','#B3B5B8','#999B9E','#77787B','#5A5B5D','#000000','#E5E6E6','#CBCCCE','#A8B1B7','#8F989D'],
		['#68737A','#41525C','#131D22','#EEE4E0','#E0D3CE','#C5BAB1','#A6988D','#696053','#4B5142','#42513D'],
		['#D7DFDB','#BFC7C3','#A4AFAF','#8B9596','#5D6967','#4F5650','#424A3E','#F1F1F2','#E4DAD5','#D5CCC9'],
		['#C2BAB7','#B3ACAB','#BCAFA7','#ACA49C','#A1968C','#99877D','#887766','#816F59','#F1F1F2','#E5E6E6'],
		['#D5D6D8','#C3C4C6','#B3B5B8','#ABADB0','#999B9E','#88898C','#77787B','#696A6C','#5A5B5D','#49593F'],
		['#5B5F3E','#606444','#AFAB89','#C7C2A3','#D8D6C4','#E6E7D8','#685000','#9A7E17','#AD923C','#CDB97D'],
		['#D8C894','#E7E2B5','#F2EFD4','#766100','#A28400','#BD9B04','#E6D568','#F1E694','#F0E7AD','#F0E8B5'],
		['#5C5B3D','#82683B','#9A6B38','#D3AF7E','#E3C197','#E8D3AC','#EFE3C6','#4E2200','#965D0F','#BA8645'],
		['#D4AB81','#E4C1A1','#F0D9C4','#F1E4CF','#7D4808','#AE6219','#CF7518','#FBB482','#FCCB9F','#FEDCC0'],
		['#FEE4CD','#641C00','#944E2E','#B17C65','#C0937E','#DAB2A2','#E3C2B4','#F0DAD0','#604C3B','#6E473A'],
		['#744739','#B89484','#D8B9A9','#E6CFC6','#EEE0DA','#7B2D19','#B23427','#ED1B2E','#F79C85','#F9B6A8'],
		['#FAC5BD','#FCDDD6','#6B2F1D','#8B3B32','#A44138','#E88E97','#F8B8C1','#FACDD1','#FCDEE0','#5E331A'],
		['#8E543E','#95533D','#DF9FA2','#FAC5C9','#FBD8DC','#FDE6E4','#571B04','#944F43','#AF7065','#C78D86'],
		['#E1B3B0','#E7C7C7','#EFDBDA','#623D39','#744143','#84414A','#D58F9E','#EAACBD','#F9C0C9','#FACED6'],
		['#593353','#823E7C','#95459A','#D28FBF','#E1ABCE','#F9C7DD','#FBD9E7','#52344D','#644764','#8E6B8B'],
		['#B495B6','#CEB3C7','#DEC5D5','#E4D6DF','#503C56','#653A71','#723983','#B98ABE','#CCA5CD','#E2C8E0'],
		['#ECDAEA','#363639','#413E44','#746774','#9B8F9B','#B5A4AD','#DFCED5','#E5DEE3','#42345F','#5D398A'],
		['#5C3896','#987BB8','#B897C7','#CCB4D6','#DECFE6','#13013A','#2A2F64','#3A4D80','#6B7AA3','#9EA7C9'],
		['#BCBFD7','#E2E1EA','#274B53','#195072','#2E598A','#93A3CA','#B0BFD9','#C1CADD','#D5DCE5','#002A55'],
		['#004677','#00548E','#1590C8','#61ABD8','#97C9EC','#ACD6F2','#022E4F','#095D7E','#3E7998','#6D98AC'],
		['#9DB7C4','#BCCED7','#DBE5EA','#002F4B','#003556','#00476C','#3097B9','#6AADC9','#95C4DB','#C3DCE9'],
		['#003E4A','#00646A','#2A8C94','#70ABB2','#94BEC2','#C4DFE5','#D5E6E5','#001719','#145351','#517676'],
		['#8CA1A2','#A7B5B6','#C2CECD','#D7DFDB','#134C3D','#005542','#006351','#6FA497','#A1C5BC','#BFD8CC'],
		['#D6E5DE','#004026','#32735B','#619081','#89ACA1','#B0C6BD','#CCDAD0','#DDE3D9','#84933','#0C796A'],
		['#008B7A','#88C8BC','#A5DBD6','#CFEAE5','#E1F1EA','#002519','#2F5A43','#668172','#8DA096','#AEBAAD'],
		['#CAD1C8','#D7DFDB','#0F5A4A','#007C66','#00937F','#84CEBF','#B0DFD6','#C2E5DD','#E1F1EA','#485E29'],
		['#48742A','#4E8636','#B5CB8B','#CADBA1','#D3E7B9','#E4F0CF','#2F431B','#576728','#727B33','#9FA374'],
		['#BABD9C','#CCCFB0','#DEDBCA','#374B01','#6E7E29','#959D56','#B4B87D','#DADCB0','#DDE1C0','#EBE8D6'],
		['#706A09','#939408','#ABBD26','#DDDD56','#E8EA7C','#EBEE98','#F2F2A8','#5B5504','#837C17','#AFA754'],
		['#C0B879','#D8D3A5','#DFDAB6','#EBE8C9','#FFFDE7','#FFFAC2','#FFF797','#FFF56E','#FFF336','#F4E500'],
		['#EEDF00','#FFFDE7','#FFFAC2','#F3EA90','#EEE168','#EBDB18','#DCCC00','#C0B400','#F2EFD4','#F2EDBE'],
		['#ECE5AC','#DAD189','#B8AC1E','#9C9300','#897C00','#D7EDE5','#BAE0CD','#9ACABE','#72AF98','#4C8F76'],
		['#00523D','#003228','#D6EEF0','#ADDFE7','#89D4E1','#59C0D5','#00AAC3','#008CA8','#006C8C','#CEEBF0'],
		['#A2DCE7','#7DD1E1','#0CBEE1','#00B6DC','#00A5DA','#0088BB','#C2E0EF','#AAD8EE','#89B7D7','#549EC5'],
		['#2988B5','#005488','#004275','#CCE0F4','#ADCCEB','#87AED6','#5288BE','#005699','#003B78','#002A5F'],
		['#CCE0F4','#B5CEEC','#84ACDB','#4F8BC9','#1568B3','#0053A0','#084694','#DFE1F1','#D4D9EE','#BFC5E4'],
		['#9EA1CB','#6E78AF','#4B4C85','#312B65','#FCE7F0','#FBD9E7','#F8B9D4','#E79CC4','#DE78B1','#CA3895'],
		['#BE037A','#FCE7F0','#ECD4E6','#EAC2DC','#DBA0C8','#C17CB5','#B0589C','#8C135E','#EFDBE4','#EBBDD2'],
		['#EBB7CE','#DC90B3','#C2779F','#923C75','#660941','#FCDEE0','#FACED6','#EBB7C0','#E399A1','#992837'],
		['#8B292E','#FCDEE0','#FACDD1','#F8B8C1','#F48DA1','#DE6A78','#CA4445','#B83536','#FDE6E4','#FDE6E4'],
		['#FCDEE0','#F9BFC5','#F69EAA','#F2727D','#EE3A47','#E2383F','#FFEFD3','#FFE3B7','#FED49A','#FDC177'],
		['#FAAB4D','#EA8B1C','#E9831D','#FFE8C6','#FFE3BD','#FED393','#DA9B3C','#D29022','#9D5D07','#844D01'],
		['#F1E4CA','#F1D0AC','#E5BF8C','#D4A46B','#BA853E','#7D4800','#5E3200','#FCD20F','#F9A020','#F68626'],
		['#ED2729','#ED202A','#EB1C29','#EB1C29','#EB1C29','#E71D2A','#E31E56','#DC1868','#B51E84','#593293'],
		['#2E3191','#303392','#007CC4','#008FD5','#00AFE5','#0094B4','#00804C','#00A55F','#00A753','#00AB50'],
		['#2BB34B','#A9CD3A','#CA462E','#945135','#131D1F','#000000','#000000','#000000','#000000','#000000'],
		['#484741','#141F1F','#171F22','#151F1E','#1B1C1F','#101B1D','#3D403E','#00B1DC','#76C046','#FCDF37'],
		['#F4792F','#EF4841','#EA2C67','#D92288','#009FDB','#39B54C','#FFC519','#F15C28','#EE312D','#EB225B'],
		['#D0168A','#02B19A','#EDE428','#FCB429','#F0552E','#EE2D59','#DE2A7B','#506DB4','#00A97A','#EADB23'],
		['#FAA328','#EF3F28','#ED2540','#E01979','#485AA8','#9C814E','#9F7E50','#A58155','#A57950','#A77650'],
		['#AE7656','#9BA0A1','#000000','#000000','#000000','#000000','#000000','#000000','#000000','#000000'],
		['#000000','#EAEB70','#E5E75A','#F5EF62','#EDEB58','#CFDD27','#C4D82D','#D9E01F','#D9E252','#FED49A'],
		['#FDCA96','#FBCE97','#F9CD9A','#F9CD96','#F5C195','#F2C793','#EBC28F'],
	];
	$(document).delegate('#MoreColors','click',function(){
		$('#baseColor').removeAttr('style');
		$('#baseColor').show();
		$('#baseColor').empty();
		var aHTML = [];
		$.each(optionsMore, function(i, aColor){
			aHTML.push('<center style="margin-bottom:-18px"><div>');
			$.each(aColor, function(i, sColor) {
				var sButton = ['<div class="btn-color" style="background-color:', sColor,
					'" data-value="', sColor,
					'" title="', sColor,
					'"></div>'].join('');
				aHTML.push(sButton);
			});
			aHTML.push('</div></center>');
		});
		$('#baseColor').html(aHTML.join(''));

	})
	$(document).delegate('.btn-color','click',function(){
		$('#btn-baseColor').css('background-color',$(this).attr('data-value'));
	});
	$(document).delegate('#BasicColors','click',function(e){
		e.preventDefault();
		$('#baseColor').hide();

	})
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