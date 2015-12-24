<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<?php include("include/header.php");?>

<link rel="stylesheet" href="<?php echo base_url()?>assets/screenshot/css/screenshot.css"> 

<link rel="stylesheet" href="<?php echo base_url()?>assets/img-preview/css/photoswipe.css"> 

<link rel="stylesheet" href="<?php echo base_url()?>assets/img-preview/css/default-skin.css"> 

<!-- Core JS file -->
<script src="<?php echo base_url()?>assets/img-preview/js/photoswipe.min.js"></script> 

<!-- UI JS file -->
<script src="<?php echo base_url()?>assets/img-preview/js/photoswipe-ui-default.min.js"></script> 
 
<?php
  
  // check per_page in url
  $per_page = '12 Per Page';
  if( isset( $_REQUEST['per_page_rec']) ){
     $per_page = $_REQUEST['per_page_rec'].' Per Page';
  }

  // check user filter
  $filter_user = 'User Filter';
  if( isset( $_REQUEST['user_filter']) ){
    foreach( $users as $key=>$value ){
        if( $_REQUEST['user_filter'] ==  $value->id){
          $filter_user = $value->user_name;  
          break;
        }
    }
  }

   // check user filter
  $filter_com = 'Computer Filter';
  if( isset( $_REQUEST['com_filter']) ){
      $filter_com = $_REQUEST['com_filter'];
  }
  
?>

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
      
        <div class="screenshots-page">
                  <div class="row">
                      <div class="col-md-12">
                          <p class="title text-left">Screenshots &nbsp;&nbsp;<?php if( isset($this->session->userdata) ): echo $this->session->userdata('username');  endif;?></p>
                          <p class="heading text-left">Filters</p>
                             <ul class="screenshots-filter">
                              <li>
                                  <div class="dropdown">
                                  <button class="btn activate-btn dropdown-toggle" type="button" data-toggle="dropdown">Data Filter
                                 <i class="fa fa-caret-down"></i></button>
                                  <ul class="dropdown-menu filter">
                                    <li><a href="#">Data Filter</a></li>
                                    <li><a href="#">Data Filter</a></li>
                                    <li><a href="#">Data Filter</a></li>
                                  </ul>
                                </div>
                                </li>
                                <li>
                                  <div class="dropdown">
                                  <button class="btn activate-btn dropdown-toggle" type="button" data-toggle="dropdown"> <?php echo ucfirst($filter_user); ?>
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
                                  <button class="btn activate-btn dropdown-toggle" type="button" data-toggle="dropdown"> <?php echo $filter_com; ?>
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
                                  <button class="btn btn-green dropdown-toggle" type="button" data-toggle="dropdown">Export Screenshots
                                  <i class="fa fa-caret-down"></i></button>
                                  <ul class="dropdown-menu filter">
                                    <li><a href="javascript:;" class="download_screenshot" data-value="current">Current</a></li>
                                    <li><a href="javascript:;" class="download_screenshot" data-value="all">All</a></li>
                                  </ul>
                                </div>
                                </li>
                                 <li>
                                  <div class="dropdown">
                                  <button class="btn edit-btn dropdown-toggle" type="button" data-toggle="dropdown">Delete Screenshots
                                  <i class="fa fa-caret-down"></i></button>
                                  <ul class="dropdown-menu filter">
                                    <li><a href="javascript:;" class="delete_screenshot" data-value="current">Current</a></li>
                                    <li><a href="javascript:;" class="delete_screenshot" data-value="all">All</a></li>
                                  </ul>
                                </div>
                                </li>
                             </ul>
                             <ul class="screenshots-search">
                              <li>
                                  <div class="input-group search">                                        
                                         <input type="text" placeholder="Title Bar">
                                         <span class="input-group-addon"><i class="fa fa-search"></i></span>
                                     </div>
                                </li>
                                <li>
                                  <div class="input-group search">                                        
                                         <input type="text" placeholder="URL">
                                         <span class="input-group-addon"><i class="fa fa-search"></i></span>
                                     </div>
                                </li>
                                <li>
                                  <div class="input-group search">                                        
                                         <input type="text" placeholder="Application">
                                         <span class="input-group-addon"><i class="fa fa-search"></i></span>
                                     </div>
                                </li>
                                <li>
                                  <div class="input-group search">                                        
                                         <input type="text" placeholder="Executable File">
                                         <span class="input-group-addon"><i class="fa fa-search"></i></span>
                                     </div>
                                </li>
                             </ul>


                             <div class="result-img">

                             <!-- show screenshots -->
                              <?php if( count( $screenshots ) > 0 ): ?>

                                <div class="my-gallery" itemscope itemtype="http://schema.org/ImageGallery">

                                <form method="post" action="" id="screenshot_form" data-url="<?php echo base_url();?>index.php/screenshots/">  
                                
                                <input type="hidden" name="dtype" value="" id="dtype" />
                                <input type="hidden" name="_c_uri" value="<?php echo $_SERVER['REQUEST_URI']; ?>" />  
                                  
                                <?php foreach( $screenshots as $key=>$value ): ?>
                               
                                <input type="hidden" name="_screenshots[]" value="<?php echo $value->id; ?>" />
                               
                                <?php if( ($key+1)%4 == 0 ): ?>  
                               
                                <div class="row rs">
                               
                                <?php endif; ?>

                                        <div class="col-sm-6 col-md-3">
                                            <div class="img-block1">
                                                  <figure itemprop="associatedMedia" itemscope itemtype="http://schema.org/ImageObject">
                                                    <a href="<?php echo base_url(); ?>uploads/screenshots/<?php echo $value->filename; ?>" itemprop="contentUrl" data-size="1024x700">
                                                        <span class="rollover"></span> 
                                                        <img src="<?php echo base_url(); ?>uploads/screenshots/thumb/<?php echo $value->filename; ?>" itemprop="thumbnail" alt="Image description" />
                                                    </a>
                                                    <p><?php echo ucfirst($value->user_name),'  ', date('d M Y', strtotime($value->date)),' ', $value->time; ?>
                                                      <a class="download" href="<?php echo base_url(); ?>index.php/screenshots/downloadSingleFile/<?php echo $value->filename; ?>" title="Download" ><img src="<?php echo base_url(); ?>assets/screenshot/images/download.png" /></a>
                                                    </p>                                      
                                                  </figure>
                                                
                                            </div>                                            
                                        </div>

                                <?php if( ($key+1)%4 == 0 ): ?>
                                </div>
                                <?php endif; ?>

                              <?php endforeach; ?>

                              </form>

                              </div>

                              <?php endif; ?>
                                <!-- end screenshots -->

                                <div class="row footer-rs">
                                  <div class="dropdown">
                                      <button class="btn activate-btn dropdown-toggle" type="button" data-toggle="dropdown"> <?php echo $per_page; ?>
                                     <i class="fa fa-caret-down"></i></button>
                                      <ul class="dropdown-menu filter ">
                                        <li><a href="<?php echo $url?>&per_page_rec=12">12 Per Page</a></li>
                                        <li><a href="<?php echo $url?>&per_page_rec=24">24 Per Page</a></li>
                                        <li><a href="<?php echo $url?>&per_page_rec=48">48 Per Page</a></li>
                                        <li><a href="<?php echo $url?>&per_page_rec=96">96 Per Page</a></li>
                                      </ul>
                                    </div>

                                    <ul class="pagination pagination-sm ">

                                      <?php if( count($links) > 0 ): ?>

                                        <!-- Show pagination links -->
                                          <?php foreach ($links as $link) : ?>
                                            <?php echo "<li>". $link."</li>"; ?>
                                          <?php endforeach; ?> 

                                      <?php endif; ?>  

                              </ul>
                                </div>
                             </div>
                             <div class="row text-center conn">
                              <button class="btn edit-btn btn-lg">Connect with Amazon S3</button>
                             </div>
                        </div>
                    </div>
            </div>        
        </div>
    </div>


    <!-- Root element of PhotoSwipe. Must have class pswp. -->
    <div class="pswp" tabindex="-1" role="dialog" aria-hidden="true">

        <!-- Background of PhotoSwipe. 
             It's a separate element, as animating opacity is faster than rgba(). -->
        <div class="pswp__bg"></div>

        <!-- Slides wrapper with overflow:hidden. -->
        <div class="pswp__scroll-wrap">

            <!-- Container that holds slides. PhotoSwipe keeps only 3 slides in DOM to save memory. -->
            <!-- don't modify these 3 pswp__item elements, data is added later on. -->
            <div class="pswp__container">
                <div class="pswp__item"></div>
                <div class="pswp__item"></div>
                <div class="pswp__item"></div>
            </div>

            <!-- Default (PhotoSwipeUI_Default) interface on top of sliding area. Can be changed. -->
            <div class="pswp__ui pswp__ui--hidden">

                <div class="pswp__top-bar">

                    <!--  Controls are self-explanatory. Order can be changed. -->

                    <div class="pswp__counter"></div>

                    <button class="pswp__button pswp__button--close" title="Close (Esc)"></button>

                    <button class="pswp__button pswp__button--share" title="Share"></button>

                    <button class="pswp__button pswp__button--fs" title="Toggle fullscreen"></button>

                    <button class="pswp__button pswp__button--zoom" title="Zoom in/out"></button>

                    <!-- Preloader demo http://codepen.io/dimsemenov/pen/yyBWoR -->
                    <!-- element will get class pswp__preloader--active when preloader is running -->
                    <div class="pswp__preloader">
                        <div class="pswp__preloader__icn">
                          <div class="pswp__preloader__cut">
                            <div class="pswp__preloader__donut"></div>
                          </div>
                        </div>
                    </div>
                </div>

                <div class="pswp__share-modal pswp__share-modal--hidden pswp__single-tap">
                    <div class="pswp__share-tooltip"></div> 
                </div>

                <button class="pswp__button pswp__button--arrow--left" title="Previous (arrow left)">
                </button>

                <button class="pswp__button pswp__button--arrow--right" title="Next (arrow right)">
                </button>

                <div class="pswp__caption">
                    <div class="pswp__caption__center"></div>
                </div>

              </div>

            </div>

    </div>

    <?php if( count( $screenshots ) > 0 ): ?>
    <script src="<?php echo base_url()?>assets/screenshot/js/screenshot.js"></script>   
    <?php endif; ?>

    <script type="text/javascript">

    $(document).on('click','.download', function(){
        //alert($(this).attr('href'));
        //window.location = $(this).attr('href')+'/downloadSingleFile/'+$(this).data('value');
    })

    </script>
  
    <a href="#menu-toggle" class="btn btn-default pull-right" id="menu-toggle">Toggle Menu</a>               
</body>
</html>