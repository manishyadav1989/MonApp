<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="<?php echo base_url(); ?>css/style.css" rel="stylesheet" type="text/css" />

<title>Employee Monitoring Software</title>
</head>

<body id="body">
<!--Header coding satrt here-->
<div class="headerDiv">
	<div class="containerDiv">
    	<div class="logo"><img class="logosize" src="<?php echo base_url(); ?>images/TrackerLogo.jpg" />
        </div>
        <div class="CF">Employee Monitoring Software</div>
        <div class="searchName">
            <div class="Cartcont">
                <a href="<?php echo site_url("logout/logoutAdmin"); ?>">
                <input name="submit" type="submit" value="Logout"></a>
            </div>
            <div class="HelShank">Welcome <?php $aecusername = ''; $aecusername = ucfirst($this->session->userdata('username')); echo $aecusername;?></div>
        </div>
         <div class="navigation">
        	
        </div>
    </div>
</div>

