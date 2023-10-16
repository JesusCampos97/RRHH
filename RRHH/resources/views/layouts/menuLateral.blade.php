
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