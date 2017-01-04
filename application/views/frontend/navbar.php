<div class="container">
	<div class="header" style="margin-bottom: 20px">
		<div class="row">
			<div class="col-md-8">
				<h1>Beyond Phenom <sup><small>3d Shop - Beta</small></sup></h1>
			</div>
			<div class="col-md-4 text-right">
				<br>
				<h4 class="block">Shopping Cart<small><strong><?php if($this->session->userdata('cart') && $this->session->userdata('cart')!=""){ count($this->session->userdata('cart')).' Items';}else {echo ' Cart is empty';} ?></strong></small></h4>
				<ul>
					<?php if($this->session->userdata('cart') && $this->session->userdata('cart')!=""){
						//echo "<pre>";print_r($this->session->userdata('cart'));echo "</pre>";
						foreach($this->session->userdata('cart') as $val){
							echo '<li>'.$val['product_name'].' &nbsp;&nbsp;>> '.$val['product_qty'].'</li>';
						}
						echo '<li><a href="javascript:void(0)" id="empty_cart" class="pull-right">Clear cart</a></li>';
					}
					?>
				</ul>
			</div>
		</div>
	</div>

	<nav class="navbar navbar-default">
		<div class="container-fluid">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<!-- <a class="navbar-brand" href="#">Project name</a> -->
			</div>
			<div id="navbar" class="navbar-collapse collapse">
				<ul class="nav navbar-nav">
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
				<ul class="nav navbar-nav navbar-right">
					<li class="active"><a href="">Customize <span class="sr-only">(current)</span></a></li>
					<li><a href="">Featured Products</a></li>
				</ul>
			</div><!--/.nav-collapse -->
		</div><!--/.container-fluid -->
	</nav>
</div>