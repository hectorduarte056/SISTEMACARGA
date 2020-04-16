var patron = new Array(3,3,4)
var patron2 = new Array(3,3,4)
var patron3 = new Array(3,7,1)
var patron4 = new Array(2,2,4)
function mascara(d,sep,pat,nums){
if(d.valant != d.value){
	val = d.value
	largo = val.length
	val = val.split(sep)
	val2 = ''
	for(r=0;r<val.length;r++){
		val2 += val[r]	
	}
	if(nums){
		for(z=0;z<val2.length;z++){
			if(isNaN(val2.charAt(z))){
				letra = new RegExp(val2.charAt(z),"g")
				val2 = val2.replace(letra,"")
			}
		}
	}
	val = ''
	val3 = new Array()
	for(s=0; s<pat.length; s++){
		val3[s] = val2.substring(0,pat[s])
		val2 = val2.substr(pat[s])
	}
	for(q=0;q<val3.length; q++){
		if(q ==0){
			val = val3[q]
		}
		else{
			if(val3[q] != ""){
				val += sep + val3[q]
				}
		}
	}
	d.value = val
	d.valant = val
	}
}

//validando el input full name
$('#form2').keyup(function(){
    var name        = $('#name').val();
    var last_name   = $('#last_name').val();
    var cedula      = $('#cedula').val();
    var dataString = 'cedula='+cedula;


  $.ajax({
           type: "POST",
           url: '../../module/add_facilitadores/controller/verificar.php',
           data: dataString,
           success: function(data)

           {
            if(data > 0){
                //removemos la clase success
                $('#class_ced').removeClass('has-success has-feedback');
                //añadimos la clase error
                $('#class_ced').addClass('has-error has-feedback');
                $('#resp').html("Número Registrado");
                //desactivamos el boton sutmit
                $('#sutmit_paciente').attr('type', 'button');
                $('#sutmit_paciente').addClass('disabled');
            }else{
                //removemos la clase error
                $('#class_ced').removeClass('has-error has-feedback');
                //activamos el boton sutmit
                $('#sutmit_paciente').attr('type', 'submit');
                $('#sutmit_paciente').removeClass('disabled');
                //añadimos la clase success
                $('#class_ced').addClass('has-success has-feedback');
                $('#resp').html("Número Disponible");
            }

           }
       });

  if(name == "" || name == " " || last_name == "" || last_name == " " || cedula == "" || cedula == " ") {
    $('#sutmit_paciente').attr('type', 'button');
    $('#sutmit_paciente').addClass('disabled'); // show the error message

  }else{
    $('#sutmit_paciente').attr('type', 'submit');
    $('#sutmit_paciente').removeClass('disabled');
  }
});


//
//verificar si la clave esta registrada
//

$( "#FormCompetencias" ).keyup(function()
{
    var clave      = $('#clave').val();
    var id_faci    = $('#id_faci').val();
    var dataString = 'verificar='+clave+'&id_faci='+id_faci;

   // alert("hola");
  $.ajax({
           type: "POST",
           url: '../../module/competencias/controller/verificar.php',
           data: dataString,
           success: function(data)

           {

             if(data == 3){
                //eliminamos las clase
                $('#class_ced').removeClass('has-error has-feedback');
                $('#class_ced').removeClass('has-warning has-feedback');

                $('#class_ced').addClass('has-success has-feedback');
                $('#resp').html("Clave Disponible");
                $('#btncompetencias').removeClass('disabled');


            }else if (data == 2) {
                //eliminamos las clase
                $('#class_ced').removeClass('has-success has-feedback');
                $('#class_ced').removeClass('has-warning has-feedback');

                $('#class_ced').addClass('has-error has-feedback');
                $('#resp').html("Clave Registrada");
                $('#btncompetencias').addClass('disabled');

            }else{

                //eliminamos las clase
                $('#class_ced').removeClass('has-success has-feedback');
                $('#class_ced').removeClass('has-error has-feedback');

                $('#class_ced').addClass('has-warning has-feedback');
                $('#resp').html("Clave No Disponible");
                $('#btncompetencias').addClass('disabled');

            }
           }
       });


});


//
//verificar si la clave esta registrada
//

$( "#AddFormCompetencias" ).keyup(function()
{
    var clave      = $('#clave').val();
    var id_faci    = $('#id_faci').val();
    var dataString = 'verificar='+clave;

   // alert("hola");
  $.ajax({                        
           type: "POST",                 
           url: '../../../module/admin/asignaturas/controllers/verificar.php',                    
           data: dataString, 
           success: function(data)             
           
           {

             if(data == 0){
                //eliminamos las clase
                $('#class_ced').removeClass('has-error has-feedback');  
                $('#class_ced').removeClass('has-success has-feedback');

                $('#class_ced').addClass('has-error has-feedback');
                $('#resp').html("Clave Registrada");
                $('#btncompetencias').addClass('disabled');
                
                }else{
                
                //eliminamos las clase
                $('#class_ced').removeClass('has-error has-feedback');
                $('#class_ced').removeClass('has-error has-feedback');
               
                $('#class_ced').addClass('has-success has-feedback');
                $('#resp').html("Clave Disponible");
                $('#btncompetencias').removeClass('disabled');

            }         
           }
       });


});

//
//Registrar competencia
//
$( "#btncompetencias" ).click(function() 
{
	  var id_faci    = $('#id_faci').val();
    var clave      = $('#clave').val();

    var dataString = 'id_faci='+id_faci+'&clave='+clave;

    //alert("hola");
  $.ajax({                        
           type: "POST",                 
           url: '../../module/competencias/controller/verificar.php',                    
           data: dataString, 
           success: function(data)             
           {
            
            $("#divcompetencias").load(" #divcompetencias");
            $('#clave').val("");
            $('#btncompetencias').addClass('disabled');
           }
       });


});

//
//Registrar Horario
//
$( "#AddHorario" ).click(function() 
{
    var id_faci    = $('#id_faci').val();
    var clave      = $('#clave').val();

    var dataString = 'id_faci='+id_faci+'&clave='+clave;

    //alert("hola");
  $.ajax({                        
           type: "POST",                 
           url: '../../module/competencias/controller/verificar.php',                    
           data: dataString, 
           success: function(data)             
           {
            
            $("#divcompetencias").load(" #divcompetencias");
            $('#clave').val("");
            $('#btncompetencias').addClass('disabled');
           }
       });


});

//
//footer siempre abajo
//
 footer = function(){ 
     /*el alto que tiene el navegador*/
     $alto_navegador= $(window).height();
     /*el alto que tiene el contenido de la pagina*/
     $alto_documento= $(document).height(); 
     /*  aqui condicionamos si el alto del contenido 
      *  es mayor que
      *  el alto del navegador*/
     if ($alto_documento>$alto_navegador)
     {
         /* si es mayor es que tiene un contenido mas 
          * largo que el alto del navegador y entonces lo dejamos a relativo*/
         $("footer").css({"position":"relative"})
         
     }
     else
     {
         /* si el alto del contenido es menor que el alto del navegador es que
          * tenemos espacio vacio y le mandamos abajo*/
         $("footer").css({"position":"fixed"})
        
     } 
 
 }
 footer();