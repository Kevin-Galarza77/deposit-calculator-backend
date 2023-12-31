<?php

namespace App\Http\Controllers\CreditsDetail;

use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use App\Models\CreditDetail;
use Illuminate\Http\Request;

class UpdateCreditDetailController extends Controller
{
    public function update(Request $request, $id)
    {
        $alert = 'No se pudo actualizar el detalle, intente nuevamente.';
        $status = false;
        $messages = [];
        $data = [];

        $validator = $this->validateData($request->all());

        if (!$validator['status']) {

            $messages = $validator['messages'];
        } else {

            $creditDetail = CreditDetail::find($id);

            $creditDetail->credit_detail_description = $request->get('credit_detail_description');
            $creditDetail->credit_detail_value       = $request->get('credit_detail_value');
            $creditDetail->credit_detail_status      = $request->get('credit_detail_status');

            if ($creditDetail->save()) {
                $alert  = 'El Detalle se ha actualizado correctamente!';
                $status = true;
                $data   = $creditDetail;
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
