    <div class="container dash-unit">
        <h2 style="margin-top:0px">Manufacturers <small>List All</small></h2>
        <div class="row" style="margin-bottom: 10px">
            <div class="col-md-4">
                <?php echo anchor(site_url('manufacturers/create'),'Create', 'class="btn btn-primary"'); ?>
            </div>
            <div class="col-md-4 text-center">
                <div style="margin-top: 8px;font-weight: bold;font-color: red;color: red;background: orange;" id="message">
                    <?php echo $this->session->userdata('message') <> '' ? $this->session->userdata('message') : ''; ?>
                </div>
            </div>
            <div class="col-md-1 text-right">
            </div>
            <div class="col-md-3 text-right">
                <form action="<?php echo site_url('manufacturers'); ?>" class="form-inline" method="get">
                    <div class="input-group">
                        <input type="text" class="form-control" name="q" value="<?php echo $q; ?>">
                        <span class="input-group-btn">
                            <?php 
                                if ($q <> '')
                                {
                                    ?>
                                    <a href="<?php echo site_url('manufacturers'); ?>" class="btn btn-default">Reset</a>
                                    <?php
                                }
                            ?>
                          <button class="btn btn-primary" type="submit">Search</button>
                        </span>
                    </div>
                </form>
            </div>
        </div>
        <table class="table table-bordered" style="margin-bottom: 10px">
            <tr>
                <th>No</th>
                <th>User Name</th>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Email</th>
                <th>Registration Date</th>
                <!--<th>Created Date</th>
                <th>Created By</th>-->
                <th>Action</th>
            </tr><?php
            foreach ($manufacturers as $manufacturer)
            {
                ?>
                <tr>
                    <td width="80px"><?php echo ++$start ?></td>
                    <td><?php echo $manufacturer->username ?></td>
                    <td><?php echo $manufacturer->userFirstName ?></td>
                    <td><?php echo $manufacturer->userLastName ?></td>
                    <td><?php echo $manufacturer->userEmail ?></td>
                    <td><?php echo $manufacturer->userRegistrationDate ?></td>
                   <!-- <td><?php /*echo $manufacturer->userCreationDate */?></td>
                    <td><?php /*echo $manufacturer->userReferer */?></td>-->
                    <td style="text-align:center" width="200px">
                        <?php
                        echo anchor(site_url('manufacturers/read/'.$manufacturer->userId),'Read');
                        echo ' | ';
                        echo anchor(site_url('manufacturers/update/'.$manufacturer->userId),'Update');
                        echo ' | ';
                        echo anchor(site_url('manufacturers/delete/'.$manufacturer->userId),'Delete','onclick="javasciprt: return confirm(\'Are You Sure ?\')"');
                        ?>
                    </td>
		</tr>
                <?php
            }
            ?>
        </table>
        <div class="row">
            <div class="col-md-6">
                <a href="#" class="btn btn-primary">Total Record : <?php echo $total_rows ?></a>
		<?php echo anchor(site_url('manufacturer/excel'), 'Excel', 'class="btn btn-primary"'); ?>
		<?php echo anchor(site_url('manufacturer/word'), 'Word', 'class="btn btn-primary"'); ?>
	    </div>
            <div class="col-md-6 text-right">
                <?php echo $pagination ?>
            </div>
        </div>
    </div>