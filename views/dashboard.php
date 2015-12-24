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
         
				<div class="page-content">
                	<div class="row">
                        <div class="col-md-8 col-sm-8">
                        <div class="date-block">
                        <p class="heading text-left">Date Range</p>
                        <div class="col-sm-5 col-md-5">
                        <div class="input-group dash">
                            <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                             <input type="text" id="datefrom" placeholder="Select Date" readonly>
                         </div>
                         </div>
                          <div class="col-sm-1 col-md-1 text-center">
                            <span class="mob-view">To </span> 
                         </div>
                        <div class="col-sm-5 col-md-5">
                        <div class="input-group dash">
                            <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                             <input type="text" id="dateto" placeholder="Select Date" readonly>
                         </div>
                         </div>
                             <div class="col-sm-1 col-md-1"></div>
                       </div>
                        </div>
                        <div class="col-md-4 col-sm-4">
                            <div class="tag-block">
                                <img src="images/Camera.png" alt="" />
                                <p class="topspace">34 </p> 
                                 <p>Screenshots</p> 
                           </div>
                        </div>
                    </div>
                
                     <div class="category-detail">
                 	<div class="row">
         			<div class="col-md-3"><p class="heading text-left">Categories</p></div>
                   	<div class="col-md-9"> 	   
                    	<div class="product-btn">
                                <button class="btn activate-btn btn-sm">Application</button>
                                <button class="btn activate-btn">Website</button>
                                 <button class="btn activate-btn">All</button>
                            </div>
                   	</div>
                    </div>
                    <div class="row">
                    <div class="col-sm-12 col-md-10">
        				<div class="table-responsive">
            				<table class="table table-bordered">
                        <thead>
                          <tr>
                            <th> #</th>
                            <th>Category Name</th> 
                             <th>Type</th>
                            <th>Time(Hours)</th>
                            <th>Productive</th>
                          </tr>
                        </thead>
                        <tbody>
                          <tr>
                            <td>1</td>
                            <td>Adult</td>
                            <td>Website</td>
                             <td>9.2</td>
                           <td class="active"><i class="fa fa-check-circle"></i></td>
                          </tr>
                          <tr>
                            <td>2</td>
                            <td>Shopping</td>
                            <td>Application</td>
                             <td>8.2</td>
                           <td class="active"><i class="fa fa-times-circle"></i></td>
                          </tr>
                      	<tr>
                            <td>3</td>
                            <td>Games</td>
                            <td>Website</td>
                             <td>9.2</td>
                           <td ><i class="fa fa-check-circle"></i></td>
                          </tr>
                          <tr>
                            <td>4</td>
                            <td>Shopping</td>
                            <td>Website</td>
                             <td>9.2</td>
                           <td><i class="fa fa-times-circle"></i></td>
                          </tr>
                        </tbody>
                      </table>
            			</div>
            			<div class="row btn-section">
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
					</div>
                    </div>                  
         			<p class="heading text-left">Top Sites</p>                 	
                 	 <div class="row">
                    <div class="col-sm-12 col-md-10">
        				<div class="table-responsive">
            				<table class="table table-bordered">
                        <thead>
                          <tr>
                            <th> #</th>
                            <th>URL</th>
                            <th>Category</th>                             
                            <th>Time(Hours)</th>
                            <th>Productive</th>
                            <th>Unkhown</th>
                          </tr>
                        </thead>
                        <tbody>
                          <tr>
                            <td>1</td>
                            <td>Adult</td>
                            <td>http://adult.com/</td>
                             <td>9.2</td>
                           <td class="active"><i class="fa fa-check-circle"></i></td>
                            <td></td>
                          </tr>
                          <tr>
                            <td>2</td>
                            <td>Shopping</td>
                            <td>http://shopping.com</td>
                             <td>8.2</td>
                           <td class="active"><i class="fa fa-times-circle"></i></td>
                             <td></td>
                          </tr>
                      	<tr>
                            <td>3</td>
                            <td>Games</td>
                            <td>http://games.com</td>
                             <td>9.2</td>
                               <td></td>
                           <td class="active"><i class="fa fa-check-circle"></i></td>
                          </tr>
                          <tr>
                            <td>4</td>
                            <td>Shopping</td>
                            <td>http://adult.com/</td>
                             <td>9.2</td>
                           <td><i class="fa fa-times-circle"></i></td>
                             <td></td>
                          </tr>
                        </tbody>
                      </table>
            			</div>
            			<div class="row btn-section">
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
					</div>
                    </div>
                    <p class="heading text-left">Top Applications</p>                 	
                 	 <div class="row">
                    <div class="col-sm-12 col-md-10">
        				<div class="table-responsive">
            				<table class="table table-bordered">
                        <thead>
                          <tr>
                            <th> #</th>
                            <th>Title Bar</th>
                            <th>Category</th>                             
                            <th>Time(Hours)</th>
                            <th>Productive</th>
                            <th>Unkhown</th>
                          </tr>
                        </thead>
                        <tbody>
                          <tr>
                            <td>1</td>
                            <td>Skype</td>
                            <td>Communication</td>
                             <td>9.2</td>
                           <td class="active"><i class="fa fa-check-circle"></i></td>
                            <td></td>
                          </tr>
                          <tr>
                            <td>2</td>
                            <td>Google Chrome</td>
                            <td>Browser</td>
                             <td>8.2</td>
                           <td class="active"><i class="fa fa-times-circle"></i></td>
                             <td></td>
                          </tr>
                      	<tr>
                            <td>3</td>
                            <td>Skype</td>
                            <td>Communication</td>
                             <td>9.2</td>
                               <td></td>
                           <td class="active"><i class="fa fa-check-circle"></i></td>
                          </tr>
                          <tr>
                            <td>4</td>
                            <td>Photoshop</td>
                            <td>Undefined</td>
                             <td>9.2</td>
                           <td><i class="fa fa-times-circle"></i></td>
                             <td></td>
                          </tr>
                        </tbody>
                      </table>
            			</div>
            			<div class="row btn-section">
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
					</div>
                    </div>
				
            </div>
           	
                     <div class="row recent">
                       <p class="heading text-left">Recent Screenshots</p>       
                     	<div class="col-sm-4 col-md-4">
                        	<div class="img-block">
								<img src="<?php echo base_url()?>assets/images/screen.png" alt=""/>                            
                            </div>
                        </div>
                     	<div class="col-sm-4 col-md-4">
                        	<div class="img-block">
								<img src="<?php echo base_url()?>assets/images/screen.png" alt=""/>                            
                            </div>
                        </div>
                        <div class="col-sm-4 col-md-4">
                        	<div class="img-block">
								<img src="<?php echo base_url()?>assets/images/screen.png" alt=""/>                            
                            </div>
                        </div>
                     </div>
        		</div>
        		
				
        </div>
    </div>
    <a href="#menu-toggle" class="btn btn-default pull-right" id="menu-toggle">Toggle Menu</a>
               
</body>
</html>