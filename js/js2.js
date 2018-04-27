$(function(){

	//yapue	
	var ip = $('#IP').val();
	var proxy = $('#PROXY').val();
	$(document).ready(function(){
		$('#r_tasklist').load('data/tasklist.php?IP='+ip+'&PROXY='+proxy);
	});

	$('#chktsk').change(function(){
        	if ($(this).is(':checked')) {
         		$('#oculto').append('<input type="hidden" name="TSK" id="TSK" value="1">');
        	}else{
			$('#TSK').remove();
		}
    	});

	$('#chkpt').change(function(){
        	if ($(this).is(':checked')) {
         		$('#oculto').append('<input type="hidden" name="PT" id="PT" value="1">');
        	}else{
			$('#PT').remove();
		}
    	});

	$('#chksvs').change(function(){
        	if ($(this).is(':checked')) {
         		$('#oculto').append('<input type="hidden" name="SVS" id="SVS" value="1">');
        	}else{
			$('#SVS').remove();
		}
    	});
	
	$('#chkwc').change(function(){
        	if ($(this).is(':checked')) {
         		$('#oculto').append('<input type="hidden" name="WC" id="WC" value="1">');
        	}else{
			$('#WC').remove();
		}
    	});

	$('#chkapplg').change(function(){
        	if ($(this).is(':checked')) {
         		$('#oculto').append('<input type="hidden" name="APPLG" id="APPLG" value="1">');
        	}else{
			$('#APPLG').remove();
		}
    	});
	
	$('#chksyslg').change(function(){
        	if ($(this).is(':checked')) {
         		$('#oculto').append('<input type="hidden" name="SYSLG" id="SYSLG" value="1">');
        	}else{
			$('#SYSLG').remove();
		}
    	});

	$('#checkboxes').change(function(){
		if ($('#chktsk').is(':checked')){
			$('#btngenerar').attr("disabled",false);
		}else if($('#chkpt').is(':checked')){
			$('#btngenerar').attr("disabled",false);
		}else if($('#chkwc').is(':checked')){
			$('#btngenerar').attr("disabled",false);
		}else if($('#chksvs').is(':checked')){
			$('#btngenerar').attr("disabled",false);
		}else if($('#chkapplg').is(':checked')){
			$('#btngenerar').attr("disabled",false);
		}else if($('#chksyslg').is(':checked')){
			$('#btngenerar').attr("disabled",false);
		}else{
		$('#btngenerar').attr("disabled",true);
		}
	});

	$("#btngenerar").click(function(){
                $('#generar').hide();
                $('.progress').show();
		$('#envio').hide();
		$('#btnenviar').attr("disabled",true);
                $.ajax({
                        url:'pdf.php',
                        type:'post',
                        data:$('#mail').serialize(),
                        success:function(){
                                $('.progress').hide();
                                $('#envio').show();
                                $('#btnenviar').attr("disabled", false);
				$('#generar').show();
				$('#formmail').slideDown();
                        }
                });
        });

        $("#btnenviar").click(function(){
                $.ajax({
                        url:'mailer.php',
                        type:'post',
                        data:$('#send').serialize(),
                        success:function(data){
                                $('#respuesta').append(data);
                        }
                });

        });

	$('#titulo1').click(function(){
		$('#titulo1').attr("disabled", true);
		$.ajax({
                        type: "GET",
                        url: 'data/tasklist.php',
                        data: {"IP":ip,"PROXY":proxy},
                        success: function(data) {
                                $('#r_tasklist').html(data);
				$('#titulo1').attr("disabled", false);
                        }
                });
	});

	$('#t_processtime').one('click',function(){
		$('#titulo2').attr("disabled", true);
		$.ajax({
                        type: "GET",
                        url: 'data/processtime.php',
                        data: {"IP":ip,"PROXY":proxy},
                        success: function(data) {
                                $('#r_processtime').html(data);
				$('#titulo2').attr("disabled", false);
                        }
                });
	});

	$('#titulo2').click(function(){
		$('#titulo2').attr("disabled", true);
		$.ajax({
                        type: "GET",
                        url: 'data/processtime.php',
                        data: {"IP":ip,"PROXY":proxy},
                        success: function(data) {
                                $('#r_processtime').html(data);
				$('#titulo2').attr("disabled", false);
                        }
                });
	});

	$('#t_wimcpu').one('click',function(){
		$('#titulo3').attr("disabled", true);
		$.ajax({
                        type: "GET",
                        url: 'data/wimcpu.php',
                        data: {"IP":ip,"PROXY":proxy},
                        success: function(data) {
                                $('#r_wimcpu').html(data);
				$('#titulo3').attr("disabled", false);
                        }
                });
	});

	$('#titulo3').click(function(){
		$('#titulo3').attr("disabled", true);
		$.ajax({
                        type: "GET",
                        url: 'data/wimcpu.php',
                        data: {"IP":ip,"PROXY":proxy},
                        success: function(data) {
                                $('#r_wimcpu').html(data);
				$('#titulo3').attr("disabled", false);
                        }
                });
	});

	$('#t_services').one('click',function(){
		$('#titulo4').attr("disabled", true);
		$.ajax({
                        type: "GET",
                        url: 'data/services.php',
                        data: {"IP":ip,"PROXY":proxy},
                        success: function(data) {
                                $('#r_services').html(data);
				$('#titulo4').attr("disabled", false);
                        }
                });
	});

	$('#titulo4').click(function(){
		$('#titulo4').attr("disabled", true);
		$.ajax({
                        type: "GET",
                        url: 'data/services.php',
                        data: {"IP":ip,"PROXY":proxy},
                        success: function(data) {
                                $('#r_services').html(data);
				$('#titulo4').attr("disabled", false);
                        }
                });
	});
	
	$('#t_applog').one('click',function(){
		$('#titulo5').attr("disabled", true);
		$.ajax({
                        type: "GET",
                        url: 'data/applog.php',
                        data: {"IP":ip,"PROXY":proxy},
                        success: function(data) {
                                $('#r_applog').html(data);
				$('#titulo5').attr("disabled", false);
                        }
                });
	});

	$('#titulo5').click(function(){
		$('#titulo5').attr("disabled", true);
		$.ajax({
                        type: "GET",
                        url: 'data/applog.php',
                        data: {"IP":ip,"PROXY":proxy},
                        success: function(data) {
                                $('#r_applog').html(data);
				$('#titulo5').attr("disabled", false);
                        }
                });
	});
	
	$('#t_syslog').one('click',function(){
		$('#titulo6').attr("disabled", true);
		$.ajax({
                        type: "GET",
                        url: 'data/syslog.php',
                        data: {"IP":ip,"PROXY":proxy},
                        success: function(data) {
                                $('#r_syslog').html(data);
				$('#titulo6').attr("disabled", false);
                        }
                });
	});

	$('#titulo6').click(function(){
		$('#titulo6').attr("disabled", true);
		$.ajax({
                        type: "GET",
                        url: 'data/syslog.php',
                        data: {"IP":ip,"PROXY":proxy},
                        success: function(data) {
                                $('#r_syslog').html(data);
				$('#titulo6').attr("disabled", false);
                        }
                });
	});

});
