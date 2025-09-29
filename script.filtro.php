<script type="text/javascript">
	function pasarpagado2(pasarpagado_id){
	//$('#personal_detalles4').html();
	//$('#dataModal4').modal('show');	

	var checkBox = document.getElementById("pasarpagado1a"+pasarpagado_id);
	var pasarpagado_text = "";
	if (checkBox.checked == true){
	pasarpagado_text = "si";
	}else{
	pasarpagado_text = "no";
	}
	  $.ajax({
		url:'ventasoperaciones2/controladorVO.php',
		method:'POST',
		data:{pasarpagado_id:pasarpagado_id,pasarpagado_text:pasarpagado_text},
		beforeSend:function(){
		$('#pasarpagado2').html('cargando');
	},
		success:function(data){
		$('#pasarpagado2').html("<span id='ACTUALIZADO' >"+data+"</span>");
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

    let totalFormateado = total.toLocaleString('es-MX', {
        minimumFractionDigits: 2,
        maximumFractionDigits: 2
    });
    $('#totalCalculado').text('$' + totalFormateado);
	 $('#reset_totales').load(location.href + ' #reset_totales');
	
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
				$("#loader").html("Cargando...");
			  },
				success:function(data){
					$(".datos_ajax").html(data).fadeIn('slow');
					$("#loader").html("");
				}
			})
		}
/* terminaB1*/		
		
	</script>
