<?php

namespace App\Http\Controllers\Weeks;

use App\Http\Controllers\Controller;
use App\Models\Week;
use Illuminate\Http\Request;

class ApiWeekController extends Controller
{
    public function store(Request $request){

    }

    public function show($id, Request $request){
        $alert = 'No se pudo encontrar las semanas, intente nuevamente';
        $status = false;
        $messages = [];
        $data = [];

        switch ($id) {
            case 'AllWeeks':
                $weeks = Week::all();
                if (isset($weeks)) {
                    $alert  = 'Se han encontrado las semanas';
                    $data   = $weeks;
                    $status = true;
                }
                break;
        }

        return [
            'alert'     =>  $alert,
            'status'    =>  $status,
            'messages'  =>  $messages,
            'data'      =>  $data
        ];
    }

    public function update(Request $request, $id){

    }

}
