@extends("theme.$theme.layout");

@section('titulo')
    Roles
@endsection

@section('scripts')
    <script src="{{ asset("assets/scripts/admin/crear.js")}}" type="text/javascript"></script>
@endsection

@section('contenido')
<div class="row">
    <div class="col-lg-12">
        @include('includes.form-error') <!-- mensajes de error -->
        @include('includes.mensaje') <!-- mensajes de satisfaccion -->
        <div class="box box-danger">
            <div class="box-header with-border">
                <h3 class="box-title">Editar Rol</h3>
                <div class="box-tools pull-right">
                    <a href="{{ route('rol') }}" class="btn btn-block btn-primary btn-sm">
                        <i class="fa fa-fw fa-plus-circle"></i> Volver al listado
                    </a>
                </div>
            </div>
            <form action="{{ route('actualizar_rol', ['id' => $data -> id ]) }}" method="POST" class="form-horizontal" id="form-general" autocomplete="off">

                @csrf @method('put')

                <div class="box-body">
                    @include('admin.rol.form')
                </div>

                <div class="box-footer">
                    <div class="col-lg-6 col-lg-offset-3">
                        @include('includes.boton-form-editar')
                    </div>
                </div>

            </form>
        </div>
    </div>
</div>
@endsection

