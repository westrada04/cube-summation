<?php
/**
 * Created by PhpStorm.
 * User: westrada
 * Date: 04/01/18
 * Time: 2:00 PM
 */

namespace App;

class Datos{
    public function __construct(){
        if (!isset($_SESSION)) {
            session_start();
        }
    }

    public function setAcciones($actions){
        $_SESSION['actions'] = $actions;
    }

    public function getAcciones(){
        return $this->retornarValor('actions');

    }

    public function getMatriz(){
        return $this->retornarValor('matriz');
    }

    public function setMatriz($matriz){
        $_SESSION['matriz'] = $matriz;
    }

    public function deleteSession(){
        session_destroy();
    }

    private function retornarValor($key){
        $value = null;
        if (isset($_SESSION[$key])) {
            $value = $_SESSION[$key];
        }
        return $value;
    }
}