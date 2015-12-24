<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<?php include("include/header.php");?>

<style type="text/css">
  .error{
      font-size: 13px;
      color: #f30;
  }  
</style>

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
                  <p class="title">Update Category</p>
                  
                    <div class="row">
                      <div id="addNewCategory">
     <?= validation_errors(); ?>                   
     <form name="edit_category" id="edit_category" method="post" action="<?php echo site_url('category/save_category');?>" >
                       
     <div class="addnew">
     
        <div class="row cat">
          <div class="col-md-8">                
               <input type="text" placeholder="Category Name"  name="cat_name" value="<?php echo $cat['cat_name'];?>" class="txt website">
               <input type="hidden" name="cat_id" value="<?php echo base64_encode($cat['cat_id']);?>">
            </div>
       </div>
        
      
       <button class="btn gray-btn" data-dismiss="modal">Cancel</button>
        
        <input type="submit" class="btn activate-btn" name="Submit" value="Update Category">
     
    </div>

    </form>
  
</div>
                    </div>
                    
            </div>        
        </div>
    </div>
   

     
</body>
<script src="http://jqueryvalidation.org/files/dist/jquery.validate.min.js"></script>

<script>

//category form validation

(function($,W,D)
{
    var JQUERY4U = {};

    JQUERY4U.UTIL =
    {
        setupFormValidation: function()
        {
            //form validation rules
            $("#edit_category").validate({
                rules: {
                    cat_name: {
                        required: true,
                        minlength: 2
                    },
                    'website_link[]': {
                        required: true,
                        minlength: 5,
                        url:true
                    }
                },
                messages: {
                    cat_name: "Please enter category name",
                    'website_link[]': "Please enter website url"                    
                },

                submitHandler: function(form) {
                    form.submit();
                }
            });
        }
    }

    //when the dom has loaded setup form validation rules
    $(D).ready(function($) {
        JQUERY4U.UTIL.setupFormValidation();
    });

})(jQuery, window, document);

$(document).ready(function() {
    //var max_fields      = 10; //maximum input boxes allowed
    var wrapper         = $("#p_scents"); //Fields wrapper
    var add_button      = $("#addwebsiteA"); //Add button ID
    
    var x = 1; //initlal text box count
    $(add_button).click(function(e){ //on add input button click
        e.preventDefault();
            x++;
            $(wrapper).append('<div><input type="text" placeholder="Website Link"  name="website_link[]" class="txt website"><a href="#" class="remove_field"><i class="fa fa-times"></i></a></div>'); //add input box
    });
    
    $(wrapper).on("click",".remove_field", function(e){ //user click on remove text
        e.preventDefault(); $(this).parent('div').remove(); x--;
    })
});
</script>
</html>