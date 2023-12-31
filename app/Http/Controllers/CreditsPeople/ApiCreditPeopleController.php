<?php

namespace App\Http\Controllers\CreditsPeople;

use App\Http\Controllers\Controller;
use App\Models\CreditPeople;
use Illuminate\Http\Request;

class ApiCreditPeopleController extends Controller
{

    public function store(Request $request)
    {
        $person = new CreateCreditPeopleController();
        return $person->store($request);
    }

    public function show($id, Request $request)
    {
        $alert = 'No se pudo encontrar las personas, intente nuevamente.';
        $status = false;
        $messages = [];
        $data = [];

        switch ($id) {
            case 'AllPeople':
                $people = CreditPeople::with('CreditDetail')->get();
                if (isset($people)) {
                    $alert  = 'Se han encontrado las personas.';
                    $data   = $people;
                    $status = true;
                }
                break;
            case 'AllOnlyPeople':
                $people = CreditPeople::all();
                if (isset($people)) {
                    $alert  = 'Se han encontrado las personas.';
                    $data   = $people;
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
        $person = new UpdateCreditPeopleController();
        return $person->update($request, $id);
    }
}
