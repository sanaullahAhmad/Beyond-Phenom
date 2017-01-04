<div class="container dash-unit">
        <h2 style="margin-top:0px">Order_product Read</h2>
        <table class="table">
	    <tr><td>OrderId</td><td><?php echo $orderId; ?></td></tr>
	    <tr><td>ProductId</td><td><?php echo $productId; ?></td></tr>
	    <tr><td>Name</td><td><?php echo $name; ?></td></tr>
	    <tr><td>Base Svg</td><td><?php echo $base_svg; ?></td></tr>
	    <tr><td>Sizes</td><td><?php echo $sizes; ?></td></tr>
	    <tr><td>Quantities</td><td><?php echo $quantities; ?></td></tr>
	    <tr><td>Price</td><td><?php echo $price; ?></td></tr>
	    <tr><td>Total</td><td><?php echo $total; ?></td></tr>
	    <tr><td>Middle Svg</td><td><?php echo $middle_svg; ?></td></tr>
	    <tr><td>Top Svg</td><td><?php echo $top_svg; ?></td></tr>
	    <tr><td>Model Obj</td><td><?php echo $model_obj; ?></td></tr>
	    <tr><td>Model Mtl</td><td><?php echo $model_mtl; ?></td></tr>
	    <tr><td>Generate File Name</td><td><?php echo $generate_file_name; ?></td></tr>
	    <tr><td>Session User</td><td><?php echo $session_user; ?></td></tr>
	    <tr><td>Imgoffsety</td><td><?php echo $imgoffsety; ?></td></tr>
	    <tr><td>Imgoffsetx</td><td><?php echo $imgoffsetx; ?></td></tr>
	    <tr><td>Imgangle</td><td><?php echo $imgangle; ?></td></tr>
	    <tr><td>MyRange</td><td><?php echo $myRange; ?></td></tr>
	    <tr><td>Imgrepeat</td><td><?php echo $imgrepeat; ?></td></tr>
	    <tr><td>Patterenused</td><td><?php echo $patterenused; ?></td></tr>
	    <tr><td>Tax</td><td><?php echo $tax; ?></td></tr>
	    <tr><td>Reward</td><td><?php echo $reward; ?></td></tr>
	    <tr><td></td><td><a href="<?php echo site_url('order_product') ?>" class="btn btn-default">Cancel</a></td></tr>
	</table>
        </div>