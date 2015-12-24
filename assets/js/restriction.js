// category form validation
(function($,W,D){

    var JQUERY4U = {};

    JQUERY4U.UTIL =
    {
        setupFormValidation: function()
        {
            //form validation rules
            $("#domain-add-form").validate({
                rules: {
                    domain_name: {
                        required: true,
                        url:true
                    }
                },
                messages: {
                    domain_name: "Please enter domain name",                                       
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

$(document).ready(function(){

	// submit form
	$("#domain-add-form").submit(function(){
		
		// domain field validation		
		if( $('.domain_name').val() != '' ){

			// if block checkbox select then block domain to all system
			if( $('#block-checkbox').is(':checked') ){
		 		socket.emit('system-apply-restriction-all', $('.domain_name').val() ); // socket send request of block to all system
		  	}

		  	return true; // return true
		}
		else{
			return false; // return false if domain fox is empty
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

	// delete selected domains
	$(document).on('click', '.delete-btn', function(){

		var deleteFlag = false;

		// get all selected item
		$('.domain-selected').each(function(key, value){
			if( $(this).is(':checked') ){
				socket.emit('system-remove-restriction-all', $(this).data('value') ); // send delete request 
				deleteFlag = true;
			}
		});

		if( deleteFlag ){
			// submit form
			$('#domain-list').submit();			
			return true;
		}
		else{
			alert('Please select domain');
			return false;
		}
	});

	// restrict single domain by computers
	var Domain;

	$(document).on('click', '.restrict-domain', function(){

		Domain = $(this).data('value');
		$('#domain_id').val( $(this).data('id') );

		$('.block-systems').each(function(key, value){
			$(this).prop('checked', false);
		});

		if( $(this).data('comblock') != undefined ){

			// deselect all computer checkbox
			$('.all-block-systems').prop('checked', false);

			// select all computer checkbox
			if( $(this).data('all') == 1 ){
				$('.all-block-systems').prop('checked', true);
			}

			// get all list of block computers
			var coms = $(this).data('comblock');
			var comList = [];

			// if coms has more than single then split
			if( coms.length > 1 ){
				comList = coms.split(','); 
			}
			else{ // if coms is single then push into array
				comList.push(coms.toString());
			}

			// mark checkbox if already in list
			$('.block-systems').each(function(key, value){

				if( comList.indexOf( $(this).val() ) != -1 ){
					$('.block-systems').eq(key).prop('checked', true);
				}
			});

		}
		
	});

	// select all computer list 
	$(document).on('click', '.all-block-systems', function(){
		if( $(this).is(':checked') ){
			$('.block-systems').prop('checked', true);
		}
		else{
			$('.block-systems').prop('checked', false);
		}
	});

	// apply restriction
	$(document).on('click', '.block-sys-domains', function(){

		var flag = false;
		// set atype
		$('#aType').val('block');

		// get all selected item
		$('.block-systems').each(function(key, value){
			
			if( $(this).is(':checked') ){

				// delete restriction from all system first
				if( flag == false ){
					socket.emit('system-remove-restriction-all', Domain ); // send delete request 
				}

				var sysName = $(this).data('value');
				sysName = sysName.split('->');

				socket.emit('system-apply-restriction', $(this).val()+sysName[0], Domain);

				flag = true;
			}

		});

		if( flag ){

			// submit form
			$('#block-by-computer').submit();		
			return true;
		}
		else{

			socket.emit('system-remove-restriction-all', Domain ); // send delete request 
			$('#block-by-computer').submit();	
			return true;
		}
	});

  // apply restriction with active button 
  $(document).on('click', '.apply-btn', function(){
      
      var counter = 0;
      var $selected = '';

      // get all selected item
      $('.domain-selected').each(function(key, value){
          if( $(this).is(':checked') ){
              counter++;
              $selected = $(this);
          }          
      });

      console.log('counter=>'+counter);
      if( counter > 1 ){
        alert('Sorry, you can\'t block multiple domain at a time');
      }
      else if( counter == 1 ){
         //console.log( $selected.parents('tr').find('td .restrict-domain').click() );
         $selected.parents('tr').find('td .restrict-domain').click();
      }
      else if( counter < 1 ){
        alert('Please select any domain');
      }

  });


});