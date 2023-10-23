
<style>
       #logoPlantilla{
        background-image: url('./images/logo_transparente_bitwise_white.png');
        height: 4rem;
        background-size: contain;
        background-repeat: no-repeat;
        background-position-x: center;
        margin-top: 0em;
        margin-bottom: 0em;
        margin-left: 5px;
        margin-right: 5px;
    }
</style>
    <div id="logoPlantilla">
        
    </div>
    <div class="user-panel mt-1 pb-1 mb-1 d-flex">
                            
    </div>
    <div class="sidebar">
                        <nav class="mt-2" >
                            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                            
                                <li class="nav-item">
                                    <a href="{{route('usuarios')}}" class="{{ (request()->is('admin/cities')) ? 'nav-link active' : 'nav-link' }} ">
                                        <i class="nav-icon fa-solid fa-user"></i>
                                        <p>
                                            Usuarios
                                        </p>
                                    </a>
                                </li>


                                <li 
                                    @if( (session('active')=='TiposIncidentes') ||  (session('active')=='TiposDescansos')
                                     ||  (session('active')=='TiposEpis') ||  (session('active')=='TiposAusencias')
                                     ||  (session('active')=='TiposEventos'))
                                        class="nav-item menu-is-opening menu-open"
                                    @else
                                        class="nav-item"
                                    @endif
                                    >
                                            <a href="#" 
                                                @if( (session('active')=='TiposIncidentes') ||  (session('active')=='TiposDescansos') 
                                                ||  (session('active')=='TiposEpis')  ||  (session('active')=='TiposAusencias') 
                                                ||  (session('active')=='TiposEventos'))
                                                    class="nav-link active"
                                                @else
                                                    class="nav-link"
                                                @endif
                                            >
                                                <i class="nav-icon fa-solid fa-person-walking"></i>
                                                <p>
                                                    Tipos
                                                <i class="fas fa-angle-left right"></i>
                                                <!-- <span class="badge badge-info right">6</span>-->
                                                </p>
                                            </a>
                                            <ul class="nav nav-treeview">
                                           
                                                <li class="nav-item">
                                                    <a href="{{route('TiposIncidentes')}}" 
                                                    
                                                    @if(session('active')=='TiposIncidentes')
                                                        class="nav-link active"
                                                    @else
                                                        class="nav-link"
                                                    @endif
                                                    >
                                                        <i class="far fa-circle nav-icon"></i>
                                                        <p>Tipos de Incidentes</p>
                                                    </a>
                                                </li>

                                                <li class="nav-item">
                                                    <a href="{{route('TiposDescansos')}}" 
                                                    
                                                    @if(session('active')=='TiposDescansos')
                                                        class="nav-link active"
                                                    @else
                                                        class="nav-link"
                                                    @endif
                                                    >
                                                        <i class="far fa-circle nav-icon"></i>
                                                        <p>Tipos de Descansos</p>
                                                    </a>
                                                </li>
                                                <li class="nav-item">
                                                    <a href="{{route('TiposEpis')}}" 
                                                    
                                                    @if(session('active')=='TiposEpis')
                                                        class="nav-link active"
                                                    @else
                                                        class="nav-link"
                                                    @endif
                                                    >
                                                        <i class="far fa-circle nav-icon"></i>
                                                        <p>Tipos de Epis</p>
                                                    </a>
                                                </li>
                                                <li class="nav-item">
                                                    <a href="{{route('TiposAusencias')}}" 
                                                    
                                                    @if(session('active')=='TiposAusencias')
                                                        class="nav-link active"
                                                    @else
                                                        class="nav-link"
                                                    @endif
                                                    >
                                                        <i class="far fa-circle nav-icon"></i>
                                                        <p>Tipos de Ausencias</p>
                                                    </a>
                                                </li>
                                                <li class="nav-item">
                                                    <a href="{{route('TiposEventos')}}" 
                                                    
                                                    @if(session('active')=='TiposEventos')
                                                        class="nav-link active"
                                                    @else
                                                        class="nav-link"
                                                    @endif
                                                    >
                                                        <i class="far fa-circle nav-icon"></i>
                                                        <p>Tipos de Eventos</p>
                                                    </a>
                                                </li>
     
     
                                            </ul>
                                </li>                                        

                            </ul>
                        </nav>
                   <!-- </div>
                </div>
            </div>-->
            <div class="os-scrollbar os-scrollbar-horizontal os-scrollbar-unusable os-scrollbar-auto-hidden">
                <div class="os-scrollbar-track"><div class="os-scrollbar-handle" style="width: 100%; transform: translate(0px, 0px);"></div></div>
            </div>
            <div class="os-scrollbar os-scrollbar-vertical os-scrollbar-auto-hidden">
                <div class="os-scrollbar-track"><div class="os-scrollbar-handle" style="height: 48.933%; transform: translate(0px, 0px);"></div></div>
            </div>
            <div class="os-scrollbar-corner"></div>
        </div>