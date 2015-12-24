<script type="text/javascript">
    var pieData = []; // define piedata globally
</script>

<?php 
  // block colors
  $block_colors = ['f', 's', 't', 'fr', 'fif', 'f', 's', 't', 'fr', 'fif']; 
  $pie_colors = ['#086e00', '#4fa6ca', '#ff00e4', '#f2e149', '#ff9c00', '#086e00', '#4fa6ca', '#ff00e4', '#f2e149', '#ff9c00']  
?>

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

<div class="row chart-block">
  <div class=" col-sm-6 col-md-6">

    <?php if( count($appsLog) > 0 ): ?>
      <div id="canvas-holder">
        <canvas id="chart-area" width="150" height="150"/>
      </div>
    <?php endif; ?>

    </div>
 
    <!-- <div class=" col-sm-6 col-md-6">
      <img src="images/chart.png" alt="" />
        
 
    </div> -->
</div>  

<div class="row">
    <div class="table-responsive col-sm-10 col-md-10">

    <?php if( count($appsLog) > 0 ): ?>

      <table class="table table-bordered ">
        <thead>
          <tr>
            <th></th> 
             <th>Application</th>
             <th>Application Title</th>
            <th>Time</th>
            <th>Percentage</th>
          </tr>
        </thead>
        <tbody>

        <?php foreach( $appsLog as $key=>$value ): ?>
        
          <tr>
            <td><div class="color-block <?php echo $block_colors[$key]; ?>"></div></td>
            <td><?php echo $value->appname;?></td>
            <td><?php echo $value->appTitle;?></td>
            <td><?php echo gmdate('H:i:s', $value->duration/1000 );?></td>
            <td><?php echo number_format( ($value->appcount/$app_counts)*100, 2 ),'%' ;?></td>
          </tr>

          <script type="text/javascript">

              var obj = {
                        value: <?php echo number_format( ($value->appcount/$app_counts)*100, 2 ) ;?>,
                        color:"<?php echo $pie_colors[$key]; ?>",
                        highlight: "#FF5A5E",
                        label: "<?php echo $value->appname;?>"
                      }
              
              pieData.push(obj);
                      
          </script>
        
        <?php endforeach; ?>

        </tbody>
      </table>

      <script type="text/javascript" src="<?php echo base_url()?>assets/chartjs/js/chart.js"></script>

      <script>

            //window.onload = function(){
              var ctx = document.getElementById("chart-area").getContext("2d");
              window.myPie = new Chart(ctx).Pie(pieData);
            //};
        </script>

    <?php else: ?>
      
      <table class="table table-bordered ">
        <thead>
          <tr>
            <th></th> 
             <th>Application</th>
            <th>Time</th>
            <th>Percentage</th>
          </tr>
        </thead>
        <tbody>
             <tr>
                <td colspan="4" align="center">Record  not found!</td>
             </tr>
        </tbody>
      </table>  

    <?php endif; ?>

  </div>
</div>