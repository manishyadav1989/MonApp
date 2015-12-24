<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<?php include("include/header.php");?>

<div id="wrapper">
<?php include("include/sidebar.php");?>  
     
         <div id="page-content-wrapper">
            <div class="container-fluid">
<?php 
    if($this->session->flashdata('message') != ""){?>
            <div class="alert alert-success"> 
               <a class="close" data-dismiss="alert">×</a>
<?php echo $this->session->flashdata('message');?>
            </div>
            <?php }?>
              <header class="header">
                <div class="page-content">      
                    <div class="col-md-6 col-sm-6">
                        <div class="hed-user-block">Welcome {Software Name}</div>
                    </div>
                    <div class="col-md-6 col-sm-3">
                        <div class="hed-btn-block dropdown">
                            <button class="btn edit-btn"  id="downloadbtn">Download <i class="fa fa-angle-down"></i></button>
                             <ul class="downloadC" id="download-content">
                                <li><a href="#">Download for Windows</a></li>
                                <li><a href="#">Download for Mac</a></li>                               
                              </ul>
                        </div>
                    </div> 
                    </div>  
        </header>
              <nav class="navbar navbar-menu">
                  <a id="" class="mob-view toggle-e menu-toggle" href="#menu-toggle"><i class="fa fa-bars"></i></a>
               </nav>
               
        <div class="restrictions-content">
                  <p class="title">Blocked Computer</p>
                  
                    <div class="row">
   <div id="addNewCategory">
     <div class="addnew">

      <form name="add_merchant" method="post" action="<?php echo site_url('restrictions/update_restrictions');?>" enctype="multipart/form-data">
        <div class="row cat">
          <div class="col-md-8">                
               <input type="text" placeholder="Site Name"  id="domain_name" name="domain_name" value="<?php echo $cat['domain_name'];?>" class="txt website">
               <input type="hidden" name="restriction_id" value="<?php echo $cat['restriction_id'];?>">
          </div>
          </div>
          <div class="row">
            <p><label><input type="checkbox" id="checkAll"/> Select all</label></p>  
        </div>
<?php   
      if(!empty($connected_pc)) 
        {
     foreach($connected_pc as $pc)
      {
    
?>
          <div class="col-md-12">
           <input type="hidden" name="user_id" class="user_id" value="<?php echo $pc['userId'];?>">
             UserId:<?php echo $pc['user_name'];?><input id="checkboxblock-1" name="selected_pc[]" type="checkbox" value="<?php echo $pc['sysName'];?>"><?php echo $pc['sysName'];?>
           
          </div>
<?php  }}?>

       </div>
        <div class="row">
          <div class="col-md-8" id="p_scents">
              
                
            </div>
       </div>
        <input type="button" class="btn activate-btn" name="Submit" id="blocked" value="Blocked">
    </div>
</div>
                    </div>
                    
            </div>        
        </div>
    </div>
   

     
</body>

</html>
<script type="text/javascript" src="<?php echo $this->config->item('socket_url'); ?>/socket.io/socket.io.js"></script>
<script type="text/javascript">
  $("#checkAll").change(function () {
    $("input:checkbox").prop('checked', $(this).prop("checked"));

  
});
  $("#blocked").on("click",function(){
      // socket 
        var socket = io('<?php echo $this->config->item("socket_url"); ?>');
        var userid=$(".user_id").val();
        
        var computername=$("#checkboxblock-1").val();
        var domain =$("#domain_name").val();
        var system = userid+computername;
        console.log(system);
        console.log(domain);
  //socket.emit('system-apply-restriction', system, domain);

  //var system = userid+computername;
  //socket.emit('system-remove-restriction', system, domain);

  });



</script>