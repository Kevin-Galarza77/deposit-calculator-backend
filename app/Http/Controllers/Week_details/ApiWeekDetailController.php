<?php

namespace App\Http\Controllers\Week_details;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Week;
use App\Models\Week_details;

class ApiWeekDetailController extends Controller
{

    public function store(Request $request)
    {
        $detail = new CreateWeekDetailController();
        return $detail->store($request);
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
        $detail = new UpdateWeekDetailController();
        return $detail->update($request, $id);
    }

    public function destroy($id)
    {
        $alert = 'No se pudo eliminar el detalle, intente nuevamente.';
        $status = false;
        $messages = [];
        $data = [];

        $week_details = Week_details::find($id);
        if (isset($week_details)) {

            if ($week_details->delete()) {
                $alert  =  'El detalle se ha eliminado correctamente!';
                $status =  true;
            }
        }

        return [
            'alert'     =>  $alert,
            'status'    =>  $status,
            'messages'  =>  $messages,
            'data'      =>  $data
        ];
    }
}
