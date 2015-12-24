<footer>
	<?php $setting = getHome();?>
  <div class="to_footer_top">
    <div class="container">
      <div class="to_footerin">
        <div class="row">
          <div class="col-md-4 col-sm-4">
            <div class="to_footer_intro">
              <?php // echo $setting['footercontents'];?>
              <img style="margin-bottom:10px; opacity:0.6;" src="http://www.twitchworks.com/enstadoc/assets/img/logoensadoc2.png" alt="logo" >
              <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
              <ul class="to_footersoc">
                <?php if(!empty($setting['homefecebook'])){ ?><li><a target="_blank" href="<?php echo $setting['homefecebook']; ?>"><i class="fa fa-facebook"></i> </a></li><?php }?>
                <?php if(!empty($setting['hometwitter'])){ ?><li><a target="_blank" href="<?php echo $setting['hometwitter']; ?>"><i class="fa fa-twitter"></i> </a></li><?php }?>
                <?php if(!empty($setting['homegoogle'])){ ?><li><a href="<?php echo $setting['homegoogle']; ?>" target="_blank"><i class="fa fa-google-plus"></i> </a></li><?php }?>
                <?php if(!empty($setting['homeyoutube'])){ ?><li><a href="<?php echo $setting['homeyoutube']; ?>" target="_blank"><i class="fa fa-youtube"></i> </a></li><?php }?>
                <?php if(!empty($setting['homelinkedin'])){ ?><li><a href="<?php echo $setting['homelinkedin']; ?>" target="_blank"><i class="fa fa-linkedin"></i> </a></li><?php }?>
                </ul>
            </div>

          </div>
          <div class="col-md-8 col-sm-8">
            <div class="row">
              <div class="col-sm-4">
                <div class="to_footerlinks">
                <h3><i class="fa fa-external-link"></i> Get Links</h3>
                  <ul>
                    <li><a href="<?php echo base_url();?>">Home</a></li>
                    <?php
                    if(!empty($loggedInUser) && isset($loggedInUser['user_id']) && $loggedInUser['user_id']==""){
                    ?>
                    <li><a href="<?php echo base_url();?>enstadoc-one">Enstadoc One</a></li>
                    <li><a href="<?php echo base_url();?>enstadoc-unlimited">Enstadoc Unlimited</a></li>
                    <?php }?>
                    <li><a href="<?php echo base_url();?>what-is-aba-file">What is ABA file?</a></li>
                    <li><a href="<?php echo base_url();?>privacy-policy">Privacy Policy</a></li>
                    <li><a href="<?php echo base_url();?>about-us">About Us</a></li>
                    <li><a href="<?php echo base_url();?>terms-and-conditions">Terms and Conditions</a></li>
                    <li><a href="<?php echo base_url();?>faq">FAQ'S</a></li>  
                  </ul>
                </div>
              </div>
              
              <div class="col-sm-4">
                <div class="to_footerlinks">
                <h3><i class="fa fa-envelope-o"></i> Newsletter</h3>
                 <p>An example of how a subscription form could look like. </p>
                 <form action="" method="get" class="news_form">
                 	<input name="" class="form-control" type="text" placeholder="Enter your address" />
                    <button>Subscribe</button>
                 </form>
                </div>
              </div>
              <div class="col-sm-4">
              	<div class="to_footerlinks">
              	<h3><i class="fa fa-phone"></i> Contact Us</h3>
                <address>
                <?php echo $setting['footeraddress'];?>
                
                <br>
                <i class="fa fa-mobile"></i> <strong>Phone -</strong>  +91 - <?php echo $setting['homemobile'];?><br>
                <i class="fa fa-envelope"></i> <strong>Email-</strong>  <a href="mailto:<?php echo $setting['homeemail'];?>"><?php echo $setting['homeemail'];?></a>
                </address>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="to_footer_bottom">
    <div class="container">
      <div class="to_footerin">
        <div class="row"> <small> <?php echo $setting['copyright'];?></small> </div>
      </div>
    </div>
  </div>
</footer>
<!--FOOTER ENDS HERE-->

<div class="scroll-to-top"> <a href="javascript:void(0);"><i class="fa fa-angle-up"></i></a> </div>

<!-- Modal -->
<div class="modal fade to_modal" id="login" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Login</h4>
      </div>
      <div class="modal-body">
	  <span id="login_error"></span>
        <form name='loginfrm' method='post' action='' onsubmit="return login();">
          <input type="hidden" name="redirect" id="redirect" value="<?=base_url()?>ajax_update">
          <div class="form-group">
            <label for="username">Email Address</label>
            <input type="text" class="form-control" id='login_email' name='login_email' placeholder="Email Address">
            <span class="input_icon"><i class="fa fa-envelope"></i></span>
          </div>
          <div class="form-group">
            <label for="password">Password</label>
			<input type="password" class="form-control" id='login_password' name='login_password' placeholder="Password">
            <span class="input_icon"><i class="fa fa-lock"></i></span>
          </div>
          <div class="row">
            <div class="col-sm-12">
              
              <p class="checkbox to_fgtpwd pull-left">
              <input type="submit" name="submit" value="LOGIN" class="btn to_regbtn">
              <a href="javascript:void(0);" data-toggle="modal" data-target="#forgot_pwd" data-dismiss="modal">Forgot Password?</a>
              </p>
            </div>
          </div>
		
     </form>
    </div>    
    </div>
  </div>
</div>

<div class="modal fade to_modal" id="forgot_pwd" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Forgot Password</h4>
      </div>
      <div class="modal-body">
	   <span id="forgot_error"></span>
	   <span id="forgetpass"></span>
          <div class="form-group">
          <label for="email">Email ID</label>
			     <input type='text' name='forget_email' id='forget_email' class="form-control" onkeyup="forgot(event)" placeholder='E-mail Address' />
          </div>
          <div class="">
		  <button type='button' id='loginbutton1' class="btn to_regbtn" name='sendpass' onclick='sendmypass()' />RESET PASSWORD</button>
		  </div>
      </div>
    </div>
  </div>
</div>
</body>
</html>
