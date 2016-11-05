$(document).ready(function () {

$.ajax({

	type:"POST",
	url:"ControladorAcceso.php",
	data:{nombre:"victor", contraseña:"1234" },
	success : function(data){
		console.log(data);
	}
})


});