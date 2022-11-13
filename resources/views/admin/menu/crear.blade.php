@extends("theme.$theme.layout")

@section('titulo')
    Menu
@endsection

@section('scripts')
    <script src="{{ asset("assets/pages/scripts/admin/menu/crear.js")}}" type="text/javascript"></script>
@endsection

@section('contenido')
    <div class="row">
        <div class="col-lg-12">
            @include('includes.form-error')
            @include('includes.mensaje')
            <div class="box box-danger">
                <div class="box-header with-border">
                  <h3 class="box-title">Crear menu</h3>
                </div>
                {{-- Al definir un formulario HTML en mi aplicacion, es imprescindible
                incluir un campo de token oculto para que el middleware de proteccion
                CSRF(falsificacion de solicitud entre sitios) pueda validar la solicitud
                HTTP, entonces uso la directiva blade @csrf para generar ese campo token
                --}}
                <form action="{{ route('guardar_menu') }}" method="POST" id="form-general" class="form-horizontal" autocomplete="off">
                    @csrf
                    <div class="box-body">
                      @include('admin.menu.form')
                    </div>
                    <!-- /.box-body -->
                    <div class="box-footer">
                      <div class="col-lg-6 col-lg-offset-3">
                        @include('includes.boton-form-crear')
                      </div>
                    </div>
                    <!-- /.box-footer -->
                  </form>
            </div>
        </div>
    </div>
@endsection
