<div class="container dash-unit">
<div class="row">
    <div class="col-md-7">

        <h2 style="margin-top:0px">Product Sizes <?php echo $button ?></h2>
        <form action="<?php echo $action; ?>" method="post">
	    <div class="form-group">
            <label for="varchar">SizeTitle <?php echo form_error('sizeTitle') ?></label>
            <input type="text" class="form-control" name="sizeTitle" id="sizeTitle" placeholder="SizeTitle" value="<?php echo $sizeTitle; ?>" />
        </div>
	    <div class="form-group">
            <label for="varchar">Size <?php echo form_error('size') ?></label>
            <input type="text" class="form-control" name="size" id="size" placeholder="Size" value="<?php echo $size; ?>" />
        </div>

         <div class="form-group">
            <label for="varchar">Output file width <?php echo form_error('output_file_width') ?></label>
            <input type="text" class="form-control" name="output_file_width" id="output_file_width" placeholder="output_file_width" value="<?php echo $output_file_width; ?>" />
        </div>

         <div class="form-group">
            <label for="varchar">Output file height <?php echo form_error('output_file_height') ?></label>
            <input type="text" class="form-control" name="output_file_height" id="output_file_height" placeholder="output_file_height" value="<?php echo $output_file_height; ?>" />
        </div>

        <div class="form-group">
            <label for="varchar">Resize Factor <?php echo form_error('resize_factor') ?></label>
            <input type="text" class="form-control" name="resize_factor" id="resize_factor" placeholder="resize_factor" value="<?php echo $resize_factor; ?>" />
        </div>

            <?php
            if($this->uri->segment('2')=='create')
            {
                $categoryId = $this->uri->segment('3');
            }
            ?>
            <input type="hidden" name="categoryId" value=<?php echo $categoryId;?>">
	    <?php /* <div class="form-group">
            <label for="int">CategoryId <?php echo form_error('categoryId') ?></label>
            <select class="form-control" name="categoryId" id="categoryId" >
                <?php
                if($product_categories)
                {
                    foreach ($product_categories as $category)
                    {
                        ?>
                        <option value="<?php echo $category->categoryId; ?>" <?php if($category->categoryId==$categoryId){ echo "selected";} ?> ><?php echo $category->categoryTitle; ?></option>
                        <?php
                    }
                }

                ?>
            </select>
        </div>
 */?>

	    <input type="hidden" name="sizeId" value="<?php echo $sizeId; ?>" /> 
	    <button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
	    <a href="<?php echo site_url('product_sizes/show') ?>" class="btn btn-default">Cancel</a>
	</form>
    </div>
    </div>
</div>