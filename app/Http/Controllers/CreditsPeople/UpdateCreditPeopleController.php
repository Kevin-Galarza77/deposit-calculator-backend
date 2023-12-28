<?php

namespace App\Http\Controllers\CreditsPeople;

use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use App\Models\CreditPeople;
use Illuminate\Http\Request;

class UpdateCreditPeopleController extends Controller
{
    public function update(Request $request, $id)
    {
        $alert = 'No se pudo actualizar la persona, intente nuevamente.';
        $status = false;
        $messages = [];
        $data = [];

        $validator = $this->validateData($request->all());

        if (!$validator['status']) {

            $messages = $validator['messages'];
        } else {

            $person_data = CreditPeople::where('credit_people_name', strtoupper($request->get('credit_people_name')))->first();

            if (isset($person_data) && $person_data['credit_people_id'] != $id) {

                array_push($messages, 'El nombre ya se encuentra registrado en otra persona');
            } else {

                $credit_people = CreditPeople::find($id);
                $credit_people->credit_people_name = strtoupper($request->get('credit_people_name'));
                if ($credit_people->update()) {
                    $alert = 'La persona se ha actualizado correctamente!';
                    $status = true;
                    $data = $credit_people;
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
            'credit_people_name.required'     =>  'El nombre de la persona es requerido'
        ];

        $infoData = [
            'credit_people_name'              =>  'required'
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
