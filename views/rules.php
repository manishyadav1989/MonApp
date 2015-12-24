<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<?php include("include/header.php");?>

<style type="text/css">
  .error{
    color:#f30;
    display: block;
    font-family: 12px;
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
                  <p class="title">Rules</p>

                  <?php if( $this->session->flashdata('notification') !== null ): ?>
                      <?php  echo $this->session->flashdata('notification'); ?>
                  <?php endif; ?>  
                 

                  <?= validation_errors(); ?>

                    <div class="row">
                      <div class="col-sm-4 col-md-3">
                          <div class="input-group rest">                                        
                                  <input type="text" placeholder="Search" id="s" name="s">
                                   <span class="input-group-addon search-restrictions" style="cursor:pointer;"><i class="fa fa-search"></i></span>
                            </div>
                        </div>
                      <div class="col-sm-8 col-md-9 text-center">
                          <button class="btn btn-green add-new-rule" type="button" data-toggle="modal" data-target="#addNewRule">Add New</button>
                        </div>
                    </div>
                    <div class="row ">
                      <div class="table-responsive">
                    <table class="table table-bordered rest-tbl">
                        <thead>
                          <tr>
                            <th> </th>
                            <th>Rule Name</th> 
                             <th>Category</th>
                            <th>Termination</th>
                            <th>Status</th>
                           
                          </tr>
                        </thead>
                        <tbody>
                         
                          <?php if( count($rules) > 0 ): ?>

                            <form action="<?php echo site_url('rules/deleteRules'); ?>" method="post" id="rules-list-form">

                            <?php foreach($rules as $key=>$rule): ?>

                            <tr>
                            <td>

                              <input data-name="<?php echo $rule->name; ?>" 
                              data-category="<?php echo $rule->category; ?>" 
                              data-terminate="<?php echo $rule->terminate_application; ?>"
                              data-contains="<?php echo $rule->contains; ?>"
                              data-type="<?php echo $rule->type; ?>"
                              data-everysecond="<?php echo $rule->ever_second_screenshot; ?>"
                              data-popupmessage="<?php echo $rule->popup_message; ?>"
                              id="checkbox-<?php echo $key; ?>" 
                              class="checkbox-custom selected-rules" 
                              type="checkbox" name="rules[]" value="<?php echo $rule->id; ?>">

                            <label for="checkbox-<?php echo $key; ?>" class="checkbox-custom-label"></label></td>
                            <td><?php echo ucwords($rule->name); ?></td>
                            <td><?php echo $rule->category; ?></td>
                            <td> <?php if( $rule->terminate_application ):?> Yes <?php else: ?> No <?php endif; ?> </td>
                            <td> <a href="<?php echo site_url('rules/changeStatus/'.base64_encode($rule->id).'/'.$rule->status); ?>" /><?php if( $rule->status ):?> Active <?php else: ?> Inactive <?php endif; ?> </a> </td>
                            
                            </tr>

                            <?php endforeach; ?>
                            
                            </form>

                          <?php else: ?>

                          <tr>
                            <td colspan="5">Rules not found!</td>
                          </tr>

                          <?php endif; ?>

                        </tbody>
                      </table>
                  </div>
                  <div class="row btn-section">
                        <div class="col-sm-7 col-md-4">
                           <button class="btn activate-btn edit-rule" >Edit</button>
                        
                           <button class="btn delete-btn delete-rule"  >Delete</button>
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
 
<div id="addNewRule" class="modal fade" role="dialog">
  <div class="modal-dialog rule">

    <div class="modal-content addnew">

    <form id="new-rule" name="new-rule" action="<?php echo site_url('rules/manageRule'); ?>" method="post">
    <input type="hidden" name="atype" id="atype" value="add">
    <input type="hidden" name="_uid" id="_uid" value="">
    <input type="hidden" name="type" id="type" value="">
    <input type="hidden" name="category" id="category" value="">
     
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">New Rule</h4>
      </div>
      <div class="modal-body">
        <div class="row">           
          <div class="col-sm-3 col-md-3">
             <p class="heading ">Conditions</p>
              <div class="dropdown">
                  <button class="btn activate-btn dropdown-toggle types" type="button" data-toggle="dropdown"><span class="current_type">Type</span>
                 <i class="fa fa-caret-down"></i></button>
                  <ul class="dropdown-menu filter">
                    <li><a class="types" data-value="Title Bar" href="#">Title Bar</a></li>
                    <li><a class="types" data-value="Domain/URL" href="#">Domain/URL</a></li>
                    <li><a class="types" data-value="Time" href="#">Time</a></li>
                  </ul>
                </div>
                <div class="error" id="type_error"></div>
            </div>
            <div class="col-sm-4 col-md-4 keyword-contains">
             <p class="heading ">Contains</p>
               <input type="text" placeholder="text value" name="contains" id="contains" class="txt">
               <span class="error" id="contains_error"></span>
            </div>

           <div class="col-sm-4 col-md-4" style="float:right;">

              <?php if( count($category) > 0 ): ?>
              <div class="dropdown">
                <p class="heading ">Category</p>
                  <button class="btn activate-btn dropdown-toggle category_list" type="button" data-toggle="dropdown"><span class="current_category">Select Category</span>
                 <i class="fa fa-caret-down"></i></button>
                  <ul class="dropdown-menu filter">
                    <?php foreach ($category as $key => $value): ?>
                        <li><a class="category_list" data-value="<?php echo $value->cat_id; ?>" href="#"><?php echo $value->cat_name; ?></a></li>
                    <?php endforeach; ?>
                  </ul>
              </div>
              <div class="error" id="category_error"></div>
              
              <?php endif; ?>

          </div>
       </div>
       <div class="row">
        <p class="heading ">Screenshot Settings</p>
             <div class="row one_screenshot_div">
                  <input id="radio-1" class="radio-custom screenshot_settings" name="screenshot_settings" type="radio" value="one_time">
                  <label for="radio-1" class="radio-custom-label">Collect One Screenshot as Rule is Triggered</label>

             </div>
             <div class="row every_second_div">
               <input id="radio-2" class="radio-custom screenshot_settings" name="screenshot_settings" type="radio" value="every_second">
               <label for="radio-2" class="radio-custom-label">Take a Screenshot every   <input id="spinner" name="seconds" class="time-input seconds"> second</label>
               <span class="error" id="seconds_error"></span>
             </div>

            <span class="error" id="screenshot_settings_error"></span>

           <div class="row poup-message-option">
              <div class="col-sm-10 col-md-8">
                <p class="heading ">Pop-up Message Settings</p>
                 <input id="radio-3" class="radio-custom" name="radio-group1" type="radio" checked>
                     <label for="radio-3" class="radio-custom-label">Enable Pop-Up Messages on User’s Computer when Rule is Triggered</label>
               </div>
             </div>
               <div class="row popup-message-text">
                  <div class="col-sm-10 col-md-8">
                      <textarea class="txtar" name="popup_msg" id="popup_msg"></textarea>
                      <span class="error" id="popup_msg_error"></span>
                    </div>
               </div>
               <div class="row text-right">
                  <div class="col-sm-12 col-md-12">
                      <div class="row">
                          <input type="text" name="rule_name" id="rule_name" placeholder="Name Your Rule" class="txt name">
                          <span class="error" id="rule_name_error"></span>
                        </div>
                        <div class="row terminate-application">
                          <input id="checkbox-terminate" class="checkbox-custom " name="terminate" value="1" type="checkbox">
                            <label for="checkbox-terminate" class="checkbox-custom-label ter">Terminate Application When Rule is Triggered?</label>
                        </div>
                    </div>
               </div>
        </div>
      </div>
      <div class="modal-footer">
       <button class="btn gray-btn"  data-dismiss="modal">Cancel</button>
        <button class="btn activate-btn save-rule" >Save</button>
      </div>

     </form> 

    </div>
  </div>
</div> 

<script type="text/javascript">
  var sUrl = '<?php echo base_url();?>index.php/rules';
  $(document).ready(function(){
      // show selected categories
      $(document).on('click', '.types', function(){
          $('.current_type').html( $(this).text() ); // show selected category
          $('#type').val( $(this).data('value') ); // set current category value in input field

          selected_type( $(this).data('value') );
      });

      $(document).on('click', '.category_list', function(){
          $('.current_category').html( $(this).text() ); // show selected category
          $('#category').val( $(this).data('value') ); // set current category value in input field
      });

      function selected_type( current_type ){

          // show all options in defaults
          if( current_type == "Title Bar" ){
              $('.every_second_div').hide();
              $('.one_screenshot_div').show();
              $('.poup-message-option').show();
              $('.popup-message-text').show();
              $('.keyword-contains').show();
              $('.keyword-contains').show();
              $('.terminate-application').show();           
          }
          else if( current_type == "Domain/URL" ){
              $('.every_second_div').hide();
              $('.one_screenshot_div').show();
              $('.poup-message-option').show();
              $('.popup-message-text').show();
              $('.keyword-contains').show();
              $('.keyword-contains').show();
              $('.terminate-application').show();
          }
          else if( current_type == "Time" ){
              $('.one_screenshot_div').hide();
              $('.poup-message-option').hide();
              $('.popup-message-text').hide();
              $('.keyword-contains').hide();
              $('.terminate-application').hide();
              $('.every_second_div').show();
          }
      }

      // save rules settings 
      $(document).on('submit', '#new-rule', function(){

          $('#category_error').html('');
          $('#screenshot_settings_error').html(''); // screenshot error message blank
          $('#rule_name_error').html(''); // rules blank message
          $('#type_error').html(''); // type error html blank
          $('#contains_error').html(''); // contans error is blank
          $('#popup_msg_error').html(''); // show popup message error is blank
          $('#seconds_error').html(''); // show second error is blank

          if( $('#type').val() == '' ){
              $('#type_error').html('Please select type');
              return false;
          }

          if( $('#category').val() == '' ){
              $('#category_error').html('Please select category');
              return false;
          }

          var screenshot_settings_flag = true;
          $('.screenshot_settings').each(function(key, value){
              if( $(this).is(':checked') ){
                  screenshot_settings_flag = false;  
              }
          });

          if( screenshot_settings_flag ){
              $('#screenshot_settings_error').html('Please choose screenshot setting options');
              return false;
          }

          // validate title bar and domain options
          if( $('#type').val() == "Title Bar" || $('#type').val() == "Domain/URL" ){
              if( $('#contains').val() == '' ){
                  $('#contains_error').html('Please enter keyword in contains');
                  return false;
              }

              if( $('#popup_msg').val() == '' ){
                  $('#popup_msg_error').html('Please enter popup message');
                  return false;
              }
          }
          else{

              if( $('.seconds').val() == '' || $('.seconds').val() < 1 ){
                  $('#seconds_error').html('Please select screenshot seconds')
                  return false;
              }
          }

          if( $('#rule_name').val() == '' ){
              $('#rule_name_error').html('Please enter rule name');
              return false;
          } 

          return true;
      });

      // delete rule
      $(document).on('click', '.delete-rule', function(){
          var ruleflag = false;
          $('.selected-rules').each(function(key, value){
              if( $(this).is(':checked') ){
                  ruleflag = true;
                  return false;
              }
          });

          if( ruleflag ){
              if( confirm('Are you sure want to delete rules!') ){
                  $('#rules-list-form').submit();
              }
          }
          else{
             alert('Please select rule');
             return false;
          }
      });

      
      // search restrictions
      $(document).on('click', '.search-restrictions', function(){
        // search record
        window.location.href = sUrl+"?s="+$('#s').val()+'&key='+Math.round( Math.random()*1000000);
      }); 

      // search record by enter
      $('#s').keypress(function(event){
        // search record
        if( event.keyCode == 13 )
          window.location.href = sUrl+"?s="+$('#s').val()+'&key='+Math.round( Math.random()*1000000);
      });

      // add rule
      $(document).on('click', '.add-new-rule', function(){
          $('#type').val('');
          $('#category').val('');
          $('#atype').val('add');
          $('#rule_name').val('');
          $('#popup_msg').val('');
          $('#contains').val('');
          $('.current_type').html('Type'); 
          $('.current_category').html('Select Category'); 
          $('.seconds').val('');
          $('.one_screenshot_div').show();
          $('.poup-message-option').show();
          $('.popup-message-text').show();
          $('.keyword-contains').show();
          $('.terminate-application').show();
          $('.every_second_div').show();
          $('#category_error').html('');
          $('#screenshot_settings_error').html(''); // screenshot error message blank
          $('#rule_name_error').html(''); // rules blank message
          $('#type_error').html(''); // type error html blank
          $('#contains_error').html(''); // contans error is blank
          $('#popup_msg_error').html(''); // show popup message error is blank
          $('#seconds_error').html(''); // show second error is blank
      });

      // edit rule
      $(document).on('click', '.edit-rule', function(){
          var $this;
          var count = 0;

           $('.selected-rules').each(function(key, value){
              if( $(this).is(':checked') ){
                  $this = $(this);
                  count++;
              }
          });

          if( count > 1 ){
              alert('Please select only single record');
              return false;
          }
          else if(count == 0){
              alert('Please select rule for edit');
              return false;
          }
          else if(count == 1){

              $('.add-new-rule').click();
              $('#atype').val('update');
              $('#_uid').val( $this.val() );

              // select type
              $('.types').each(function(key, value){
                  if( $(this).data('value') == $this.data('type') ){
                    $(this).click();
                    return false;
                  }
              });

              // select category
              $('.category_list').each(function(key, value){
                  if( $(this).html() == $this.data('category') ){
                    $(this).click();
                    return false;
                  }
              });

              // set rule name
              $('#rule_name').val( $this.data('name') );

              selected_type($this.data('type'));

              // check rule type
              if( $this.data('type') == "Title Bar" ||  $this.data('type') == "Domain/URL" ){
                  $('#popup_msg').val( $this.data('popupmessage') );
                  $('.one_screenshot_div').find('.screenshot_settings').click();
                  $('#contains').val( $this.data('contains') );   
                  if( $this.data('terminate') ){
                      $('#checkbox-terminate').click();
                  }             
              }
              else{
                  $('.every_second_div').find('.screenshot_settings').click();
                  $('.seconds').val( $this.data('everysecond') )
              }
          }
      });
      
  });

</script>

</body>
</html>