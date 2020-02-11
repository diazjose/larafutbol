$(document).ready(function(){

	$("#buscar").on("keyup", function(){
		var buscar = $(this).val();
		var form = $("#form-search");
		var url = form.attr('action');
		$("#form_buscar").val(buscar);
		if (window.location.pathname == '/larafutbol/public/equipos/Pre-Veteranos') {
			$("#viene").val('Pre-Veteranos');
		}else{
			$("#viene").val('Veteranos');
		}
		var data = form.serialize();
		$.ajax({          
	        url: url,
	        type: 'POST',
	        data : data,
	        success: function(data){
	        	$("#tbody").remove('tr');
	            $("#tbody").html(data);
	        }
	    });
	});	

	$("#accept").click(function(e){
		e.preventDefault();		
		//var id = $(this).val();
		var status = $(this).val();
		console.log(status);

		
	});
				
});
