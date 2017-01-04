<div class="container dash-unit">
    <h2 style="margin-top:0px">Users Orders  <small>List All</small></h2>
        <div class="row" style="margin-bottom: 10px">
            <div class="col-md-4">
            </div>
            <div class="col-md-4 text-center">
                <div style="margin-top: 4px"  id="message">
                    <?php echo $this->session->userdata('message') <> '' ? $this->session->userdata('message') : ''; ?>
                </div>
            </div>
            <div class="col-md-4 text-right">
                <?php echo anchor(site_url('user_orders/create'), 'Create', 'class="btn btn-primary"'); ?>
		<?php echo anchor(site_url('user_orders/excel'), 'Excel', 'class="btn btn-primary"'); ?>
		<?php echo anchor(site_url('user_orders/word'), 'Word', 'class="btn btn-primary"'); ?>
	    </div>
        </div>
        <table class="table table-bordered table-striped" id="mytable">
            <thead>
                <tr>
		    <th>Order Price</th>
		    <th>Billing Address</th>
		    <th>Delivery Address</th>
		    <th>Status</th>
		    <th>Delivery Method</th>
		    <th>User</th>
		    <th>Created Date</th>
		    <th>Action</th>
                </tr>
            </thead>
	    <tbody>
            <?php
            $start = 0;
            foreach ($user_orders_data as $user_orders)
            {
                ?>
                <tr>
		    <td>$<?php echo $user_orders->order_price ?></td>
		    <td><?php echo $user_orders->billing_address ?></td>
		    <td><?php echo $user_orders->delivery_address ?></td>
		    <td><?php echo $user_orders->orderStatus ?></td>
		    <td><?php echo $user_orders->delivery_method ?></td>
		    <td><?php echo $user_orders->username ?></td>
		    <td><?php echo $user_orders->created_date ?></td>
		    <td style="text-align:center" width="200px">
			<?php 
			echo anchor(site_url('user_orders/read/'.$user_orders->orderId),'Read'); 
			echo ' | '; 
			echo anchor(site_url('user_orders/update/'.$user_orders->orderId),'Update'); 
			echo ' | '; 
			echo anchor(site_url('user_orders/delete/'.$user_orders->orderId),'Delete','onclick="javasciprt: return confirm(\'Are You Sure ?\')"');
            echo ' | ';
            if(!$user_orders->manufacturer_permission)
            {
                echo '<span id="manufacturer_select_'.$user_orders->orderId.'">';
                $action = 'onclick="load_manufacturers('.$user_orders->orderId.')"';
                echo '<button '.$action.' class="btn btn-primary">Send Manufacturer</button>';
                echo '</span>';
            }

            ?>

		    </td>
	        </tr>
                <?php
            }
            ?>
            </tbody>
        </table>
        <script src="<?php echo base_url('assets/js/jquery-1.11.2.min.js') ?>"></script>
        <script src="<?php echo base_url('assets/datatables/jquery.dataTables.js') ?>"></script>
        <script src="<?php echo base_url('assets/datatables/dataTables.bootstrap.js') ?>"></script>
        <script type="text/javascript">
            $(document).ready(function () {
                $("#mytable").dataTable();
            });
            function load_manufacturers(orderId) {
                $.ajax({
                    url: '<?php echo base_url();?>user_orders/load_manufacturers',
                    type: 'POST',
                    /*dataType: "json",*/
                    data: {
                        userType:1,
                        orderId:orderId
                    },
                    async: false,
                    success: function(res)
                    {
                        $('#manufacturer_select_'+orderId).html(res);
                    },
                    error: function(res){
                    },
                    beforeSend: function(){
                    }
                });
            }
            function select_manuf (manufacturerId, orderId) {
                $.ajax({
                    url: '<?php echo base_url();?>user_orders/select_manuf',
                    type: 'POST',
                    /*dataType: "json",*/
                    data: {
                        manufacturerId:manufacturerId,
                        orderId:orderId
                    },
                    async: false,
                    success: function(res)
                    {
                        $('#manufacturer_select_'+orderId).html("Sent");
                    },
                    error: function(res){
                    },
                    beforeSend: function(){
                    }
                });
            }
        </script>
    </div>