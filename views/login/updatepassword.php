
<html xmlns='http://www.w3.org/1999/xhtml' xml:lang='en' lang='en'>
<head>    
    <title>Update Password</title>
</head>
<body>
    <div id='home_form'> 
        <?php
				if($this->session->flashdata('error')){
				?>
				<div class="alert alert-dismissable alert-danger">
				<button type="button" class="close" data-dismiss="alert">&times;</button>
				<strong>Error !</strong> <?php echo $this->session->flashdata('error');?>
				</div>
				<?php
				}
				?>
<?php
?>
<?php $attributes = array('password' => 'Password');
echo form_open('login/changePassword',$attributes); ?>
<form  method='post' >
            <table>
                <tr>
                    <td> New Password:</td><input type="hidden" name="id" value="<?php echo $id;?>">
                    <td><input type="password" name="Password"/></td>
                </tr>
                <tr>
                    <td>Confirm Password:</td>
                    <td><input type="password" name="confirmPassword"/></td>
                </tr>
                <tr>
                    <td><input type="submit" name="submit" value="Update"></td>
                </tr>
            </table>
        </form>
    </div>
</body>
</html>