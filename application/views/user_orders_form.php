<div class="container dash-unit">
    <h2 style="margin-top:0px">Users Orders  <small>form</small></h2>
        <form action="<?php echo $action; ?>" method="post">
	    <div class="form-group">
            <label for="float">Order Price <?php echo form_error('order_price') ?></label>
            <input type="text" class="form-control" name="order_price" id="order_price" placeholder="Order Price" value="<?php echo $order_price; ?>" />
        </div>
	    <div class="form-group">
            <label for="billing_address">Billing Address <?php echo form_error('billing_address') ?></label>
            <textarea class="form-control" rows="3" name="billing_address" id="billing_address" placeholder="Billing Address"><?php echo $billing_address; ?></textarea>
        </div>
	    <div class="form-group">
            <label for="delivery_address">Delivery Address <?php echo form_error('delivery_address') ?></label>
            <textarea class="form-control" rows="3" name="delivery_address" id="delivery_address" placeholder="Delivery Address"><?php echo $delivery_address; ?></textarea>
        </div>
	    <div class="form-group">
            <label for="billing_method">Billing Method <?php echo form_error('billing_method') ?></label>
            <textarea class="form-control" rows="3" name="billing_method" id="billing_method" placeholder="Billing Method"><?php echo $billing_method; ?></textarea>
        </div>
	    <div class="form-group">
            <label for="delivery_method">Delivery Method <?php echo form_error('delivery_method') ?></label>
            <textarea class="form-control" rows="3" name="delivery_method" id="delivery_method" placeholder="Delivery Method"><?php echo $delivery_method; ?></textarea>
        </div>
	    <div class="form-group">
            <label for="int">UserId <?php echo form_error('userId') ?></label>
            <input type="text" class="form-control" name="userId" id="userId" placeholder="UserId" value="<?php echo $userId; ?>" />
        </div>
	    <div class="form-group">
            <label for="datetime">Created Date <?php echo form_error('created_date') ?></label>
            <input type="text" class="form-control" name="created_date" id="created_date" placeholder="Created Date" value="<?php echo $created_date; ?>" />
        </div>
	    <input type="hidden" name="orderId" value="<?php echo $orderId; ?>" /> 
	    <button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
	    <a href="<?php echo site_url('user_orders') ?>" class="btn btn-default">Cancel</a>
	</form>
    </di>