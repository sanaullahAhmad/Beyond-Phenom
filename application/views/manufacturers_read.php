    <div class="container dash-unit">
        <h2 style="margin-top:0px">Manufactures <small>View Detail</small></h2>
        <table class="table">
	    <tr><td>Username</td><td><?php echo $username; ?></td></tr>
			<tr><td>First Name</td><td><?php echo $userFirstName; ?></td></tr>
	    <tr><td>LastName</td><td><?php echo $userLastName; ?></td></tr>
	    <tr><td>Email</td><td><?php echo $userEmail; ?></td></tr>
	    <tr><td>Registration Date</td><td><?php echo $userRegistrationDate; ?></td></tr>
	    <tr><td>Dob</td><td><?php echo $userDob; ?></td></tr>
	    <tr><td>userAddress</td><td><?php echo $userAddress; ?></td></tr>
	    <tr><td></td><td><a href="<?php echo site_url('manufacturers') ?>" class="btn btn-default">Cancel</a></td></tr>
	</table>
        </div>