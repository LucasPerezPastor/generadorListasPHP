<!doctype html>
<html lang="esp">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="generator" content="">
    <title>Title</title>
  </head>
  <body>
      <?php
        require_once 'models/Lista.php';
        require_once 'config/list.php';
        
      
      //Llamada al método que devuelve un string con todos los elementos de la lista
      //separados por un fin de linea PHP_EOL  
      echo Lista::getListToHtmlToString($list1,$toClass);

      //Llamada al método que devuelve un string con todos los elementos de la lista
      //separados por un fin de linea PHP_EOL . Sin pasarle ningún tipo de clase para cada elemento.

      echo Lista::getListToHtmlToString($list1);


      //Llamada al método que devuelve un array con todos los elementos de la lista ya creados.
      $lista=Lista::getListToHTML($list1,$toClass);
      //Después recorremos el array e imprimimos el resultado línea por línea.
      foreach ($lista as $value) {
        # code...
        echo $value;
      }

      ?>
  </body>
</html>
