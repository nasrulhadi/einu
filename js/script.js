$(function() {
      var currentDate = new Date(),
          finished = false,
          availiableExamples = {
            set15daysFromNow: 15 * 24 * 60 * 60 * 1000,
            set5minFromNow  : 5 * 60 * 1000,
            set1minFromNow  : 1 * 60 * 1000
          };
      
      function callback(event) {
  		  $this = $(this);
  			switch(event.type) {
  				case "seconds":
  				case "minutes":
  				case "hours":
  				case "days":
  				case "weeks":
  				case "daysLeft":
  				  $this.find('span#'+event.type).html(event.value);
  				  if(finished) {
  				    $this.fadeTo(0, 1);
  				    finished = false;
  				  }
  					break;
  				case "finished":
            $this.fadeTo('slow', .5);
            finished = true;
  					break;
  			}
      }
      
  		$('div#clock').countdown("2013/01/02/", callback);
  		
  		$('select#exampleDate').change(function() {
  		  try {
    		  var $this = $(this),
    		      value;
  		    currentDate = new Date();
    		  switch($this.attr('value')) {
    		    case "other":
    		      value = prompt('Set the date to countdown:\nThe hh:mm:ss parameters are opitionals', 'YYYY/MM/DD hh:mm:ss');
    		      break;
    		    case "daysFromNow":
    		      value = prompt('How many days from now?', '');
    		      value = new Number(value) * 24 * 60 * 60 * 1000 + currentDate.valueOf();
    		      break;
    		    case "minutesFromNow":
    		      value = prompt('How many minutes from now?', '');
    		      value = new Number(value) * 60 * 1000 + currentDate.valueOf();
    		      break;
    		    default:
    		      value = availiableExamples[$this.attr('value')] + currentDate.valueOf();
    		  }
    		  $('div#clock').countdown(value, callback);
    		  $this.find('option:first').attr('selected', true);
    		} catch(e) { alert(e); }
  		});
  	});

//expand
$(document).ready(function(){
	$('#user_login').submit(function() {
		var username = $('#username').val();
		var password = $('#password').val();
		// email validation
		if (!username){
			$('#lr').html('<div class="warning">mohon isi username anda</div>').show();
			return false;	
		} else if (!password){
			$('#lr').html('<div class="warning">mohon isi password anda</div>').show();
			return false;	
		}
		// loader while data submission
		$('#lr').html('<div class="loader"><span style="padding-left: 5px;">Loading...</span></div>');
		$.ajax({
			type: 'POST',
			url: $(this).attr('action'),
			data: $(this).serialize(),
			success: function(data) {
				$('#lr').html(data);
			}
		})
		return false;
	});
	
	$('#user_forget').submit(function() {
		var uoe = $('#uoe').val();
		// email validation
		if (!uoe){
			$('#lr2').html('<div class="warning">mohon isi username atau email anda</div>').show();
			return false;	
		} 
		// loader while data submission
		$('#lr2').html('<div class="loader"><span style="padding-left: 5px;">Loading...</span></div>');
		$.ajax({
			type: 'POST',
			url: $(this).attr('action'),
			data: $(this).serialize(),
			success: function(data) {
				$('#lr2').html(data);
			}
		})
		return false;
	});
	
	$("#report tr:odd").addClass("odd");
	//$("#report tr:not(.odd)").hide();
	$("#report tr:first-child").show();
	
	//$("#report tr.toggle").click(function(){
	//	$(this).next("tr").fadeIn();
	//});
	//$("#report").jExpand();
	$("#report tr.toggle").toggle(function(){
		//first click happened
		$(this).next("tr").fadeIn();
		},function(){
		//second click happened
		$(this).next("tr").fadeOut();
	});
	
	$("#region").change(function() {
		var val = $(this).val();
		window.location.href='home.php?rid='+val;
	});
	
	var clearMePrevious = '';
	
	// clear input on focus
	$('#username,#password,#uoe').focus(function()	{
		$(this).addClass('glow');
	});
	
	// if field is empty afterward, add text again
	$('#username,#password,#btn,#uoe').blur(function()	{
		$(this).removeClass('glow');
	});
	
	$('#btn').hover(function()	{
		$(this).addClass('glow');}, function() {
		$(this).removeClass('glow');
	});

	$("input:text:visible:first").focus();
	
	// Add pdf icons to pdf links
	$("a[href$='.pdf']").addClass("pdf");
	 
	// Add txt icons to document links (doc, rtf, txt)
	$("a[href$='.doc'], a[href$='.txt'], a[href$='.rtf']").addClass("txt");

	// Add zip icons to Zip file links (zip, rar)
	$("a[href$='.zip'], a[href$='.rar']").addClass("zip"); 
	
	// Add email icons to email links
	$("a[href^='mailto:']").addClass("email");
	
	$("a[href$='.mp3'], a[href$='.wav']").addClass("mp3");
	$("a[href$='.mp4'], a[href$='.3gp'], a[href$='.flv']").addClass("film");

	//Add external link icon to external links - 
	$('a').filter(function() {
		//Compare the anchor tag's host name with location's host name
	    return this.hostname && this.hostname !== location.hostname;
	  }).addClass("external");
	$('#forget_pass').click(function(){
		$('.loginform').slideUp();
		$('.forgetform').slideDown();
	});
	
	$('#backlogin').click(function(){
		$('.forgetform').slideUp();
		$('.loginform').slideDown();
	});
});

	


//<![CDATA[
function hiLight(el,color) {
	var rows=document.getElementsByTagName("tr");
	for(i=0;i<rows.length;i++) {
	rows[i].style.background="#fff";
	}
	el.style.background=color;
}
//]]>