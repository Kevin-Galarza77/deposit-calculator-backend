<?php

namespace App\Http\Controllers\CreditsPeople;

use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use App\Models\CreditPeople;
use Illuminate\Http\Request;

class CreateCreditPeopleController extends Controller
{

    public function store(Request $request)
    {
        $alert = 'No se pudo crear la persona, intente nuevamente.';
        $status = false;
        $messages = [];
        $data = [];

        $validator = $this->validateData($request->all());

        if (!$validator['status']) {

            $messages = $validator['messages'];
        } else {

            $person_data = CreditPeople::where('credit_people_name', strtoupper($request->get('credit_people_name')))->first();

            if (isset($person_data)) {

                array_push($messages, 'El nombre ya se encuentra registrado en otra persona');
            } else {

                $credit_people = new CreditPeople();
                $credit_people->credit_people_name = strtoupper($request->get('credit_people_name'));
                if ($credit_people->save()) {
                    $alert = 'La persona se ha creado correctamente!';
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
