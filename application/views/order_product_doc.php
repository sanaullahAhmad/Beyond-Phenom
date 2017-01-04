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
        <h2>Order_product List</h2>
        <table class="word-table" style="margin-bottom: 10px">
            <tr>
                <th>No</th>
		<th>OrderId</th>
		<th>ProductId</th>
		<th>Name</th>
		<th>Base Svg</th>
		<th>Sizes</th>
		<th>Quantities</th>
		<th>Price</th>
		<th>Total</th>
		<th>Middle Svg</th>
		<th>Top Svg</th>
		<th>Model Obj</th>
		<th>Model Mtl</th>
		<th>Generate File Name</th>
		<th>Session User</th>
		<th>Imgoffsety</th>
		<th>Imgoffsetx</th>
		<th>Imgangle</th>
		<th>MyRange</th>
		<th>Imgrepeat</th>
		<th>Patterenused</th>
		<th>Tax</th>
		<th>Reward</th>
		
            </tr><?php
            foreach ($order_product_data as $order_product)
            {
                ?>
                <tr>
		      <td><?php echo ++$start ?></td>
		      <td><?php echo $order_product->orderId ?></td>
		      <td><?php echo $order_product->productId ?></td>
		      <td><?php echo $order_product->name ?></td>
		      <td><?php echo $order_product->base_svg ?></td>
		      <td><?php echo $order_product->sizes ?></td>
		      <td><?php echo $order_product->quantities ?></td>
		      <td><?php echo $order_product->price ?></td>
		      <td><?php echo $order_product->total ?></td>
		      <td><?php echo $order_product->middle_svg ?></td>
		      <td><?php echo $order_product->top_svg ?></td>
		      <td><?php echo $order_product->model_obj ?></td>
		      <td><?php echo $order_product->model_mtl ?></td>
		      <td><?php echo $order_product->generate_file_name ?></td>
		      <td><?php echo $order_product->session_user ?></td>
		      <td><?php echo $order_product->imgoffsety ?></td>
		      <td><?php echo $order_product->imgoffsetx ?></td>
		      <td><?php echo $order_product->imgangle ?></td>
		      <td><?php echo $order_product->myRange ?></td>
		      <td><?php echo $order_product->imgrepeat ?></td>
		      <td><?php echo $order_product->patterenused ?></td>
		      <td><?php echo $order_product->tax ?></td>
		      <td><?php echo $order_product->reward ?></td>	
                </tr>
                <?php
            }
            ?>
        </table>
    </body>
</html>