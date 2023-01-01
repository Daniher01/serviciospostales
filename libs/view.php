<?php 

class View{

    function __construct()
    {
        
    }

    function render($nombre){
        try{
            require 'vista/' .$nombre. '.php';
        }catch (Error $e){
            error_log("APP::View Base-> $e");
        }
        
    }

    

}

?>