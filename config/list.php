<?php


//Deficinicion del array asociativo para las listas
//["type"=>Tipo de lista se obtiene de los valores de HtmlTag como LIST_ORDERED,LIST_UNORDERED,LIST_ARTICLE,HYPERLINK=
//  "id"=>Identidicador del item de la lista,
//  "method"=>En el caso de un menu se puede indicar que es un menu desplegable con el valor de HtmlTag LIST_DROPDOWM,
//  "include"=>Nuevo Array asociativo con todos los Arrays de lista que estan incluidos dentro de esta lista.
//  "title"=>Titulo de la lista,
//  "src"=>Dirección de Hyperlink donde nos envía ese item de la lista
//  "btn"=> Si el valor es True indica que el elemento debe ser un botón, por ejemplo convertir un HipeLink en un boton



$list1=["type"=>Lista::LIST_UNORDERED,"id"=>'ul-1',"method"=>'',"title"=>'Links',"src"=>'',"include"=>
            [["type"=>Lista::LIST_ARTICLE,"id"=>'l1-1',"method"=>'',"title"=>'',"src"=>'',"include"=>["type"=>Lista::HYPERLINK,"id"=>'li-1-a-1',"method"=>'',"title"=>'Link',"src"=>'','btn'=>true]],
            ["type"=>Lista::LIST_ARTICLE,"id"=>'li-2',"method"=>'',"title"=>'',"src"=>'',"include"=>["type"=>Lista::HYPERLINK,"id"=>'li-2-a-1',"method"=>'',"title"=>'Link',"src"=>'']],
            ["type"=>Lista::LIST_ARTICLE,"id"=>'li-3',"method"=>'',"title"=>'',"src"=>'',"include"=>["type"=>Lista::HYPERLINK,"id"=>'li-3-a-1',"method"=>'',"title"=>'Link',"src"=>'']],
            ]];

//Creamos un array multidimensinal asociativo donde indicamos para cada tipo de lista si queremos que tenga una clase
//Además podemos añadir la clase classbtn que sustituye a la clase normal si el elemento de la lista tiene la clave "btn" en true

$toClass=[["type"=>Lista::LIST_UNORDERED,"class"=>"list-ul"],["type"=>Lista::LIST_ARTICLE,"class"=>"list-li"],
    ["type"=>Lista::HYPERLINK,"class"=>"list-a","classbtn"=>"btn list-a"]];
