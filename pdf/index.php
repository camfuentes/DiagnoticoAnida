<?php ?>
<!DOCTYPE html>
<html>
<head>
	<title>Admin PDF</title>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <link rel="icon" href="../../../favicon.ico">
        <link rel="stylesheet" type="text/css" href="css/style.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<script>
		$(document).ready(function(){
			var accion = $('#btnLimpiar').val();
			$('#btnLimpiar').on('click',function(){
                		$.ajax({
                        	url:'limpiar.php',
                        	type:'post',
                        	data:('limpiar:'+accion),
                        	success:function(data){
                                	$('#lista').html(data);
                        		}
                		});
			});
			
			if($('#lista').text().indexOf('No hay archivos')>= 0){
				$('#btnLimpiar').attr('disabled',true);
			}
			
			$('#lista').change(function(){	
				$('#btnLimpiar').attr('disabled',true);
			});	
		});
		
	</script>
</head>
<body>
	<div>
                <nav class="navbar navbar-default">
                	<div class="container-fluid">
                		<div class="navbar-header">
                        		<a class="navbar-brand" href="http://172.21.2.16/imonyou/zabbix.php?action=dashboard.view"><img alt="Brand" src="../img/logo.jpg" height="33px"></a>
                		</div>
                		<div class="navbar-collapse collapse navbar-right">
                			<p class="navbar-text">Subgerencia de Monitoreo y disponiblidad de Servicio </p>
                		</div>
                	</div>
                </nav>
	</div>
	<div style="margin-left:1%">
	<h1>Archivos PDF <button name="limpiar" id="btnLimpiar" class='btn-default btn' value="1">Limpiar</button></h1>	
	</div>
	<div id="lista" style="margin-left:1%"> 	
<?php 
	$res = shell_exec("cd /usr/share/zabbix/scripts/diagnostico/pdf/ && ls *.pdf -t");
	if(strlen($res)>0){
		$lista = explode('.pdf',$res);
		foreach($lista as $elemento){
		echo "<a href='$elemento.pdf'>$elemento</a></br>";
		}
	}else if(is_null($res)){
		echo "No hay archivos";
	}
?>
	</div>
</body>
</html>






