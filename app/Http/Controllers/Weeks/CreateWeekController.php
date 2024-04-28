<?php

namespace App\Http\Controllers\Weeks;

use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Week;

class CreateWeekController extends Controller
{

    public function store(Request $request)
    {
        $alert    = 'No se pudo crear la semana, intente nuevamente.';
        $status   = false;
        $messages = [];
        $data     = [];

        $validator = $this->validateData($request->all());

        if (!$validator['status']) {

            $messages = $validator['messages'];
        } else {

            $date = Week::where('week_date', $request->get('week_date'))->first();

            if (isset($date)) {

                array_push($messages, 'La semana con esta fecha ya se encuentra registrada.');
            } else {

                $week = new Week();
                $week->week_alias    = strtoupper($request->get('week_alias'));;
                $week->week_date    = $request->get('week_date');
                $week->week_status  = 1;

                if ($week->save()) {
                    $alert = 'La semana se ha creado correctamente!';
                    $status = true;
                    $data = $week;
                }
            }
        }

        return [
            'alert'     =>  $alert,
            'status'    =>  $status,
            'messages'  =>  $messages,
            'data'      =>  $data
        ];
    }



    private function validateData($data)
    {
        $status = true;
        $messages = [
            'week_date.required'     =>  'La fecha de la semana es requerido'
        ];

        $infoData = [
            'week_date'              =>  'required'
        ];

        $validator = Validator::make($data, $infoData, $messages);

        if ($validator->fails()) {
            $messages = $validator->errors()->all();
            $status = false;
        }

        return [
            'status'    =>  $status,
            'messages'  =>  $messages
        ];
    }
}
