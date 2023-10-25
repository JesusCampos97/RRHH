@extends('layouts.maintemplate')

@section('content')

<style>
    .timeline>div>.fa, .timeline>div>.fab, .timeline>div>.fad, .timeline>div>.fal, .timeline>div>.far, .timeline>div>.fas, .timeline>div>.ion, .timeline>div>.svg-inline--fa {
    background-color: #adb5bd;
    border-radius: 50%;
    font-size: 13px;
    height: 20px !important;
    left: 16px !important;
    line-height: 12px;
    position: absolute;
    text-align: center;
    top: 0;
    width: 20px !important;
    }
</style>

<div class="container-fluid">
    <div class="row">
        <div class="col-12">

            <div class="card mt-2">
                <div class="card-header">
                    <h3 class="card-title">Control de jornada</h3>
                </div>

                <div class="card-body">
                    <div class="row mb-4 text-center">
                        
                            <button type="button" class="btn col btn-info" style="height: 4em;" @if(!$jornadaFinalizada) hidden @endif id="IniciarJornadaButton">Iniciar Jornada</button>
                            <button type="button" class="btn col btn-warning mr-1" @if($jornadaFinalizada) hidden @endif style="height: 4em;"  id="IniciarDescansoButton">
                                @if($descansoAbierto)
                                    Finalizar Descanso
                                @else
                                    Iniciar Descanso
                                @endif
                            </button>
                            <button type="button" @if($descansoAbierto) disabled @endif class="btn col btn-success" @if($jornadaFinalizada) hidden @endif style="height: 4em;" id="FinalizarJornadaButton">Finalizar Jornada</button>
                    </div>
                    <div class="timeline" id="timeline">
                        <div class="time-label">
                            <span class="bg-red" id="todayDate">{{ date('d/m/Y')}}</span>
                        </div>

                        @foreach($jornadaEnCurso as $j)
                            <div>
                                <i class='fas fa-solid fa-hourglass-start bg-blue'></i>
                                <div class='timeline-item'>
                                    <span class='time'><i class='fas fa-clock'></i> {{substr($j->hora_ini,0,5)}}</span>
                                    <h3 class='timeline-header'><a href='#'>Jornada Iniciada</a></h3>
                                    <div class='timeline-body'>
                                        Puede hacer un descanso o finalizar su jornada cuando lo necesite.
                                    </div>
                                </div>
                            </div>
                            @php
                                $hora_fin=$j->hora_fin;
                                
                                //buscar si mi jornada tiene descansos. Si la jornada tiene descansos, habrá que hacer un for
                                //que recorra todos los descansos y vaya metiendo en funcion a estos descansos
                                //como un descanso esta dentro d euna jornada, siembre va entre el inicio y el fin de jornada
                            @endphp

                            @foreach($descansosJornadasHoy as $descanso)
                                @if($descanso->id_jornada==$j->id)
                                    @php
                                        $hora_ini_descanso=$descanso->hora_ini;
                                        $hora_fin_descanso=$descanso->hora_fin;
                                        $descripcion=$descanso->nombreDescanso;
                                    @endphp
                                    @if(isset($hora_ini_descanso) && $hora_ini_descanso!=null)
                                        <div>
                                            <i class='fas fa-solid fa-pause bg-grey'></i>
                                            <div class='timeline-item'>
                                                <span class='time'><i class='fas fa-clock'></i> {{substr($hora_ini_descanso,0,5)}}</span>
                                                <h3 class='timeline-header'><a href='#'>Descanso iniciado</a></h3>
                                                <div class='timeline-body'>
                                                    {{$descripcion}}. Puede parar su descanso cuando lo necesite.
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                    @if(isset($hora_fin_descanso) && $hora_fin_descanso!=null)
                                        <div>
                                            <i class='fas fa-solid fa-play bg-blue'></i>
                                            <div class='timeline-item'>
                                                <span class='time'><i class='fas fa-clock'></i> {{substr($hora_fin_descanso,0,5)}}</span>
                                                <h3 class='timeline-header'><a href='#'>Descanso finalizado</a></h3>
                                                <div class='timeline-body'>
                                                    ¡Su descanso ha finalizado!
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                @endif
                                

                            @endforeach

                            
                            @if($hora_fin!=null)
                            <div>
                                <i class='fas fa-solid fa-hourglass-end bg-green'></i>
                                <div class='timeline-item'>
                                    <span class='time'><i class='fas fa-clock'></i> {{substr($hora_fin,0,5)}}</span>
                                    <h3 class='timeline-header'><a href='#'>Jornada Finalizada</a></h3>
                                    <div class='timeline-body'>
                                        ¡Gran trabajo!
                                    </div>
                                </div>
                            </div>
                            @endif
                        @endforeach
                        
                        
                        <div id="div_replace">
                            <i class="fas fa-clock bg-gray"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection



@section('modal')
<!-- Modal  Create-->
<div class="modal fade" id="tiposDescanso" tabindex="-1" role="dialog" aria-labelledby="createTitle" aria-hidden="true" style="padding-right:0px">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content" style="min-width: 650px">
            <div class="modal-header">
                <h1>Seleccione el tipo de descanso</h1>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close" onclick="actualizarBotones()">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
             
            <div class="modal-body" style=" margin-top: -2em;">
                
                <form action="" method="POST" name="tiposDescansoForm" id="tiposDescansoForm">
                    @csrf
                    <hr>
                    <div class="card-body" style="padding: 0;">
                        <div class="form-group">
                            <label style="font-size:13px" for="apellidos"><b>Tipo de descanso*</b></label>
                            <select class="js-example-responsive js-example-placeholder-single js-states form-control" id="tipoDescanso_select" required>
                                    <option value=""></option>
                                    @foreach($tiposDescanso as $t)
                                        <option value="{{$t->id}}">{{$t->nombre}}</option>
                                    @endforeach
                            </select>
                        </div>
                   </div>
                   <hr>
                    <div class="card-footer" style="background-color: white; padding: 0;">
                        <button type="button" class="btn btn-secondary float-left" id="insertDescansoButtonCancel" data-bs-dismiss="modal">Cancelar</button>
                        <button type="button" class="btn btn-primary float-right" id="insertDescansoDataButton">Aceptar</button>
                    </div>
              
                </form>
                          
            </div>
        </div>
    </div>
</div>
@endsection



@section('scripts')

<script>
    $(document).ready( function () {

        function getLocationPermission() {
            return new Promise((resolve, reject) => {
                navigator.geolocation.getCurrentPosition(
                    position => resolve(position), 
                    error => reject(error)
                );
            });
        }

        $("#IniciarJornadaButton").click(function(e){

            $("#IniciarJornadaButton").prop("disabled", true);
            $("#FinalizarJornadaButton").prop("disabled", false);

            getLocationPermission()
            .then(position => {
                var latitud = position.coords.latitude;
                var longitud = position.coords.longitude;
                // Aquí puedes continuar con el resto de tu código.
                $.ajax({
                    url: "{{route('iniciarJornada')}}",
                    type: "POST",
                    cache: false,
                    data:{
                        _token:'{{ csrf_token() }}',
                        lat: latitud,
                        lng: longitud

                    },
                    success: function(dataResult){
                        console.log(dataResult)
                        //cambiamos los botones
                        document.getElementById("IniciarDescansoButton").removeAttribute("hidden");
                        document.getElementById("FinalizarJornadaButton").removeAttribute("hidden");
                        document.getElementById("IniciarJornadaButton").setAttribute("hidden", true);

                        //añadimos los datos al timeline
                        addTimeLine(dataResult["data"][0], 1);
                        msgSuccess(dataResult["msg"])
                    },
                    error: function(e){
                        console.log(e)
                        msgError("Error genérico. Por favor, inténtelo más tarde.")
                    }

                });
            })
            .catch(error => {

                switch (error.code) {
                    case error.PERMISSION_DENIED:
                        gpsOk = false;
                        msgError("El usuario no permitió el acceso a su ubicación.");
                        break;
                    case error.POSITION_UNAVAILABLE:
                        gpsOk = false;
                        msgError("La información de la ubicación no está disponible.");
                        break;
                    case error.TIMEOUT:
                        gpsOk = false;
                        msgError("La solicitud para obtener la ubicación del usuario ha excedido el tiempo permitido.");
                        break;
                    case error.UNKNOWN_ERROR:
                        gpsOk = false;
                        console.log("Ha ocurrido un error desconocido.");
                        msgError("Ha ocurrido un error desconocido. Asegurese de tener internet.")
                        break;
                }
                // Aquí puedes manejar el rechazo o el error.
            });
           
        }); 


        @if($descansoAbierto)
            var estado = "FinalizarDescanso"
        @else
            var estado = "IniciarDescanso"
        @endif
        $("#IniciarDescansoButton").click(function(e){

            console.log("**"+estado)
            //si inicio descanso, deshabilito el finalizar jornada
            if(estado=="IniciarDescanso"){
                estado="FinalizarDescanso"
                $("#FinalizarJornadaButton").prop("disabled", true);
                $("#IniciarDescansoButton").text("Finalizar Descanso");

                //mostramos un modal para seleccionar el tipo de descanso
                $('#tiposDescanso').modal('show');


            }else{
                estado="IniciarDescanso"
                $("#FinalizarJornadaButton").prop("disabled", false);
                $("#IniciarDescansoButton").text("Iniciar Descanso");
                // Aquí puedes continuar con el resto de tu código.
                $.ajax({
                    url: "{{route('finalizarDescanso')}}",
                    type: "POST",
                    cache: false,
                    data:{
                        _token:'{{ csrf_token() }}'
                    },
                    success: function(dataResult){
                        console.log(dataResult)
                        //cambiamos los botones
                        //añadimos los datos al timeline
                        addTimeLine(dataResult["data"][0], 4);
                        msgSuccess(dataResult["msg"])

                    },
                    error: function(e){
                        console.log(e)
                        msgError("Error genérico. Por favor, inténtelo más tarde.")
                    }
                });
                
            }
            console.log("--"+estado)
        });

        $("#FinalizarJornadaButton").click(function(e){

            //si finalizo jornada, habilito de nuevo el iniciar jornada
            $("#FinalizarJornadaButton").prop("disabled", true);
            $("#IniciarJornadaButton").prop("disabled", false);

            // Aquí puedes continuar con el resto de tu código.
            $.ajax({
                url: "{{route('finalizarJornada')}}",
                type: "POST",
                cache: false,
                data:{
                    _token:'{{ csrf_token() }}'
                },
                success: function(dataResult){
                    console.log(dataResult)
                    //cambiamos los botones
                    document.getElementById("IniciarDescansoButton").setAttribute("hidden", true);
                    document.getElementById("FinalizarJornadaButton").setAttribute("hidden", true);
                    document.getElementById("IniciarJornadaButton").removeAttribute("hidden");

                    //añadimos los datos al timeline
                    addTimeLine(dataResult["data"][0], 2);
                    msgSuccess(dataResult["msg"])

                },
                error: function(e){
                    console.log(e)
                    msgError("Error genérico. Por favor, inténtelo más tarde.")
                }
            });

        });

        function addTimeLine(data, type){

            titulo="";
            descripcion="";
            hora="";
            icon="";
            color="";
            if (type==1){
                titulo="Jornada Iniciada"
                descripcion="Puede hacer un descanso o finalizar su jornada cuando lo necesite."
                hora=data.hora_ini.substring(0,5)
                icon="fa-hourglass-start"
                color="blue"
            }
            else if(type==2){
                titulo="Jornada Finalizada"
                descripcion="¡Gran trabajo!"
                hora=data.hora_fin.substring(0,5)
                icon="fa-hourglass-end"
                color="green"
            }else if(type==3){
                titulo="Descanso iniciado"
                descripcion=data.nombreDescanso+". Puede finalizar su descanso cuando lo necesite."
                hora=data.hora_ini.substring(0,5)
                icon="fa-pause"
                color="grey"
            }else if(type==4){
                titulo="Descanso finalizado"
                descripcion="¡Su descanso ha finalizado!"
                hora=data.hora_fin.substring(0,5)
                icon="fa-play"
                color="blue"
            }
            
            newDiv=" <div> \
                            <i class='fas fa-solid "+icon+" bg-"+color+"'></i>\
                            <div class='timeline-item'>\
                                <span class='time'><i class='fas fa-clock'></i> "+hora+"</span>\
                                <h3 class='timeline-header'><a href='#'>"+titulo+"</a></h3>\
                                <div class='timeline-body'>\
                                    "+descripcion+"\
                                </div>\
                            </div>\
                        </div>\
                        <div id='div_replace'>\
                            <i class='fas fa-clock bg-gray'></i>\
                        </div>";
            $("#div_replace").replaceWith(newDiv);


        }

        //insertdata
        $("#insertDescansoDataButton").click(function(e){
            var formulario = $('#tiposDescansoForm');

            // Validación de campos requeridos
            var todosLosCamposSonValidos = true;

            formulario.find('input[required]').each(function(){
                if ($(this).val() === '') {
                    todosLosCamposSonValidos = false;
                    return false; // salir del bucle
                }
            });

            // Si hay un campo que no es válido:
            if (!todosLosCamposSonValidos) {
                e.preventDefault();
                msgError('Por favor, complete todos los campos requeridos.')
                return;
            }

            getLocationPermission()
            .then(position => {
                var latitud = position.coords.latitude;
                var longitud = position.coords.longitude;
                // Aquí puedes continuar con el resto de tu código.
                $.ajax({
                url: "{{route('insertDescansoJornada')}}",
                type: "POST",
                cache: false,
                data:{
                    _token:'{{ csrf_token() }}',
                    tipo: $('#tipoDescanso_select').val(),
                    lat: latitud,
                    lng: longitud
                },
                success: function(dataResult){
                    console.log(dataResult)
                    if(dataResult["code"]==200){
                        msgSuccess(dataResult["msg"])
                        //$('#insertDescansoButtonCancel').click();
                        $('#tiposDescanso').modal('toggle');
                        //habra que cargar el add_time_line
                        addTimeLine(dataResult["data"][0], 3);

                    }else{
                        msgError(dataResult["msg"])
                    }

                },
                error: function(e){
                    console.log(e)
                    msgError("Error genérico. Por favor, inténtelo más tarde.")
                }

            });
            })
            .catch(error => {

                switch (error.code) {
                    case error.PERMISSION_DENIED:
                        gpsOk = false;
                        msgError("El usuario no permitió el acceso a su ubicación.");
                        break;
                    case error.POSITION_UNAVAILABLE:
                        gpsOk = false;
                        msgError("La información de la ubicación no está disponible.");
                        break;
                    case error.TIMEOUT:
                        gpsOk = false;
                        msgError("La solicitud para obtener la ubicación del usuario ha excedido el tiempo permitido.");
                        break;
                    case error.UNKNOWN_ERROR:
                        gpsOk = false;
                        console.log("Ha ocurrido un error desconocido.");
                        msgError("Ha ocurrido un error desconocido. Asegurese de tener internet.")
                        break;
                }
                // Aquí puedes manejar el rechazo o el error.
            });

            

        });


        $("#insertDescansoButtonCancel").click(function(e){
            estado="IniciarDescanso"
            $("#FinalizarJornadaButton").prop("disabled", false);
            $("#IniciarDescansoButton").text("Iniciar Descanso");
        });

    });

        
</script>

@endsection