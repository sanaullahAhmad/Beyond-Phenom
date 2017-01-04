<div class="container dash-unit">
	<h2 style="margin-top:0px">Order Product <small>List All</small></h2>
        <div class="row" style="margin-bottom: 10px">
            <div class="col-md-4">

            </div>
            <div class="col-md-4 text-center">
                <div style="margin-top: 4px"  id="message">
                    <?php echo $this->session->userdata('message') <> '' ? $this->session->userdata('message') : ''; ?>
                </div>
            </div>
            <div class="col-md-4 text-right">
                <?php echo anchor(site_url('order_product/create'), 'Create', 'class="btn btn-primary"'); ?>
		<?php echo anchor(site_url('order_product/excel'), 'Excel', 'class="btn btn-primary"'); ?>
		<?php echo anchor(site_url('order_product/word'), 'Word', 'class="btn btn-primary"'); ?>
	    </div>
        </div>
        <table class="table table-bordered table-striped" id="mytable">
            <thead>
                <tr>
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
		    <th>Action</th>
                </tr>
            </thead>
	    <tbody>
            <?php
            $start = 0;
            foreach ($order_product_data as $order_product)
            {
                ?>
                <tr>
		    <td><?php echo $order_product->name ?></td>
		    <td><?php echo $order_product->base_svg ?></td>
		    <td><?php echo $order_product->sizes ?></td>
		    <td><?php echo $order_product->quantities ?></td>
		    <td><?php echo number_format((float)$order_product->price, 2, '.', '') ?></td>
		    <td><?php echo number_format((float)$order_product->total, 2, '.', '') ?></td>
		    <td><?php echo $order_product->middle_svg ?></td>
		    <td><?php echo $order_product->top_svg ?></td>
		    <td><?php echo $order_product->model_obj ?></td>
		    <td><?php echo $order_product->model_mtl ?></td>
		    <td><?php echo $order_product->generate_file_name ?></td>
		    <td style="text-align:center" width="200px">
			<?php 
			echo anchor(site_url('order_product/read/'.$order_product->order_product_id),'Read'); 
			echo ' | '; 
			echo anchor(site_url('order_product/update/'.$order_product->order_product_id),'Update'); 
			echo ' | '; 
			echo anchor(site_url('order_product/delete/'.$order_product->order_product_id),'Delete','onclick="javasciprt: return confirm(\'Are You Sure ?\')"'); 
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
        </script>
   </div>