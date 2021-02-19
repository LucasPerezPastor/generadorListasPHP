<?php

class Lista{

    const LIST_ORDERED="ol";
    const LIST_UNORDERED="ul";
    const LIST_ARTICLE="li";
    const LIST_DROPDOWN="dropdown";
    const LIST_ACTIVE="active";
    
    const HYPERLINK="a";
    const HYPERLINK_DISABLED="disabled";

    // Tipos válidos de Lista
    private const ARRAY_TYPE=[SELF::LIST_UNORDERED,SELF::LIST_ORDERED,SELF::LIST_ARTICLE,SELF::HYPERLINK];

    const KEYS=["{type}","{id_name}","{title}","{class}","{href}"]; //asignamos las palabras claves que serán substituidas en un array    
    const START_MASK_STRUCTURE_HTML='<{type} {id_name} {class} {href} >{title}';   

     /**
     * Devuelve un string con la estructura $nameVariable="$variable" 
     * en el caso que $variable tenga algun valor válido sino 
     * devuelve un string vacio
     *
     * @param string $variable
     * @param string $nameVariable
     * @return string
     */
    public static function returnValue(string $variable='',string $nameVariable=''):string{
        if (!empty($variable) && str_replace(' ','',$variable)<>''){
          return $nameVariable.'="'.trim($variable).'"';
        }else{
          return '';
        }
      }


    /**
     * Devuelve un array de String con las conversiones del array $list a código HTML
     * El array $toClass es para añadir la clase correspondiente en función del tipo especificado
     * 
     * @param array $list
     * @param array $toClass
     * @return array
     */
    public static function getListToHTML(array $list=NULL,array $toClass=NULL):array
    {
      $out=[];     
      
      if (!empty($list) && $list!=NULL)
      {
       
           
        if (array_key_exists("type",$list))
        {//Si existe la clave "type" es un array asociativo
          //Si el array $list no tiene alguna de las claves=>valor las pone en valor vacio.
          $listType=$list["type"];
          $listMethod=(array_key_exists("method",$list))?$list["method"]:'';
          $listId=(array_key_exists("id",$list))?$list["id"]:'';
          $listTitle=(array_key_exists("title",$list))?$list["title"]:'';
          $listSrc=(array_key_exists("src",$list))?$list["src"]:'';
          $isButton=(array_key_exists("btn",$list))?(($list["btn"]==true)?$list["btn"]:false):false;

          $listRel=(array_key_exists("rel",$list))?$list["rel"]:1; //si no existe rel la relación será 1 a 1
          $innerClass='';
          if ($toClass!=NULL)
          {
            $existType=array_search($listType,array_column($toClass,"type"));//Buscamos dentro del array $toClass si hay alguna key con valor $listType
            //Si $exisType no es explicitamente false es que existe una key con el valor $listType
            //en $exisType se guarda la posición del array que contiene esa key

            $innerClass=($existType===false)?'':(($isButton)?(array_key_exists("classbtn",$toClass[$existType])?$toClass[$existType]["classbtn"]:((array_key_exists("class",$toClass[$existType]))?$toClass[$existType]["class"]:''))
            :((array_key_exists("class",$toClass[$existType]))?$toClass[$existType]["class"]:''));


            //Operador ternario anidado , si $exisType es explicitamente false entonces $innerClass vale '', en el caso contrario,
            //vamos a mirar si $isButton es true por lo que si es true mirariamos si existe la clave "classbtn" para obtener su valor,
            //si no existe esta clave miraremos si existe la clabe "class" para obtener su valor y si no existe esa clave valdrá ''
            //en el caso que $isButton sea false miraremos si exsite la clave "class" par obtner su valor y en el caso contrario valdrá ''
          }
          

          if (in_array($listType,self::ARRAY_TYPE))
          {
            $words=[$listType,self::returnValue($listId,"id"),
            $listTitle,self::returnValue($innerClass.' '.$listMethod,"class"),
            self::returnValue($listSrc,"href"),];//asignamos el valor que substituirá a las palabras claves en otro array
            //substituimos las palabras clave por sus valores y lo guardamos en el array $out[]
            $out[]=str_replace(self::KEYS,$words,self::START_MASK_STRUCTURE_HTML);
            if (array_key_exists("include",$list)){
              //Si existe la clave "include", hay dentro otro array por lo que llamamos recursivamente al método listExplorer
              //para que nos devuelva un un array de strings            
              $out=array_merge($out,self::getListToHTML($list["include"],$toClass));
            }
            $out[]='</'.$listType.'>'; 
          }
        }else
        {
          // Al no existir la clave "type" , vamos a comprobar si dentro hay más arrays.
          $arrs=array_filter($list,'is_array');//Filtra elementos de un array usando una función 'is_array',
          //Devolverá un array con tantos 'true' como arrays haya dentro del array original 
          if (count($arrs)==count($list))
          {
            //Determinamos que todos los elementos del array original son arrays
            // Y pasaremos a recorrer estos arrays para llamar de forma recursiva al método y pasarle los parámetros del array
            foreach ($list as $value) {
              //Añadimos al array $out el resultado de pasarle de forma recursiva el array al método
              $out=array_merge($out,self::getListToHTML($value,$toClass));
          }
          }else
          {
            //El Array recibido no es válido
          };
        }
      } 
      
      return $out;
    }

  /**
   * Devuelve un String con cada código HTMl que se ha generado con el método getListToHtml,
   * para ello lee el string devuelto por getListToHtml y los concatena todos en un solo string añadiendo saltos
   * de línea PHP_EOL entre cada uno de ellos.
   *
   * @param array $list
   * @param array $toClass
   * @return string
   */  
  public static function getListToHtmlToString(array $list=NULL,array $toClass=NULL):string
  {
    $out='';
    $listArray=self::getListToHTML($list,$toClass);

  
    foreach ($listArray as $value) {
      # code...
      $out=$out.$value.PHP_EOL;
    }
    return $out;
  }
}