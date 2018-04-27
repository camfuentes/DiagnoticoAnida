$(function(){
	
	var ip = $('#IP').val();
	var proxy = $('#PROXY').val();
	$(document).ready(function(){
		$('#r_procesos').load('data/procesos.php?IP='+ip+'&PROXY='+proxy);
		$('#r_dmesg').load('data/dmesg.php?IP='+ip+'&PROXY='+proxy);
	});
	
	$('#chkpcs').change(function(){
        	if ($(this).is(':checked')) {
         		$('#oculto').append('<input type="hidden" name="PCS" id="PCS" value="1">');
        	}else{
			$('#PCS').remove();
		}
    	});

	$('#chktop').change(function(){
        	if ($(this).is(':checked')) {
         		$('#oculto').append('<input type="hidden" name="TOP" id="TOP" value="1">');
        	}else{
			$('#TOP').remove();
		}
    	});
	$('#chkcpu').change(function(){
        	if ($(this).is(':checked')) {
         		$('#oculto').append('<input type="hidden" name="CPUL" id="CPUL" value="1">');
        	}else{
			$('#CPUL').remove();
		}
    	});
	$('#chkmem').change(function(){
        	if ($(this).is(':checked')) {
         		$('#oculto').append('<input type="hidden" name="MEM" id="MEM" value="1">');
        	}else{
			$('#MEM').remove();
		}
    	});

	$('#chkdsc').change(function(){
        	if ($(this).is(':checked')) {
         		$('#oculto').append('<input type="hidden" name="DSC" id="DSC" value="1">');
        	}else{
			$('#DSC').remove();
		}
    	});

	$('#chkdmesg').change(function(){
        	if ($(this).is(':checked')) {
         		$('#oculto').append('<input type="hidden" name="DMESG" id="DMESG" value="1">');
        	}else{
			$('#DMESG').remove();
		}
    	});
	
	$('#checkboxes').change(function(){
		if ($('#chkpcs').is(':checked')){
			$('#btngenerar').attr("disabled",false);
		}else if($('#chktop').is(':checked')){
			$('#btngenerar').attr("disabled",false);
		}else if($('#chkcpu').is(':checked')){
			$('#btngenerar').attr("disabled",false);
		}else if($('#chkmem').is(':checked')){
			$('#btngenerar').attr("disabled",false);
		}else if($('#chkdsc').is(':checked')){
			$('#btngenerar').attr("disabled",false);
		}else if($('#chkdmesg').is(':checked')){
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
                        url: 'data/procesos.php',
                        data: {"IP":ip,"PROXY":proxy},
                        success: function(data) {
                                $('#r_procesos').html(data);
				$('#titulo1').attr("disabled", false);
                        }
                });
		//$('#procesos').load('procesos.php?IP='+ip);
	});

	$('#t_top').one('click',function(){
		$('#titulo2').attr("disabled", true);
		$.ajax({
                        type: "GET",
                        url: 'data/top.php',
                        data: {"IP":ip,"PROXY":proxy},
                        success: function(data) {
                                $('#r_top').html(data);
				$('#titulo2').attr("disabled", false);
                        }
                });
                //$('#top').load('top.php?IP='+ip);
        });

	$('#titulo2').click(function(){
		$('#titulo2').attr("disabled", true);
		$.ajax({
                        type: "GET",
                        url: 'data/top.php',
                        data: {"IP":ip,"PROXY":proxy},
                        success: function(data) {
                                $('#r_top').html(data);
				$('#titulo2').attr("disabled", false);
                        }
                });
                //$('#top').load('top.php?IP='+ip);
        });

	$('#t_cpu').one('click',function(){
                $('#titulo3').attr("disabled", true);
		$.ajax({
                        type: "GET",
                        url: 'data/cpu.php',
                        data: {"IP":ip,"PROXY":proxy},
                        success: function(data) {
                                $('#r_cpu').html(data);
				$('#titulo3').attr("disabled", false);
                        }
                });
		//$('#cpu').load('cpu.php?IP='+ip);
        });

	$('#titulo3').click(function(){
                $('#titulo3').attr("disabled", true);
		$.ajax({
                        type: "GET",
                        url: 'data/cpu.php',
                        data: {"IP":ip,"PROXY":proxy},
                        success: function(data) {
                                $('#r_cpu').html(data);
				$('#titulo3').attr("disabled", false);
                        }
                });
		//$('#cpu').load('cpu.php?IP='+ip);
        });
	
	$('#t_memoria').one('click',function(){
                $('#titulo4').attr("disabled", true);
		$.ajax({
                        type: "GET",
                        url: 'data/memoria.php',
                        data: {"IP":ip,"PROXY":proxy},
                        success: function(data) {
                                $('#r_memoria').html(data);
				$('#titulo4').attr("disabled", false);
                        }
                });
		//$('#memoria').load('memoria.php?IP='+ip);
        });

	$('#titulo4').click(function(){
                $('#titulo4').attr("disabled", true);
		$.ajax({
                        type: "GET",
                        url: 'data/memoria.php',
                        data: {"IP":ip,"PROXY":proxy},
                        success: function(data) {
                                $('#r_memoria').html(data);
				$('#titulo4').attr("disabled", false);
                        }
                });
		//$('#memoria').load('memoria.php?IP='+ip);
        });

	$('#t_discos').one('click',function(){
                $('#titulo5').attr("disabled", true);
		$.ajax({
                        type: "GET",
                        url: 'data/discos.php',
                        data: {"IP":ip,"PROXY":proxy},
                        success: function(data) {
                                $('#r_discos').html(data);
				$('#titulo5').attr("disabled", false);
                        }
                });
		//$('#discos').load('discos.php?IP='+ip);
        });

	$('#titulo5').click(function(){
                $('#titulo5').attr("disabled", true);
		$.ajax({
                        type: "GET",
                        url: 'data/discos.php',
                        data: {"IP":ip,"PROXY":proxy},
                        success: function(data) {
                                $('#r_discos').html(data);
				$('#titulo5').attr("disabled", false);
                        }
                });
		//$('#discos').load('discos.php?IP='+ip);
        });

	
	$('#titulo61').click(function(){
		$('#titulo61').attr("disabled", true);
		$('#titulo62').attr("disabled", true);
		$.ajax({
 			type: "GET",
 			url: 'data/dmesg.php',
 			data: {"IP":ip,"EX":" ","PROXY":proxy},
 			success: function(data) {
              			$('#r_dmesg').html(data);
				$('#titulo61').attr("disabled", false);
				$('#titulo62').attr("disabled", false);
                     	}
             	});	
 		//$('#dmesg').load('dmesg.php?IP='+ip);
        });
	
        $('#titulo62').click(function(){
		$('#titulo61').attr("disabled", true);
		$('#titulo62').attr("disabled", true);
		$.ajax({
 			type: "GET",
 			url: 'data/dmesg.php',
 			data: {"IP":ip,"EX":"-T","PROXY":proxy},
 			success: function(data) {
              			$('#r_dmesg').html(data);
				$('#titulo61').attr("disabled", false);
				$('#titulo62').attr("disabled", false);
                     	}
             	});	
 		//$('#dmesg').load('dmesg.php?IP='+ip);
        });
	 
});
