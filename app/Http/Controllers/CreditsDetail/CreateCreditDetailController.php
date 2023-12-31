<?php

namespace App\Http\Controllers\CreditsDetail;

use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use App\Models\CreditDetail;
use Illuminate\Http\Request;

class CreateCreditDetailController extends Controller
{
    public function store(Request $request)
    {
        $alert = 'No se pudo crear el detalle, intente nuevamente.';
        $status = false;
        $messages = [];
        $data = [];

        $validator = $this->validateData($request->all());

        if (!$validator['status']) {

            $messages = $validator['messages'];
        } else {

            $data = CreditDetail::where('week_id', $request->get('week_id'))
                ->where('credit_people_id', $request->get('credit_people_id'))
                ->first();
            if (isset($data)) {

                array_push($messages, 'Ya existe un registro de esta persona en esta semana, actualizalo!');
            } else {

                $creditDetail = new CreditDetail();

                $creditDetail->week_id            = $request->get('week_id');
                $creditDetail->credit_people_id   = $request->get('credit_people_id');
                $creditDetail->credit_detail_description  = strtoupper($request->get('credit_detail_description'));
                $creditDetail->credit_detail_value        = $request->get('credit_detail_value');
                $creditDetail->credit_detail_status       = 1;

                if ($creditDetail->save()) {
                    $alert = 'El Detalle se ha creado correctamente!';
                    $status = true;
                    $data = $creditDetail;
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
            'week_id.required'                   =>  'La semana es requerida',
            'credit_people_id.required'          =>  'La persona es requerida',
            'credit_detail_description.required' =>  'La descripciòn es requerida',
            'credit_detail_value.required'       =>  'El valor es requerido'
        ];

        $infoData = [
            'week_id'                   =>  'required',
            'credit_people_id'          =>  'required',
            'credit_detail_description' =>  'required',
            'credit_detail_value'       =>  'required'
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
