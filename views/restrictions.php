<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<?php include("include/header.php");?>

<style>
	.error{
		color:#f30;
	}
</style>

<div id="wrapper">
<?php include("include/sidebar.php");?>  
     
         <div id="page-content-wrapper">
            <div class="container-fluid">
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
                  <p class="title">Restrictions</p>
                    <div class="row">
                   
                    <?php if( $this->session->flashdata('notification') !== null ): ?>
                        <?php  echo $this->session->flashdata('notification'); ?>
                    <?php endif; ?>  
                   

                    <?= validation_errors(); ?>

                      <div class="col-sm-4 col-md-3">
                          <div class="input-group rest">                                        
                                  <input type="text" name="s" id="s" value="<?php if( isset($_REQUEST['s']) ): echo $_REQUEST['s']; endif; ?>" placeholder="Search">
                                  <span class="input-group-addon search-restrictions"><i class="fa fa-search" style="cursor:pointer;"></i></span>
                            </div>
                        </div>
                        <div class="col-sm-8 col-md-7 text-center">
                        	<p>&nbsp;</p>
                        </div>

                      <div class="col-sm-8 col-md-2 text-center pull-right">
                          <button class="btn btn-green" type="button" data-toggle="modal" data-target="#addNewModal">Add New</button>
                        </div>
                    </div>

                    <div class="row ">
                      <div class="table-responsive">

                    <form id="domain-list" action="<?php echo site_url('restrictions/delete_domain');?>" method="post">  

                    <table class="table table-bordered rest-tbl">
                        <thead>
                          <tr>
                            <th> </th>
                            <th>Domain</th> 
                            <th>Computer</th>
                            <th>Status</th>
                           <!--  <th>Action</th> -->
                          </tr>
                        </thead>
                        <tbody>
                <?php 

                    if(!empty($selectpage))
                    {
                        $page_num = 1;
                    //  echo     $ci->router->fetch_method();
                        foreach($selectpage as $res1)
                        { 

                  ?>              
                          <tr>
                            <td><input class="domain-selected" name="selected_item[]" type="checkbox" data-value="<?php echo $res1['domain_name'];?>" value="<?php echo $res1['restriction_id']; ?>">
                            <label for="checkbox-1" class="checkbox-custom-label"></label></td>
                            <td><?php echo $res1['domain_name'];?></td>
                            <td><?php if( $res1['block_all'] ==1 ):?>
                            		All Computers &nbsp;<i class="fa fa-cog restrict-domain" <?php if($res1['domain_status']==1) : ?> data-all="<?php echo $res1['block_all'];?>"  data-comblock="<?php echo $res1['blocked_computer'];?>" <?php endif; ?> data-id="<?php echo $res1['restriction_id'];?>" data-value="<?php echo $res1['domain_name'];?>" data-toggle="modal" data-target="#blockModal" style="cursor:pointer;"></i>  
                            	<?php elseif( $res1['domain_status'] ==1 ): ?>
                            		<?php echo getComNames( $res1['blocked_computer'] ); ?>	&nbsp;<i class="fa fa-cog restrict-domain" <?php if($res1['domain_status']==1) : ?> data-all="<?php echo $res1['block_all'];?>"  data-comblock="<?php echo $res1['blocked_computer'];?>" <?php endif; ?> data-id="<?php echo $res1['restriction_id'];?>" data-value="<?php echo $res1['domain_name'];?>" data-toggle="modal" data-target="#blockModal" style="cursor:pointer;"></i>  
                            	<?php elseif( $res1['domain_status'] == 0 ): ?> 
                                &nbsp;<i class="fa fa-cog restrict-domain" data-id="<?php echo $res1['restriction_id'];?>" data-value="<?php echo $res1['domain_name'];?>" data-toggle="modal" data-target="#blockModal" style="cursor:pointer; display:none;"></i> 
                              <?php endif; ?>  
                            </td>

                            <td><?php if($res1['domain_status']==1){?>
                              Block
                              <?php }else{?> 
                              Unblock	
                             <!--  <a href="<?php //echo base_url().'index.php/restrictions/block_computer/'.$res1['restriction_id'];?>"> </a>-->
                              <?php }?>
                            </td>
                            <!-- <td><a href="<?php //echo base_url().'index.php/restrictions/delete_domain/'.$res1['restriction_id'];?>">Delete</a></td> -->
                 <?php 
                        $page_num++; }}
                         else
                {?>
                          <tr><td colspan ='4' style="text-align:center;"><?php echo 'No Domain Blocked';?></td></tr> 
                <?php }
                ?>          </tr>
                          
                        </tbody>
                      </table>
                      
                      </form>

                  </div>
                  <div class="row btn-section">
                        <div class="col-sm-7 col-md-4">
                        
                        <?php if( count($selectpage) > 0 ): ?>
                        	<button class="btn activate-btn apply-btn" >Apply</button>
                            <button class="btn delete-btn">Delete</button>
                        <?php endif; ?>
                            
                        </div>
                        <div class="col-sm-5 col-md-8">
                            <ul class="pagination pagination-sm tbl">

	                           <?php if( count($links) > 0 ): ?>
                                <!-- Show pagination links -->
                                  <?php foreach ($links as $link) : ?>
                                    <?php echo "<li>". $link."</li>"; ?>
                                  <?php endforeach; ?> 

                              <?php endif; ?> 

                            </ul>
                          </div>
                        </div>
                    </div>
            </div>        
        </div>
    </div>
  
<div id="addNewModal" class="modal fade" role="dialog">
  <div class="modal-dialog">
   
    <div class="modal-content addnew">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Add New Domain</h4>
      </div>
      <div class="modal-body">

      <form name="domain-add-form" id="domain-add-form" method="post" action="<?php echo site_url('restrictions/add_domain');?>" >
        
        <div class="row">
          <div class="col-md-12">
              <div class="rest">                                        
                    <input type="text" placeholder="Insert Domain"  name="domain_name" class="domain_name">
                 </div>
            </div>
       </div>
        <div class="row">
          <div class="col-md-12">
              <input id="block-checkbox" name="domain_status" value="1" type="checkbox">
                 <label for="checkboxblock" class="checkbox-custom-label">Blocked</label>
            </div>
       </div>
      </div>
      <div class="modal-footer">
       <button class="btn gray-btn"  data-dismiss="modal">Cancel</button>
        

        <input type="submit" class="btn activate-btn" name="Submit" value="Add Domain">
      </div>
      </form>

    </div>
  </div>
</div> 
<div id="blockModal" class="modal fade" role="dialog">
  <div class="modal-dialog">
  
    <div class="modal-content addnew">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Block By Computer</h4>
      </div>
      <div class="modal-body">
        
        <div class="row">
          <div class="col-md-12">
          		<?php if( count($comList) > 0 ): ?>
          		 
          		<form id="block-by-computer" action="<?php echo site_url('restrictions/block_by_computer');?>" method="post" >
          		 <input type="hidden" name="domain_id" id="domain_id" value="">
          		 <input type="hidden" name="aType" id="aType" value=""> 	
          		 <input class="all-block-systems" name="block_all" value="1" type="checkbox">
                 <label for="checkboxblock-1" class="checkbox-custom-label">All Computers</label>
	                 
	                <?php foreach( $comList as $key=>$value ): ?> 
	                 <br/>
	                 <input class="block-systems" name="block_systems[]" data-value="<?php echo $value->com_name; ?>" value="<?php echo $value->id; ?>" type="checkbox">
	                 <label for="checkboxblock-2" class="checkbox-custom-label"><?php echo ucwords($value->com_name); ?></label>
	                <?php endforeach; ?>
	           
	            </form>
	                
             	<?php endif; ?>

            </div>
       </div>
      </div>
      <div class="modal-footer">
       <button class="btn gray-btn"  data-dismiss="modal">Cancel</button>
       
       <?php if( count($comList) > 0 ): ?>
       <button class="btn activate-btn block-sys-domains">Block</button>
       <?php endif; ?>

      </div>
    </div>
  </div>
</div>       

<script type="text/javascript" src="<?php echo base_url()?>assets/js/jquery.validate.min.js"></script>
<script type="text/javascript" src="<?php echo $this->config->item('socket_url'); ?>/socket.io/socket.io.js"></script>

<script>

 var socket = io('<?php echo $this->config->item("socket_url"); ?>');
 var sUrl = "<?php echo site_url('restrictions');?>";

</script>  
<script type="text/javascript" src="<?php echo base_url()?>assets/js/restriction.js"></script>
  
</body>
</html>