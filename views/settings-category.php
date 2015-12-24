<div class="row cat">
  <div class="col-sm-12 col-md-3"></div>
   <div class="col-sm-4 col-md-3">
    <div class="input-group search">
      <input type="text" name="s" id="s" placeholder="Title Bar">
      <span class="input-group-addon search-restrictions"><i class="fa fa-search" style="cursor:pointer;"></i></span> 
    </div>
   </div>
    <div class="col-sm-4 col-md-3">
      <button class="btn btn-green productive-action" type="button">Mark as Productive</button>
    </div>
    <div class="col-sm-4 col-md-3">
      <button class="btn delete-btn unproductive-action" type="button">Mark as Unproductive</button>
    </div>
  </div>
  <div class="row">
    <div class="col-sm-6 col-md-3">
      
      <?php if( count( $categories ) > 0 ): ?>

      <div class="dropdown">
        <button class="btn activate-btn dropdown-toggle" type="button" data-toggle="dropdown"> <span class="current-category-list"> Category </span> <i class="fa fa-caret-down"></i></button>
        <ul class="dropdown-menu filter" style="height:400px; overflow:auto;">

            <li><a href="<?php echo site_url('settings'); ?>">All Category</a></li>
            <?php foreach( $categories as $category ): ?>
            <li><a class="main-category-list" data-value="<?php echo $category->cat_id; ?>" href="<?php echo site_url('settings'); ?>?cat=<?php echo $category->cat_id; ?>&token=<?php echo md5(rand(1111, 9999)); ?>"><?php echo $category->cat_name; ?></a></li>
            <?php endforeach; ?>

        </ul>
      </div>

      <?php endif; ?>

    </div>
    <div class="col-sm-12 col-md-9">
    
    <div class="row">
      <div class="col-md-12">
        <div class="table-responsive">

        <form action="<?php echo site_url('settings/manageActions'); ?>" method="post" id="setting-category-form">
        <input type="hidden" name="atype" id="atype" value="" />
          <table class="table table-bordered rest-tbl">
            <thead>
              <tr>
                <th> </th>
                <th>Domain</th>
                <th>Application Name</th>
                <th>Category</th>
                <th>Productive</th>
                <th>Usage %</th>
               
              </tr>
            </thead>
            <tbody>

            <?php if( count($settingCategory) > 0 ): ?>

             <?php foreach($settingCategory as $category): ?>

              <tr class="active">
                <td>
                  <input value="<?php echo $category->id; ?>" name="settings_category[]" 
                  data-uid="<?php echo $category->id; ?>"
                  data-domain="<?php echo $category->domain_name; ?>" 
                  data-application="<?php echo $category->application_name; ?>"
                  data-category="<?php echo $category->category; ?>"
                  data-productive="<?php echo $category->productive; ?>" 
                  class="selected-set-category" type="checkbox"></td>

                <td><?php echo $category->domain_name; ?></td>
                <td><?php echo $category->application_name; ?></td>
                <td><?php if($category->category != 0): ?>Yes <?php else: ?> No <?php endif; ?></td>
                <td><?php if($category->productive == 1): ?>Active <?php else: ?> Inactive <?php endif; ?></td>
                <td></td>
              
              </tr>
              <?php endforeach; ?>
            <?php else: ?>
              <tr colspan="6">Record not exists!</tr>
            <?php endif; ?>  
              
            </tbody>
          </table>
          
          </form>

        </div>
      </div>
    </div>
    <div class="row">
      <div class="row btn-section">
        <div class="col-sm-4 col-md-2">
          <button class="btn activate-btn create-new" id="downloadbtn" data-toggle="modal" data-target="#addNewCategory">Create New</button>
        </div>
        <div class="col-sm-4 col-md-2">
          <button class="btn yellow-btn edit-set-cat" id="downloadbtn">Edit</button>
        </div>
        <div class="col-sm-4 col-md-2">
          <button class="btn delete-btn delete-set-cat" id="downloadbtn">Delete</button>
        </div>
        <div class="col-sm-12 col-md-6">
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

<div id="addNewCategory" class="modal fade in" role="dialog">
  <div class="modal-dialog">

    <div class="modal-content addnew">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">×</button>
        <h4 class="modal-title">Add New Categories</h4>
      </div>

      <form name="create_category" id="create_category" method="post" action="<?php echo site_url('settings/storeCategory');?>" >

      <input type="hidden" name="actype" id="actype" value="add">
      <input type="hidden" name="mark_as" id="mark-as" value="">
      <input type="hidden" name="category" id="category" value="">
      <input type="hidden" name="_uid" id="_uid" value="">

      <div class="modal-body">
      
        <div class="row cat">
          <div class="col-md-8">                
                <input type="text" placeholder="Domain Name"  name="domain_name" id="domain_name" class="txt website name-group">
            </div>
            <div class="error" id="domain-error"></div>
        </div>
        <div class="row cat">
          <div class="col-md-8">                
                  <input type="text" placeholder="Application Name"  name="application_name" id="application_name" class="txt website">
          </div>
          <div class="error" id="application-error"></div>
        </div>

        <div class="row cat">
          <div class="col-md-7">                
                <div class="dropdown open">
                    <button class="btn activate-btn dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="true"> <span class="current-markas">Mark As</span>
                    <i class="fa fa-caret-down"></i></button>
                    <ul class="dropdown-menu filter">
                      <li><a href="javascript:;" class="mark-as" data-value="1">Productive</a></li>
                      <li><a href="javascript:;" class="mark-as" data-value="0">Unproductive</a></li>
                     </ul>
                     <span class="error" id="mark_as-error"></span>
                  </div>
          </div>
        </div>

        <?php if( count( $categories ) > 0 ): ?>
        <div class="row cat">
          <div class="col-md-7">                
                <div class="dropdown open">
                    <button class="btn activate-btn dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="true"><span class="current-category">Category</span>
                    <i class="fa fa-caret-down"></i></button>
                    <ul class="dropdown-menu filter" style="height:250px; overflow:auto;">
                     <li><a href="javascript:;" class="categories" data-value="0">Select Category</a></li>
                      <?php foreach( $categories as $category ): ?>
                      <li><a href="javascript:;" class="categories" data-value="<?php echo $category->cat_id; ?>"><?php echo $category->cat_name; ?></a></li>
                      <?php endforeach; ?>
                     </ul>
                     <span class="error" id="category-error"></span>
                  </div>
          </div>
        </div>
        <?php endif; ?>

      </div>
      <div class="modal-footer">
        <button class="btn gray-btn" data-dismiss="modal">Cancel</button>
        <input type="submit" class="btn activate-btn add-button" name="Submit" value="Add">
      </div>

      </form>

      <script src="<?php echo base_url(); ?>assets/js/jquery.validate.min.js"></script>

      <script type="text/javascript">

        // show current category that 
        <?php if( isset($_GET['cat']) ): ?>
            $('.main-category-list').each(function(){
                if( $(this).data('value') == '<?php echo $_GET['cat']; ?>' ){
                    $('.current-category-list').html( $(this).text() );
                    return;
                }
            });
        <?php endif; ?>

        // show selected categories
        $(document).on('click', '.categories', function(){
            $('.current-category').html( $(this).text() ); // show selected category
            $('#category').val( $(this).data('value') ); // set current category value in input field
            $('#category-error').html('');
        });

        // show selected mark as
        $(document).on('click', '.mark-as', function(){
            $('.current-markas').html( $(this).text() ); // show selected category
            $('#mark-as').val( $(this).data('value') ); // set current mark as value in input field
            $('#mark_as-error').html('');
        });

       $(document).on('submit', '#create_category', function(){

            $('#domain-error').html('');
            $('#application-error').html('');

            // validate domain name or application name 
            if(  $('#domain_name').val() == '' && $('#application_name').val() == '' ){
                $('#domain-error').html('Please fill atleast 1 field');
                $('#application-error').html('Please fill atleast 1 field');
                return false;
            }

            // validate mark as
            if( $('#mark-as').val() == '' ){
              $('#mark_as-error').html('Please select mark as option');
              return false;
            }

            // validate category
            // if( $('#category').val() == '' ){
            //   $('#category-error').html('Please select category');
            //   return false;
            // }

            return true;
       });

       $(document).on('click', '.create-new', function(){
          $('#actype').val('add');
          $('#domain_name').val(''); // set domain name
          $('#application_name').val(''); // set application name
          $('.current-category').html('Category');
          $('.current-markas').html('Mark As'); // show selected category
          $('.add-button').val('Add');
       });
      

       var sUrl = '<?php echo site_url("settings"); ?>'; 
       <?php if( count($settingCategory) > 0 ): ?>


          // manage delete action
          $(document).on('click', '.edit-set-cat', function(){

            var counter = 0;
            var $this = '';
            
            $('.selected-set-category').each(function(key, value){
                if( $(this).is(':checked') ){
                    counter++;
                    $this = $(this);
                }
            });

            if( counter == 1 ){

                $('.create-new').click();

                $('#domain_name').val( $this.data('domain') ); // set domain name
                $('#application_name').val( $this.data('application') ); // set application name
                $('#_uid').val( $this.data('uid') );

                // set category selected
                $('.categories').each(function(key, value){
                    if( $(this).data('value') == $this.data('category') ){
                        $('.categories').eq(key).click();
                    }
                });

               // set mark as
               $('.mark-as').each(function(key, value){
                  if( $(this).data('value') == $this.data('productive') ){
                      $('.mark-as').eq(key).click();
                  }
                });

               $('#actype').val('update'); //set atype
               $('.add-button').val('Update');
            }
            else if( counter > 1 ){
                alert('Sorry, you can\'t edit more than one at a time');
            }
            else if( counter == 0 ){
                alert('Please select any one category setting');
            }

          }); 

          // manage actions like productive
          $(document).on('click', '.productive-action', function(){
              var flag = false;
              $('#atype').val('productive'); //set atype

              $('.selected-set-category').each(function(key, value){
                  if( $(this).is(':checked') ){
                      flag = true;
                      return;
                  }
              });

              // if flag is true then submit form
              if(flag){
                  $('#setting-category-form').submit();
              }
              else{
                alert('Please select category settings');
              }
          });

         // manage actions like unproductive
         $(document).on('click', '.unproductive-action', function(){
            var flag = false;
            $('#atype').val('unproductive'); //set atype

            $('.selected-set-category').each(function(key, value){
                if( $(this).is(':checked') ){
                    flag = true;
                    return;
                }
            });

            // if flag is true then submit form
            if(flag){
                $('#setting-category-form').submit();
            }
            else{
              alert('Please select category settings');
            }

          });

         // manage actions like delete settings category
         $(document).on('click', '.delete-set-cat', function(){
            var flag = false;
            $('#atype').val('delete'); //set atype

            $('.selected-set-category').each(function(key, value){
                if( $(this).is(':checked') ){
                    flag = true;
                    return;
                }
            });

            // if flag is true then submit form
            if(flag){
              $('#setting-category-form').submit();
            }
            else{
              alert('Please select category settings');
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

       <?php endif; ?>

      </script>



    </div>
  </div>
</div>