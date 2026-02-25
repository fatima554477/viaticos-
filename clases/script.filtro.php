
<style>
/* Loader con animación */
.loader {
  border: 4px solid #f3f3f3;
  border-top: 4px solid #6a0dad; /* Morado elegante */
  border-radius: 50%;
  width: 22px;
  height: 22px;
  animation: spin 1s linear infinite;
  display: inline-block;
  vertical-align: middle;
  margin-right: 8px;
}

@keyframes spin {
  0%   { transform: rotate(0deg); }
  100% { transform: rotate(360deg); }
}

/* Texto estilizado */
.msg-actualizando {
  font-weight: bold;
  font-size: 20px;
  color: #6a0dad;
  background: #f3e9fb;
  border-radius: 6px;
  padding: 6px 12px;
  display: inline-flex;
  align-items: center;
  box-shadow: 0px 2px 6px rgba(0,0,0,0.1);
}
</style>

<script type="text/javascript">



	function pasarpagado2(pasarpagado_id){


	var checkBox = document.getElementById("pasarpagado1a"+pasarpagado_id);
	var pasarpagado_text = "";
	if (checkBox.checked == true){
	pasarpagado_text = "si";
	}else{
	pasarpagado_text = "no";
	}
	  $.ajax({
		url:'pagoproveedores/controladorPP.php',
		method:'POST',
		data:{pasarpagado_id:pasarpagado_id,pasarpagado_text:pasarpagado_text},
		beforeSend:function(){
		$('#pasarpagado2').html('cargando');
	},
		success:function(data){
		var result = data.split('^');			
		$('#pasarpagado2').html("<span 'ACTUALIZADO'</span>").fadeIn().delay(500).fadeOut();
		load(1);

		
		if(pasarpagado_text=='si'){
		$('#color_pagado1a'+pasarpagado_id).css('background-color', '#ceffcc');
		}
		if(pasarpagado_text=='no'){
		$('#color_pagado1a'+pasarpagado_id).css('background-color', '#e9d8ee');
		}		
		
	}
	});
}


function STATUS_CHECKBOX(CHECKBOX_id, permisoModificar) {
    var checkBox = document.getElementById("STATUS_CHECKBOX" + CHECKBOX_id);
    var CHECKBOX_text = checkBox.checked ? "si" : "no";

    // Cambiar color visual inmediato (optimista)
    var newColor = checkBox.checked ? '#ceffcc' : '#e9d8ee';
    $('#color_CHECKBOX' + CHECKBOX_id).css('background-color', newColor);

    let monto = $('#montoOriginal_' + CHECKBOX_id).text().replace(/,/g, '');
    
    // Bloqueo inmediato si se activa sin permiso
    if (checkBox.checked && !permisoModificar) {
        setTimeout(() => {
            checkBox.disabled = true;
        }, 100);
    }

    // Actualizar el valor calculado en la interfaz inmediatamente
    if (checkBox.checked) {
        $('#valorCalculado_' + CHECKBOX_id).text('');
    } else {
        if (!isNaN(monto)) {
            let resultado = monto * 1.46;
            let resultadoFormateado = resultado.toLocaleString('es-MX', {
                minimumFractionDigits: 2,
                maximumFractionDigits: 2
            });
            $('#valorCalculado_' + CHECKBOX_id).text('$' + resultadoFormateado);
        } else {
            $('#valorCalculado_' + CHECKBOX_id).text('NaN');
        }
    }

    // Enviar actualización al servidor
    $.ajax({
        url: 'pagoproveedores/controladorPP.php',
        method: 'POST',
        data: { 
            CHECKBOX_id: CHECKBOX_id,
            CHECKBOX_text: CHECKBOX_text 
        },
        beforeSend: function() {
            $('#ajax-notification')
                .html('<div class="loader"></div> ⏳ ACTUALIZANDO...')
                .fadeIn();
        },
        success: function(data) {
            var result = data.split('^'); // ejemplo de retorno: "ok^si" o "ok^no"

            // Mostrar notificación de éxito
            $('#ajax-notification')
                .html("✅ ACTUALIZADO")
                .delay(1000)
                .fadeOut();

            // Validar respuesta del servidor
            if (result[1] === 'si') {
                $('#color_CHECKBOX' + CHECKBOX_id).css('background-color', '#ceffcc');
                $('#valorCalculado_' + CHECKBOX_id).text('');
                
                // Bloquear después de confirmación si no hay permiso
                if (!permisoModificar) {
                    checkBox.disabled = true;
                }
            } else if (result[1] === 'no') {
                $('#color_CHECKBOX' + CHECKBOX_id).css('background-color', '#e9d8ee');
                
                if (!isNaN(monto)) {
                    let resultado = monto * 1.46;
                    let resultadoFormateado = resultado.toLocaleString('es-MX', {
                        minimumFractionDigits: 2,
                        maximumFractionDigits: 2
                    });
                    $('#valorCalculado_' + CHECKBOX_id).text('$' + resultadoFormateado);
                } else {
                    $('#valorCalculado_' + CHECKBOX_id).text('NaN');
                }
                
                // Re-habilitar si falló el guardado
                checkBox.disabled = false;
            }
        },
        error: function() {
            // Revertir el cambio si ocurre un error
            checkBox.checked = !checkBox.checked;
            let originalColor = checkBox.checked ? '#ceffcc' : '#e9d8ee';
            $('#color_CHECKBOX' + CHECKBOX_id).css('background-color', originalColor);
            
            // Re-habilitar en caso de error
            checkBox.disabled = false;

            $('#ajax-notification')
                .html("❌ Error al actualizar")
                .delay(2000)
                .fadeOut();
        }
    });
    recalcularTotal();
}


function recalcularTotal() {
    let total = 0;

    $('[id^=valorCalculado_]').each(function() {
        let texto = $(this).text().replace(/[$,]/g, ''); // quitar $ y ,
        let valor = parseFloat(texto);
        if (!isNaN(valor)) {
            total += valor;
        }
    });

}




function STATUS_AUDITORIA3(id){
  var $cb = $("#STATUS_AUDITORIA3" + id);
  var permGuardar   = ($cb.data("perm-guardar")   == 1);
  var permModificar = ($cb.data("perm-modificar") == 1);
  var valorPrevio   = String($cb.data("prev")); // 'si' | 'no'
  var valorNuevo    = $cb.is(":checked") ? "si" : "no";

  // 1) Sin guardar ni modificar: nunca debería disparar, pero por seguridad:
  if(!permGuardar && !permModificar){
    $cb.prop('checked', (valorPrevio === 'si'));
    showNotify("Sin permiso para modificar", false);
    return;
  }

  // 2) Si NO tiene modificar:
  // - Puede pasar de 'no' -> 'si'
  // - NO puede pasar de 'si' -> 'no' (revertir y salir)
  if(!permModificar){
    if(valorPrevio === 'si' && valorNuevo === 'no'){
      // No permitido apagar
      $cb.prop('checked', true);
      showNotify("Solo puedes prender, no apagar", false);
      return;
    }
  }

  // Pintado optimista
  $("#color_AUDITORIA3" + id).css('background-color', (valorNuevo === 'si') ? '#ceffcc' : '#e9d8ee');

  $.ajax({
    url: 'pagoproveedores/controladorPP.php',
    type: 'POST',
    data: { AUDITORIA3_id: id, AUDITORIA3_text: valorNuevo },
    beforeSend: function(){
      $('#pasarpagado2').html('cargando...');
    },
    success: function(resp){
      // Éxito → fijar nuevo previo
      $cb.data("prev", valorNuevo);

      // 3) Regla clave: si SOLO tiene guardar y acaba de prender -> BLOQUEAR
      if(!permModificar && permGuardar && valorNuevo === 'si'){
        $cb.prop('disabled', true)
           .css('cursor','not-allowed')
           .attr('title','Autorizado (bloqueado)');
      }

      $('#pasarpagado2').html("<span>ACTUALIZADO</span>").fadeIn().delay(500).fadeOut();
      showNotify("Autorización actualizada ✅", true);
	  	
    },

    error: function(xhr){
      // Rollback total
      var volverSi = (valorPrevio === 'si');
      $cb.prop('checked', volverSi);
      $("#color_AUDITORIA3" + id).css('background-color', volverSi ? '#ceffcc' : '#e9d8ee');

      showNotify("❌ Error de conexión (" + xhr.status + ")", false);
    }
  });
}

function showNotify(msg, ok){
  $("#ajax-notification").stop(true,true)
    .text(msg)
    .css('background', ok ? '#4CAF50' : '#E53935')
    .fadeIn(150).delay(1000).fadeOut(300);
}


function STATUS_SINXML(id){
  var $cb = $("#STATUS_SINXML" + id);
  var permGuardar2   = ($cb.data("perm-guardar2")   == 1);
  var permModificar2 = ($cb.data("perm-modificar2") == 1);
  var valorPrevio2   = String($cb.data("prev2")); // 'si' | 'no'
  var valorNuevo2    = $cb.is(":checked") ? "si" : "no";

  // 1) Sin guardar ni modificar: nunca debería disparar, pero por seguridad:
  if(!permGuardar2 && !permModificar2){
    $cb.prop('checked', (valorPrevio2 === 'si'));
    showNotify2("Sin permiso para modificar", false);
    return;
  }

  // 2) Si NO tiene modificar:
  // - Puede pasar de 'no' -> 'si'
  // - NO puede pasar de 'si' -> 'no' (revertir y salir)
  if(!permModificar2){
    if(valorPrevio2 === 'si' && valorNuevo2 === 'no'){
      // No permitido apagar
      $cb.prop('checked', true);
      showNotify2("Solo puedes prender, no apagar", false);
      return;
    }
  }

  // Pintado optimista
  $("#color_SINXML" + id).css('background-color', (valorNuevo2 === 'si') ? '#ceffcc' : '#e9d8ee');

  $.ajax({
    url: 'pagoproveedores/controladorPP.php',
    type: 'POST',
    data: { SINXML_id: id, SINXML_text: valorNuevo2 },
    beforeSend: function(){
      $('#pasarpagado2').html('cargando...');
    },
    success: function(resp){
      // Éxito → fijar nuevo prev2io
      $cb.data("prev2", valorNuevo2);

      // 3) Regla clave: si SOLO tiene guardar y acaba de prender -> BLOQUEAR
      if(!permModificar2 && permGuardar2 && valorNuevo2 === 'si'){
        $cb.prop('disabled', true)
           .css('cursor','not-allowed')
           .attr('title','Autorizado (bloqueado)');
      }

      $('#pasarpagado2').html("<span>ACTUALIZADO</span>").fadeIn().delay(500).fadeOut();
      showNotify2("Autorización actualizada ✅", true);
	  	
    },

    error: function(xhr){
      // Rollback total
      var volverSi = (valorPrevio2 === 'si');
      $cb.prop('checked', volverSi);
      $("#color_SINXML" + id).css('background-color', volverSi ? '#ceffcc' : '#e9d8ee');

      showNotify2("❌ Error de conexión (" + xhr.status + ")", false);
    }
  });
}

function showNotify2(msg, ok){
  $("#ajax-notification").stop(true,true)
    .text(msg)
    .css('background', ok ? '#4CAF50' : '#E53935')
    .fadeIn(150).delay(1000).fadeOut(300);
}






	function STATUS_RESPONSABLE_EVENTO(RESPONSABLE_EVENTO_id){


	var checkBox = document.getElementById("STATUS_RESPONSABLE_EVENTO"+RESPONSABLE_EVENTO_id);
	var RESPONSABLE_text = "";
	if (checkBox.checked == true){
	RESPONSABLE_text = "si";
	}else{
	RESPONSABLE_text = "no";
	}
	  $.ajax({
		url:'pagoproveedores/controladorPP.php',
		method:'POST',
		data:{RESPONSABLE_EVENTO_id:RESPONSABLE_EVENTO_id,RESPONSABLE_text:RESPONSABLE_text},
		beforeSend:function(){
		$('#pasarpagado2').html('cargando');
	},
		success:function(data){
		var result = data.split('^');				
		$('#pasarpagado2').html("<span id='ACTUALIZADO' >"+result[0]+"</span>");
		
		
		if(result[1]=='si'){
		$('#color_RESPONSABLE_EVENTO'+RESPONSABLE_EVENTO_id).css('background-color', '#ceffcc');
		}
		if(result[1]=='no'){
		$('#color_RESPONSABLE_EVENTO'+RESPONSABLE_EVENTO_id).css('background-color', '#e9d8ee');
		}
		
	}
	});
}






	function STATUS_AUDITORIA1(AUDITORIA1_id){


	var checkBox = document.getElementById("STATUS_AUDITORIA1"+AUDITORIA1_id);
	var AUDITORIA1_text = "";
	if (checkBox.checked == true){
	AUDITORIA1_text = "si";
	}else{
	AUDITORIA1_text = "no";
	}

	  $.ajax({
		url:'pagoproveedores/controladorPP.php',
		method:'POST',
		data:{AUDITORIA1_id:AUDITORIA1_id,AUDITORIA1_text:AUDITORIA1_text},
		beforeSend:function(){
		$('#STATUS_AUDITORIA1').html('cargando');
	},
		success:function(data){
		var result = data.split('^');				
		$('#pasarpagado2').html("<span id='ACTUALIZADO' >"+result[0]+"</span>");
		load(1);
		

	if(result[1]=='si'){
	$('#color_AUDITORIA1'+AUDITORIA1_id).css('background-color', '#ceffcc');
	}
		if(result[1]=='no'){
		$('#color_AUDITORIA1'+AUDITORIA1_id).css('background-color', '#e9d8ee');
		}
	   	
		
	}
	});
}











	function STATUS_AUDITORIA2(AUDITORIA2_id){
	

	var checkBox = document.getElementById("STATUS_AUDITORIA2"+AUDITORIA2_id);
	var AUDITORIA2_text = "";
	if (checkBox.checked == true){
	AUDITORIA2_text = "si";
	}else{
	AUDITORIA2_text = "no";
	}
	  $.ajax({
		url:'pagoproveedores/controladorPP.php',
		method:'POST',
		data:{AUDITORIA2_id:AUDITORIA2_id,AUDITORIA2_text:AUDITORIA2_text},
		beforeSend:function(){
		$('#pasarpagado2').html('cargando');
	},
		success:function(data){
		var result = data.split('^');				
		$('#pasarpagado2').html("Cargando...").fadeIn().delay(500).fadeOut();
		load(1);

		if(result[1]=='si'){
		$('#color_AUDITORIA2'+AUDITORIA2_id).css('background-color', '#ceffcc');
		}
		if(result[1]=='no'){
		$('#color_AUDITORIA2'+AUDITORIA2_id).css('background-color', '#e9d8ee');
		}		
		
	}
	});
}




function STATUS_RECHAZADO(RECHAZADO_id){

	var checkBox = document.getElementById("STATUS_RECHAZADO"+RECHAZADO_id);
	var $checkBox = $(checkBox);

	var RECHAZADO_text = checkBox.checked ? "si" : "no";

	if(RECHAZADO_text === 'no'){
		$checkBox.data('forzarAgregarMotivo', 'si');
	} else if(RECHAZADO_text === 'si' && $checkBox.data('forzarAgregarMotivo') !== 'si'){
		$checkBox.removeData('forzarAgregarMotivo');
	}

	actualizarBotonesRechazo(RECHAZADO_id, RECHAZADO_text);

	$.ajax({

		url:'pagoproveedores/controladorPP.php',

		method:'POST',

		data:{RECHAZADO_id:RECHAZADO_id,RECHAZADO_text:RECHAZADO_text},

		beforeSend:function(){

			$('#pasarpagado2').html('cargando');

		},

		success:function(data){

			var result = data.split('^');

			$('#pasarpagado2').html("Cargando...").fadeIn().delay(500).fadeOut();

			
            if(result[1]=='si') $('#color_RECHAZADO'+RECHAZADO_id).css('background-color', '#ceffcc');

			if(result[1]=='no') $('#color_RECHAZADO'+RECHAZADO_id).css('background-color', '#e9d8ee');

	        if(result[1] == 'si' || result[1] == 'no'){
				if(result[1] == 'si' && $checkBox.data('forzarAgregarMotivo') !== 'si'){
					$checkBox.removeData('forzarAgregarMotivo');
				}
				actualizarBotonesRechazo(RECHAZADO_id, result[1]);
			}

		}

	});

}



function abrirFormularioRechazo(RECHAZADO_id){
	var motivoActual = $('#motivo_rechazo_'+RECHAZADO_id).val() || '';
	$('#modal_rechazo_id').val(RECHAZADO_id);
	configurarModalRechazo('editar', motivoActual, 'Captura el motivo y presiona Guardar.');

	$('#btn_guardar_rechazo_modal').off('click').on('click', function(){
		guardarMotivoRechazoModal();
	});

}


function guardarMotivoRechazoModal(){
	var RECHAZADO_id = $('#modal_rechazo_id').val();
	var motivo = ($('#modal_rechazo_texto').val() || '').trim();

	if(motivo === ''){
		$('#modal_rechazo_mensaje').text('Debes capturar un motivo de rechazo.').css('color', '#b22222');
		return;
	}

$.ajax({
		url:'pagoproveedores/controladorPP.php',
		method:'POST',
		data:{RECHAZO_MOTIVO_id:RECHAZADO_id,RECHAZO_MOTIVO_text:motivo},
		success:function(resp){
	if(resp.indexOf('ok') !== -1){
				$('#motivo_rechazo_'+RECHAZADO_id).val(motivo);
				$('#STATUS_RECHAZADO'+RECHAZADO_id).removeData('forzarAgregarMotivo');
				actualizarBotonesRechazo(RECHAZADO_id);
				$('#modal_rechazo_mensaje').text('Motivo guardado correctamente.').css('color', '#228b22');
				setTimeout(function(){ cerrarModalRechazoPago(); }, 400);
			}else{
				$('#modal_rechazo_mensaje').text('No fue posible guardar el motivo.').css('color', '#b22222');
			}
		}
	});
}



function verMotivoRechazo(RECHAZADO_id){

	var motivoLocal = $('#motivo_rechazo_'+RECHAZADO_id).val() || '';
	$('#modal_rechazo_id').val(RECHAZADO_id);

	if(motivoLocal !== ''){
		configurarModalRechazo('ver', motivoLocal, 'Consulta del motivo registrado.');

		return;

	}

	$.ajax({

		url:'pagoproveedores/controladorPP.php',

		method:'POST',

		data:{RECHAZO_MOTIVO_VER_id:RECHAZADO_id},



		success:function(resp){

			var motivo = (resp || '').trim();

			if(motivo !== ''){

				$('#motivo_rechazo_'+RECHAZADO_id).val(motivo);
				configurarModalRechazo('ver', motivo, 'Consulta del motivo registrado.');

			}else{
				configurarModalRechazo('ver', 'No hay motivo de rechazo registrado.', 'Consulta del motivo registrado.');

			}

		}


	});

}

function configurarModalRechazo(modo, texto, mensaje){
	var esVer = (modo === 'ver');
	$('#modalRechazoPagoLabel').text(esVer ? 'Ver motivo del rechazo' : 'Agregar motivo del rechazo');
	$('#modal_rechazo_texto').val(texto || '').prop('readonly', esVer);
	$('#modal_rechazo_mensaje').text(mensaje || '').css('color', '#666');
	$('#btn_guardar_rechazo_modal').toggle(!esVer);
	mostrarModalRechazoPago();
}

function actualizarBotonesRechazo(RECHAZADO_id, statusRechazado){
	var statusActual = statusRechazado;
	if(typeof statusActual === 'undefined'){
		statusActual = $('#STATUS_RECHAZADO'+RECHAZADO_id).is(':checked') ? 'si' : 'no';
	}
    var motivo = ($('#motivo_rechazo_'+RECHAZADO_id).val() || '').trim();
	var forzarAgregarMotivo = ($('#STATUS_RECHAZADO'+RECHAZADO_id).data('forzarAgregarMotivo') === 'si');
	var mostrarVer = (statusActual === 'si' && motivo !== '');
	var mostrarAgregar = (statusActual === 'si' && (motivo === '' || forzarAgregarMotivo));

	if(forzarAgregarMotivo && statusActual === 'si'){
		mostrarVer = false;
	}

	$('#agregar_rechazo_'+RECHAZADO_id).toggle(mostrarAgregar);
	$('#ver_rechazo_'+RECHAZADO_id).toggle(mostrarVer);
}

function mostrarModalRechazoPago(){
	if($('#modalRechazoPago').length === 0){
		return;
	}
	if(typeof $('#modalRechazoPago').modal === 'function'){
		$('#modalRechazoPago').modal('show');
	} else {
		$('#modalRechazoPago').show();
	}
}

function cerrarModalRechazoPago(){
	if($('#modalRechazoPago').length === 0){
		return;
	}
	if(typeof $('#modalRechazoPago').modal === 'function'){
		$('#modalRechazoPago').modal('hide');
	} else {
		$('#modalRechazoPago').hide();
	}
}

function STATUS_FINANZAS(FINANZAS_id){



	var checkBox = document.getElementById("STATUS_FINANZAS"+FINANZAS_id);
	var FINANZAS_text = "";
	if (checkBox.checked == true){
	FINANZAS_text = "si";
	}else{
	FINANZAS_text = "no";
	}
	  $.ajax({
		url:'pagoproveedores/controladorPP.php',
		method:'POST',
		data:{FINANZAS_id:FINANZAS_id,FINANZAS_text:FINANZAS_text},
		beforeSend:function(){
		$('#pasarpagado2').html('cargando');
	},
		success:function(data){
		var result = data.split('^');				
		$('#pasarpagado2').html("Cargando...").fadeIn().delay(500).fadeOut();
		load(1);
		
		if(result[1]=='si'){
		$('#color_FINANZAS'+FINANZAS_id).css('background-color', '#ceffcc');
		}
		if(result[1]=='no'){
		$('#color_FINANZAS'+FINANZAS_id).css('background-color', '#e9d8ee');
		}		
		
	}
	});
}

	function STATUS_VENTAS(VENTAS_id){
	

	var checkBox = document.getElementById("STATUS_VENTAS"+VENTAS_id);
	var VENTAS_text = "";
	if (checkBox.checked == true){
	VENTAS_text = "si";
	}else{
	VENTAS_text = "no";
	}
	  $.ajax({
		url:'pagoproveedores/controladorPP.php',
		method:'POST',
		data:{VENTAS_id:VENTAS_id,VENTAS_text:VENTAS_text},
		beforeSend:function(){
		$('#pasarpagado2').html('cargando');
	},
	success:function(data){
		var result = data.split('^');				
		$('#pasarpagado2').html("Cargando...").fadeIn().delay(500).fadeOut();
		
		
		if(result[1]=='si'){
		$('#color_VENTAS'+VENTAS_id).css('background-color', '#ceffcc');
		$('#STATUS_RECHAZADO'+VENTAS_id)
			.prop('checked', false)
			.prop('disabled', true)
			.css('cursor', 'not-allowed')
			.attr('title', 'No se puede rechazar: autorizado por ventas');
		$('#agregar_rechazo_'+VENTAS_id).hide();
		$('#ver_rechazo_'+VENTAS_id).hide();
		}
		if(result[1]=='no'){
		$('#color_VENTAS'+VENTAS_id).css('background-color', '#e9d8ee');
		$('#STATUS_RECHAZADO'+VENTAS_id)
			.prop('disabled', false)
			.css('cursor', 'pointer')
			.attr('title', '');
		actualizarBotonesRechazo(VENTAS_id);
		}		
		
	}
	});

}

function LIMPIAR(){

$("#NUMERO_CONSECUTIVO_PROVEE_1").val("");
$("#NOMBRE_COMERCIAL_1").val("");
$("#RAZON_SOCIAL_1").val("");
$("#VIATICOSOPRO_1").val("");
$("#RFC_PROVEEDOR_1").val("");
$("#NUMERO_EVENTO_1").val("");
$("#NOMBRE_EVENTO_1").val("");
$("#MOTIVO_GASTO_1").val("");
$("#CONCEPTO_PROVEE_1").val("");
$("#MONTO_TOTAL_COTIZACION_ADEUDO_1").val("");
$("#MONTO_FACTURA_1").val("");
$("#MONTO_PROPINA_1").val("");
$("#MONTO_DEPOSITAR_1").val("");
$("#TIPO_DE_MONEDA_1").val("");
$("#PFORMADE_PAGO_1").val("");

$("#FECHA_DE_PAGO").val("");
$("#FECHA_DE_PAGO2a").val("");

$("#FECHA_A_DEPOSITAR_1").val("");
 $("#STATUS_DE_PAGO_1").val("");
 $("#ACTIVO_FIJO_1").val("");
 $("#GASTO_FIJO_1").val("");
 $("#PAGAR_CADA_1").val("");
 $("#FECHA_PPAGO_1").val("");
 $("#FECHA_TPROGRAPAGO_1").val("");
 $("#NUMERO_EVENTOFIJO_1").val("");
 $("#CLASI_GENERAL_1").val("");
 $("#SUB_GENERAL_1").val("");
 $("#MONTO_DEPOSITADO_1").val("");
 $("#NUMERO_EVENTO1_1").val("");
 $("#CLASIFICACION_GENERAL_1").val("");
 $("#CLASIFICACION_ESPECIFICA_1").val("");
 $("#PLACAS_VEHICULO_1").val("");
 $("#MONTO_DE_COMISION_1").val("");
 $("#POLIZA_NUMERO_1").val("");
 $("#NOMBRE_DEL_EJECUTIVO_1").val("");
 $("#NOMBRE_DEL_AYUDO_1").val("");
 $("#OBSERVACIONES_1_1").val("");
 $("#FECHA_DE_LLENADO_1").val("");
 $("#BANCO_ORIGEN_1").val("");
 
 $("#ID_RELACIONADO_1").val("");
 $("#IVA").val("");
 $("#IEPS").val("");


 $("#UUID").val("");
 $("#metodoDePago").val("");
 $("#totalf").val("");
 $("#serie").val("");
 $("#folio").val("");
 $("#regimenE").val("");
 $("#UsoCFDI").val("");
 $("#TImpuestosTrasladados").val("");
 $("#TImpuestosRetenidos").val("");
 $("#Version").val("");
 $("#tipoDeComprobante").val("");
 $("#condicionesDePago").val("");
 $("#fechaTimbrado").val("");
 $("#nombreR").val("");
 $("#rfcR").val("");
 $("#Moneda").val("");
 $("#TipoCambio").val("");
 $("#ValorUnitarioConcepto").val("");
 $("#DescripcionConcepto").val("");
 $("#ClaveUnidadConcepto").val("");
 $("#ClaveProdServConcepto").val("");
 $("#CantidadConcepto").val("");
 $("#ImporteConcepto").val("");
 $("#UnidadConcepto").val("");
 $("#TUA").val("");
 $("#TuaTotalCargos").val("");
 $("#DESCUENTO").val("");
 $("#subTotal").val("");
 $("#TIPO_CAMBIOP").val("");
 $("#TOTAL_ENPESOS").val("");
 $("#IMPUESTO_HOSPEDAJE").val("");
 $("#propina").val("");
 $("#IVAXML").val("");
 $("#IEPSXML").val("");
		$(function() {
			load(1);
		});
}

        $(function() {
                const triggerSearch = () => load(1);

                $('#target3').on('keydown', 'thead input, thead select', function(event) {
                        if (event.key === 'Enter' || event.which === 13) {
                                event.preventDefault();
                                triggerSearch();
                        }
                });

                load(1);
        });
		function load(page){
			var query=$("#NOMBRE_EVENTO").val();
			var DEPARTAMENTO2=$("#DEPARTAMENTO2WE").val();
var NUMERO_CONSECUTIVO_PROVEE=$("#NUMERO_CONSECUTIVO_PROVEE_1").val();
var NOMBRE_COMERCIAL=$("#NOMBRE_COMERCIAL_1").val();
var RAZON_SOCIAL=$("#RAZON_SOCIAL_1").val();
var VIATICOSOPRO=$("#VIATICOSOPRO_1").val();
var RFC_PROVEEDOR=$("#RFC_PROVEEDOR_1").val();
var NUMERO_EVENTO=$("#NUMERO_EVENTO_1").val();
var NOMBRE_EVENTO=$("#NOMBRE_EVENTO_1").val();
var MOTIVO_GASTO=$("#MOTIVO_GASTO_1").val();
var CONCEPTO_PROVEE=$("#CONCEPTO_PROVEE_1").val();
var MONTO_TOTAL_COTIZACION_ADEUDO=$("#MONTO_TOTAL_COTIZACION_ADEUDO_1").val();
var MONTO_FACTURA=$("#MONTO_FACTURA_1").val();
var MONTO_PROPINA=$("#MONTO_PROPINA_1").val();
var MONTO_DEPOSITAR=$("#MONTO_DEPOSITAR_1").val();
var TIPO_DE_MONEDA=$("#TIPO_DE_MONEDA_1").val();
var PFORMADE_PAGO=$("#PFORMADE_PAGO_1").val();

var FECHA_DE_PAGO=$("#FECHA_DE_PAGO").val();
var FECHA_DE_PAGO2a=$("#FECHA_DE_PAGO2a").val();


var FECHA_A_DEPOSITAR=$("#FECHA_A_DEPOSITAR_1").val();
var STATUS_DE_PAGO=$("#STATUS_DE_PAGO_1").val();
var ACTIVO_FIJO=$("#ACTIVO_FIJO_1").val();
var GASTO_FIJO=$("#GASTO_FIJO_1").val();
var PAGAR_CADA=$("#PAGAR_CADA_1").val();
var FECHA_PPAGO=$("#FECHA_PPAGO_1").val();
var FECHA_TPROGRAPAGO=$("#FECHA_TPROGRAPAGO_1").val();
var NUMERO_EVENTOFIJO=$("#NUMERO_EVENTOFIJO_1").val();
var CLASI_GENERAL=$("#CLASI_GENERAL_1").val();
var SUB_GENERAL=$("#SUB_GENERAL_1").val();
var MONTO_DEPOSITADO=$("#MONTO_DEPOSITADO_1").val();
var NUMERO_EVENTO1=$("#NUMERO_EVENTO1_1").val();
var CLASIFICACION_GENERAL=$("#CLASIFICACION_GENERAL_1").val();
var CLASIFICACION_ESPECIFICA=$("#CLASIFICACION_ESPECIFICA_1").val();
var PLACAS_VEHICULO=$("#PLACAS_VEHICULO_1").val();
var MONTO_DE_COMISION=$("#MONTO_DE_COMISION_1").val();
var POLIZA_NUMERO=$("#POLIZA_NUMERO_1").val();
var NOMBRE_DEL_EJECUTIVO=$("#NOMBRE_DEL_EJECUTIVO_1").val();
var NOMBRE_DEL_AYUDO=$("#NOMBRE_DEL_AYUDO_1").val();
var OBSERVACIONES_1=$("#OBSERVACIONES_1_1").val();
var FECHA_DE_LLENADO=$("#FECHA_DE_LLENADO_1").val();
var hiddenpagoproveedores=$("#hiddenpagoproveedores_1").val();
var TIPO_CAMBIOP=$("#TIPO_CAMBIOP").val();
var TOTAL_ENPESOS=$("#TOTAL_ENPESOS").val();
var IMPUESTO_HOSPEDAJE=$("#IMPUESTO_HOSPEDAJE").val();                   
var BANCO_ORIGEN=$("#BANCO_ORIGEN").val();
var ID_RELACIONADO=$("#ID_RELACIONADO_1").val();
var IVA=$("#IVA_1").val();
var IEPS=$("#IEPS").val();
var TImpuestosRetenidosIVA=$("#TImpuestosRetenidosIVA_4").val();
var TImpuestosRetenidosISR=$("#TImpuestosRetenidosISR_4").val();
var descuentos=$("#descuentos_4").val();

var UUID=$("#UUID").val();
var metodoDePago=$("#metodoDePago").val();
var totalf=$("#totalf").val();
var serie=$("#serie").val();
var folio=$("#folio").val();
var regimenE=$("#regimenE").val();
var UsoCFDI=$("#UsoCFDI").val();
var TImpuestosTrasladados=$("#TImpuestosTrasladados").val();
var TImpuestosRetenidos=$("#TImpuestosRetenidos").val();
var Version=$("#Version").val();
var tipoDeComprobante=$("#tipoDeComprobante").val();
var condicionesDePago=$("#condicionesDePago").val();
var fechaTimbrado=$("#fechaTimbrado").val();
var nombreR=$("#nombreR").val();
var rfcR=$("#rfcR").val();
var Moneda=$("#Moneda").val();
var TipoCambio=$("#TipoCambio").val();
var ValorUnitarioConcepto=$("#ValorUnitarioConcepto").val();
var DescripcionConcepto=$("#DescripcionConcepto").val();
var ClaveUnidadConcepto=$("#ClaveUnidadConcepto").val();
var ClaveProdServConcepto=$("#ClaveProdServConcepto").val();
var CantidadConcepto=$("#CantidadConcepto").val();
var ImporteConcepto=$("#ImporteConcepto").val();
var UnidadConcepto=$("#UnidadConcepto").val();
var TUA=$("#TUA").val();
var TuaTotalCargos=$("#TuaTotalCargos").val();
var DESCUENTO=$("#DESCUENTO").val();
var subTotal=$("#subTotal").val();
var propina=$("#propina").val();

var IVAXML=$("#IVAXML").val();
var IEPSXML=$("#IEPSXML").val();
var STATUS_CHECKBOX=$("#STATUS_CHECKBOX").val();
/*termina copiar y pegar*/
			
			var per_page=$("#per_page").val();
			var parametros = {
			"action":"ajax",
			"page":page,
			'query':query,
			'per_page':per_page,

/*inicia copiar y pegar*/'NUMERO_CONSECUTIVO_PROVEE':NUMERO_CONSECUTIVO_PROVEE,
'NOMBRE_COMERCIAL':NOMBRE_COMERCIAL,
'RAZON_SOCIAL':RAZON_SOCIAL,
'RFC_PROVEEDOR':RFC_PROVEEDOR,
'NUMERO_EVENTO':NUMERO_EVENTO,
'NOMBRE_EVENTO':NOMBRE_EVENTO,
'MOTIVO_GASTO':MOTIVO_GASTO,
'CONCEPTO_PROVEE':CONCEPTO_PROVEE,
'MONTO_TOTAL_COTIZACION_ADEUDO':MONTO_TOTAL_COTIZACION_ADEUDO,
'MONTO_FACTURA':MONTO_FACTURA,
'MONTO_PROPINA':MONTO_PROPINA,
'MONTO_DEPOSITAR':MONTO_DEPOSITAR,
'TIPO_DE_MONEDA':TIPO_DE_MONEDA,
'PFORMADE_PAGO':PFORMADE_PAGO,

'FECHA_DE_PAGO':FECHA_DE_PAGO,
'FECHA_DE_PAGO2a':FECHA_DE_PAGO2a,

'FECHA_A_DEPOSITAR':FECHA_A_DEPOSITAR,
'STATUS_DE_PAGO':STATUS_DE_PAGO,
'ACTIVO_FIJO':ACTIVO_FIJO,
'GASTO_FIJO':GASTO_FIJO,
'PAGAR_CADA':PAGAR_CADA,
'FECHA_PPAGO':FECHA_PPAGO,
'FECHA_TPROGRAPAGO':FECHA_TPROGRAPAGO,
'NUMERO_EVENTOFIJO':NUMERO_EVENTOFIJO,
'CLASI_GENERAL':CLASI_GENERAL,
'SUB_GENERAL':SUB_GENERAL,
'MONTO_DEPOSITADO':MONTO_DEPOSITADO,
'NUMERO_EVENTO1':NUMERO_EVENTO1,
'CLASIFICACION_GENERAL':CLASIFICACION_GENERAL,
'CLASIFICACION_ESPECIFICA':CLASIFICACION_ESPECIFICA,
'PLACAS_VEHICULO':PLACAS_VEHICULO,
'MONTO_DE_COMISION':MONTO_DE_COMISION,
'POLIZA_NUMERO':POLIZA_NUMERO,
'NOMBRE_DEL_AYUDO':NOMBRE_DEL_AYUDO,
'NOMBRE_DEL_EJECUTIVO':NOMBRE_DEL_EJECUTIVO,
'OBSERVACIONES_1':OBSERVACIONES_1,
'FECHA_DE_LLENADO':FECHA_DE_LLENADO,
'hiddenpagoproveedores':hiddenpagoproveedores,
'TIPO_CAMBIOP':TIPO_CAMBIOP,
'TOTAL_ENPESOS':TOTAL_ENPESOS,
'IMPUESTO_HOSPEDAJE':IMPUESTO_HOSPEDAJE,
'BANCO_ORIGEN':BANCO_ORIGEN,
'STATUS_CHECKBOX':STATUS_CHECKBOX,

'ID_RELACIONADO':ID_RELACIONADO,
'IVA_1':IVA,
'IEPS':IEPS,
'TImpuestosRetenidosIVA_4':TImpuestosRetenidosIVA,
'TImpuestosRetenidosISR_4':TImpuestosRetenidosISR,
'descuentos_4':descuentos,

'UUID':UUID,
'metodoDePago':metodoDePago,
'totalf':totalf,
'serie':serie,
'folio':folio,
'regimenE':regimenE,
'UsoCFDI':UsoCFDI,
'TImpuestosTrasladados':TImpuestosTrasladados,
'TImpuestosRetenidos':TImpuestosRetenidos,
'Version':Version,
'tipoDeComprobante':tipoDeComprobante,
'condicionesDePago':condicionesDePago,
'fechaTimbrado':fechaTimbrado,
'nombreR':nombreR,
'rfcR':rfcR,
'Moneda':Moneda,
'TipoCambio':TipoCambio,
'ValorUnitarioConcepto':ValorUnitarioConcepto,
'DescripcionConcepto':DescripcionConcepto,
'ClaveUnidadConcepto':ClaveUnidadConcepto,
'ClaveProdServConcepto':ClaveProdServConcepto,
'CantidadConcepto':CantidadConcepto,
'ImporteConcepto':ImporteConcepto,
'UnidadConcepto':UnidadConcepto,
'TUA':TUA,

'TuaTotalCargos':TuaTotalCargos,
'DESCUENTO':DESCUENTO,
'subTotal':subTotal,
'propina':propina,
'IVAXML':IVAXML,
'IEPSXML':IEPSXML,

/*termina copiar y pegar*/

			'DEPARTAMENTO2':DEPARTAMENTO2
			};
			$("#loader").fadeIn('slow');
			$.ajax({
				url:'ventasoperaciones2/clases/controlador_filtro.php',
				type: 'POST',				
				data: parametros,
beforeSend: function(objeto){
  $("#loader").html(
    '<div class="msg-actualizando">' +
      '<span class="loader"></span> ⏳ ACTUALIZADO...' +
    '</div>'
  ).fadeIn();
},
				success:function(data){
					$(".datos_ajax").html(data).fadeIn('slow');
					$("#loader").html("");
				}
			})
		}
/* terminaB1*/		
		
	</script>
