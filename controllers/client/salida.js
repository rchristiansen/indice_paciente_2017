$(document).ready(function(){
		
	// $("#indicePacienteRau").click(function(){
	// 	$(this).data('clicked', true);
	// });	

	// if(jQuery('#indicePacienteRau').data('clicked')) {
 //    	alert("si")
	// } else {
 //    	alert("no")
	// }	

	$("#indicePacienteRau").on('click', function() {
		$(this).data('clicked', 'yes');
	});
	
	var isClicked = $("#indicePacienteRau").data('clicked');
	if( isClicked == 'yes') {
  	   // do something
  	   alert("dddd")
	}else{
		alert("ggg")
	   // do something else
	}
});