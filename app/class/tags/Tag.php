<?php
require_once __DIR__. '/../crud.php';

class Tag{

    private static $table= 'tags';

public static function ajout($data){
    
    $ooo = new Crud();
    $ooo->insertRecord(self::$table, $data);

}

public function supp(){

}

public function upda(){

}

public function show(){

}

}