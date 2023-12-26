<?php

namespace App\Http\Controllers\Week_details;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Week;

class ApiWeekDetailController extends Controller
{

    public function store(Request $request)
    {
    }

    public function show($id, Request $request)
    {
        $alert    = 'No se pudo encontrar los detalles de la semana, intente nuevamente.';
        $status   = false;
        $messages = [];
        $data     = [];

        switch ($id) {
            case 'AllWeekDetailsByWeek':
                $week_details = Week::with('weekDetails')->find($request->get('week'));
                if (isset($week_details)) {
                    $alert  = 'Se han encontrado los detalles de la semanas';
                    $data   = $week_details;
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

    public function update(Request $request, $id)
    {
    }
}
