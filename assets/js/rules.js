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