<?php
require_once __DIR__. '/../class/tags/Tag.php';


class taghandler{

    public static function addTag(){
        if(isset($_POST['addtag']) && $_SERVER['REQUEST_METHOD'] == "POST"){
            $tagname=$_POST['name'];
            echo $tagname;
            $tag=Tag::ajout($tagname);
            
        }
    }

}