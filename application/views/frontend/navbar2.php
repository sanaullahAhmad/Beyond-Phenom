<header id="header" class="style2 ">
	<div class="container">
		<!-- logo -->
		<h1 id="logo1"><a <?php echo base_url()?>"><img src="http://beyondphenom.com/wp-content/themes/mystile/images/logo(1).png" border="0"></a></h1>
		<!-- HEADER ACTION -->

		<ul class="topnav navLeft" id="hid_my_cart">
			<li class="drop">
				<a id="mycartbtn" href="<?php echo base_url()?>/cart/" title="View your shopping cart">
					MY CART						</a>
				<div class="pPanel">
					<div class="inner">
						<span class="cart_details">
							<?php
							//echo "<pre>";print_r($this->session->userdata('cart'));echo "</pre>";
							$total_price = 0;
							$total_quatity = 0;
							if($this->session->userdata('cart') && $this->session->userdata('cart')!=""){
								foreach($this->session->userdata('cart') as $val){
									$total_price 	= $total_price + $val['price'];
									$total_quatity 	= $total_quatity + $val['product_qty'];
								}
							}
							?>
						<?php echo $total_quatity;?> items, Total of $<?php echo $total_price;?>
							<a href="<?php echo base_url()?>cart" title="View your shopping cart" class="checkout">
								Checkout
								<span class="icon-chevron-right"></span>
							</a>
						</span>
					</div>
				</div>
			</li>
		</ul>

		<ul class="topnav navLeft">
		</ul>
		<ul class="topnav navRight">
			<?php if($this->session->userdata('cart') && $this->session->userdata('cart')!=""){
				//echo "<pre>";print_r($this->session->userdata('cart'));echo "</pre>";
				foreach($this->session->userdata('cart') as $val){
					echo '<li>'.$val['product_name'].' &nbsp;&nbsp;>> '.$val['product_qty'].'</li>';
				}
				echo '<li><a href="javascript:void(0)" id="empty_cart" class="pull-right">Clear cart</a></li>';
			}
			else
			{
				?>
				<li>
					<a class="simplemodal-login" href="#">&nbsp;</a>
				</li>
				<?php
			}
			?>
		</ul>

		<!-- search -->
		<div id="search">
			<a href="" class="searchBtn" style="display: none"><span class="icon-search icon-white"></span></a>
			<div class="search" style="">
				<li class="search">
					<form role="search" method="get" id="searchform" action="http://beyondphenom.com/">
						<label class="screen-reader-text" for="s">Search Products:</label>
						<input type="search" results="5" autosave="http://beyondphenom.com/" class="input-text" placeholder="Search Products" value="" name="s" id="s">
						<input type="submit" class="button" id="searchsubmit" value="Search">
						<input type="hidden" name="post_type" value="product">
					</form>
				</li>
			</div>
		</div>
		<!-- end search -->
		<!-- main menu -->
		<nav id="main_menu" class="smooth_menu">
			<div class="zn_menu_trigger"><a href="">Menu</a></div>
			<ul id="main-nav" class="nav fr">


				<li class="active"><a href="<?php echo base_url('');?>">Home</a></li>
				<!-- <li><a href="#">Shop</a></li> -->
				<li><a href="#">Contact</a></li>
				<li class="dropdown">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Shop<span class="caret"></span></a>
					<ul class="dropdown-menu">
						<!-- <li class="dropdown-header">For Men</li> -->
						<?php
						foreach($this->categories as $category)
						{
							?>
							<li><a style="text-style: capitalize" href="<?=base_url('design/').'/'.$category->categoryId?>"><?php echo str_replace('-',' ',$category->categoryTitle);?></a></li>
							<?php
						}?>
					</ul>
				</li>
				<li class="dropdown">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">My Account <span class="caret"></span></a>
					<ul class="dropdown-menu">
						<?php
						if($this->session->userdata('is_user_logged_id'))
						{
							?>
							<li><a href="<?=base_url('welcome_dashboard')?>">My Account</a></li>
							<li><a href="<?=base_url('logout')?>">Logout</a></li>
							<?php
						}
						else
						{
							?>
							<li><a href="<?=base_url('login')?>">Login</a></li>
							<li><a href="<?=base_url('signup')?>">signup</a></li>
							<?php
						}
						?>
					</ul>
				</li>


			</ul>
		</nav>
		<!-- end main_menu -->
	</div>

</header>