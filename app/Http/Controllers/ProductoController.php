<?php

namespace App\Http\Controllers;

use App\Producto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class ProductoController extends Controller
{
    private $exito;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //return "aqui estoy";
        $productos = Producto::all();
        Session::forget('exito');
        return view("productos", compact('productos'));
        //dd($productos);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //return ("aqui estoy");
        //dd($request->all());
        Session::forget('errores');
        Session::forget('exito');
        $path = $request->file('fichero_csv')->getRealPath();
        $data = array_map('str_getcsv', file($path));
        
        //dd($data);
        if($this->validarLineaHeader($data[0])){
            $guardar=true;
            $registros=array_slice($data, 1, count($data));
            $cantidadRegistros=count($registros);
            $i=1;
            foreach($registros as $registro){
              $respuesta = $this->validarRegistro($registro);
              //dd($respuesta);
              if($respuesta){
                Session::put('errores', "Error en Archivo CSV, fila ".$i.": ".$respuesta);  
                $guardar=false;
                break;
              }
              $i++;
            }
            if($guardar){
              $this->exito= array();
              foreach($registros as $registro){
                $this->ejecutarComando($registro);
              }
              Session::put('exito', $this->exito);  
            }
        }else{
          Session::put('errores', "Error en Archivo CSV, Header invalido "); 
        }
        $productos = Producto::all();
        return view("productos", compact('productos'));
    }

    private function validarLineaHeader(Array $linea){
        //dd($linea);
        $columnas=["identificador","comando","parametro"];
        $columnasLinea = explode(";", $linea[0]);
        if($columnas == $columnasLinea)
            return true;
        else
            return false;
    }

    private function validarRegistro(Array $linea){

      $columnasLinea = explode(";", $linea[0]);

      $producto = Producto::find($columnasLinea[0]);
      if($producto==null)
        return "Producto Inválido";
      
      if($columnasLinea[1]!="Agregar" && $columnasLinea[1]!="Restar" && $columnasLinea[1]!="Activar" && $columnasLinea[1]!="Desactivar"){
        return "Comando Inválido";
      }

      if(($columnasLinea[1]=="Agregar" || $columnasLinea[1]=="Restar") && !is_numeric($columnasLinea[2])){
        return "Parámetro Inválido";
      }

      if($columnasLinea[1]=="Restar"){
        $resta=$producto->unidades_actuales - (int)$columnasLinea[2];
        if($resta<0)
          return "No se puede Restar la cantidad al producto";
      }


      return false;
    }

    private function ejecutarComando(Array $linea){
      $columnasLinea = explode(";", $linea[0]);
      $producto = Producto::find($columnasLinea[0]);
      if($columnasLinea[1]=="Agregar"){
        $producto->unidades_actuales = $producto->unidades_actuales + (int)$columnasLinea[2];
        array_push($this->exito, "Se Sumaron ".$columnasLinea[2]." articulos al producto ".$producto->nombre."(".$producto->id.")");
      }else  if($columnasLinea[1]=="Restar"){
        $producto->unidades_actuales = $producto->unidades_actuales - (int)$columnasLinea[2];
        array_push($this->exito, "Se Restaron ".$columnasLinea[2]." articulos al producto ".$producto->nombre."(".$producto->id.")");
      }else if($columnasLinea[1]=="Activar"){
        $producto->estado = 1;
        array_push($this->exito, "Se Activó el producto ".$producto->nombre."(".$producto->id.")");
      }else if($columnasLinea[1]=="Desactivar"){
        $producto->estado = 0;
        array_push($this->exito, "Se Desactivó el producto ".$producto->nombre."(".$producto->id.")");
      }

      $producto->save();
    }
    /**
     * Display the specified resource.
     *
     * @param  \App\Producto  $producto
     * @return \Illuminate\Http\Response
     */
    public function show(Producto $producto)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Producto  $producto
     * @return \Illuminate\Http\Response
     */
    public function edit(Producto $producto)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Producto  $producto
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Producto $producto)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Producto  $producto
     * @return \Illuminate\Http\Response
     */
    public function destroy(Producto $producto)
    {
        //
    }
}
