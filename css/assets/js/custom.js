 $(function() {
	  $(".menu-toggle").click(function(e) {
        e.preventDefault();
        $("#wrapper").toggleClass("toggled");
		//#wrapper.toggled #sidebar-wrapper
    });
    $( "#datefrom" ).datepicker({
		  beforeShow: function (input, inst) {
        var rect = input.getBoundingClientRect();
        setTimeout(function () {
	        inst.dpDiv.css({ left: rect.left -38,top:rect.top+40 });
        }, 0);
    	}
	});
		$( "#dateto" ).datepicker({
			  beforeShow: function (input, inst) {
			var rect = input.getBoundingClientRect();
			setTimeout(function () {
				inst.dpDiv.css({ left: rect.left -38,top:rect.top+40 });
			}, 0);
		}
	});
	$("input[type='checkbox']").click(function(){ 
	$(this).parents('tr').toggleClass("active");
	});
	
	$( "#downloadbtn").click(function(){
		$("#download-content").slideToggle();
	});
	
	$( "#spinner" ).spinner();
	
// productivity-meter slider
	 $( ".productivity-meter-1" ).slider({
      orientation: "horizontal",
      range: "min",
      max: 255
    });
    $( ".productivity-meter-1" ).slider( "value", 150 );
  });