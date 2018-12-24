<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
  <head>
    <meta charset="utf-8">

    <!-- Bootstrap CSS -->
   <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

    <title>Merqueo</title>
  </head>
  <body>
    <div class="container-fluid">
    <div class="row">
      @if (Session::get('errores')!=null)
        <div class="alert alert-danger col-12">
            <ul>
                {{Session::get('errores')}}
            </ul>
        </div>
      @endif
      @if (Session::get('exito')!=null)
        <div class="alert alert-success col-12">
            <ul>
              @foreach (Session::get('exito') as $exito)
                  <li>{{ $exito }}</li>
              @endforeach
            </ul>
        </div>
      @endif
      <div class="col-2 offset-10">
        <a id="collapseButton" class="btn btn-primary float-right" data-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">
          Subir CSV
        </a>
      </div>
      <div class="collapse" id="collapseExample">
        <form id="guardarRecurso" accept-charset="UTF-8" enctype="multipart/form-data"  method="post" action="/api/productos" style="margin-top:2rem;">
          <div class="form-group row">
            <div class="form-group col-12">
              <div class="custom-file">
                Enviar este fichero: <input type="file" id="fichero_csv" name="fichero_csv">
              </div>
            </div>
          </div>
        </form>
      </div>
      </div>
      <div class="row">
        <div class="col-12">
            <table class="table">
                <thead class="thead-light">
                <tr>
                  <th scope="col">#</th>
                  <th scope="col">Nombre</th>
                  <th scope="col">Referencia</th>
                  <th scope="col">Precio</th>
                  <th scope="col">Costo</th>
                  <th scope="col">Unidades</th>
                  <th scope="col">Estado</th>
                </tr>
                </thead>
                <tbody>
<?php           $i=0;
                foreach ($productos as $producto) {                          ?>
                    <tr>
                    <th scope="row">{{$i}}</th>
                    <td>{{$producto->nombre}}</td>
                    <td>{{$producto->referencia}}</td>
                    <td>{{$producto->precio}}</td>
                    <td>{{$producto->costo}}</td>
                    <td>{{$producto->unidades_actuales}}</td>
                    <td>{{$producto->estado}}</td>
                    <!--<td>
                        <a href="/admin/productos/{{$producto->id}}">Ver</a> |
                        <form method="POST" id="delete{{$producto->id}}" action="/api/admin/productos/{{$producto->id}}">{{ csrf_field() }}{{ method_field('DELETE') }}<a href="#" onclick="eliminar({{$producto->id}})">Eliminar</a> </form> |
                        <a href="/admin/productos/{{$producto->id}}/edit">Editar</a>
                    </td>-->
                    </tr>
<?php               $i++;
                }                                                               
?>

                </tbody>
            </table>
        </div>  
      </div>
      <!--<div class="row">
        <div class="col-2 offset-10">
            <a href="#">
                <button type="submit" class="btn btn-primary">Subir CSV</button>
            </a>
        </div>
      </div>-->
      
    <!--<script type="text/javascript" src="js/bootstrap.min.js"></script>-->
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    <script type="text/javascript" src={{asset('js/upload.js')}} charset="UTF-8"></script>
  </body>
</html>