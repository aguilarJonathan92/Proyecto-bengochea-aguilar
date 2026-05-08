<?php

namespace App\Http\Controllers;

use App\Http\Requests\QueriesRequest;
use Illuminate\Http\Request;
use Apps\Model\Query;
use SweetAlert2\Laravel\Swal;

class QueriesController extends Controller
{
    public function index(){
        return view('pages.queries');
    }
    public function query_store(QueriesRequest $request){
        $datos = $request->validated();
        Swal::success([
            'title' => '!Hecho!',
            'text' => '¡La consulta se ha procesado correctamente!'
        ]);
        return redirect()->back()->with('success', '¡Recibido! Nos pondremos en contacto a la brevedad.');
    }


}
