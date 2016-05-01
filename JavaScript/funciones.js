$(document).ready(function(){
	
	MostrarGrilla();
	
});

function MostrarGrilla(){
	
    var pagina = "./administracion.php";

	$.ajax({
        type: 'POST',
        url: pagina,
		data : { queHago : "mostrarGrilla"},
        dataType: "html",
        async: true
    })
	.done(function (grilla) {

		$("#divGrilla").html(grilla);
	})
	.fail(function (jqXHR, textStatus, errorThrown) {
        alert(jqXHR.responseText + "\n" + textStatus + "\n" + errorThrown);
    });   
}

function SubirFoto(){
	
    var pagina = "./administracion.php";
	var foto = $("#archivo").val();
	
	if(foto === "")
	{
		return;
	}

	var archivo = $("#archivo")[0];
	var formData = new FormData();
	formData.append("archivo",archivo.files[0]);
	formData.append("queHago", "subirFoto");

	$.ajax({
        type: 'POST',
        url: pagina,
        dataType: "json",
		cache: false,
		contentType: false,
		processData: false,
        data: formData,
        async: true
    })
	.done(function (objJson) {

		if(!objJson.Exito){
			alert(objJson.Mensaje);
			return;
		}
		$("#divFoto").html(objJson.Html);
	})
	.fail(function (jqXHR, textStatus, errorThrown) {
        alert(jqXHR.responseText + "\n" + textStatus + "\n" + errorThrown);
    });   
}

function BorrarFoto(){

	var pagina = "./administracion.php";
	var foto = $("#hdnArchivoTemp").val();
	
	if(foto === "")
	{
		alert("No hay foto que borrar!!!");
		return;
	}
	
	$.ajax({
        type: 'POST',
        url: pagina,
        dataType: "json",
        data: {
			queHago : "borrarFoto",
			foto : foto
		},
        async: true
    })
	.done(function (objJson) {

		if(!objJson.Exito){
			alert(objJson.Mensaje);
			return;
		}
		
		$("#divFoto").html("");
		$("#hdnArchivoTemp").val("");
		$("#archivo").val("");
	})
	.fail(function (jqXHR, textStatus, errorThrown) {
        alert(jqXHR.responseText + "\n" + textStatus + "\n" + errorThrown);
    });   	
	
	return;
}

function AgregarEmpleado(){
	
    var pagina = "./administracion.php";
	var legajo = $("#legajo").val();
	var nombre = $("#nombre").val();
	var apellido = $("#apellido").val();
	var rdoSexo= $("#rdoSexo").val();
	var archivo = $("#hdnArchivoTemp").val();
	var queHago = $("#hdnQueHago").val();
	
	var empleado = {};
	empleado.nombre = nombre;
	empleado.legajo = legajo;
	empleado.apellido = apellido;
	empleado.rdoSexo = rdoSexo;
	empleado.archivo = archivo;

	if(!Validar(empleado)){
		alert("Debe completar TODOS los campos!!!");
		return;
	}
	
    $.ajax({
        type: 'POST',
        url: pagina,
        dataType: "json",
        data: {
			queHago : queHago,
			empleado : empleado
		},
        async: true
    })
	.done(function (objJson) {
		
		if(!objJson.Exito){
			alert(objJson.Mensaje);
			return;
		}
		
		alert(objJson.Mensaje);
		
		BorrarFoto();
		
		$("#legajo").val("");
		$("#nombre").val("");
		$("#apellido").val("");
		$("#rdoSexo").val("");
		
		MostrarGrilla();

		if(queHago !== "agregar"){
			$("#hdnQueHago").val("agregar");
			$("#legajo").removeAttr("readonly");
		}
		
	})
	.fail(function (jqXHR, textStatus, errorThrown) {
        alert(jqXHR.responseText + "\n" + textStatus + "\n" + errorThrown);
    });    
		
}

function EliminarEmpleado(empleado){
	
	if(!confirm("Desea ELIMINAR a la persona: "+empleado.nombre+"??")){
		return;
	}
	
    var pagina = "./administracion.php";
	
    $.ajax({
        type: 'POST',
        url: pagina,
        dataType: "json",
        data: {
			queHago : "eliminar",
			empleado : empleado
		},
        async: true
    })
	.done(function (objJson) {
		
		if(!objJson.Exito){
			alert(objJson.Mensaje);
			return;
		}
		
		alert(objJson.Mensaje);
		
		MostrarGrilla();

	})
	.fail(function (jqXHR, textStatus, errorThrown) {
        alert(jqXHR.responseText + "\n" + textStatus + "\n" + errorThrown);
    });    
	
}
function ModificarEmpleado(objJson){
$("#legajo").val(objJson.legajo);
$("#nombre").val(objJson.nombre);
$("#apellido").val(objJson.apellido);
$("#rdoSexo").val(objJson.rdoSexo);
	$("#hdnQueHago").val("modificar");
	
	$("#legajo").attr("readonly", "readonly");

	
}

function Validar(objJson){

	alert("implementar validaciones...");
	//aplicar validaciones
	return true;
}