<div class="row cat">
	<div class="col-sm-4 col-md-3">
	  <div class="dropdown">
	    <button class="btn activate-btn dropdown-toggle" type="button" data-toggle="dropdown"><span class="current-timezone">Time Zone</span> <i class="fa fa-caret-down"></i></button>
	    <ul class="dropdown-menu filter " style="height:200px; overflow:auto;">

	   	  <?php if( count($timezone) > 0 ): ?>	
	   	  	<?php foreach($timezone as $key=>$value): ?>
		      <li><a href="javascript:;" class="timezones" data-value="<?php echo $value->gmt; ?>"><?php echo $value->timezone_location, ' ', $value->gmt; ?></a></li>
	      	<?php endforeach; ?>	      	
	      <?php endif; ?>	

	    </ul>
	    <span class="error timezone-error"></span>
	  </div>
	</div>
	</div>
	<div class="row cat">
	<div class="col-sm-4 col-md-3">
	  <div class="dropdown">
	    <button class="btn activate-btn dropdown-toggle" type="button" data-toggle="dropdown"><span class="current-dateformat">Date Format </span><i class="fa fa-caret-down"></i></button>
	    <ul class="dropdown-menu filter " style="height:200px; overflow:auto;">
	       
	       <?php if( count($dateTime) > 0 ): ?>	
	   	  	<?php foreach($dateTime as $key=>$value): ?>
		      <li><a href="javascript:;" class="dateformat" data-value="<?php echo $value->format; ?>"><?php echo $value->date_format ;?></a></li>
	      	<?php endforeach; ?>
	      	
	      <?php endif; ?>

	    </ul>
	    <span class="error dateformat-error"></span>
	  </div>
	</div>
	</div>
	<div class="row cat">
	<div class="col-sm-4 col-md-3">
	 
	 <?php if( count($timezone) > 0 && count($dateTime) > 0 ): ?>
	 	<form id="timezone-form" action="<?php echo site_url('settings/storeTimezone'); ?>" method="post">
	 		<input type="hidden" name="atype" id="atype" value="store">
	 		<input type="hidden" name="description" id="description" value="" />
	 		<input type="hidden" name="timezone" id="timezone" value="" />
	 		<input type="hidden" name="dateformat" id="dateformat" value="" />
	  		<button class="btn activate-btn" id="downloadbtn">Save</button>
	  	</form>
	 <?php endif; ?>


	<?php if( isset( $configTimezone ) && isset( $configDateFormat ) && isset( $timezone ) && isset( $dateTime ) ): ?>
		<script type="text/javascript">
			// update action	
			$('#atype').val('update');

			// set default timezone
			$('.timezones').each(function(key, value){
				if( $(this).data('value') == '<?php echo $configTimezone; ?>' && $(this).text() == '<?php echo $configTimezoneDesc; ?>' ){
					$('.timezones').eq(key).click();
					return;
				}
			});

			// set default timeformat
			$('.dateformat').each(function(key, value){
				if( $(this).data('value') == '<?php echo $configDateFormat; ?>' ){
					$('.dateformat').eq(key).click();
					return;
				}
			});

		</script>
	<?php endif; ?> 

	</div>
	</div>