@extends("theme.$theme.layout")

@section('titulo')
    Rol
@endsection

@section('scripts')
    <script src="{{ asset("assets/pages/scripts/admin/crear.js") }}"></script>
@endsection

@section('contenido')
<div class="row">
    <div class="col-lg-12">
        @include('includes.form-error')
        @include('includes.mensaje')
        <div class="box box-danger">
            <div class="box-header with-border">
                <h3 class="box-title">Crear Rol</h3>
                <div class="box-tools pull-right">
                    <a href="{{ route('rol') }}" class="btn btn-block btn-primary btn-sm">
                        <i class="fa fa-fw fa-plus-circle"></i>Volver al listado
                    </a>
                </div>
            </div>
            <form action="{{ route('guardar_rol') }}" method="POST" class="form-horizontal" id="form-general" autocomplete="off">
                @csrf
                <div class="box-body">
                    @include('admin.rol.form')
                </div>
                <div class="box-footer">
                    <div class="col-lg-6 col-lg-offset-3">
                        @include('includes.boton-form-crear')
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
