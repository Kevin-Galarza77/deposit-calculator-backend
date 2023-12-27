<?php

namespace App\Http\Controllers\Weeks;

use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Week;

class UpdateWeekController extends Controller
{

    public function update(Request $request,$id)
    {
        $alert    = 'No se pudo actualizar la semana, intente nuevamente.';
        $status   = false;
        $messages = [];
        $data     = [];

        $validator = $this->validateData($request->all());

        if (!$validator['status']) {

            $messages = $validator['messages'];
        } else {

            $data = Week::where('week_date', $request->get('week_date'))->first();

            if (isset($data) && $data->week_id != $id) {

                array_push($messages, 'La semana con esta fecha ya se encuentra registrada en otra semana');
            } else {

                $week = Week::find($id);
                $week->week_date    = $request->get('week_date');
                $week->week_status  = 1;

                if ($week->update()) {
                    $alert = 'La semana se ha actualizado correctamente!';
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
            'week_date.required'     =>  'La fecha de la semana es requerido',
            'week_id.required'       =>  'La semana es requerida',   
        ];

        $infoData = [
            'week_date'              =>  'required',
            'week_id'              =>  'required'
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
