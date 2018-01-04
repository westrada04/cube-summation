<?php

namespace App\Http\Controllers;

use App\Datos;
use App\Matriz;
use Illuminate\Http\Request;

class CuboController extends Controller
{
    public function index(){
        return view('main.main');
    }
    
    public function configurar(Request $request){
        $datos = new Datos();
        $this->validate($request, [
            'numeroMatriz' => 'required|integer',
            'numeroComandos' => 'required|integer'
        ]);

        $input = $request->only('numeroComandos', 'numeroMatriz');
        $matriz = new Matriz($input['numeroMatriz'], $input['numeroComandos']);

        $datos->setMatriz($matriz);
        $datos->setAcciones(0);

        return response()->json(['success' => 'true']);
    }
    
     public function actualizar(Request $request){
        $datos = new Datos();

        $this->validate($request, [
            'x' => 'required|integer',
            'y' => 'required|integer',
            'z' => 'required|integer',
            'value' => 'required|integer',
        ]);

        $matriz = $datos->getMatriz();
        if (!$matriz) {
            return response()->json(['error' => 'La matriz no ha sido configurada'], 500);
        }

        $input = $request->only('x', 'y', 'z', 'value');

        if ($input['x'] > $matriz->getNumeroMatriz() || $input['y'] > $matriz->getNumeroMatriz() || $input['z']> $matriz->getNumeroMatriz()) {
            return response()->json(['error' => 'los Valores exceden el tamaño de la matriz'], 422);
        }

        if (!$this->comprobarTests($matriz)) {
            return response()->json(['error' => 'Tests finalizados'], 500);
        };

        $matriz->actualizarValor($input['x'] - 1, $input['y'] - 1, $input['z'] - 1, $input['value']);

        return response()->json(['success' => true]);
    }
    
    private function comprobarTests($matriz){
        $datos = new Datos();

        if ($datos->getAcciones() >= $matriz->getNumeroComandos()) {
            $datos->setMatriz(null);
            return false;
        } else {
           $datos->setAcciones($datos->getAcciones() + 1);
        }
        return true;
    }
    
     public function consultar(Request $request){
        $datos = new Datos();

        $this->validate($request, [
            'x1' => 'required',
            'x2' => 'required',
            'y1' => 'required',
            'y2' => 'required',
            'z1' => 'required',
            'z2' => 'required',
        ]);

        $matriz = $datos->getMatriz();

        if(!$matriz){
            return response()->json(['error' => 'La matriz no ha sido configurada'], 500);
        }

        $values = $request->only('x1', 'x2', 'y1', 'y2', 'z1', 'z2');

        if($values['x2']-1 < $values['x1']-1 || $values['y2']-1 < $values['y1']-1 || $values['z2']-1 < $values['z1']-1){
            return response()->json(['error' => 'Un rango minimo es menor al maximo'], 422);
        }

        if(!$this->comprobarTests($matriz)){
            return response()->json(['success' => 'Tests finalizados'], 500);
        };

        return response()->json(['resultado' => $matriz->query($values['x1']-1, $values['y1']-1, $values['z1']-1, $values['x2']-1, $values['y2']-1, $values['z2']-1)]);
    }

}
