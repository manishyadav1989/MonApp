<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <title>Login</title>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <link href="<?php echo base_url(); ?>css/style.css" rel="stylesheet" type="text/css" />
        <script>

            function init() {
                // Clear forms here
                //alert('hi');
                document.process.reset();
            }

        </script>
 <script>
$("#forgetForm").validate();
</script>
    </head>

    <body>

        <div class="headerDiv">
            <div class="containerDiv">
                <div class="logo"><img src="<?php echo base_url(); ?>/images/logo.png" />
                </div>
                <div class="CF">COLLEGE FINDER</div>
            </div>
        </div>

        <div class="container">
            <div class="containerDiv">
                <div class="loginBox">
                    <div class="loginContent">

                        <?php echo validation_errors(); ?>
                        <?php
                        $attributes = array('id'=>"forgetForm",'class' => '', 'email_id' => 'email');
                        echo form_open('login/forgetpassword', $attributes);
                        ?>
                        <div class="login">
                            Forget Password
                        </div>
                        <?php if ($this->session->flashdata('success') == TRUE) { ?>
                            <div class="peyp"><?php echo $this->session->flashdata('success'); ?></div>
                        <?php } ?>
                        <?php if ($this->session->flashdata('error') == TRUE) { ?>
                            <div class="peyp"><strong>Error !</strong> <?php echo $this->session->flashdata('error'); ?></div>
                        <?php } ?>
                    </div><!-- end of login -->
                    <div class="usernameBox">

                        <div class="user">
                            Enter you email ID:
                        </div><!-- end of user -->
                        <div class="textBox">
                            <input required class="textbox" type='text' name='email'/>
<!--                            <input type="text" class="textbox" />-->
                        </div>
                        <div class="loginSearch">
                            <div class="login_text"><button  type='Submit' value='Send' name="submit" onload="return init();" class="saveButton1">Send</button></div>               
                          </div><!-- end of loginSearch -->  
                        <div class="loginSearch">
                                          
                            <div class="login_text"><button  type='button' value='Back' name="Back" onclick="history.go(-1);" class="saveButton1">Back</button></div>               
                        </div><!-- end of loginSearch --> 
                        </form>
                    </div>
                    </body>
                    </html>