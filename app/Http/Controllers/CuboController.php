<?php

namespace App\Http\Controllers;

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
}
