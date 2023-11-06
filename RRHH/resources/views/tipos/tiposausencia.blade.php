@extends('layouts.maintemplate')

@section('content')

<div class="container-fluid">
    <div class="row">
        <div class="col-12">

            <div class="card mt-2">
                <div class="card-header">
                    <h3 class="card-title">Listado de Tipos de Ausencias</h3>
                </div>

                

                <div class="card-body">

                    <ul class="nav nav-tabs" id="custom-content-below-tab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="tab-tipos-ausencias-activos" data-toggle="pill" href="#tab-tipo-ausencia-activos-tab" role="tab" aria-controls="custom-content-below-home" aria-selected="true">Tipos de ausencias activos</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="tab-tipos-ausencias-no-activos" data-toggle="pill" href="#tab-tipo-ausencia-no-activos-tab" role="tab" aria-controls="custom-content-below-profile" aria-selected="false">Tipos de ausencias no activos</a>
                        </li>
                    </ul>

                    <div class="tab-content" id="custom-content-below-tabContent">
                        <div class="tab-pane fade active show" id="tab-tipo-ausencia-activos-tab" role="tabpanel" aria-labelledby="tab-tipos-ausencias-activos">
                            <div id="example1_wrapper" class="dataTables_wrapper dt-bootstrap4">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <table id="table_id" class="table table-bordered table-striped dataTable dtr-inline"  cellspacing="0" width="100%" top="2em">
                                            
                                        </table> 
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="tab-tipo-ausencia-no-activos-tab" role="tabpanel" aria-labelledby="tab-tipos-ausencias-no-activos">
                            <div id="example1_wrapper" class="dataTables_wrapper dt-bootstrap4">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <table id="table_2" class="table table-bordered table-striped dataTable dtr-inline"  cellspacing="0" width="100%" top="2em">
                                            
                                        </table> 
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
</div>


<div>

    <div class="floating-container">
        <div class="floating-button btn" type="reset" data-toggle="modal" data-target="#createModal">
            +
        </div>
    </div>  
</div>


@endsection



@section('modal')

<!-- Modal  Create-->
<div class="modal fade" id="createModal" tabindex="-1" role="dialog" aria-labelledby="createTitle" aria-hidden="true" style="padding-right:0px">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content" style="min-width: 650px">
            <div class="modal-header">
            <h1>Añadir Tipo de Ausencia</h1>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
             </div>
             
            <div class="modal-body" style=" margin-top: -2em;">
                
                <form action="" method="POST" name="createTipoAusencia" id="createTipoAusencia">
                    @csrf
                    <hr>
                    <div class="card-body" style="padding: 0;">
                        <div class="form-group">
                            <label style="font-size:13px" for="nombre"><b>Nombre*</b></label>
                            <input class="form-control form-control-border border-width-2" type="text" placeholder="Nombre" name="nombre" id="nombre" required>
                        </div> 
                        <div class="form-group">
                            <label style="font-size:13px">Color*</label>
                           <div class="input-group my-colorpicker2 colorpicker-element" data-colorpicker-id="2">
                                <input type="text" class="form-control" data-original-title="" title="" name="color" id="color" required>
                                <div class="input-group-append">
                                    <span class="input-group-text"><i class="fas fa-square"></i></span>
                                </div>
                            </div>       
                   
                        </div>            
                   </div>
                   <hr>
                    <div class="card-footer" style="background-color: white; padding: 0;">
                        <button type="button" class="btn btn-secondary float-left" id="insertDataButtonClose" data-dismiss="modal">Cancelar</button>
                        <button type="button" class="btn btn-primary float-right" id="insertDataButton">Aceptar</button>
                    </div>
              
                </form>                         
            </div>
        </div>
    </div>
</div>


 <!-- Modal  Update-->
 <div class="modal fade" id="updateModal" tabindex="-1" role="dialog" aria-labelledby="updateTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content"  style="min-width: 650px">
        <div class="modal-header">
        <h1>Actualizar Tipo de Ausencia</h1>
        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        </div>
        <div class="modal-body" style=" margin-top: -2em;">
        
            <form method="POST" id="updateForm"> 
                @csrf
                <hr>
                <div class="card-body" style="padding: 0;">
                    <div class="form-group">
                        <label style="font-size:13px" for="nombre"><b>Nombre*</b></label>
                        <input class="form-control form-control-border border-width-2" type="text" placeholder="Nombre" name="nombre" id="nombreEditar" required>
                    </div>

                    <div class="form-group">
                        <label style="font-size:13px">Color*</label>
                        <div class="input-group my-colorpicker2 colorpicker-element" data-colorpicker-id="2">
                            <input type="text" class="form-control" data-original-title="" title="" name="color" id="colorEditar" required>
                            <div class="input-group-append">
                                <span class="input-group-text"><i class="fas fa-square"></i></span>
                            </div>
                        </div>                            
                    </div> 
               </div>

                <hr>
                <div class="card-footer" style="background-color: white; padding: 0;">
                                         
                    <button type="button" class="btn btn-danger float-left"  id="" data-bs-toggle="modal" data-bs-target="#deleteModal">Marcar como inactivo</button>             
                    <button type="button"   id="updateDataButton" class="btn btn-primary float-right" >Aceptar</button>
                    <button type="button" class="btn btn-secondary float-right  mr-1"  id="UpdateDataButtonClose" data-bs-dismiss="modal">Cancelar</button>

                
                </div>
              
              </form>

            </div>
        </div>
    </div>
</div>

 <!-- Modal  Delete-->
 <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h1>Desactivar Tipo de Ausencia</h1>
            <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        
        </div>
        <div class="modal-body" style="margin-top:-2em">
        
            <form method="POST"> 
                @csrf
                <hr>
                <div class="container" >
                  <div class="form-group">
                    <p>¿Deseas marcar como inactivo al tipo de ausencia?</p> 
                  </div>                     
              
                </div>
               <hr>
                <div class="card-footer" style="background-color: white; padding: 0;">
                    <button type="button"  class="btn btn-secondary float-left"  id="DeleteDataButtonClose" data-bs-dismiss="modal">Cancelar</button>
                    <button type="button"  id="DeleteDataButton" class="btn btn-primary float-right">Aceptar</button>
                </div>
              
              </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal  Delete-->
<div class="modal fade" id="updateModal_NoActivo" tabindex="-1" role="dialog" aria-labelledby="updateModal_NoActivo" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h1>Activar Tipo de Ausencia</h1>
            <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        
        </div>
        <div class="modal-body" style="margin-top:-2em">
        
            <form method="POST"> 
                @csrf
                <hr>
                <div class="container" >
                  <div class="form-group">
                    <p>¿Deseas volver a activar el tipo de ausencia?</p> 
                  </div>                     
              
                </div>
               <hr>
               <div class="card-footer" style="background-color: white; padding: 0;">
                    <button type="button"  class="btn btn-secondary float-left"  id="NoActivoButtonClose" data-bs-dismiss="modal">Cancelar</button>
                    <button type="button"  id="NoActivoButton" class="btn btn-primary float-right">Aceptar</button>
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
        
        $('#color').colorpicker();
    
        $('#colorEditar').colorpicker();

            $('.my-colorpicker2').on('colorpickerChange', function(event) {
                $('.my-colorpicker2 .fa-square').css('color', event.color.toString());
            })

        //selectdata
        var datatable = $('#table_id').DataTable({
            language: {
                "url": "//cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json"
                },
            ajax: {
                url: "{{route('listarTiposAusencias')}}",
                type: 'post',
                data: {
                    "_token": $("meta[name='csrf-token']").attr("content"),
                    "activo": 1
                },
                                       
            },
            responsive: true,
            columns: [{ data: "nombre", title: "Nombre" }, { data: "color", title: "Color" }],
        });

        
        var datatable2 = $('#table_2').DataTable({
            language: {
                "url": "//cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json"
                },
            ajax: {
                url: "{{route('listarTiposAusencias')}}",
                type: 'post',
                data: {
                    "_token": $("meta[name='csrf-token']").attr("content"),
                    "activo": 0
                },
                                       
            },
            responsive: true,
            columns: [{ data: "nombre", title: "Nombre" }, { data: "color", title: "Color" }],
        });


        //hacemos el trigger de un onclick, concretamente de un click en una etiqueta td con una clase (class) dtr-control
        $('#table_id tbody').on('click', 'td.dtr-control', function (e) {

            //me cojo la row del td al que he dado click
            var tr = $(this).closest('tr');
            //cojo la row del datatable para ver si se ha mostrado
            var row = datatable.row(tr);

            //de la row al que he dado click, comprueba si tiene la clase, 
            //si es el casoes que no estaba abierto y paro la propagacion del modal
            //o en el caso de que este ya abierto comprobamos con el datatable 
            if (//tr.hasClass('dt-hasChild') || !row.child.isShown()
                //datatable te da una funcion que te dice si el responsive esta activado o no
                datatable.responsive.hasHidden() ) {
                //no muestres el modal
                e.stopPropagation();
            } 
        } );

         //hacemos el trigger de un onclick, concretamente de un click en una etiqueta td con una clase (class) dtr-control
         $('#table_2 tbody').on('click', 'td.dtr-control', function (e) {

            //me cojo la row del td al que he dado click
            var tr = $(this).closest('tr');
            //cojo la row del datatable para ver si se ha mostrado
            var row = datatable2.row(tr);

            //de la row al que he dado click, comprueba si tiene la clase, 
            //si es el casoes que no estaba abierto y paro la propagacion del modal
            //o en el caso de que este ya abierto comprobamos con el datatable 
            if (//tr.hasClass('dt-hasChild') || !row.child.isShown()
                //datatable te da una funcion que te dice si el responsive esta activado o no
                datatable2.responsive.hasHidden() ) {
                //no muestres el modal
                e.stopPropagation();
            } 
        } );

        var data = null
        $('#table_id tbody').on('click', 'tr', function () {
            data = datatable.row(this).data();
            datatable.row(this).index
            if(data==undefined)
            {
                var tr = $(this.closest('tr'));
                if(tr.hasClass('child')){
                    tr = tr.prev();
                }
                data = datatable.row(tr).data();
            }
            //console.log( datatable.row(this).hasClass('testCVs'));
             //console.log(data)
            //alert('You clicked on ' + data["id"] + "'s row");
            $.ajax({
                url: "{{route('getDataTiposAusencias')}}",
                type: "POST",
                cache: false,
                data:{
                    _token:'{{ csrf_token() }}',
                    id: data["id"]
                },
                success: function(dataResult){


                    console.log(dataResult)
                    //console.log(dataResult[1])
                    dataJson=JSON.parse(dataResult)
                    document.getElementById('nombreEditar').value=dataJson[0]["nombre"];
                    document.getElementById('colorEditar').value=dataJson[0]["color"];

                    $('#updateModal').modal('show');        
                },
                error: function(e){
                    console.log(e)
                }
            });
        });

        
        var data2 = null
        $('#table_2 tbody').on('click', 'tr', function () {
            data2 = datatable2.row(this).data();
            datatable2.row(this).index
            $('#updateModal_NoActivo').modal('show');        

        });


    //deletedata
    $("#NoActivoButton").click(function(){
            $.ajax({
                url: "{{route('activadesactivaTiposAusencias')}}",
                type: "POST",
                cache: false,
                data:{
                    _token:'{{ csrf_token() }}',
                    id: data2["id"],
                    activo: 1

                },
                success: function(dataResult){
                    //console.log(dataResult)

                    if(dataResult["code"]==200){
                        msgSuccess(dataResult["msg"])
                        $('#NoActivoButtonClose').click();
                        datatable.ajax.reload();
                        datatable2.ajax.reload();
                    }else{
                        msgError(dataResult["msg"])
                    }
                  
                },
                error: function(e){
                    console.log(e)
                    msgError("Error genérico. Por favor, inténtelo más tarde.")
                }
            });
    }); 

        //deletedata
        $("#DeleteDataButton").click(function(){
            $.ajax({
                url: "{{route('activadesactivaTiposAusencias')}}",
                type: "POST",
                cache: false,
                data:{
                    _token:'{{ csrf_token() }}',
                    id: data["id"],
                    activo: 0

                },
                success: function(dataResult){
                    //console.log(dataResult)

                    if(dataResult["code"]==200){
                        msgSuccess(dataResult["msg"])
                        $('#DeleteDataButtonClose').click();
                        $('#UpdateDataButtonClose').click();
                        datatable.ajax.reload();
                        datatable2.ajax.reload();

                    }else{
                        msgError(dataResult["msg"])
                    }
                  
                },
                error: function(e){
                    console.log(e)
                    msgError("Error genérico. Por favor, inténtelo más tarde.")
                }
            });
        }); 

        
        //insertdata
        $("#insertDataButton").click(function(e){
            var formulario = $('#createTipoAusencia');

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
                msgError('Por favor, complete todos los campos requeridos')
                return;
            }
                
                $.ajax({
                    url: "{{route('insertTiposAusencias')}}",
                    type: "POST",
                    cache: false,
                    data:{
                        _token:'{{ csrf_token() }}',
                        nombre: $('#nombre').val(),
                        color: $('#color').val(),

                    },
                    success: function(dataResult){
                        console.log(dataResult)
                        if(dataResult["code"]==200){
                            msgSuccess(dataResult["msg"])
                            $('#insertDataButtonClose').click();
                            datatable.ajax.reload();
                        }else{
                            msgError(dataResult["msg"])
                        }

                    },
                    error: function(e){
                        console.log(e)
                        msgError("Error genérico. Por favor, inténtelo más tarde.")
                    }

                });
       
        }); 

        //updatedata
        $("#updateDataButton").click(function(e){
            // Suponiendo que tu formulario tenga el ID 'updateForm':
            var formulario = $('#updateForm');

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
                msgError('Por favor, complete todos los campos requeridos')
                return;
            }
            $.ajax({
                url: "{{route('updateTiposAusencias')}}",
                type: "POST",
                cache: false,
                data:{
                    _token:'{{ csrf_token() }}',
                    nombre: $('#nombreEditar').val(),  
                    color: $('#colorEditar').val(),                                      
                    id: data["id"]
                },

                success: function(dataResult){
                    //console.log(dataResult)
                    if(dataResult["code"]==200){
                        msgSuccess(dataResult["msg"])
                        $('#UpdateDataButtonClose').click();
                        datatable.ajax.reload();
                    }else{
                        msgError(dataResult["msg"])
                    }         
                
                },
                error: function(e){
                    console.log(e)
                    msgError("Error genérico. Por favor, inténtelo más tarde.")
                }
            });
        }); 

        /*para el caso en el que no insertemos ni nada por ajax, por ejemplo un post de un formulario que devuelve el action*/
        @if(Session::has('success'))
           /* Swal.fire({
                position: 'top-end',
                icon: 'success',
                title: '{{Session::has("success")}}',
                showConfirmButton: false,
                timer: 0
            });*/
        @endif

        @if(Session::has('error'))
            /*Swal.fire({
                position: 'top-end',
                icon: 'error',
                title: '{{Session::has("error")}}',
                showConfirmButton: false,
                timer: 0
            });*/
        @endif

    });

    
</script>

@endsection