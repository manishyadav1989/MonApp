<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <title>Login</title>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        
		<link href="<?php echo base_url(); ?>css/style.css" rel="stylesheet" type="text/css" /> 
		
        <script>

            function init() {
                document.process.reset();
            }

        </script>
<script>
//$("#commentForm").validate();
</script>
    </head>

    <body>

        <div class="headerDiv">
            <div class="containerDiv">
                <div class="logo">
				
				<img class="logosize" src="<?php echo base_url(); ?>/images/TrackerLogo.jpg" />
                </div>
                <div class="CF">Employee Monitoring Software</div>
                
            </div>
           
        </div>

        <div class="container_Lgn">
            <div class="containerDiv">
                <div class="loginBox">
                    <div class="loginContent">
                        <?php
                        $attributes = array('id'=>"commentForm",'user_name' => 'username', 'password' => 'password');
                        echo form_open('login/user_exist', $attributes);
                        ?>
                        <div class="login">
                            LOGIN
                        </div>
                        
                            <!--                                                        Please enter your password-->
                            <?php if ($this->session->flashdata('validation')==TRUE) { ?>
                                <div class="peyp"><?php echo $this->session->flashdata('validation'); ?></div>
                            <?php } ?>
                                <?php if ($this->session->flashdata('success')==TRUE) { ?>
                                <div class="peyp"><?php echo $this->session->flashdata('success'); ?></div>
                            <?php } ?>
                            <?php if ($this->session->flashdata('error')==TRUE) { ?>
                                <div class="peyp"><strong>Error !</strong> <?php echo $this->session->flashdata('error'); ?></div>
                            <?php } ?>
                       <!--    end of peyp -->
                    </div><!-- end of login -->
                    <div class="usernameBox">
                        
                        <div class="user">
                            Username :
                        </div><!-- end of user -->
                        <div class="textBox">
                            <input required class="textbox" type='text' name='username' id='username' size='25' value="<?php echo $this->input->post('username') ?>"/>
<!--                            <input type="text" class="textbox" />-->
                        </div><!-- end of textBox -->
                        <div class="pass">
                            Password :
                        </div><!-- end of pass -->
                        <div class="textBox">
                            <input required class="textbox" type='password' name='password' id='password' size='25'  />
<!--                            <input type="password" class="textbox" />-->
                        </div><!-- end of textBox_1 -->
                          <div class="forget">
                            <a href="<?php echo site_url("login/emailexist"); ?>">Forget Password</a> 
                        </div><!-- end of forget -->
						
                        <div class="loginSearch">
                            <button  type='Submit' value='login' name="submit" onload="return init();" class="saveButton1">LOGIN</button>            
                        </div><!-- end of loginSearch -->
                        </form>
                    </div><!-- end of usernameBox -->
                </div><!-- end of loginContent -->
            </div><!-- end of loginBox -->
        </div><!-- end of container -->

        <div class="footerDiv">
            <div class="containerDiv"> </div>
        </div>
    </body>
</html>
