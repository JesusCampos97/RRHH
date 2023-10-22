@extends('layouts.maintemplate')

@section('content')

<div class="container-fluid">
    <div class="row">
        <div class="col-12">

            <div class="card mt-2">
                <div class="card-header">
                    <h3 class="card-title">Listado de Tipos de Incidentes</h3>
                </div>

                <div class="card-body">

                    <div class="tab-content" id="custom-content-below-tabContent">
                        <div class="tab-pane fade active show" id="tab-tipos-incidentes-tab" role="tabpanel" aria-labelledby="tab-tipos-incidentes">
                            <div id="example1_wrapper" class="dataTables_wrapper dt-bootstrap4">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <table id="table_id" class="table table-bordered table-striped dataTable dtr-inline"  cellspacing="0" width="100%" top="2em">
                                            
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
            <h1>Añadir Tipo de Incidente</h1>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
             </div>
             
            <div class="modal-body" style=" margin-top: -2em;">
                
                <form action="" method="POST" name="createTipoIncidente" id="createTipoIncidente">
                    @csrf
                    <hr>
                    <div class="card-body" style="padding: 0;">
                        <div class="form-group">
                            <label style="font-size:13px" for="nombre"><b>Nombre*</b></label>
                            <input class="form-control form-control-border border-width-2" type="text" placeholder="Nombre" name="nombre" id="nombre" required>
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
        <h1>Actualizar Tipo de Incidente</h1>
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
               </div>

                <hr>
                <div class="card-footer" style="background-color: white; padding: 0;">
                                         
                    <button type="button" class="btn btn-danger float-left"  id="" data-bs-toggle="modal" data-bs-target="#deleteModal">Eliminar</button>             
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
            <h1>Eliminar Tipo de Incidente</h1>
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
                    <p>¿Deseas eliminar este registro?</p> 
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




@endsection



@section('scripts')

<script>

    $(document).ready( function () {
        

        //selectdata

        var datatable = $('#table_id').DataTable({
            language: {
                "url": "//cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json"
                },
            ajax: {
                url: "{{route('listarTiposIncidentes')}}",
                type: 'post',
                data: {
                    "_token": $("meta[name='csrf-token']").attr("content"),
                    //"activo": 1
                },
                                       
            },
            responsive: true,
            columns: [{ data: "nombre", title: "Nombre" }],
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

        var data = null
        $('#table_id tbody').on('click', 'tr', function () {
            data = datatable.row(this).data();
            datatable.row(this).index
            //console.log( datatable.row(this).hasClass('testCVs'));
             //console.log(data)
            //alert('You clicked on ' + data["id"] + "'s row");
            $.ajax({
                url: "{{route('getDataTiposIncidentes')}}",
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

                    $('#updateModal').modal('show');        
                },
                error: function(e){
                    console.log(e)
                }
            });
        });
  
        //deletedata
        $("#DeleteDataButton").click(function(){
            $.ajax({
                url: "{{route('deleteTiposIncidentes')}}",
                type: "POST",
                cache: false,
                data:{
                    _token:'{{ csrf_token() }}',
                    id: data["id"],
                    //activo: 0

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
            var formulario = $('#createTipoIncidente');

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
                    url: "{{route('insertTiposIncidentes')}}",
                    type: "POST",
                    cache: false,
                    data:{
                        _token:'{{ csrf_token() }}',
                        nombre: $('#nombre').val(),
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
                url: "{{route('updateTiposIncidentes')}}",
                type: "POST",
                cache: false,
                data:{
                    _token:'{{ csrf_token() }}',
                    nombre: $('#nombreEditar').val(),                    
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