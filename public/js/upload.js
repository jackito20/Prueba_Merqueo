if ( document.getElementById( "fichero_csv" )) {
    document.getElementById("fichero_csv").addEventListener("change", function(e){
      /*contador=0;
      carousel="articulo";
      console.log("subir archivo");*/
      var file = e.target.files[0];
      if(file.size>2097152){
        document.getElementById("fichero_csv").value="";
        alert("El tamaño de los archivos no debe ser mayor a 2Mb");
      }else{
        document.getElementById("guardarRecurso").submit();
      }
    });
  }