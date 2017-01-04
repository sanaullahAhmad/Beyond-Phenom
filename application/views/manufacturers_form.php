<div class="container dash-unit">
    <div class="row">
            <div class="col-sm-7">
            <h2 style="margin-top:0px">Manufacturers <small><?php echo $button ?></small></h2>

            <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="varchar">User Name <?php echo form_error('username') ?></label>
                    <input type="text" class="form-control" name="username" id="username" value="<?php echo $username; ?>" />
                </div>
                <div class="form-group">
                    <label for="varchar">Password <?php echo form_error('userPassword') ?></label>
                    <input type="password" class="form-control" name="userPassword" id="userPassword"  autocomplete="off" value="<?php echo $userPassword; ?>" />
                </div>
                <div class="form-group">
                    <label for="varchar">First Name <?php echo form_error('userFirstName') ?></label>
                    <input type="text" class="form-control" name="userFirstName" id="userFirstName" value="<?php echo $userFirstName; ?>" />
                </div>
                    <div class="form-group">
                        <label for="varchar">Last Name <?php echo form_error('userLastName') ?></label>
                        <input type="text" class="form-control" name="userLastName" id="userLastName"  value="<?php echo $userLastName; ?>"  />
                    </div>
                    <div class="form-group">
                        <label for="varchar">Email <?php echo form_error('userEmail') ?></label>
                        <input type="text" class="form-control" name="userEmail" id="userEmail"  value="<?php echo $userEmail; ?>"  />
                    </div>
                    <div class="form-group">
                        <label for="varchar">Dob <?php echo form_error('userDob') ?></label>
                        <input type="text" class="form-control" name="userDob" id="userDob"  value="<?php echo $userDob; ?>"  />
                    </div>
                    <div class="form-group">
                        <label for="varchar">Address <?php echo form_error('userAddress') ?></label>
                        <input type="text" class="form-control" name="userAddress" id="userAddress"  value="<?php echo $userAddress; ?>"  />
                    </div>

                <input type="hidden" name="userId" value="<?php echo $userId; ?>" />
                <button type="submit" class="btn btn-primary"><?php echo $button ?></button>
                <a href="<?php echo site_url('manufacturers') ?>" class="btn btn-default">Cancel</a>
            </form>
            <div class="clearfix clear-both"></div>
        </div>
    </div>
</div>