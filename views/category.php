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
                  <p class="title">Category</p>
                    <div class="row">
                      <div class="col-md-12 text-center">
                          <button class="btn btn-green" type="button" data-toggle="modal" data-target="#addNewCategory">Add New</button>
                        </div>
                    </div>
                    <div class="row ">

                    <?php if( $this->session->flashdata('notification') !== null ): ?>
                        <?php  echo $this->session->flashdata('notification'); ?>
                    <?php endif; ?>  
                   

                    <?= validation_errors(); ?>
                      <div class="table-responsive">
                    <table class="table table-bordered rest-tbl">
                        <thead>
                          <tr>
                            <th> <input id="main-checkbox" type="checkbox"> &nbsp; All </th>
                            <th>Category Name</th> 
                             
                             <th>Action</th>
                          </tr>
                        </thead>
                        <tbody>
               <?php 
                      if(!empty($selectpage))
                      {

                        echo "<form action='".site_url('category/deleteCategories')."' method='post' id='category-form' >";

                        foreach($selectpage as $res)
                        { 

                        ?>
                          <tr class="active">
                            <td><input class="categories-checkbox" name="categories[]" value="<?php echo base64_encode($res['cat_id']); ?>" type="checkbox">
                            <!-- <label for="categorycheckbox-2" class="checkbox-custom-label"></label> --></td>
                            <td><?php echo $res['cat_name'];?></td>
                            <td><a title="Edit" href="<?php echo base_url().'index.php/category/update_category/'.base64_encode($res['cat_id']),'/token='.md5('edit');?>"> <i class="glyphicon glyphicon-cog"></i></a>
                                <a title="Delete" href="javascript:;" class="delete-category" data-value="<?php echo base_url().'index.php/category/delete_category/'.base64_encode($res['cat_id']),'/token='.md5('delete');?>"> <i class="glyphicon glyphicon-trash"></i></a>
                            </td>                          
                        
                          </tr>
                <?php 
                  }
                  echo "</form>";
                }
                         else
                {?>
                          <tr><td colspan ='12' style="text-align:center;"><?php echo 'No Category Found';?></td></tr> 
                <?php }
                ?>
                         
                        </tbody>
                      </table>
                  </div>
                  <div class="row btn-section">
                        <div class="col-sm-7 col-md-4">
                           <button class="btn delete-btn"  >Delete</button>
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
   
<div id="addNewCategory" class="modal fade in" role="dialog">
  <div class="modal-dialog">

    <div class="modal-content addnew">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">×</button>
        <h4 class="modal-title">Add New Category</h4>
      </div>

      <form name="add_category" id="add_category" method="post" action="<?php echo site_url('category/add_category');?>" >

      
        <div class="row cat">
          <div class="col-md-8">                
                    <input type="text" placeholder="Category Name"  name="cat_name" class="txt website">
            </div>
       </div>
        
      <div class="modal-footer">
       <button class="btn gray-btn" data-dismiss="modal">Cancel</button>
        
        <input type="submit" class="btn activate-btn" name="Submit" value="Add Category">
      </div>

      </form>

    </div>
  </div>
</div>
     
</body>

<script src="http://jqueryvalidation.org/files/dist/jquery.validate.min.js"></script>

<script>

// category form validation
(function($,W,D)
{
    var JQUERY4U = {};

    JQUERY4U.UTIL =
    {
        setupFormValidation: function()
        {
            //form validation rules
            $("#add_category").validate({
                rules: {
                    cat_name: {
                        required: true,
                        minlength: 2
                    }                   
                },
                messages: {
                    cat_name: "Please enter category name",
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
    });


    // delete category
    $(document).on('click', '.delete-category', function(){
        if( confirm('Are you sure. You want to delete this category!') ){
            window.location.href = $(this).data('value');
        }
    });

    // select all category 
    $(document).on('click', '#main-checkbox', function(){
        if( $(this).is(':checked') ){
            $('.categories-checkbox').each(function(key, value){
                $(this).attr('checked', true);
            });
        }
        else{
            console.log('start false loop \n');
            $('.categories-checkbox').each(function(key, value){
                $(this).attr('checked', false);
            });
        }

    });

    // delete selected item
    $(document).on('click', '.delete-btn', function(){
        
        var error_flage = true;
        var selected = [];

        $('.categories-checkbox').each(function(key, value){
            if(  $(this).is(':checked') ){
              error_flage = false;
            }
        });

        if( error_flage ){
            alert('Please select category');
        }
        else{
            if(confirm('Are you sure want to delete category?')){
                $('#category-form').submit();  
            }            
        }
    });

});
</script>
</html>