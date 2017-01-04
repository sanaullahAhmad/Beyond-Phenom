<div class="container dash-unit">
    <h2 style="margin-top:0px">Order Product <small>Read</small></h2>
        <form action="<?php echo $action; ?>" method="post">
	    <div class="form-group">
            <label for="int">OrderId <?php echo form_error('orderId') ?></label>
            <input type="text" class="form-control" name="orderId" id="orderId" placeholder="OrderId" value="<?php echo $orderId; ?>" />
        </div>
	    <div class="form-group">
            <label for="int">ProductId <?php echo form_error('productId') ?></label>
            <input type="text" class="form-control" name="productId" id="productId" placeholder="ProductId" value="<?php echo $productId; ?>" />
        </div>
	    <div class="form-group">
            <label for="varchar">Name <?php echo form_error('name') ?></label>
            <input type="text" class="form-control" name="name" id="name" placeholder="Name" value="<?php echo $name; ?>" />
        </div>
	    <div class="form-group">
            <label for="varchar">Base Svg <?php echo form_error('base_svg') ?></label>
            <input type="text" class="form-control" name="base_svg" id="base_svg" placeholder="Base Svg" value="<?php echo $base_svg; ?>" />
        </div>
	    <div class="form-group">
            <label for="sizes">Sizes <?php echo form_error('sizes') ?></label>
            <textarea class="form-control" rows="3" name="sizes" id="sizes" placeholder="Sizes"><?php echo $sizes; ?></textarea>
        </div>
	    <div class="form-group">
            <label for="quantities">Quantities <?php echo form_error('quantities') ?></label>
            <textarea class="form-control" rows="3" name="quantities" id="quantities" placeholder="Quantities"><?php echo $quantities; ?></textarea>
        </div>
	    <div class="form-group">
            <label for="decimal">Price <?php echo form_error('price') ?></label>
            <input type="text" class="form-control" name="price" id="price" placeholder="Price" value="<?php echo $price; ?>" />
        </div>
	    <div class="form-group">
            <label for="decimal">Total <?php echo form_error('total') ?></label>
            <input type="text" class="form-control" name="total" id="total" placeholder="Total" value="<?php echo $total; ?>" />
        </div>
	    <div class="form-group">
            <label for="varchar">Middle Svg <?php echo form_error('middle_svg') ?></label>
            <input type="text" class="form-control" name="middle_svg" id="middle_svg" placeholder="Middle Svg" value="<?php echo $middle_svg; ?>" />
        </div>
	    <div class="form-group">
            <label for="varchar">Top Svg <?php echo form_error('top_svg') ?></label>
            <input type="text" class="form-control" name="top_svg" id="top_svg" placeholder="Top Svg" value="<?php echo $top_svg; ?>" />
        </div>
	    <div class="form-group">
            <label for="varchar">Model Obj <?php echo form_error('model_obj') ?></label>
            <input type="text" class="form-control" name="model_obj" id="model_obj" placeholder="Model Obj" value="<?php echo $model_obj; ?>" />
        </div>
	    <div class="form-group">
            <label for="varchar">Model Mtl <?php echo form_error('model_mtl') ?></label>
            <input type="text" class="form-control" name="model_mtl" id="model_mtl" placeholder="Model Mtl" value="<?php echo $model_mtl; ?>" />
        </div>
	    <div class="form-group">
            <label for="varchar">Generate File Name <?php echo form_error('generate_file_name') ?></label>
            <input type="text" class="form-control" name="generate_file_name" id="generate_file_name" placeholder="Generate File Name" value="<?php echo $generate_file_name; ?>" />
        </div>
	    <div class="form-group">
            <label for="varchar">Session User <?php echo form_error('session_user') ?></label>
            <input type="text" class="form-control" name="session_user" id="session_user" placeholder="Session User" value="<?php echo $session_user; ?>" />
        </div>
	    <div class="form-group">
            <label for="varchar">Imgoffsety <?php echo form_error('imgoffsety') ?></label>
            <input type="text" class="form-control" name="imgoffsety" id="imgoffsety" placeholder="Imgoffsety" value="<?php echo $imgoffsety; ?>" />
        </div>
	    <div class="form-group">
            <label for="varchar">Imgoffsetx <?php echo form_error('imgoffsetx') ?></label>
            <input type="text" class="form-control" name="imgoffsetx" id="imgoffsetx" placeholder="Imgoffsetx" value="<?php echo $imgoffsetx; ?>" />
        </div>
	    <div class="form-group">
            <label for="varchar">Imgangle <?php echo form_error('imgangle') ?></label>
            <input type="text" class="form-control" name="imgangle" id="imgangle" placeholder="Imgangle" value="<?php echo $imgangle; ?>" />
        </div>
	    <div class="form-group">
            <label for="varchar">MyRange <?php echo form_error('myRange') ?></label>
            <input type="text" class="form-control" name="myRange" id="myRange" placeholder="MyRange" value="<?php echo $myRange; ?>" />
        </div>
	    <div class="form-group">
            <label for="varchar">Imgrepeat <?php echo form_error('imgrepeat') ?></label>
            <input type="text" class="form-control" name="imgrepeat" id="imgrepeat" placeholder="Imgrepeat" value="<?php echo $imgrepeat; ?>" />
        </div>
	    <div class="form-group">
            <label for="varchar">Patterenused <?php echo form_error('patterenused') ?></label>
            <input type="text" class="form-control" name="patterenused" id="patterenused" placeholder="Patterenused" value="<?php echo $patterenused; ?>" />
        </div>
	    <div class="form-group">
            <label for="decimal">Tax <?php echo form_error('tax') ?></label>
            <input type="text" class="form-control" name="tax" id="tax" placeholder="Tax" value="<?php echo $tax; ?>" />
        </div>
	    <div class="form-group">
            <label for="int">Reward <?php echo form_error('reward') ?></label>
            <input type="text" class="form-control" name="reward" id="reward" placeholder="Reward" value="<?php echo $reward; ?>" />
        </div>
	    <input type="hidden" name="order_product_id" value="<?php echo $order_product_id; ?>" /> 
	    <button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
	    <a href="<?php echo site_url('order_product') ?>" class="btn btn-default">Cancel</a>
	</form>
    </div>