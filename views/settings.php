<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<?php include("include/header.php");?>

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
   
    <div class="settings-page">
    <p class="title">Settings</p>

      <?php if( $this->session->flashdata('notification') !== null ): ?>
         <?php  echo $this->session->flashdata('notification'); ?>
      <?php endif; ?>  
     

      <?= validation_errors(); ?>

      <ul class="nav nav-tabs">
        <li class="active categories-show"><a  data-toggle="tab" href="#categories"><i class="fa fa-tags"></i> Categories</a></li>
        <li><a data-toggle="tab" href="#sub-users"><i class="fa fa-users"></i> Sub-users</a></li>
        <li><a data-toggle="tab" href="#storage-settings"><i class="fa fa-cog"></i> Storage Settings</a></li>
        <li class="time-zone-show"><a data-toggle="tab" href="#time-zone"><i class="fa fa-clock-o"></i> Time Zone</a></li>
        <li><a data-toggle="tab" href="#user-profiles"><i class="fa fa-user"></i> User Profiles</a></li>
      </ul>
      <div class="tab-content">
        <div id="categories" class="tab-pane fade in active">
            <div id="categories-show">
              <!-- show time-zone content-->
            </div>
        </div>

        <div id="sub-users" class="tab-pane fade ">
          <div class="row cat">
            <div class="col-sm-4 col-md-3">
              <div class="input-group rest">
                <input type="text" placeholder="Search">
                <span class="input-group-addon"><i class="fa fa-search"></i></span> </div>
            </div>
          </div>
          <div class="row">
            <div class="table-responsive">
              <table class="table table-bordered rest-tbl">
                <thead>
                  <tr>
                    <th> </th>
                    <th>User Id</th>
                    <th>User Nickname</th>
                    <th>Productivity Meter</th>
                   
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td><input id="subUser-checkbox-1" class="checkbox-custom" type="checkbox">
                      <label for="subUser-checkbox-1" class="checkbox-custom-label"></label></td>
                    <td>123456</td>
                    <td>John PC</td>
                    <td><div class="productivity-meter-1"></div></td>
                   
                  </tr>
                  <tr class="active">
                    <td><input id="subUser-checkbox-2" class="checkbox-custom" type="checkbox" checked="">
                      <label for="subUser-checkbox-2" class="checkbox-custom-label"></label></td>
                    <td>234567</td>
                    <td>Nick user</td>
                    <td><div class="productivity-meter-1"></div></td>
                  
                  </tr>
                  <tr class="active">
                    <td><input id="subUser-checkbox-3" class="checkbox-custom" type="checkbox" checked="">
                      <label for="subUser-checkbox-3" class="checkbox-custom-label"></label></td>
                    <td>45675</td>
                    <td>John PC</td>
                    <td><div class="productivity-meter-1"></div></td>
                   
                  </tr>
                  <tr>
                    <td><input id="subUser-checkbox-4" class="checkbox-custom" type="checkbox">
                      <label for="subUser-checkbox-4" class="checkbox-custom-label"></label></td>
                    <td>876543</td>
                    <td>John PC</td>
                    <td><div class="productivity-meter-1"></div></td>
                   
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
          <div class="row">
            <div class="row btn-section">
              <div class="col-sm-6 col-md-4">
                <button class="btn yellow-btn" >Edit</button>             
                <button class="btn delete-btn" >Delete</button>
              </div>
              <div class="col-sm-6 col-md-8">
                <ul class="pagination pagination-sm tbl">
                  <li><a href="#"><i class="fa fa-angle-left"></i> Older</a></li>
                  <li><a href="#">1</a></li>
                  <li><a href="#">2</a></li>
                  <li><a href="#">3</a></li>
                  <li><a href="#">4</a></li>
                  <li><a href="#">5</a></li>
                  <li><a href="#">Newer <i class="fa fa-angle-right"></i></a></li>
                </ul>
              </div>
            </div>
          </div>
        </div>
        <div id="storage-settings" class="tab-pane fade ">
          <div class="row">
            <div class="col-md-12">
              <div class="row  conn">
                <button class="btn edit-btn">Connect Account with Amazon S3</button>
              </div>
            </div>
          </div>
        </div>

        <div id="time-zone" class="tab-pane fade ">
            <div id="time-zone-show">
              <!-- show time-zone content-->
            </div>
        </div>

        <div id="user-profiles" class="tab-pane fade ">
          <div class="row cat">
            <div class="col-sm-4 col-md-3">
              <div class="input-group rest">
                <input type="text" placeholder="Search">
                <span class="input-group-addon"><i class="fa fa-search"></i></span> </div>
            </div>
          </div>
          <div class="row">
            <div class="table-responsive">
              <table class="table table-bordered rest-tbl">
                <thead>
                  <tr>
                    <th> </th>
                    <th>User Id</th>
                    <th>Role</th>
                    <th>Access Control</th>
                   
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td><input id="profilesheckbox-1" class="checkbox-custom" type="checkbox">
                      <label for="profilesheckbox-1" class="checkbox-custom-label"></label></td>
                    <td>@gmail.com</td>
                    <td>Admin</td>
                    <td>All Computers</td>
                  
                  </tr>
                  <tr class="active">
                    <td><input id="profilesheckbox-2" class="checkbox-custom" type="checkbox" checked="">
                      <label for="profilesheckbox-2" class="checkbox-custom-label"></label></td>
                    <td>@gmail.com</td>
                    <td>Manager</td>
                    <td>Computer 1</td>
                   
                  </tr>
                  <tr class="active">
                    <td><input id="profilesheckbox-3" class="checkbox-custom" type="checkbox" checked="">
                      <label for="profilesheckbox-3" class="checkbox-custom-label"></label></td>
                    <td>@gmail.com</td>
                    <td>Admin</td>
                    <td>All Computers</td>
                   
                  </tr>
                  <tr>
                    <td><input id="profilesheckbox-4" class="checkbox-custom" type="checkbox">
                      <label for="profilesheckbox-4" class="checkbox-custom-label"></label></td>
                     <td>@gmail.com</td>
                    <td>Admin</td>
                    <td>All Computers</td>
                  
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
          <div class="row">
            <div class="row btn-section">
              <div class="col-sm-7 col-md-4">
                <button class="btn yellow-btn">Edit</button>
              
                <button class="btn delete-btn">Delete</button>
              </div>
              <div class="col-sm-5 col-md-8">
                <ul class="pagination pagination-sm tbl">
                  <li><a href="#"><i class="fa fa-angle-left"></i> Older</a></li>
                  <li><a href="#">1</a></li>
                  <li><a href="#">2</a></li>
                  <li><a href="#">3</a></li>
                  <li><a href="#">4</a></li>
                  <li><a href="#">5</a></li>
                  <li><a href="#">Newer <i class="fa fa-angle-right"></i></a></li>
                </ul>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<?php
  $queryString = '';
  if( isset( $_SERVER['QUERY_STRING'] ) ){
     $queryString = '?'.$_SERVER['QUERY_STRING'];
  }
?>

<script type="text/javascript">
  $(document).ready(function(){

    // category setting
    $(document).on('click', '.categories-show', function(){
       getCategories();
    });

    // get categories tab content
    function getCategories(){
      $.post("<?php echo site_url('settings/categories'),$queryString;?>", {}, function(res){
          if(res != ''){
              $('#categories-show').html( res );
          }
      });
    }
    getCategories();

    // time zone
    $(document).on('click', '.time-zone-show', function(){
        $.post("<?php echo site_url('settings/timeZone');?>", {}, function(res){
            if(res != ''){
                $('#time-zone-show').html( res );
            }
        });
    });

    // select timezone
    $(document).on('click', '.timezones', function(){
        $('.current-timezone').text( $(this).text() ); // change text button with selected item
        $('#description').val( $(this).text() ); // store timezone in description
        $('#timezone').val( $(this).data('value') ); // store selected item in timezone hidden field
        $('.timezone-error').html(''); // set blank error message
    });

    // select dateformat
    $(document).on('click', '.dateformat', function(){
        $('.current-dateformat').text( $(this).text() ); // change text button with selected item
        $('#dateformat').val( $(this).data('value') ); // store selected item in dateformat hidden field
        $('.dateformat-error').html(''); // set blank error message
    });

    // validate timezone form 
    $(document).on('submit', '#timezone-form', function(){
        // validate timezone
        if( $('#timezone').val() == '' ){

          $('.timezone-error').html('Please select timezone');
          return false;
        }

        // validate date format
        if( $('#dateformat').val() == '' ){
          $('.dateformat-error').html('Please select date format');
          return false;
        }

        return true; 
    });

  });
</script>

</body>
</html>