@extends('layouts.maintemplate')

@section('content')

<div class="container-fluid">
    <div class="row">
        <div class="col-12">

            <div class="card mt-2">
                <div class="card-header">
                    <h3 class="card-title">Listado de Usuarios</h3>
                </div>

                <div class="card-body">

                    <ul class="nav nav-tabs" id="custom-content-below-tab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="tab-usuarios-activos" data-toggle="pill" href="#tab-usuarios-activos-tab" role="tab" aria-controls="custom-content-below-home" aria-selected="true">Usuarios activos</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="tab-usuarios-no-activos" data-toggle="pill" href="#tab-usuarios-no-activos-tab" role="tab" aria-controls="custom-content-below-profile" aria-selected="false">Usuarios no activos</a>
                        </li>
                    </ul>

                    <div class="tab-content" id="custom-content-below-tabContent">
                        <div class="tab-pane fade active show" id="tab-usuarios-activos-tab" role="tabpanel" aria-labelledby="tab-usuarios-activos">
                            <div id="example1_wrapper" class="dataTables_wrapper dt-bootstrap4">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <table id="table_id" class="table table-bordered table-striped dataTable dtr-inline"  cellspacing="0" width="100%" top="2em">
                                            
                                        </table> 
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="tab-usuarios-no-activos-tab" role="tabpanel" aria-labelledby="tab-usuarios-no-activos">
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
            <h1>Añadir Usuario</h1>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
             </div>
             
            <div class="modal-body" style=" margin-top: -2em;">
                
                <form action="" method="POST" name="createUser" id="createUser">
                    @csrf
                    <hr>
                    <div class="card-body" style="padding: 0;">
                        <div class="form-group">
                            <label style="font-size:13px" for="nombre"><b>Nombre*</b></label>
                            <input class="form-control form-control-border border-width-2" type="text" placeholder="Nombre" name="nombre" id="nombre" required>
                        </div>
                        <div class="form-group">
                            <label style="font-size:13px" for="apellidos"><b>Apellidos*</b></label>
                            <input class="form-control form-control-border border-width-2" type="text" placeholder="Apellidos" name="apellidos" id="apellidos" required>
                        </div>
                        <div class="form-group">
                            <label style="font-size:13px" for="email"><b>Email*</b></label>
                            <input class="form-control form-control-border border-width-2" type="email" placeholder="Email" name="email" id="email" required>
                        </div>
                        <div class="form-group">
                            <label style="font-size:13px" for="rol-usuario"><b>Rol Usuario*</b></label>
                            <select class="js-example-responsive js-example-placeholder-single js-states form-control" id="id_label_rol_usuario" required>
                                <!-- <optgroup label="Sexo">-->
                                    <option value=""></option>
                                    @foreach($roles as $r)
                                        <option value="{{$r->id}}">{{$r->name}}</option>
                                    @endforeach
                                <!--</optgroup>-->
                            </select>
                     
                        </div>
    
                        <div class="row">
                            <div class="form-group col-md-11">
                                <div class="row">
                                    <label style="font-size:13px; align-self: center; margin-bottom: unset; " for="empresa" class="col-md-4"><b>Empresa*</b></label>
                                    <select class="js-example-responsive js-example-placeholder-single js-states form-control col-md-8" id="id_label_empresa_usuario" required>
                                        <!-- <optgroup label="Sexo">-->
                                            <option value=""></option>
                                            @foreach($empresas as $e)
                                                <option value="{{$e->id}}">{{$e->nombre}}</option>
                                            @endforeach
                                        <!--</optgroup>-->
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-1">
                                <button type="button" id="insertEmpresaButton" class="btn btn-outline-primary btn-block"><i class="fa fa-plus"></i></button>
                            </div>
                            <div class="form-group col-md-11">
                                <div class="row">
                                    <label style="font-size:13px; align-self: center;margin-bottom: unset; " for="puesto_trabajo"class="col-md-4"><b>Puesto trabajo*</b></label>
                                    <select class="js-example-responsive js-example-placeholder-single js-states form-control col-md-8" id="id_label_puestos_trabajo_usuario" required>
                                            <option value=""></option>
                                            @foreach($puestos_trabajo as $p)
                                                <option value="{{$p->id}}">{{$p->nombre}}</option>
                                            @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-1">
                                <button type="button" id="insertPuestosButton" class="btn btn-outline-primary btn-block"><i class="fa fa-plus"></i></button>
                            </div>
                        </div>
    
                        <div class="row">
                            <div class="form-group col-md-6">
                                <div class="row">
                                    <label style="font-size:13px; align-self: center; margin-bottom: unset; " for="Ciudad" class="col-md-4"><b>Ciudad</b></label>
                                    <input class="form-control form-control-border border-width-2 col-md-8" type="text" placeholder="Ciudad" name="ciudad" id="ciudad">
                                </div>
                            </div>
                            <div class="form-group col-md-6">
                                <div class="row">
                                    <label style="font-size:13px; align-self: center; margin-bottom: unset; " for="Localidad" class="col-md-4"><b>Localidad</b></label>
                                    <input class="form-control form-control-border border-width-2 col-md-8" type="text" placeholder="Localidad" name="localidad" id="localidad">
                                </div>
                            </div>
                        </div>
    
                        <div class="row">
                            <div class="form-group col-md-6">
                                <div class="row">
                                    <label style="font-size:13px; align-self: center; margin-bottom: unset; " for="codigo_postal" class="col-md-4"><b>Codigo Postal</b></label>
                                    <input class="form-control form-control-border border-width-2 col-md-8" type="text" placeholder="Codigo Postal" name="codigo_postal" id="codigo_postal">
                                </div>
                            </div>
                            <div class="form-group col-md-6">
                                <div class="row">
                                    <label style="font-size:13px; align-self: center; margin-bottom: unset; " for="Direccion" class="col-md-4"><b>Direccion</b></label>
                                    <input class="form-control form-control-border border-width-2 col-md-8" type="text" placeholder="Direccion" name="direccion" id="direccion">
                                </div>
                            </div>
                        </div>
    
                        <div class="row">
                            <div class="form-group col-md-6">
                                <div class="row">
                                    <label style="font-size:13px; align-self: center; margin-bottom: unset; " for="dni" class="col-md-4"><b>DNI*</b></label>
                                    <input class="form-control form-control-border border-width-2 col-md-8" type="text" placeholder="DNI" name="dni" id="dni" required>
                                </div>
                            </div>
                            <div class="form-group col-md-6">
                                <div class="row">
                                    <label style="font-size:13px; align-self: center;text-align: center margin-bottom: unset; " for="sexo"class="col-md-4"><b>Sexo*</b></label>
                                    <!--<input class="form-control form-control-border border-width-2 col-md-6" type="number" placeholder="Sexo" name="sexo" id="sexoEditar" disabled>-->
                                    <select class="js-example-disabled js-states form-control col-md-8" id="id_label_single_sexo" name="id_label_single_sexo" required>
                                                <!-- <optgroup label="Sexo">-->
                                                    <option value=""></option>
                                                    <option value="0">Mujer</option>
                                                    <option value="1">Hombre</option>
                                                <!--</optgroup>-->
                                    </select>
                                </div>
                            </div>
                        </div>
    
                        <div class="row">
                            <div class="form-group col-md-6">
                                <div class="row">
                                    <label style="font-size:13px; align-self: center;margin-bottom: unset; " for="telefono" class="col-md-4"><b>Teléfono*</b></label>
                                    <input class="form-control form-control-border border-width-2 col-md-8" type="number" placeholder="Teléfono" name="telefono" id="telefono" required>
                                </div>
                            </div>
                            <div class="form-group col-md-6">
                                <div class="row">
                                    <label style="font-size:13px; align-self: center; margin-bottom: unset; " for="fechaNac" class="col-md-4"><b>Fecha nacimiento*</b></label>
                                    <input class="form-control form-control-border border-width-2 col-md-8"  type="date" placeholder="Fecha nacimiento" name="fechaNac" id="fechaNac" required>
                                </div>
                            </div>
                        </div>

                        <div class="alert alert-info alert-dismissible">
                            <h5><i class="icon fas fa-info"></i> ¡Atención!</h5>
                            La contraseña inicial del usuario será su DNI.
                            <br>
                            Además, el usuario deberá de cambiarla en su primer inicio de sesión.
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
        <h1>Actualizar Usuario</h1>
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
                        <label style="font-size:13px" for="apellidos"><b>Apellidos*</b></label>
                        <input class="form-control form-control-border border-width-2" type="text" placeholder="Apellidos" name="apellidos" id="apellidosEditar" required>
                    </div>
                    <div class="form-group">
                        <label style="font-size:13px" for="email"><b>Email*</b></label>
                        <input class="form-control form-control-border border-width-2" type="email" placeholder="Email" name="email" id="emailEditar" required>
                    </div>
                    <div class="form-group">
                        <label style="font-size:13px" for="rol-usuario"><b>Rol Usuario*</b></label>
                         <!--<input class="form-control form-control-border border-width-2" type="email" placeholder="Email" name="rol-usuario" id="rol-usuario" required>-->
                        <select class="js-example-responsive js-example-placeholder-single js-states form-control" id="id_label_rol_usuario_update" required>
                            <!-- <optgroup label="Sexo">-->
                                <option value=""></option>
                                @foreach($roles as $r)
                                    <option value="{{$r->id}}">{{$r->name}}</option>
                                @endforeach
                            <!--</optgroup>-->
                        </select>
                 
                    </div>

                    <div class="row">
                        <div class="form-group col-md-11">
                            <div class="row">
                                <label style="font-size:13px; align-self: center; margin-bottom: unset; " for="empresa" class="col-md-4"><b>Empresa*</b></label>
                                <select class="js-example-responsive js-example-placeholder-single js-states form-control col-md-8" id="id_label_empresa_usuario_update" required>
                                    <!-- <optgroup label="Sexo">-->
                                        <option value=""></option>
                                        @foreach($empresas as $e)
                                            <option value="{{$e->id}}">{{$e->nombre}}</option>
                                        @endforeach
                                    <!--</optgroup>-->
                                </select>
                            </div>
                        </div>
                        <div class="col-md-1">
                            <button type="button" id="insertEmpresaButtonEditar" class="btn btn-outline-primary btn-block"><i class="fa fa-plus"></i></button>
                        </div>
                        <div class="form-group col-md-11">
                            <div class="row">
                                <label style="font-size:13px; align-self: center;margin-bottom: unset; " for="puesto_trabajo"class="col-md-4"><b>Puesto trabajo*</b></label>
                                <select class="js-example-responsive js-example-placeholder-single js-states form-control col-md-8" id="id_label_puestos_trabajo_usuario_update" required>
                                        <option value=""></option>
                                        @foreach($puestos_trabajo as $p)
                                            <option value="{{$p->id}}">{{$p->nombre}}</option>
                                        @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-1">
                            <button type="button" id="insertPuestosButtonEditar" class="btn btn-outline-primary btn-block"><i class="fa fa-plus"></i></button>
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group col-md-6">
                            <div class="row">
                                <label style="font-size:13px; align-self: center; margin-bottom: unset; " for="Ciudad" class="col-md-4"><b>Ciudad</b></label>
                                <input class="form-control form-control-border border-width-2 col-md-8" type="text" placeholder="Ciudad" name="ciudad" id="ciudadEditar">
                            </div>
                        </div>
                        <div class="form-group col-md-6">
                            <div class="row">
                                <label style="font-size:13px; align-self: center; margin-bottom: unset; " for="Localidad" class="col-md-4"><b>Localidad</b></label>
                                <input class="form-control form-control-border border-width-2 col-md-8" type="text" placeholder="Localidad" name="localidad" id="localidadEditar">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group col-md-6">
                            <div class="row">
                                <label style="font-size:13px; align-self: center; margin-bottom: unset; " for="codigo_postal" class="col-md-4"><b>Codigo Postal</b></label>
                                <input class="form-control form-control-border border-width-2 col-md-8" type="text" placeholder="Codigo Postal" name="codigo_postal" id="codigo_postalEditar">
                            </div>
                        </div>
                        <div class="form-group col-md-6">
                            <div class="row">
                                <label style="font-size:13px; align-self: center; margin-bottom: unset; " for="Direccion" class="col-md-4"><b>Direccion</b></label>
                                <input class="form-control form-control-border border-width-2 col-md-8" type="text" placeholder="Direccion" name="direccion" id="direccionEditar">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group col-md-6">
                            <div class="row">
                                <label style="font-size:13px; align-self: center; margin-bottom: unset; " for="dni" class="col-md-4"><b>DNI*</b></label>
                                <input class="form-control form-control-border border-width-2 col-md-8" type="text" placeholder="DNI" name="dni" id="dniEditar" required>
                            </div>
                        </div>
                        <div class="form-group col-md-6">
                            <div class="row">
                                <label style="font-size:13px; align-self: center;text-align: center margin-bottom: unset; " for="sexo"class="col-md-4"><b>Sexo*</b></label>
                                <!--<input class="form-control form-control-border border-width-2 col-md-6" type="number" placeholder="Sexo" name="sexo" id="sexoEditar" disabled>-->
                                <select class="js-example-disabled js-states form-control col-md-8" id="id_label_single_sexo_update" name="id_label_single_sexo_update" required>
                                            <!-- <optgroup label="Sexo">-->
                                                <option value=""></option>
                                                <option value="0">Mujer</option>
                                                <option value="1">Hombre</option>
                                            <!--</optgroup>-->
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group col-md-6">
                            <div class="row">
                                <label style="font-size:13px; align-self: center;margin-bottom: unset; " for="telefono" class="col-md-4"><b>Teléfono*</b></label>
                                <input class="form-control form-control-border border-width-2 col-md-8" type="number" placeholder="Teléfono" name="telefono" id="telefonoEditar" required>
                            </div>
                        </div>
                        <div class="form-group col-md-6">
                            <div class="row">
                                <label style="font-size:13px; align-self: center; margin-bottom: unset; " for="fechaNac" class="col-md-4"><b>Fecha nacimiento*</b></label>
                                <input class="form-control form-control-border border-width-2 col-md-8"  type="date" placeholder="Fecha nacimiento" name="fechaNac" id="fechaNacEditar" required>
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
            <h1>Desactivar Usuario</h1>
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
                    <p>¿Deseas marcar como inactivo al usuario?</p> 
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
            <h1>Activar Usuario</h1>
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
                    <p>¿Deseas volver a activar el usuario?</p> 
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
        

        //selectdata

        var datatable = $('#table_id').DataTable({
            language: {
                "url": "//cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json"
                },
            ajax: {
                url: "{{route('listarusuarios')}}",
                type: 'post',
                data: {
                    "_token": $("meta[name='csrf-token']").attr("content"),
                    "activo": 1
                },
                                       
            },
            responsive: true,
            columns: [{ data: "name", title: "Nombre" }, { data: "apellidos", title: "Apellidos"}, { data: "email", title: "Email" }, { data: "DNI", title: "DNI" }, 
            { data: "sexo", title: "Sexo", render: function ( data, type, row ) {
                switch (data) {
                    case 0:
                        return 'Mujer';
                        break;
                    case 1:
                        return 'Hombre';
                        break;
                    default:
                        return data;
                }
            } },{ data: "telefono", title: "Teléfono" },
            { data: "fechaNac", render: DataTable.render.datetime( 'D/M/YYYY' ), title: "Fecha Nacimiento" }, { data: "ciudad", title: "Ciudad" }],
        });

        var datatable2 = $('#table_2').DataTable({
            language: {
                "url": "//cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json"
                },
            ajax: {
                url: "{{route('listarusuarios')}}",
                type: 'post',
                data: {
                    "_token": $("meta[name='csrf-token']").attr("content"),
                    "activo": 0
                },
                                       
            },
            responsive: true,
            columns: [{ data: "name", title: "Nombre" }, { data: "apellidos", title: "Apellidos"}, { data: "email", title: "Email" }, { data: "DNI", title: "DNI" }, 
            { data: "sexo", title: "Sexo", render: function ( data, type, row ) {
                switch (data) {
                    case 0:
                        return 'Mujer';
                        break;
                    case 1:
                        return 'Hombre';
                        break;
                    default:
                        return data;
                }
            } },{ data: "telefono", title: "Teléfono" },
            { data: "fechaNac", render: DataTable.render.datetime( 'D/M/YYYY' ), title: "Fecha Nacimiento" }, { data: "ciudad", title: "Ciudad" }],
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
            if(data==undefined)
            {
                var tr = $(this.closest('tr'));
                if(tr.hasClass('child')){
                    tr = tr.prev();
                }
                data = datatable.row(tr).data();
            }
            datatable.row(this).index
            //console.log( datatable.row(this).hasClass('testCVs'));

            //alert('You clicked on ' + data["id"] + "'s row");
            $.ajax({
                url: "{{route('getDataUsuarios')}}",
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
                    document.getElementById('nombreEditar').value=dataJson[0]["name"];
                    document.getElementById('apellidosEditar').value=dataJson[0]["apellidos"];
                    document.getElementById('dniEditar').value=dataJson[0]["DNI"];
                    //document.getElementById('sexoEditar').value=dataJson[0]["sexo"];
                    $("#id_label_single_sexo_update").val(dataJson[0]["sexo"])
                    document.getElementById('emailEditar').value=dataJson[0]["email"];
                    document.getElementById('telefonoEditar').value=dataJson[0]["telefono"];
                    document.getElementById('fechaNacEditar').value=dataJson[0]["fechaNac"];
                    document.getElementById('ciudadEditar').value=dataJson[0]["ciudad"];
                    document.getElementById('localidadEditar').value=dataJson[0]["localidad"];
                    document.getElementById('codigo_postalEditar').value=dataJson[0]["codigo_postal"];
                    document.getElementById('direccionEditar').value=dataJson[0]["direccion"];

                    $("#id_label_rol_usuario_update").val(dataJson[0]["role_id"]) 
                    $("#id_label_empresa_usuario_update").val(dataJson[0]["id_empresa"]) 
                    $("#id_label_puestos_trabajo_usuario_update").val(dataJson[0]["id_puesto_trabajo"]) 

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
                url: "{{route('activadesactivaUsuario')}}",
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
                url: "{{route('activadesactivaUsuario')}}",
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
            var formulario = $('#createUser');

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

            let fecha = $('#fechaNac').val();
            let fechaNacimiento = new Date(fecha);
            let dia = fechaNacimiento.getDate() + 1;
            let mes = fechaNacimiento.getMonth() + 1;
            let ano = fechaNacimiento.getFullYear();

            let edad = obtenerEdad(dia, mes, ano);

            let mayorEdad = esMayorEdad(edad);

            if (mayorEdad) {
                
                $.ajax({
                    url: "{{route('insertUsuario')}}",
                    type: "POST",
                    cache: false,
                    data:{
                        _token:'{{ csrf_token() }}',
                        nombre: $('#nombre').val(),
                        apellidos: $('#apellidos').val(),
                        dni: $('#dni').val(),
                        ciudad: $('#ciudad').val(),
                        localidad: $('#localidad').val(),
                        codigo_postal: $('#codigo_postal').val(),
                        direccion: $('#direccion').val(),
                        sexo: $('#id_label_single_sexo').val(),
                        email: $('#email').val(),
                        telefono: $('#telefono').val(),
                        fechaNac: $('#fechaNac').val(),
                        role_id: $("#id_label_rol_usuario").val(),
                        id_empresa: $("#id_label_empresa_usuario").val(),
                        id_puesto_trabajo: $("#id_label_puestos_trabajo_usuario").val(),

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
            } else {
                msgError("No se puede completar el registro por ser menor de edad.")
            }

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
                url: "{{route('updateUsuario')}}",
                type: "POST",
                cache: false,
                data:{
                    _token:'{{ csrf_token() }}',
                    nombre: $('#nombreEditar').val(),
                    apellidos: $('#apellidosEditar').val(),
                    dni: $('#dniEditar').val(),
                    ciudad: $('#ciudadEditar').val(),
                    localidad: $('#localidadEditar').val(),
                    codigo_postal: $('#codigo_postalEditar').val(),
                    direccion: $('#direccionEditar').val(),
                    sexo: $('#id_label_single_sexo_update').val(),
                    email: $('#emailEditar').val(),
                    telefono: $('#telefonoEditar').val(),
                    fechaNac: $('#fechaNacEditar').val(),
                    role_id: $("#id_label_rol_usuario_update").val(),
                    id_empresa: $("#id_label_empresa_usuario_update").val(),
                    id_puesto_trabajo: $("#id_label_puestos_trabajo_usuario_update").val(),
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



        let obtenerEdad = (dia, mes, ano) => {
            //let evento = new Date(2018, 1, 14);
            let evento = new Date();
            let eventoAno = evento.getFullYear();
            let eventoMes = evento.getMonth() + 1;
            let eventoDia = evento.getDate();

            let edad = eventoAno - ano;

            if (eventoAno - ano < 18) {
                //
            } else {
                if (eventoMes < mes) {
                    edad--;
                }
                if (mes == eventoMes && eventoDia < dia) {
                    edad--;
                }
            }
            return edad;
        }

        let esMayorEdad = (edad) => {
            if (edad >= 18) {
                return true;
            } else {
                return false;
            }
        }


    });

    
</script>

@endsection