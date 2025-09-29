<?php
/*
fecha sandor: 05/06/2025
fecha fatis : 07/04/2024
*/
?>
	<?php
$connecDB = $conexion->db();


if (!isset($_SERVER['HTTP_X_REQUESTED_WITH']) || $_SERVER['HTTP_X_REQUESTED_WITH'] != 'XMLHttpRequest') {
$idem_usuario = $_SESSION['idem'];
$pagoproveedores->borrar_historico_xml('02SUBETUFACTURADOCTOS',$idem_usuario);
$_SESSION['P_NOMBRE_COMERCIAL_EMPRESA12'] = '';
$_SESSION['idusuario12']= '';

}

?>
		<script type="text/javascript">

		function calcular() {
			const numberNoCommas = (x) => {
				return x.toString().replace(/,/g, "");
			}
			const numberWithCommas = (x) => {
			
				const num = parseFloat(x);
				if(isNaN(num)) return '';
				return num.toFixed(2).replace(/\B(?=(\d{3})+(?!\d))/g, ",");
			}

			function formatInputPreservingCursor(inputElement, value) {
				const originalValue = inputElement.value;
				const cursorPos = inputElement.selectionStart;
				const commasBefore = originalValue.slice(0, cursorPos).split(',').length - 1;
				const formattedValue = numberWithCommas(value);
				inputElement.value = formattedValue;
				let newCursorPos = cursorPos - commasBefore;
				let i = 0,
					charsPassed = 0;
				while(charsPassed < newCursorPos && i < formattedValue.length) {
					if(formattedValue[i] !== ',') {
						charsPassed++;
					}
					i++;
				}
				inputElement.setSelectionRange(i, i);
			}
			// Listener para inputs tipo .tol
			const inputs = document.querySelectorAll(".total");
			inputs.forEach(input => {
				input.addEventListener("keydown", function(e) {
					const keyCode = e.keyCode || e.which;
					// Teclas numéricas (teclado principal del 0 al 9 o numpad 0 al 9)
					const isNumberKey = (keyCode >= 48 && keyCode <= 57) || // Teclado principal
						(keyCode >= 96 && keyCode <= 105) || (keyCode === 46) || (keyCode === 8); // Numpad
					if(isNumberKey) {
						// Esperar a que el valor se actualice antes de formatear
						setTimeout(() => {
							const arr = document.getElementsByClassName("total");
							let MONTO_PROPINA_elem = document.getElementsByName("MONTO_PROPINA")[0];
							let MONTO_FACTURA_elem = document.getElementsByName("MONTO_FACTURA")[0];
							let MONTO_PROPINA2 = numberNoCommas(MONTO_PROPINA_elem.value);
							let MONTO_FACTURA2 = numberNoCommas(MONTO_FACTURA_elem.value);
					
							let tot = 0;
							for(let i = 0; i < arr.length; i++) {
								const inputName = arr[i].getAttribute("name");
								const value = parseFloat(numberNoCommas(arr[i].value)) || 0;
								if(["TImpuestosRetenidosIVA", "TImpuestosRetenidosISR", "descuentos"].includes(inputName)) {
									tot -= value; // Se RESTA
								} else {
									tot += value; // Se SUMA
								}
							}
							formatInputPreservingCursor(document.getElementById('MONTO_DEPOSITAR'), tot);
							formatInputPreservingCursor(MONTO_PROPINA_elem, MONTO_PROPINA2);
							formatInputPreservingCursor(MONTO_FACTURA_elem, MONTO_FACTURA2);

						}, 0);
					}
				});
			});
		}
		document.addEventListener("DOMContentLoaded", calcular);
		$(document).on('change', 'input[type="checkbox"]', function(e) {
			if(this.id == "MONTO_DEPOSITAR1") {
				if(this.checked) $('#FECHA_AUTORIZACION_RESPONSABLE').val(this.value);
				else $('#FECHA_AUTORIZACION_RESPONSABLE').val("");
			}
		});
		$(document).on('change', 'input[type="checkbox"]', function(e) {
			if(this.id == "MONTO_DEPOSITAR2") {
				if(this.checked) $('#FECHA_AUTORIZACION_AUDITORIA').val(this.value);
				else $('#FECHA_AUTORIZACION_AUDITORIA').val("");
			}
		});
		$(document).on('change', 'input[type="checkbox"]', function(e) {
			if(this.id == "MONTO_DEPOSITAR3") {
				if(this.checked) $('#FECHA_DE_LLENADO').val(this.value);
				else $('#FECHA_DE_LLENADO').val("");
			}
		});
		</script>
		<div id="content">
			<hr/> <strong> <P class="mb-0 text-uppercase">
<img src="includes/contraer31.png" id="mostrar1" style="cursor:pointer;"/>
<img src="includes/contraer41.png" id="ocultar1" style="cursor:pointer;"/>&nbsp;&nbsp;&nbsp;VIÁTICOS</p></strong></div>
		<div id="mensajepagoproveedores2">
			<div class="progress" style="width: 25%;">
				<div class="progress-bar" role="progressbar" style="width: <?php echo $pagoaproveedoress ; ?>%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">
					<?php echo $pagoaproveedoress ; ?>%</div>
			</div>
		</div>
		<div id="target1" style="display:block;" class="content2">
			<div class="card">
				<div class="card-body">
				<form class="row g-3 needs-validation was-validated" novalidate="" id="pagoaproveedoresform" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
					                 <table class="table table-striped table-bordered"  >
         
               
                 <tr  style="background: #d2faf1" > 

           
                 <th scope="row"> <label  for="formFileSm"  class="form-label">ADJUNTAR FACTURA(FORMATO XML)</label></th>
                 <td style="width:400px;">
				 
	


		<div id="drop_file_zone" ondrop="upload_file(event,'ADJUNTAR_FACTURA_XML')" ondragover="return false" >
		<p>Suelta aquí o busca tu archivo</p>
		<p><input class="form-control form-control-sm" id="ADJUNTAR_FACTURA_XML" type="text" onkeydown="return false" onclick="file_explorer('ADJUNTAR_FACTURA_XML');"  VALUE="<?php echo $ADJUNTAR_FACTURA_XML; ?>" required /></p>
		<input type="file" name="ADJUNTAR_FACTURA_XML" id="nono"/>
		<div id="1ADJUNTAR_FACTURA_XML">
		   <?php 
		if($ADJUNTAR_FACTURA_XML!=""){echo "<a target='_blank' href='includes/archivos/".$ADJUNTAR_FACTURA_XML."'>Visualizar!</a>"; 
		}?>
		</div>
		</div>
		

				 
<div id="2ADJUNTAR_FACTURA_XML"><?php 

$listadosube = $pagoproveedores->Listado_subefacturadocto('ADJUNTAR_FACTURA_XML');

while($rowsube=mysqli_fetch_array($listadosube)){
	echo "<a target='_blank' href='includes/archivos/".$rowsube['ADJUNTAR_FACTURA_XML']."' id='A".$rowsube['id']."' >Visualizar!</a> "." <span id='".$rowsube['id']."' class='view_dataSBborrar2' style='cursor:pointer;color:blue;'>Borrar!</span> <span > ".$rowsube['fechaingreso']."</span>".'<br/>';		
}

	$NUMERO_CONSECUTIVO_PROVEE = '';	
	$FECHA_DE_PAGO = '';
	
	$regreso = $pagoproveedores->variable_SUBETUFACTURA();
	$url = __ROOT1__.'/includes/archivos/'.$regreso['ADJUNTAR_FACTURA_XML'];
	
if( file_exists($url) ){
	$regreso = $conexion2->lectorxml($url);
	
	$Version = $regreso['Version'];
	$sello = $regreso['selo'];
	$Certificado = $regreso['Certificado'];
	$noCertificado = $regreso['noCertificado'];
	$fecha = $regreso['fecha'];
	$tipoDeComprobante = $regreso['tipoDeComprobante'];
	$metodoDePago = $regreso['metodoDePago'];
	$formaDePago = $regreso['formaDePago'];
	$condicionesDePago = $regreso['condicionesDePago'];
	$subTotal = $regreso['subTotal'];
	$TipoCambio = $regreso['TipoCambio'];
	$Moneda = $regreso['Moneda'];
	$total = $regreso['total'];
	$serie = $regreso['serie'];
	$folio = $regreso['folio'];
	$LugarExpedicion = $regreso['LugarExpedicion'];
	
	$rfcE = $regreso['rfcE'];					
	$nombreE = $regreso['nombreE'];	
	$regimenE = $regreso['regimenE'];
	
	$rfcR = $regreso['rfcR'];
	$nombreR = $regreso['nombreR'];
	$UsoCFDI = $regreso['UsoCFDI'];
	$DomicilioFiscalReceptor = $regreso['DomicilioFiscalReceptor'];
	$RegimenFiscalReceptor = $regreso['RegimenFiscalReceptor'];
	
	$UUID = $regreso['UUID'];
	$selloCFD = $regreso['selloCFD'];
	$noCertificadoSAT = $regreso['noCertificadoSAT'];	
	$FechaTimbrado = $regreso['FechaTimbrado'];
	$RfcProvCertif = $regreso['RfcProvCertif'];	
	$TImpuestosRetenidos = $regreso['TImpuestosRetenidos'];
	$TImpuestosTrasladados = $regreso['TImpuestosTrasladados'];
        $Descuento = $regreso['Descuento'];
	$Cantidad = $regreso['Cantidad'];
	$ValorUnitario = $regreso['ValorUnitario'];
	$Importe = $regreso['Importe'];
	$ClaveProdServ = $regreso['ClaveProdServ'];
	$Unidad = $regreso['Unidad'];
	$Descripcion = $regreso['Descripcion'];
	$ClaveUnidad = $regreso['ClaveUnidad'];
	$NoIdentificacion = $regreso['NoIdentificacion'];
	$ObjetoImp = $regreso['ObjetoImp'];
	$impueRdesglosado002 = $regreso['impueRdesglosado002'];
	$impueRdesglosado001 = $regreso['impueRdesglosado001'];
	
	/*nuevo*/

	$fechaInicio=strtotime(date('Y-m-d'));
	$FECHA_domingo = date('Y-m-d', strtotime('next monday', $fechaInicio));
	$FECHA_jueves = date('Y-m-d', strtotime('next Thursday', strtotime($FECHA_domingo)));
	$FECHA_DE_PAGO = $FECHA_jueves;//'2023-08-03';//. $conexion2->fechaEs($FECHA_jueves);

	/*nuevo*/
		
	$NUMERO_CONSECUTIVO_PROVEE = $pagoproveedores->select_02XML() + 1;
}
?></div>		

         
</td>
             </tr>
			 
			 
			 
			 
			 
             <tr  style="background: #d2faf1" >  

             
<th scope="row"> <label for="validationCustom03" class="form-label">ADJUNTAR FACTURA (FORMATO PDF)</label></th>


<td>



<div id="drop_file_zone" ondrop="upload_file(event,'ADJUNTAR_FACTURA_PDF')" ondragover="return false" >
<p>Suelta aquí o busca tu archivo</p>
<p><input class="form-control form-control-sm" id="ADJUNTAR_FACTURA_PDF" type="text" onkeydown="return false" onclick="file_explorer('ADJUNTAR_FACTURA_PDF');"  VALUE="<?php echo $ADJUNTAR_FACTURA_PDF; ?>" required /></p>
<input type="file" name="ADJUNTAR_FACTURA_PDF" id="nono"/>

</div>



<div id="2ADJUNTAR_FACTURA_PDF"><?php 

$listadosube = $pagoproveedores->Listado_subefacturadocto('ADJUNTAR_FACTURA_PDF');

while($rowsube=mysqli_fetch_array($listadosube)){
echo "<a target='_blank' href='includes/archivos/".$rowsube['ADJUNTAR_FACTURA_PDF']."' id='A".$rowsube['id']."' >Visualizar!</a> "." <span id='".$rowsube['id']."' class='view_dataSBborrar2' style='cursor:pointer;color:blue;'>Borrar!</span> <span > ".$rowsube['fechaingreso']."</span>".'<br/>';		

}

?></div>			 


</td>
</tr>             

        
                 <tr  style="background:#c5f58c"> 

                 <th scope="row"> <label for="validationCustom03" class="form-label">NÚMERO CONSECUTIVO DE PAGO A PROVEEDORES</label></th>
                 <td> <input type="text" class="form-control"  required=""  value="<?php  echo $NUMERO_CONSECUTIVO_PROVEE = isset($_GET['NUMERO_CONSECUTIVO_PROVEE'])?$_GET['NUMERO_CONSECUTIVO_PROVEE']:''; ?>" name="NUMERO_CONSECUTIVO_PROVEE" placeholder=""  readonly="readonly"></div></td>
                 </tr>
				 
		 
				 
				 
				 
				 
				 
				 
				  <tr style="width:300px;background:#d2faf1">
				     <th scope="row"> <label  style="width:300px;text-align:left"  for="validationCustom03" class="form-label">PAGO A PROVEEDOR, VIÁTICO O REEMBOLSO:</label></th>
           <td><input type="text" class="form-control" id="VIATICOS" required=""  value="VIATICOS" name="VIATICOSOPRO" placeholder="VIATICOS"  readonly="readonly"></td>
                 </tr>
      	                 <tr  style="background:#c5f58c"> 

                 <th scope="row"> <label for="validationCustom03" class="form-label">ID RELACIONADO A ESTE VIÁTICO</label></th>
                 <td> <input type="text" class="form-control" id="ID_RELACIONADO" required=""  value="<?php 
				 
				 echo $ID_RELACIONADO = isset($_GET['ID_RELACIONADO'])?$_GET['ID_RELACIONADO']:''; ?>" name="ID_RELACIONADO" placeholder="ID RELACIONADO"  readonly="readonly"></div></td>
                 </tr>		


				 

                 <tr style="background: #d2faf1"> 

     <th scope="row"> <label for="validationCustom03" class="form-label">NOMBRE COMERCIAL</label></th>
   <td><input type="text" class="form-control"  required=""  value="<?php echo $NOMBRE_COMERCIAL; ?>" name="NOMBRE_COMERCIAL" placeholder="NOMBRE COMERCIAL"></td>
                 </tr>
				 
				 
				 
<tr  style="background:#fcf3cf"> 

<th scope="row"> <label for="validationCustom03" class="form-label">RAZÓN SOCIAL</label></th>
                 <td> <div id="RAZON_SOCIAL2">
				 
				
				 
<input type="text" class="form-control" id="RAZON_SOCIAL" required=""  value="<?php echo $nombreE; ?>" name="RAZON_SOCIAL" placeholder="RAZÓN SOCIAL">
				 </div>
				 </td>
                 </tr>
                 <tr  style="background:#fcf3cf"> 
              

   <th scope="row"> <label for="validationCustom03" class="form-label">RFC DEL PROVEEDOR:</label></th>
                 <td><div id="RFC_PROVEEDOR2">
				 
	
<input type="text" class="form-control" id="RFC_PROVEEDOR"   value="<?php echo $rfcE; ?>" name="RFC_PROVEEDOR" placeholder="RFC DEL PROVEEDOR">
				 
				 </div>
				 </td>
                 </tr>
				 
				 
				                  <tr  style="background: #d2faf1">

                 <th scope="row"> <label for="validationCustom03" class="form-label">MOTIVO DEL GASTO:</label></th>
                 <td><input type="text" class="form-control" id="validationCustom03" required=""  value="<?php echo $MOTIVO_GASTO; ?>" name="MOTIVO_GASTO"placeholder="MOTIVO DEL GASTO "></td>
                 </tr>
                 <tr style="background: #d2faf1">

                                 <th scope="row"> <label  style="width:300px" for="validationCustom03" class="form-label">No. DE EVENTO:</label></th>
                 <td>




<div style="">
  <select class="form-select mb-3" id="NUMERO_EVENTO" name="NUMERO_EVENTO" onchange="buscanombreevento(1);">
  <option value="<?php echo $numero_evento_get; ?>"><?php echo $numero_evento_get; ?></option>
  </select>
</div>
				 
<script type="text/javascript">
      $('#NUMERO_EVENTO').select2({
        placeholder: 'ESCRIBE Y SELECCIONA UNA OPCIÓN',
        ajax: {
          url: 'comprobaciones/controladorPP.php',
          dataType: 'json',
          delay: 250,
		  type:'post',
          processResults: function (data) {
            return {
              results: data
            };
          },
          cache: true
        }
      });






function buscanombreevento(page){
			var NUMERO_EVENTO=$("#NUMERO_EVENTO").val();
var parametros = {
			"action":"ajax",
			"NUMERO_EVENTO":NUMERO_EVENTO
};
			$("#loader").fadeIn('slow');
			$.ajax({
				url:'pagoproveedores/controladorPP.php',
				type: 'POST',				
				data: parametros,
				 beforeSend: function(objeto){
				$("#loader").html("Cargando...");
			  },
				success:function(data){
//buscaultimopago(1);
	document.getElementsByName('NOMBRE_EVENTO')[0].value = data;
				}
			})
		}





</script>




				 </td>
                 </tr>
				 
                 <tr  style="background:#fcf3cf">

                 <th scope="row"> <label for="validationCustom03" class="form-label">NOMBRE DEL EVENTO:</label></th>
                 <td><input type="text" class="form-control" id="NOMBRE_EVENTO" required=""  value="<?php echo $NOMBRE_EVENTO_get ?>" name="NOMBRE_EVENTO" placeholder="NOMBRE DEL EVENTO"></td>
                 </tr>
				 
				
				 
				 
    <tr style="background:#fcf3cf"> 

    <th scope="row"> <label for="validationCustom03" class="form-label">CONCEPTO DE LA FACTURA:</label></th>
    <td><div id="CONCEPTO_PROVEE2"><input type="text" class="form-control" id="CONCEPTO_PROVEE" required=""  value="<?php echo $Descripcion; ?>" name="CONCEPTO_PROVEE"placeholder="CONCEPTO DE LA FACTURA"></div></td>
                 </tr>
                 <tr  style="background: #d2faf1" > 
             <th scope="row"> <label for="validationCustom03" class="form-label">ADJUNTAR COTIZACIÓN O REPORTE: (CUAQUIER FORMATO)</label></th>
             <td>



  <div id="drop_file_zone" ondrop="upload_file(event,'ADJUNTAR_COTIZACION')" ondragover="return false" >
  <p>Suelta aquí o busca tu archivo</p>
  <p><input class="form-control form-control-sm" id="ADJUNTAR_COTIZACION" type="text" onkeydown="return false" onclick="file_explorer('ADJUNTAR_COTIZACION');"  VALUE="<?php echo $ADJUNTAR_COTIZACION; ?>" required /></p>
  <input type="file" name="ADJUNTAR_COTIZACION" id="nono"/>

  </div>
  

         
         <div id="2ADJUNTAR_COTIZACION"><?php $listadosube = $pagoproveedores->Listado_subefacturadocto('ADJUNTAR_COTIZACION');

while($rowsube=mysqli_fetch_array($listadosube)){
echo "<a target='_blank' href='includes/archivos/".$rowsube['ADJUNTAR_COTIZACION']."' id='A".$rowsube['id']."' >Visualizar!</a> "." <span id='".$rowsube['id']."' class='view_dataSBborrar2' style='cursor:pointer;color:blue;'>Borrar!</span><span > ".$rowsube['fechaingreso']."</span>".'<br/>';	
}


         ?></div>				 
         </td>
         
             </tr>
             

                 <tr style="background: #d2faf1">  

                 <th scope="row"> <label for="validationCustom03" class="form-label">MONTO TOTAL DE LA COTIZACIÓN O DEL ADEUDO:</label></th>
                 <td>   <div class="input-group mb-3"> <span class="input-group-text">$</span> <input type="text" class="form-control" id="validationCustom03" required=""  value="<?php echo $MONTO_TOTAL_COTIZACION_ADEUDO; ?>" name="MONTO_TOTAL_COTIZACION_ADEUDO"placeholder="MONTO TOTAL DE LA COTIZACÓN" onkeyup="comasainput('MONTO_TOTAL_COTIZACION_ADEUDO')"></td>
                 </tr> </div>
             
             

            
            


            <tr style="background:#fcf3cf">
					<th scope="row">
						<label style="width:300px" for="validationCustom03" class="form-label">SUB TOTAL:</label>
					</th>
					<td>
						<div id="2MONTO_FACTURA">
							<div class="input-group mb-3"> <span class="input-group-text">$</span>
								<input type="text" style="width:300px;height:40px;" id="MONTO_FACTURA" required="" onkeyup="calcular()" value="<?php echo $subTotal; ?>" name="MONTO_FACTURA" class="total" placeholder="SUB TOTAL"> </div>
						</div>
					</td>
				</tr>
				 
				 
				 
				 
				 <tr style="background:#fcf3cf">
				 <th scope="row"> <label  style="width:300px" for="validationCustom03" class="form-label">IVA:</label></th>               				 
				 <td> 				 
				<div id="2IVA">			 
     <div class="input-group mb-3"> <span class="input-group-text">$</span> <input type="text"  style="width:300px;height:40px;"  id="IVA" required="" onkeyup="calcular()" value="<?php echo $TImpuestosTrasladados; ?>"   name="IVA" class="total" placeholder="IVA">
				
				</div></div>
				 </td>
                 </tr> 

			 
				 
			<tr style="background:#fcf3cf">
            <th scope="row"> <label  style="width:300px" for="validationCustom03" class="form-label">IMPUESTOS RETENIDOS &nbsp;<a style="color:red;font:12px">(IVA)</a></label></th>               				 
				 <td> 				 
				<div id="2TImpuestosRetenidosIVA">			 
     <div class="input-group mb-3"> <span class="input-group-text">$</span> <input type="text"  style="width:300px;height:40px;"  id="TImpuestosRetenidosIVA" required=""  onkeyup="comasainput('TImpuestosRetenidosIVA')"   name="TImpuestosRetenidosIVA"  value="<?php echo $impueRdesglosado002; ?>" class="total" placeholder="IMPUESTOS RETENIDOS IVA">
				
				</div></div>
				 </td>
                 </tr>
				<tr style="background:#fcf3cf">
            <th scope="row"> <label  style="width:300px" for="validationCustom03" class="form-label">IMPUESTOS RETENIDOS &nbsp;<a style="color:red;font:12px">(ISR)</a></label></th>               				 
				 <td> 				 
				<div id="2TImpuestosRetenidosISR">			 
     <div class="input-group mb-3"> <span class="input-group-text">$</span> <input type="text"  style="width:300px;height:40px;"  onkeyup="comasainput('TImpuestosRetenidosISR')" id="TImpuestosRetenidosISR" required=""    name="TImpuestosRetenidosISR"  value="<?php echo $impueRdesglosado001; ?>" class="total" placeholder="IMPUESTOS RETENIDOS ISR">
				
				</div></div>
				 </td>
                 </tr>
				 
                 <tr style="background: #d2faf1">

                 <th scope="row"> <label   for="validationCustom03" class="form-label"><a style="color:red;font:12px">FAVOR DE PONER EL:&nbsp;</a>MONTO DE LA PROPINA O <br>SERVICIO ESTÉ INCLUIDO O NO EN LA FACTURA</label></th>
               
				 <div>
     				 <td> <div class="input-group mb-3"> <span class="input-group-text">$</span> <input type="text"  style="width:300px;height:40px;" onkeyup="calcular()" id="MONTO_PROPINA" required=""    value="<?php echo $MONTO_PROPINA; ?>" name="MONTO_PROPINA" class="total" placeholder="MONTO DE LA PROPINA"></td>
				 </div></div>
				 </td>
                 </tr>
				 
				 
                 <tr style="background: #d2faf1">           
                 <th scope="row"> <label  style="width:300px" for="validationCustom03" class="form-label"><a style="color:red;font:12px">FAVOR DE PONER EL:&nbsp;</a> IMPUESTO SOBRE <BR>HOSPEDAJE MÁS EL IMPUESTO DE SANEAMIENTO:</label></th>			
     				 <td> <div class="input-group mb-3"> <span class="input-group-text">$</span> <input type="text"  style="width:300px;height:40px;" onkeyup="calcular()" id="IMPUESTO_HOSPEDAJE" required=""    value="<?php echo $IMPUESTO_HOSPEDAJE; ?>" name="IMPUESTO_HOSPEDAJE" class="total" placeholder="IMPUESTO SOBRE HOSPEDAJE"></td>
				 </div></div>
				 </td>
                 </tr>
			<tr style="background:#fcf3cf">
            <th scope="row"> <label  style="width:300px" for="validationCustom03" class="form-label">DESCUENTO:</label></th>               				 
				 <td> 				 
				<div id="2descuentos">			 
     <div class="input-group mb-3"> <span class="input-group-text">$</span> <input type="text"  style="width:300px;height:40px;"  id="descuentos" required=""  onkeyup="comasainput('descuentos')"  name="descuentos"  value="<?php echo $Descuento; ?>" class="total" placeholder="DESCUENTO">
				
				</div></div>
				 </td>
                 </tr>				 

                    <tr style="background:#fcf3cf">

                 <th scope="row"> <label  style="width:300px" for="validationCustom03" class="form-label">TOTAL:</label></th>
                 <td>
				 <div id="2MONTO_DEPOSITAR">
             <div class="input-group mb-3"> <span class="input-group-text">$</span><input type="text" class="form-control" id="MONTO_DEPOSITAR" required=""   value="<?php echo $total; ?>" name="MONTO_DEPOSITAR"  placeholder="TOTAL">
				
				 </td>
                 </tr> </div> </div>
    
  


                 <tr style="background: #d2faf1">

                 <th scope="row"> 
				 
				 
				 <label  style="width:300px" for="validationCustom03" class="form-label">TIPO DE MONEDA O DIVISA:</label></th>
                
      

                 <td>
				 
                 <div id="TIPO_DE_MONEDA2">				 
				 <select class="form-select mb-3" aria-label="Default select example" id="validationCustom02" required="" name="TIPO_DE_MONEDA">			                 
                         <option style="background: #c9e8e8" value="<?php echo $Moneda; ?>" <?php if($Moneda=='MXN'){echo "selected";} ?>>MXN (Peso mexicano)</option>
                         <option style="background: #a3e4d7" value="<?php echo $Moneda; ?>" <?php if($Moneda=='USD'){echo "selected";} ?>>USD (Dolar)</option>
                         <option style="background: #e8f6f3" value="<?php echo $Moneda; ?>" <?php if($Moneda=='EUR'){echo "selected";} ?>>EUR (Euro)</option>
                         <option style="background: #fdf2e9" value="<?php echo $Moneda; ?>" <?php if($Moneda=='GBP'){echo "selected";} ?>>GBP (Libra esterlina)</option>
                         <option style="background: #eaeded" value="<?php echo $Moneda; ?>" <?php if($Moneda=='CHF'){echo "selected";} ?>>CHF (Franco suizo)</option>
                         <option style="background: #fdebd0" value="<?php echo $Moneda; ?>" <?php if($Moneda=='CNY'){echo "selected";} ?>>CNY (Yuan)</option>
                         <option style="background: #ebdef0" value="<?php echo $Moneda; ?>" <?php if($Moneda=='JPY'){echo "selected";} ?>>JPY (Yen japonés)</option>
                         <option style="background: #d6eaf8" value="<?php echo $Moneda; ?>" <?php if($Moneda=='HKD'){echo "selected";} ?>>HKD (Dólar hongkonés)</option>
                         <option style="background: #fef5e7" value="<?php echo $Moneda; ?>" <?php if($Moneda=='CAD'){echo "selected";} ?>>CAD (Dólar canadiense)</option>
                         <option style="background: #ebedef" value="<?php echo $Moneda; ?>" <?php if($Moneda=='AUD'){echo "selected";} ?>>AUD (Dólar australiano)</option>
                         <option style="background: #fbeee6" value="<?php echo $Moneda; ?>" <?php if($Moneda=='BRL'){echo "selected";} ?>>BRL (Real brasileño)</option>
                         <option style="background: #e8f6f3" value="<?php echo $Moneda; ?>" <?php if($Moneda=='RUB'){echo "selected";} ?>>RUB  (Rublo ruso)</option>

                         </select> 
                            </div>
							
							</td>                    

                 </tr>
				 
				     <tr style="background: #d2faf1">				 
                 <th scope="row"> <label  style="width:300px" for="validationCustom03" class="form-label">TIPO DE CAMBIO:</label></th>
             			
				 <td>
             <div class="input-group mb-3"> <span class="input-group-text">$</span> <input type="text" style="width:300px;height:40px;"  value="<?php echo $TIPO_CAMBIOP; ?>" name="TIPO_CAMBIOP" onkeyup="comasainput2('TIPO_CAMBIOP')"  placeholder="TIPO DE CAMBIO" >
				 </div>
 </td>
				 </tr>
				     <tr style="background: #d2faf1">				 
				 <th scope="row"> <label  style="width:300px" for="validationCustom03" class="form-label">TOTAL DE LA CONVERSIÓN:</label></th>
             
                
				 
			
				 <td>
             <div class="input-group mb-3"> <span class="input-group-text">$</span> <input type="text" style="width:300px;height:40px;"  value="<?php echo $TOTAL_ENPESOS; ?>" name="TOTAL_ENPESOS" onkeyup="comasainput2('TOTAL_ENPESOS')"  placeholder="TOTAL DE LA CONVERSIÓN" >
				 </div>
 </td>
				 </tr>
				 
				 
				 
				 
				 
				 
                 <tr  style="background: #d2faf1">

                 <th><label style="width: 300px" for="validationCustom02" class="form-label">FORMA DE PAGO:</label></th>
				 
				 
             <td style="width: 45%;">

             <script type="text/javascript">  function EFECTIVO (texto) {    alert(texto);} </script>
<div id="2PFORMADE_PAGO">

       <select class="form-select mb-3" aria-label="Default select example" id="PFORMADE_PAGO" required="" name="PFORMADE_PAGO">

              <option style="background:#dee6fc" <?php if($formaDePago=='04'){echo "selected";} ?> value="04">04 TARJETA DE CREDITO</option>
			  
              <option style="background:#f2b4f5" <?php if($formaDePago=='03'){echo "selected";} ?> value="03">03 TRANSFERENCIA ELECTRONICA DE FONDOS</option>
        
              <option style="background:#ddf5da"  <?php if($formaDePago=='01'){echo "selected";} ?>  value="01 EFECTIVO" >01 EFECTIVO</option>
				
        
              <option style="background:#fceade" <?php if($formaDePago=='02'){echo "selected";} ?> value="02">02 CHEQUE NOMITATIVO</option>
        
     
        
              <option style="background:#f6fcde" <?php if($formaDePago=='05'){echo "selected";} ?> value="05">05 MONEDERO ELECTRONICO</option>
        
              <option style="background:#dee2fc" <?php if($formaDePago=='06'){echo "selected";} ?> value="06">06 DINERO ELECTRONICO</option>
        
              <option style="background:#f9e5fa" <?php if($formaDePago=='08'){echo "selected";} ?> value="08">08 VALES DE DESPENSA</option>
        
              <option style="background:#eefcde" <?php if($formaDePago=='28'){echo "selected";} ?> value="28">28 TARJETA DE DEBITO</option>
        
              <option style="background:#fcfbde" <?php if($formaDePago=='29'){echo "selected";} ?> value="29">29 TARJETA DE SERVICIO</option>
        
              <option style="background:#f9e5fa" <?php if($formaDePago=='99'){echo "selected";} ?> value="99">99 OTRO</option>
        
              </select> 
        
    <div/>
        </td>

        </tr>

                 <tr style="background: #d2faf1"> 

                 <th scope="row"> <label for="validationCustom03" class="form-label">FECHA EFECTIVA DE PAGO:</label></th>
                 <td><input type="date" class="form-control" id="validationCustom03" required=""  value="<?php echo $FECHA_A_DEPOSITAR; ?>" name="FECHA_A_DEPOSITAR" placeholder="FECHA A DEPOSITAR" ></td>
                 </tr>

 

                 <tr style="background: #d2faf1" > 
                             
                 <th scope="row">  <label for="validationCustom02" class="form-label">STATUS DE PAGO:</label></th>
                 <td>   <select class="form-select mb-3" aria-label="Default select example" id="validationCustom02" value="<?php echo $STATUS_DE_PAGO; ?>" required="" name="STATUS_DE_PAGO"> 
                <strong>   <option style="background:#d9f9fa " <?php if($FORMATO_EVENTO=='PAGADO'){echo "selected";} ?> value="PAGADO">PAGADO</option></strong>
				<strong>   <option style="background:#d9f9fa " <?php if($FORMATO_EVENTO=='COTIZADO'){echo "selected";} ?> value="COTIZADO">COTIZADO</option></strong>
				<strong>   <option style="background:#d9f9fa " <?php if($FORMATO_EVENTO=='COTIZADO'){echo "selected";} ?> value="COTIZADO">CANCELADO</option></strong>
				

                   
                 </tr>
              
<tr  style="background: #d2faf1"> 

<th scope="row"> <label  style="width:300px" for="validationCustom03" class="form-label">OBSERVACIONES:</label></th>
<td><input type="text" class="form-control" id="validationCustom03" required=""  value="<?php echo $OBSERVACIONES_1; ?>" name="OBSERVACIONES_1"placeholder="OBSERVACIONES 1"></td>
</tr>
				 
				 
				 

                <tr style="background: #d2faf1"> 

                 <th scope="row"> <label for="validationCustom03" class="form-label"> ADJUNTAR COMPROBANTE DE DEVOLUCIÓN DE DINERO:(CUALQUIER FORMATO)</label></th>
                 <td  style="width:400px;">
 
		<div id="drop_file_zone" ondrop="upload_file(event,'COMPROBANTE_DE_DEVOLUCION')" ondragover="return false" >
		<p>Suelta aquí o busca tu archivo</p>
		<p><input class="form-control form-control-sm" id="COMPROBANTE_DE_DEVOLUCION" type="text" onkeydown="return false" onclick="file_explorer('COMPROBANTE_DE_DEVOLUCION');" VALUE="<?php echo $COMPROBANTE_DE_DEVOLUCION; ?>" required /></p>
		<input type="file" name="COMPROBANTE_DE_DEVOLUCION" id="nono"/>
	
		</div>

				 
				 <div id="2COMPROBANTE_DE_DEVOLUCION"><?php $listadosube = $pagoproveedores->Listado_subefacturadocto('COMPROBANTE_DE_DEVOLUCION');

while($rowsube=mysqli_fetch_array($listadosube)){
	echo "<a target='_blank' href='includes/archivos/".$rowsube['CALCULO_DE_COMISION']."' id='A".$rowsube['id']."' >Visualizar!</a> "." <span id='".$rowsube['id']."' class='view_dataSBborrar2' style='cursor:pointer;color:blue;'>Borrar!</span><span > ".$rowsube['fechaingreso']."</span>".'<br/>';	
}


				 ?></div> 
				 </td>
                 </tr> 

				 
<tr  style="background:#fcf3cf" >				 
<th scope="row"> <label  for="validationCustom03" class="form-label">NOMBRE DEL EJECUTIVO QUE INGRESO ESTA FACTURA:</label></th>
<td><input type="text" class="form-control" id="validationCustom03" required=""  value="<?php echo $_SESSION["NOMBREUSUARIO"]; ?>" name="NOMBRE_DEL_AYUDO"placeholder="NOMBRE DEL EJECUTIVO" readonly="readonly"></td>
</tr>					 
<tr>
    <th style="background: #d2faf1; text-align:left" scope="col">NOMBRE DEL EJECUTIVO QUE REALIZÓ LA COMPRA:</th>
       <td  style="background: #d2faf1"  >
<?php
$encabezadoA = '';
$queryper = $conexion->colaborador_generico_bueno();
$encabezadoA = '<select class="form-select mb-3" aria-label="Default select example" id="NOMBRE_DEL_EJECUTIVO" required="" name="NOMBRE_DEL_EJECUTIVO"  placeholder="SELECIONA UNA OPCIÓN">
<option> SELECIONA UNA OPCIÓN</option>';


$fondos = array("fff0df","f4ffdf","dfffed","dffeff","dfe8ff","efdfff","ffdffd","efdfff","ffdfe9");
$num = 0;

while($row = mysqli_fetch_array($queryper))
{

if($num==8){$num=0;}else{$num++;}

$select='';
if($_SESSION['idem']==$row['idRelacion']){
$select='selected';
}

$option2 .= '<option style="background: #'.$fondos[$num].'" '.$select.' 
value="'.$row['NOMBRE_1'].' '.$row['NOMBRE_2'].' '.$row['APELLIDO_PATERNO'].' '.$row['APELLIDO_MATERNO'].'">'.$row['NOMBRE_1'].' '.$row['NOMBRE_2'].' '.$row['APELLIDO_PATERNO'].' '.$row['APELLIDO_MATERNO'].
'</option>';
}
echo $encabezadoA.$option2.'</select>';		
?></td>

    </tr>


             
          
            
                 <tr style="background: #d2faf1"> 

                 <th scope="row"> <label for="validationCustom03" class="form-label">ADJUNTAR ARCHIVO RELACIONADO A ESTE GASTO: (CUALQUIER FORMATO)</label></th>
                 <td>

		            <div id="drop_file_zone" ondrop="upload_file(event,'ADJUNTAR_ARCHIVO_1')" ondragover="return false" >
	              	<p>Suelta aquí o busca tu archivo</p>
		            <p><input class="form-control form-control-sm" id="ADJUNTAR_ARCHIVO_1" type="text" onkeydown="return false" onclick="file_explorer('ADJUNTAR_ARCHIVO_1');"  VALUE="<?php echo $ADJUNTAR_ARCHIVO_1; ?>" required /></p>
		            <input type="file" name="ADJUNTAR_ARCHIVO_1" id="nono"/>
		        
		            </div>

			 	 
				 <div id="2ADJUNTAR_ARCHIVO_1"><?php 
	           $listadosube = $pagoproveedores->Listado_subefacturadocto('ADJUNTAR_ARCHIVO_1');

	            while($rowsube=mysqli_fetch_array($listadosube)){
	           echo "<a target='_blank' href='includes/archivos/".$rowsube['ADJUNTAR_ARCHIVO_1']."'  id='A".$rowsube['id']."' >Visualizar!</a> "." <span id='".$rowsube['id']."' class='view_dataSBborrar2' style='cursor:pointer;color:blue;'>Borrar!</span><span > ".$rowsube['fechaingreso']."</span>".'<br/>';
	              }


				 ?></div>	
					 

         
         <input type="hidden" style="width:200px;"  class="form-control" id="validationCustom03"   value="<?php echo date('d-m-Y'); ?>" name="FECHA_DE_LLENADO">
      
            
 
				



            <input type="hidden" name="hiddenpagoproveedores" value="hiddenpagoproveedores">
                          

	
                

	</table>

 
  
                   
						 
    	   
                
              

<BR/>
<BR/>

				       
                           <table  style="border-collapse:collapse;" border="1";  class="table mb-0 table-striped" id="resettabla">
	

                    <tr>
                    <th scope="col">FACTURA</th>
                    <th  scope="col">DATOS DE LA FACTURA</th>
                    </tr>

                   <tr>
                    <th scope="row"> <label for="validationCustom03" class="form-label">NOMBRE RECEPTOR:</label></th>
                 <td><input type="text" class="form-control" id="validationCustom03" required=""  value="<?php echo $nombreR; ?>" name="DATOS_DE_EPC_INNOVACC_JUST" placeholder="DATOS DE EPC, INNOVACC O JUST"readonly="readonly"></td>
                 </tr>
                 

                   <tr>
                    <th scope="row"> <label for="validationCustom03" class="form-label">RFC RECEPTOR:</label></th>
                 <td><input type="text" class="form-control" id="validationCustom03" required=""  value="<?php echo $rfcR; ?>" name="DATOS_DE_EPC_INNOVACC_JUST" placeholder="DATOS DE EPC, INNOVACC O JUST"readonly="readonly"></td>
                 </tr>
				 
             
                 
                    <tr>
                    <th scope="row"> <label for="validationCustom03" class="form-label">RAZÓN SOCIAL DEL PROVEEDOR:</label></th>
                 <td><input type="text" class="form-control" id="validationCustom03" required=""  value="<?php echo $nombreE; ?>" name="RAZON_SOCIAL_FACTURA" placeholder="RAZON SOCIAL DEL PROVEEDOR" readonly="readonly"></td>
                 </tr>

                 <tr>
                    <th scope="row"> <label for="validationCustom03" class="form-label">RFC:</label></th>
                 <td><input type="text" class="form-control" id="validationCustom03" required=""  value="<?php echo $rfcE; ?>" name="rfcE" placeholder="RFC" readonly="readonly"></td>
                 </tr>
                 
				 <tr>
                 <th scope="row"> <label for="validationCustom03" class="form-label">REGÍMEN FISCAL:</label></th>
                 <td><input type="text" class="form-control" id="validationCustom03" required=""  value="<?php echo $regimenE; ?>" name="RegimenFiscalReceptor" placeholder="REGIMEN FISCAL"readonly="readonly"></td>
                 </tr>
				 
		                 <tr>		 
                 <th scope="row"> <label for="validationCustom03" class="form-label">UUID:</label></th>
                 <td><input type="text" class="form-control" id="validationCustom03" required=""  value="<?php echo $UUID; ?>" name="UUID" placeholder="UUID" readonly="readonly"></td>
                 </tr>

                 <tr>
                    <th scope="row"> <label for="validationCustom03" class="form-label">FOLIO:</label></th>
                 <td><input type="text" class="form-control" id="validationCustom03" required=""  value="<?php echo $folio; ?>" name="FOLIO_FACTURA" placeholder="FOLIO" readonly="readonly"></td>
                 </tr>
				 
                 <tr>
                    <th scope="row"> <label for="validationCustom03" class="form-label">SERIE:</label></th>
                 <td><input type="text" class="form-control" id="validationCustom03" required=""  value="<?php echo $serie; ?>" name="SERIE_FACTURA" placeholder="SERIE" readonly="readonly"></td>
                 </tr>
                 <tr>
                 <th scope="row"><label for="validationCustom03" class="form-label">FECHA DE FACTURA:</label></th>
                 <td><input  type="text" class="form-control" id="validationCustom03" required=""  value="<?php echo $fecha; ?>" name="FECHA_DE_EMISION" placeholder="FECHA DE FACTURA" readonly="readonly"></td>
                 </tr>
                
                 <tr>
                    <th scope="row"> <label for="validationCustom03" class="form-label">CANTIDAD:</label></th>
                 <td><input type="text" class="form-control" id="validationCustom03" required=""  value="<?php echo $Cantidad; ?>" name="CANTIDAD" placeholder="CANTIDAD"readonly="readonly"></td>
                 </tr>
                 <tr>
                    <th scope="row"> <label for="validationCustom03" class="form-label">CLAVE DE PRODUCTO O SERVICIO:</label></th>
                 <td><input type="text" class="form-control" id="validationCustom03" required=""  value="<?php echo $ClaveProdServ; ?>" name="CLAVE-PRODUCTO_SERVICIO" placeholder="CLAVE DE PRODUCTO O SERVICIO"readonly="readonly"></td>
                 </tr>
                 <tr>
                 <th scope="row"> <label for="validationCustom03" class="form-label">CLAVE DE UNIDAD:</label></th>
                 <td><input type="text" class="form-control" id="validationCustom03" required=""  value="<?php echo $ClaveUnidad; ?>" name="CLAVE_DE_UNIDAD" placeholder="CLAVE DE UNIDAD"readonly="readonly"></td>
                 </tr>


				 
                 <tr>
                    <th scope="row"> <label for="validationCustom03" class="form-label">DESCRIPCIÓN:</label></th>
                 <td><input type="text" class="form-control" id="validationCustom03" required=""  value="<?php echo $Descripcion; ?>" name="DESCRIPCION" placeholder="DESCRIPCION"readonly="readonly"></td>
                 </tr>
                 <tr>
                    <th scope="row"> <label for="validationCustom03" class="form-label">DESCUENTO:</label></th>
                 <td><input type="text" class="form-control" id="validationCustom03" required=""  value="<?php echo $Descuento; ?>" name="DESCUENTO" placeholder="DESCUESTO"readonly="readonly"></td>
                 </tr>
                 
				 <tr> <th scope="row"> <label for="validationCustom03" class="form-label">IMPORTE:</label></th>
                 <td><input type="text" class="form-control" id="validationCustom03" required=""  value="<?php echo $Importe; ?>" name="IMPORTE" placeholder="IMPORTE"readonly="readonly"></td>
                 </tr>

                 <tr>
                 <th scope="row"> <label for="validationCustom03" class="form-label">No IDENTIFICACION:</label></th>
                 <td><input type="text" class="form-control" id="validationCustom03" required=""  value="<?php echo $NoIdentificacion; ?>" name="No_IDENTIFICACION" placeholder="No IDENTIFICACION"readonly="readonly"></td>
                 </tr>
                 <tr>
                    <th scope="row"> <label for="validationCustom03" class="form-label">OBJETO IMP:</label></th>
                 <td><input type="text" class="form-control" id="validationCustom03" required=""  value="<?php echo $ObjetoImp; ?>" name="OBJETO_IMP" placeholder="OBJETO IMP"readonly="readonly"></td>
                 </tr>
                 <tr>
                    <th scope="row"> <label for="validationCustom03" class="form-label">UNIDAD:</label></th>
                 <td><input type="text" class="form-control" id="validationCustom03" required=""  value="<?php echo $Unidad; ?>" name="IVA_FACTURA" placeholder="UNIDAD"readonly="readonly"></td>
                 </tr>
                 <tr>
                    <th scope="row"> <label for="validationCustom03" class="form-label">VALOR UNITARIO:</label></th>
                 <td><input type="text" class="form-control" id="validationCustom03" required=""  value="<?php echo $ValorUnitario; ?>" name="IVA_FACTURA" placeholder="VALOR UNITARIO"readonly="readonly"></td>
                 </tr>
                  <tr>
                    <th scope="row"> <label for="validationCustom03" class="form-label">BASE:</label></th>
                 <td><input type="text" class="form-control" id="validationCustom03" required=""  value="<?php echo $IVA_FACTURA; ?>" name="IVA_FACTURA" placeholder="BASE"readonly="readonly"></td>
                 </tr>
                 <tr>
                    <th scope="row"> <label for="validationCustom03" class="form-label">IMPUESTO:</label></th>
                 <td><input type="text" class="form-control" id="validationCustom03" required=""  value="<?php echo $IVA_FACTURA; ?>" name="IVA_FACTURA" placeholder="IMPUESTO"readonly="readonly"></td>
                 </tr>
                 <tr>
                    <th scope="row"> <label for="validationCustom03" class="form-label">TASA O CUOTA:</label></th>
                 <td><input type="text" class="form-control" id="validationCustom03" required=""  value="<?php echo $IVA_FACTURA; ?>" name="IVA_FACTURA" placeholder="TASA O CUOTA"readonly="readonly"></td>
				 
                 </tr>
                 <tr>
                    <th scope="row"> <label for="validationCustom03" class="form-label">TIPO FACTOR:</label></th>
                 <td><input type="text" class="form-control" id="validationCustom03" required=""  value="<?php echo $IVA_FACTURA; ?>" name="IVA_FACTURA" placeholder="TIPO FACTOR"readonly="readonly"></td>
                 </tr>
                 <tr>
                    <th scope="row"> <label for="validationCustom03" class="form-label">IVA:</label></th>
                 <td><input type="text" class="form-control" comasainput("IVA_FACTURA") id="validationCustom03" required=""  value="<?php echo $TImpuestosTrasladados; ?>" name="IVA_FACTURA" placeholder="IVA" readonly="readonly"></td>
                 </tr>
                 <tr>

               
                 <tr>
                    <th scope="row"> <label  style="width:300px" for="validationCustom03" class="form-label">IMPUESTOS RETENIDOS:</label></th>
                 <td><input type="text" class="form-control" id="validationCustom03" required=""  value="<?php echo $TImpuestosRetenidos; ?>" name="TImpuestosRetenidos" placeholder="IMPUESTOS RETENIDO" readonly="readonly"></td>
                 </tr>
                
                 <!-- <tr> 
                    <th scope="row"> <label  style="width:300px" for="validationCustom03" class="form-label">I.S.R RETENIDO:</label></th>
                 <td><input type="text" class="form-control" id="validationCustom03" required=""  value="<?php echo $ISR_RETENIDO; ?>" name="ISR_RETENIDO" placeholder="I.S.R RETENIDO" readonly="readonly"></td>
                 </tr>-->
                
                 <tr>
                    <th scope="row"> <label for="validationCustom03" class="form-label">TUA:</label></th>
                 <td><input type="text" class="form-control" id="validationCustom03" required=""  value="<?php echo $TUA_FACTURA; ?>" name="TUA_FACTURA" placeholder="TUA"readonly="readonly"></td>
                 </tr>
                 <tr>
                    <th scope="row"> <label for="validationCustom03" class="form-label">I.S.H:</label></th>
                 <td><input type="text" class="form-control" id="validationCustom03" required=""  value="<?php echo $ISH_FACTURA; ?>" name="ISH_FACTURA" placeholder="I.S.H"readonly="readonly"></td>
                 </tr>
                 <tr>
                    <th scope="row"> <label for="validationCustom03" class="form-label">IEPS:</label></th>
                 <td><input type="text" class="form-control" id="validationCustom03" required=""  value="<?php echo $IEPS_FACTURA; ?>" name="IEPS_FACTURA" placeholder="IEPS"readonly="readonly"></td>
                 </tr>
                 <tr>
                    <th scope="row"> <label for="validationCustom03" class="form-label">PROPINA:</label></th>
                 <td><input type="text" class="form-control" id="validationCustom03" required=""  value="<?php echo $PROPINA_FACTURA; ?>" name="PROPINA_FACTURA" placeholder="PROPINA"readonly="readonly"></td>
                 </tr>
                 <tr>
                    <th scope="row"> <label for="validationCustom03" class="form-label">OTRO:</label></th>
                 <td><input type="text" class="form-control" id="validationCustom03" required=""  value="<?php echo $OTRO_FACTURA; ?>" name="OTRO_FACTURA" placeholder="OTRO" readonly="readonly"></td>
                 </tr>
                 <tr>
                    <th scope="row"> <label for="validationCustom03" class="form-label">TOTAL:</label></th>
                 <td><input type="text" class="form-control" id="validationCustom03" required=""  value="<?php echo $total; ?>" name="TOTAL_FACTURA" placeholder="TOTAL" readonly="readonly"></td>
                 </tr>
                 <tr>
                    <th scope="row"> <label for="validationCustom03" class="form-label">MONEDA:</label></th>
                 <td><input type="text" class="form-control" id="validationCustom03" required=""  value="<?php echo $Moneda; ?>" name="MONEDA_FACTURA" placeholder="MONEDA"readonly="readonly"></td>
                 </tr>
                 <tr>
                    <th scope="row"> <label for="validationCustom03" class="form-label">MONEDA EXTRANGERA:</label></th>
                 <td><input type="text" class="form-control" id="validationCustom03" required=""  value="<?php echo $MONEDA_EXTRANGERA_FACTURA; ?>" name="MONEDA_EXTRNGERA_FACTURA" placeholder="MONEDA EXTRANGERA"readonly="readonly"></td>
                 </tr>
                 
				 <tr>
                    <th scope="row"> <label for="validationCustom03" class="form-label">TIPO DE CAMBIO:</label></th>
                 <td><input type="text" class="form-control" id="validationCustom03" required=""  value="<?php echo $TipoCambio; ?>" name="TIPO_DE_CAMBIO" placeholder="TIPO DE CAMBIO"readonly="readonly"></td>
                 </tr>
                 
                  
                 <tr>
                    <th scope="row"> <label for="validationCustom03" class="form-label">USO DE CFDI:</label></th>
                 <td><input type="text" class="form-control" id="validationCustom03" required=""  value="<?php echo $UsoCFDI; ?>" name="USO_CFDI_FACTURA" placeholder="USO DE CFDI"readonly="readonly"></td>
                 </tr>
                 <tr>
                    <th scope="row"> <label for="validationCustom03" class="form-label">FORMA DE PAGO:</label></th>
                 <td><input type="text" class="form-control" id="validationCustom03" required=""  value="<?php echo $formaDePago; ?>" name="FORMA_DE_PAGO_FACTURA" placeholder="FORMA DE PAGO"readonly="readonly"></td>
                 </tr>
                 <tr>
                    <th scope="row"> <label for="validationCustom03" class="form-label">METODO DE PAGO:</label></th>
                 <td><input type="text" class="form-control" id="validationCustom03" required=""  value="<?php echo $metodoDePago; ?>" name="METODO_DE_PAGO_FACTURA" placeholder="METODO DE PAGO"readonly="readonly"></td>
                 </tr>
                 <tr>
                    <th scope="row"> <label for="validationCustom03" class="form-label">CONDICIONES DE PAGO:</label></th>
                 <td><input type="text" class="form-control" id="validationCustom03" required=""  value="<?php echo $CONDICIONES_DE_PAGO; ?>" name="CONDICIONES_DE_PAGO" placeholder="CONDICIONES DE PAGO" readonly="readonly"></td>
                 </tr>
                 <tr>
                    <th scope="row"> <label for="validationCustom03" class="form-label">TIPO DE COMPROBANTE:</label></th>
                 <td><input type="text" class="form-control" id="validationCustom03" required=""  value="<?php echo $tipoDeComprobante; ?>" name="TIPO_DE_COMPROBANTE" placeholder="TIPO DE COMPROBANTE" readonly="readonly"></td>
                 </tr>
             
                 <tr>
                    <th scope="row"> <label for="validationCustom03" class="form-label">CLAVE DE UNIDAD:</label></th>
                 <td><input type="text" class="form-control" id="validationCustom03" required=""  value="<?php echo $TIPO_DE_COMPROBANTE; ?>" name="TIPO_DE_COMPROBANTE" placeholder="CLAVE DE UNIDAD" readonly="readonly"></td>
                 </tr>
                 <tr>
                    <th scope="row"> <label for="validationCustom03" class="form-label">VERSIÓN:</label></th>
                 <td><input type="text" class="form-control" id="validationCustom03" required=""  value="<?php echo $Version; ?>" name="TIPO_DE_COMPROBANTE" placeholder="VERSION" readonly="readonly"></td>
                 </tr>
                 <tr>
                    <th scope="row"> <label for="validationCustom03" class="form-label">FECHA DE TIMBRADO:</label></th>
                 <td><input type="text" class="form-control" id="validationCustom03" required=""  value="<?php echo $FechaTimbrado; ?>" name="TIPO_DE_COMPROBANTE" placeholder="TIPO DE COMPROBANTE" readonly="readonly"></td>
                 </tr></table><table>
			<table style="text-align:right;">
				<tr>
					<td>
						<?php if($conexion->variablespermisos('','viaticos','guardar')=='si'){ ?>
							<button class="btn btn-primary" type="button" id="enviarPAGOPROVEEDORES">GUARDAR</button>
							<div style="
    color: #f5f5f5;
    text-shadow: 1px 1px 1px #919191,
        1px 2px 1px #919191,
        1px 3px 1px #919191,
        1px 4px 1px #919191,
        1px 5px 1px #919191,
        1px 6px 1px #919191,
        1px 7px 1px #919191,
        1px 8px 1px #919191,
        1px 9px 1px #919191,
        1px 10px 1px #919191,
    1px 18px 6px rgba(16,16,16,0.4),
    1px 22px 10px rgba(16,16,16,0.2),
    1px 25px 35px rgba(16,16,16,0.2),
    1px 30px 60px rgba(16,16,16,0.4);
	@keyframes fadeIn {
  0% { opacity: 0; }
  100% { opacity: 100; }
}" id="mensajepagoproveedores" /> </td>
					<?php } ?>
				</tr>
			</table>
			</form>
		</div>
		</div>
		</div>
		</div>