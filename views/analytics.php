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
     
        <div class="analytics-page">
                <p class="title">Analytics</p>
                   <ul class="nav nav-tabs">
                    <li class="active"><a  data-toggle="tab" href="#websites"><i class="fa fa-globe"></i> Top Websites</a></li>
                    <li><a data-toggle="tab" href="#application" class="application-tab"><i class="fa fa-file-text-o"></i> Top Application</a></li>
                    <li><a data-toggle="tab" href="#categories"><i class="fa fa-tags"></i> Top Categories</a></li>
          <li><a data-toggle="tab" href="#activity-log"><i class="fa fa-pencil-square-o"></i> Activity Log</a></li>
                  </ul>
          <div class="tab-content">
          <div id="websites" class="tab-pane fade in active">           
            <div class="row">
              <ul class="analytics-filter">
                              <!-- <li>
                                  <div class="dropdown">
                                  <button class="btn activate-btn dropdown-toggle" type="button" data-toggle="dropdown">Data Filter
                                 <i class="fa fa-caret-down"></i></button>
                                  <ul class="dropdown-menu filter">
                                    <li><a href="#">Data Filter</a></li>
                                    <li><a href="#">Data Filter</a></li>
                                    <li><a href="#">Data Filter</a></li>
                                  </ul>
                                </div>
                                </li> -->
                                <li>
                                  <div class="dropdown">
                                  <button class="btn activate-btn dropdown-toggle" type="button" data-toggle="dropdown">User Filter
                                 <i class="fa fa-caret-down"></i></button>
                                  <ul class="dropdown-menu filter">
                                    
                                    <?php if( count($users) > 0 ): ?>
                                        <li><a  href="<?php echo base_url() ?>index.php/screenshots">All</a></li>
                                        <?php foreach( $users as $key=>$value ): ?>
                                          <li><a  href="<?php echo $userUrl; ?>&user_filter=<?php echo $value->id; ?>"><?php echo ucfirst($value->user_name); ?></a></li>
                                        <?php endforeach; ?>
                                    <?php endif; ?>

                                  </ul>
                                </div>
                                </li>
                                <li>
                                  <div class="dropdown">
                                  <button class="btn activate-btn dropdown-toggle" type="button" data-toggle="dropdown">Computer Filter
                                  <i class="fa fa-caret-down"></i></button>
                                  <ul class="dropdown-menu filter">
                                    
                                    <?php if( count($comps) > 0 ): ?>
                                        <li><a  href="<?php echo base_url() ?>index.php/screenshots">All</a></li>
                                        <?php foreach( $comps as $key=>$value ): ?>
                                            <li><a href="<?php echo $comUrl; ?>&com_filter=<?php echo $value->sysName; ?>"><?php echo ucfirst($value->sysName); ?></a></li>
                                        <?php endforeach; ?>
                                    <?php endif; ?>

                                  </ul>
                                </div>
                              </li>
                                 <li>
                                  <div class="dropdown">
                                  <button class="btn activate-btn dropdown-toggle" type="button" data-toggle="dropdown">Productivity
                                  <i class="fa fa-caret-down"></i></button>
                                  <ul class="dropdown-menu filter">
                                    <li><a href="#">Computer Filter</a></li>
                                    <li><a href="#">Computer Filter</a></li>
                                    <li><a href="#">Computer Filter</a></li>
                                  </ul>
                                </div>
                                </li>
                                 <li><button class="btn btn-green" type="button" >Export</button></li>
                             </ul>
            </div>
                        <!-- <div class="row chart-block">
                          <div class=" col-sm-6 col-md-6">
                          <img src="images/chart.png" alt="" />
                                
                            </div>
                         
                            <div class=" col-sm-6 col-md-6">
                              <img src="images/chart.png" alt="" />
                                
                         
                            </div>
                        </div> -->
                        <div class="row">
                          <div class="table-responsive col-sm-10 col-md-10">
                      <!-- <table class="table table-bordered ">
                        <thead>
                          <tr>
                            <th></th> 
                             <th>Website</th>
                            <th>Time</th>
                            <th>Percentage</th>
                            <th></th>
                            <th>Page Title</th>
                            <th>Time</th>
                            
                          </tr>
                        </thead>
                        <tbody>
                          <tr>
                            <td><div class="color-block f"></div></td>
                            <td>Banking</td>
                            <td>01:00:00</td>
                             <td>23%</td>
                          <td><div class="color-block f1"></div></td>
                            <td>Banking</td>
                            <td>01:00:00</td>
                          </tr>
                          <tr>
                            <td><div class="color-block s"></div></td>
                            <td>Shopping</td>
                              <td>01:00:00</td>
                             <td>23%</td>
                             <td><div class="color-block s1"></div></td>
                            <td>Banking</td>
                            <td>01:00:00</td>
                          
                          </tr>
                        <tr>
                            <td><div class="color-block t"></div></td>
                            <td>Games</td>
                              <td>01:00:00</td>
                             <td>23%</td>
                          <td><div class="color-block t1"></div></td>
                            <td>Banking</td>
                            <td>01:00:00</td>
                          </tr>
                          <tr>
                            <td><div class="color-block fr"></div></td>
                            <td>Shopping</td>
                             <td>01:00:00</td>
                             <td>23%</td>
                             <td><div class="color-block fr1"></div></td>
                            <td>Banking</td>
                            <td>01:00:00</td>
                          
                          </tr>
                           <tr>
                            <td><div class="color-block fif"></div></td>
                            <td>Shopping</td>
                             <td>01:00:00</td>
                             <td>23%</td>
                          <td><div class="color-block fif1"></div></td>
                            <td>Shopping</td>
                             <td>01:00:00</td>
                            
                          </tr>
                        </tbody>
                      </table> -->
                  </div>
                          
                        </div>
          </div>
           <div id="application" class="tab-pane fade ">

              <div class="application-data" >
                  <!-- show application data -->
              </div>
              
           </div>
           <div id="categories" class="tab-pane fade ">
            <div class="row">
              <ul class="analytics-filter">
                             <!--  <li>
                                  <div class="dropdown">
                                  <button class="btn activate-btn dropdown-toggle" type="button" data-toggle="dropdown">Data Filter
                                 <i class="fa fa-caret-down"></i></button>
                                  <ul class="dropdown-menu filter">
                                    <li><a href="#">Data Filter</a></li>
                                    <li><a href="#">Data Filter</a></li>
                                    <li><a href="#">Data Filter</a></li>
                                  </ul>
                                </div>
                                </li> -->
                                <li>
                                  <div class="dropdown">
                                  <button class="btn activate-btn dropdown-toggle" type="button" data-toggle="dropdown">User Filter
                                 <i class="fa fa-caret-down"></i></button>
                                  <ul class="dropdown-menu filter">
                                  
                                    <?php if( count($users) > 0 ): ?>
                                        <li><a  href="<?php echo base_url() ?>index.php/screenshots">All</a></li>
                                        <?php foreach( $users as $key=>$value ): ?>
                                          <li><a  href="<?php echo $userUrl; ?>&user_filter=<?php echo $value->id; ?>"><?php echo ucfirst($value->user_name); ?></a></li>
                                        <?php endforeach; ?>
                                    <?php endif; ?>  

                                  </ul>
                                </div>
                                </li>
                                <li>
                                  <div class="dropdown">
                                  <button class="btn activate-btn dropdown-toggle" type="button" data-toggle="dropdown">Computer Filter
                                  <i class="fa fa-caret-down"></i></button>
                                  <ul class="dropdown-menu filter">
                                    
                                    <?php if( count($comps) > 0 ): ?>
                                        <li><a  href="<?php echo base_url() ?>index.php/screenshots">All</a></li>
                                        <?php foreach( $comps as $key=>$value ): ?>
                                            <li><a href="<?php echo $comUrl; ?>&com_filter=<?php echo $value->sysName; ?>"><?php echo ucfirst($value->sysName); ?></a></li>
                                        <?php endforeach; ?>
                                    <?php endif; ?>

                                  </ul>
                                </div>
                              </li>
                                 <li>
                                  <div class="dropdown">
                                  <button class="btn activate-btn dropdown-toggle" type="button" data-toggle="dropdown">Productivity
                                  <i class="fa fa-caret-down"></i></button>
                                  <ul class="dropdown-menu filter">
                                    <li><a href="#">Computer Filter</a></li>
                                    <li><a href="#">Computer Filter</a></li>
                                    <li><a href="#">Computer Filter</a></li>
                                  </ul>
                                </div>
                                </li>
                                 <li><button class="btn btn-green" type="button" >Export</button></li>
                             </ul>
            </div>
                         <!-- <div class="row chart-block">
                          <div class=" col-sm-6 col-md-6">
                          <img src="images/chart.png" alt="" />
                                
                            </div>
                         
                        </div> -->
                        <div class="row">
                          <div class="table-responsive col-sm-8 col-md-8">
                   <!--  <table class="table table-bordered ">
                        <thead>
                          <tr>
                            <th></th> 
                             <th>Category</th>
                            <th>Time</th>
                            <th>Percentage</th>
                            
                          </tr>
                        </thead>
                        <tbody>
                          <tr>
                            <td><div class="color-block f"></div></td>
                            <td>Banking</td>
                            <td>01:00:00</td>
                             <td>23%</td>
                         
                          </tr>
                          <tr>
                            <td><div class="color-block s"></div></td>
                            <td>Shopping</td>
                              <td>01:00:00</td>
                             <td>23%</td>
                          
                          </tr>
                        <tr>
                            <td><div class="color-block t"></div></td>
                            <td>Games</td>
                              <td>01:00:00</td>
                             <td>23%</td>
                        
                          </tr>
                          <tr>
                            <td><div class="color-block fr"></div></td>
                            <td>Shopping</td>
                             <td>01:00:00</td>
                             <td>23%</td>
                          
                          </tr>
                           <tr>
                            <td><div class="color-block fif"></div></td>
                            <td>Shopping</td>
                             <td>01:00:00</td>
                             <td>23%</td>
                          
                          </tr>
                        </tbody>
                      </table> -->
                  </div>
                           
                        </div>
           </div>
           <div id="activity-log" class="tab-pane fade ">
            <div class="row">
              <ul class="analytics-filter">
                              <!-- <li>
                                  <div class="dropdown">
                                  <button class="btn activate-btn dropdown-toggle" type="button" data-toggle="dropdown">Data Filter
                                 <i class="fa fa-caret-down"></i></button>
                                  <ul class="dropdown-menu filter">
                                    <li><a href="#">Data Filter</a></li>
                                    <li><a href="#">Data Filter</a></li>
                                    <li><a href="#">Data Filter</a></li>
                                  </ul>
                                </div>
                                </li> -->
                                <li>
                                  <div class="dropdown">
                                  <button class="btn activate-btn dropdown-toggle" type="button" data-toggle="dropdown">User Filter
                                 <i class="fa fa-caret-down"></i></button>
                                  <ul class="dropdown-menu filter">
                                   
                                    <?php if( count($users) > 0 ): ?>
                                        <li><a  href="<?php echo base_url() ?>index.php/screenshots">All</a></li>
                                        <?php foreach( $users as $key=>$value ): ?>
                                          <li><a  href="<?php echo $userUrl; ?>&user_filter=<?php echo $value->id; ?>"><?php echo ucfirst($value->user_name); ?></a></li>
                                        <?php endforeach; ?>
                                    <?php endif; ?>

                                  </ul>
                                </div>
                                </li>
                                <li>
                                  <div class="dropdown">
                                  <button class="btn activate-btn dropdown-toggle" type="button" data-toggle="dropdown">Computer Filter
                                  <i class="fa fa-caret-down"></i></button>
                                  <ul class="dropdown-menu filter">
                                      
                                      <?php if( count($comps) > 0 ): ?>
                                        <li><a  href="<?php echo base_url() ?>index.php/screenshots">All</a></li>
                                        <?php foreach( $comps as $key=>$value ): ?>
                                            <li><a href="<?php echo $comUrl; ?>&com_filter=<?php echo $value->sysName; ?>"><?php echo ucfirst($value->sysName); ?></a></li>
                                        <?php endforeach; ?>
                                      <?php endif; ?>

                                  </ul>
                                </div>
                              </li>
                                 <li>
                                  <div class="dropdown">
                                  <button class="btn activate-btn dropdown-toggle" type="button" data-toggle="dropdown">Productivity
                                  <i class="fa fa-caret-down"></i></button>
                                  <ul class="dropdown-menu filter">
                                    <li><a href="#">Computer Filter</a></li>
                                    <li><a href="#">Computer Filter</a></li>
                                    <li><a href="#">Computer Filter</a></li>
                                  </ul>
                                </div>
                                </li>
                                 <li><button class="btn btn-green" type="button" >Export</button></li>
                             </ul>
            </div>
                        <div class="row cat">
                          <div class="table-responsive  col-sm-10 col-md-10">
                   <!--  <table class="table table-bordered rest-tbl">
                        <thead>
                          <tr>
                            <th>Screenshot </th>
                            <th>Date</th> 
                             <th>Time</th>
                            <th>User Name</th>
                            <th>Duration</th>
                             <th>Page/Window Title</th>
                              <th>URL</th>
                          </tr>
                        </thead>
                        <tbody>
                          <tr>
                            <td></td>
                            <td>05/11/15</td>
                           <td>13:00:44</td>
                            <td>User 1</td>
                            <td>00:44:65</td>
                            <td></td>
                            <td></td>
                          </tr>
                         <tr>
                            <td></td>
                            <td>05/11/15</td>
                           <td>13:00:44</td>
                            <td>User 1</td>
                            <td>00:44:65</td>
                            <td></td>
                            <td></td>
                          </tr>
                        <tr>
                            <td></td>
                            <td>05/11/15</td>
                           <td>13:00:44</td>
                            <td>User 1</td>
                            <td>00:44:65</td>
                            <td></td>
                            <td></td>
                          </tr>
                         <tr>
                            <td></td>
                            <td>05/11/15</td>
                           <td>13:00:44</td>
                            <td>User 1</td>
                            <td>00:44:65</td>
                            <td></td>
                            <td></td>
                          </tr>
                         
                        </tbody>
                      </table> -->
                  </div>
                        </div>
                        <!-- <div class="row">
                          <div class="col-sm-5 col-md-6">
                                      <div class="dropdown">
                                          <button class="btn activate-btn dropdown-toggle" type="button" data-toggle="dropdown">Results Per Page
                                         <i class="fa fa-caret-down"></i></button>
                                          <ul class="dropdown-menu filter ">
                                            <li><a href="#">Results Per Page</a></li>
                                            <li><a href="#">Results Per Page</a></li>
                                            <li><a href="#">Results Per Page</a></li>
                                          </ul>
                                        </div>
                              </div>
                              <div class="col-sm-7 col-md-6">
                                        <ul class="pagination pagination-sm ">
                                            <li><a href="#"><i class="fa fa-angle-left"></i> Older</a></li>
                                            <li><a href="#">1</a></li>
                                             <li><a href="#">2</a></li>
                                              <li><a href="#">3</a></li> 
                                              <li><a href="#">4</a></li>
                                               <li><a href="#">5</a></li>
                                            <li><a href="#">Newer <i class="fa fa-angle-right"></i></a></li>
                                  </ul>
                                </div>
                                    </div> -->
           </div>
        </div>
            </div>        
        </div>
    </div>

<script type="text/javascript">
  $(document).ready(function(){
      $(document).on('click', '.application-tab', function(){
          $.post("<?php echo site_url('analytics/applicationData'); ?>", {}, function(res){
              if(res != ''){
                  $('.application-data').html( res );
              }
          });
      });
  })
</script>

</body>

</html>