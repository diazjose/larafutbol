$(document).ready(function(){
	$("#fixture").hide();
	$("#tabla").hide();

	$("#ver_editar").click(function(){
		$("#actualizar").show();
		$(this).addClass('active');
		$("#fixture").hide();
		$("#ver_fixture").removeClass('active');
		$("#tabla").hide();
		$("#ver_tabla").removeClass('active');
		$("#equipos").hide();
		$("#ver_equipos").removeClass('active');
	});
	$("#ver_fixture").click(function(){
		$("#fixture").show();
		$(this).addClass('active');
		$("#actualizar").hide();
		$("#ver_editar").removeClass('active');
		$("#tabla").hide();
		$("#ver_tabla").removeClass('active');
		$("#equipos").hide();
		$("#ver_equipos").removeClass('active');
	});
	$("#ver_tabla").click(function(){
		$("#tabla").show();
		$(this).addClass('active');
		$("#actualizar").hide();
		$("#ver_editar").removeClass('active');
		$("#fixture").hide();
		$("#ver_fixture").removeClass('active');
		$("#equipos").hide();
		$("#equipos").removeClass('active');
	});
	$("#ver_equipos").click(function(){
		$("#equipos").show();
		$(this).addClass('active');
		$("#fixture").hide();
		$("#ver_fixture").removeClass('active');
		$("#actualizar").hide();
		$("#ver_editar").removeClass('active');
		$("#tabla").hide();
		$("#ver_tabla").removeClass('active');
	});
/*
	$("#sel").change(function(){
		$(this).siblings().find('option[value="'+$(this).val()+'"]').remove();	
		alert('olo');		
	});
*/				
});

var i=0;
$(document).on('change','.sel',function(){
  var remo = $(this).val();
  $(this).siblings().find('option[value="'+$(this).val()+'"]').remove();
  i++;
  console.log($(this).val());
});