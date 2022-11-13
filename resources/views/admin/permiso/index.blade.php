@extends("theme.$theme.layout");

@section('titulo')

@endsection

@section('contenido')
    <div class="row">
        <div class="col-lg-12">
            <div class="box box-primary">
                <div class="box-header with-border">
                  <h3 class="box-title">Bordered Table</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body table-responsive no-padding">
                  <table class="table table-bordered table-hover table-striped">
                      <thead>
                        <th>Id</th>
                        <th>Nombre</th>
                        <th>Slug</th>
                        <th>Accion</th>
                      </thead>
                      <tbody>
                        @foreach ($permisos as $permiso )
                            <tr>
                                <td> {{ $permiso->id }} </td>
                                <td> {{ $permiso->nombre }} </td>
                                <td> {{ $permiso->slug }} </td>
                                <td> </td>
                            </tr>
                        @endforeach
                      </tbody>
                  </table>
                </div>
            </div>
        </div>
    </div>
@endsection
