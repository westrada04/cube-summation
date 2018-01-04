<?php
/**
 * Created by PhpStorm.
 * User: westrada
 * Date: 04/01/18
 * Time: 2:00 PM
 */

namespace App;

class Matriz{
    private $numeroComandos;
    private $numeroMatriz;
    private $matriz;

    function __construct($numeroMatriz, $numeroComandos){
        $this->numeroComandos = $numeroComandos;
        $this->numeroMatriz = $numeroMatriz;
        $this->construirMatriz($numeroMatriz);
    }

    private function construirMatriz($numeroMatriz){
        for ($i = 0; $i <= $numeroMatriz; $i++) {
            for ($j = 0; $j <= $numeroMatriz; $j++) {
                for ($k = 0; $k <= $numeroMatriz; $k++) {
                    $this->matriz[$i][$j][$k] = 0;
                }
            }
        }
    }

    public function actualizarValor($x, $y, $z, $value){
        $this->matriz[$x][$y][$z] = $value;
    }

    public function query($x1, $y1, $z1, $x2, $y2, $z2){
        $sum = 0;
        for ($i = $x1; $i <= $x2; $i++) {
            for ($j = $y1; $j <= $y2; $j++) {
                for ($k = $z1; $k <= $z2; $k++) {
                    $sum += $this->matriz[$i][$j][$k];
                }
            }
        }
        return $sum;
    }

    public function getNumeroComandos(){
        return $this->numeroComandos;
    }

    public function getMatriz(){
        return $this->matriz;
    }

    public function getNumeroMatriz(){
        return $this->numeroMatriz;
    }
}
