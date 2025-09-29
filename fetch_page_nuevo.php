<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">

<div id="content">     
			<hr/>
		<strong>	  <p class="mb-0 text-uppercase" ><img src="includes/contraer31.png" id="mostrar3" style="cursor:pointer;"/>
<img src="includes/contraer41.png" id="ocultar3" style="cursor:pointer;"/>&nbsp;&nbsp;&nbsp; FILTRO VIATICOS</p></strong></div>


<div  id="mensajefiltro">
<div class="progress" style="width: 25%;">
<div class="progress-bar" role="progressbar" style="width: <?php echo $Aeventosporcentaje ; ?>%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"><?php echo $Aeventosporcentaje ; ?>%</div></div>
 </div>
							
	        <div id="target3" style="display:block;" class="content2">
        <div class="card">
          <div class="card-body">
      
<!--aqui inicia filtro-->

            <div class="row text-center" id="loader" style="position: absolute;top: 140px;left: 50%"></div>
<table width="100%" border="0">
<tr>
<td width="30%" align="center">
	<span>Mostrar</span>
	<select  class="form-select mb-3" id="per_page" onchange="load(1);">
		<option value="20" <?php if(!empty($_REQUEST['per_page'])){echo 'selected';} ?>>20</option>
		<option value="40" <?php if($_REQUEST['per_page']=='40'){echo 'selected';} ?>>40</option>
		<option value="100" <?php if($_REQUEST['per_page']=='100'){echo 'selected';} ?>>100</option>
		<option value="150" <?php if($_REQUEST['per_page']=='15'){echo 'selected';} ?>>150</option>
		<option value="200" <?php if($_REQUEST['per_page']=='200'){echo 'selected';} ?>>200</option>
		<option value="200000" <?php if($_REQUEST['per_page']=='200000'){echo 'selected';} ?>>TODOS</option>
	</select>
</td>



<td width="30%" align="center">					
	<button  class="btn btn-sm btn-outline-success px-5" type="button" onclick="load(1);" >BUSCAR</button>
</td>

<td width="30%" align="center">
	<span>PLANTILLA</span>
	
	<!--<select  class="form-select mb-3" id="DEPARTAMENTO2WE" onchange="load(1);">
	
	<option value="DEFAULT" <?php if($_SESSION['DEPARTAMENTO']=='DEFAULT'){echo 'selected';} ?>>DEFAULT</option>
	
	<option value="SANDOR" <?php if($_SESSION['DEPARTAMENTO']=='SANDOR'){echo 'selected';} ?>>SANDOR</option>
	
	<option value="SANDOR3" <?php if($_SESSION['DEPARTAMENTO']=='SANDOR3'){echo 'selected';} ?>>SANDOR3</option>

	</select>-->


	<?php
	$encabezado = '';$option='';
	$queryper = $conexion->desplegablesfiltro('ventasoperaciones','');
	$encabezado = '<select class="form-select mb-3" id="DEPARTAMENTO2WE" required="" onchange="load(1);">
	<option value="">SELECCIONA UNA OPCIÓN</option>';
	/*linea para multiples colores*/
	$fondos = array("fff0df","f4ffdf","dfffed","dffeff","dfe8ff","efdfff","ffdffd","efdfff","ffdfe9");
	$num = 0;
	/*linea para multiples colores*/	
	while($row1 = mysqli_fetch_array($queryper))
	{
	/*linea para multiples colores*/
	if($num==8){$num=0;}else{$num++;}
	/*linea para multiples colores*/		
	$select='';
	if($_SESSION['DEPARTAMENTO']==$row1['nombreplantilla']){$select = "selected";};

	$option .= '<option style="background: #'./*linea para multiples colores*/$fondos[$num]./*linea para multiples colores*/'" '.$select.' value="'.$row1['nombreplantilla'].'">'.$row1['nombreplantilla'].'</option>';
	}
	echo $encabezado.$option.'</select>';			
	?>	




</td>

</tr>
</table>
		<div class="datos_ajax">
		</div>
  
<!--aqui termina filtro-->


</div>
</div>
</div>

<?php
if (!empty($_GET['NUMERO_CONSECUTIVO_PROVEE'])) {
    $_SESSION['NUMERO_CONSECUTIVO_PROVEE'] = $_GET['NUMERO_CONSECUTIVO_PROVEE'];
} else {
    $_SESSION['NUMERO_CONSECUTIVO_PROVEE'] = '';
}
require "clases/script.filtro.php";
?>