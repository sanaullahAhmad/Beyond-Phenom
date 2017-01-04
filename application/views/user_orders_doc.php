<!doctype html>
<html>
    <head>
        <title>harviacode.com - codeigniter crud generator</title>
        <link rel="stylesheet" href="<?php echo base_url('assets/bootstrap/css/bootstrap.min.css') ?>"/>
        <style>
            .word-table {
                border:1px solid black !important; 
                border-collapse: collapse !important;
                width: 100%;
            }
            .word-table tr th, .word-table tr td{
                border:1px solid black !important; 
                padding: 5px 10px;
            }
        </style>
    </head>
    <body>
        <h2>User_orders List</h2>
        <table class="word-table" style="margin-bottom: 10px">
            <tr>
                <th>No</th>
		<th>ProductId</th>
		<th>Order Price</th>
		<th>Billing Address</th>
		<th>Delivery Address</th>
		<th>Billing Method</th>
		<th>Delivery Method</th>
		<th>UserId</th>
		<th>Created Date</th>
		
            </tr><?php
            foreach ($user_orders_data as $user_orders)
            {
                ?>
                <tr>
		      <td><?php echo ++$start ?></td>
		      <td><?php echo $user_orders->productId ?></td>
		      <td><?php echo $user_orders->order_price ?></td>
		      <td><?php echo $user_orders->billing_address ?></td>
		      <td><?php echo $user_orders->delivery_address ?></td>
		      <td><?php echo $user_orders->billing_method ?></td>
		      <td><?php echo $user_orders->delivery_method ?></td>
		      <td><?php echo $user_orders->userId ?></td>
		      <td><?php echo $user_orders->created_date ?></td>	
                </tr>
                <?php
            }
            ?>
        </table>
    </body>
</html>