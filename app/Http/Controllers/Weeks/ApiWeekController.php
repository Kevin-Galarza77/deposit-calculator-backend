<?php

namespace App\Http\Controllers\Weeks;

use App\Http\Controllers\Controller;
use App\Models\Week;
use Illuminate\Http\Request;

class ApiWeekController extends Controller
{
    public function store(Request $request)
    {
        $week = new CreateWeekController();
        return $week->store($request);
    }

    public function show($id, Request $request)
    {
        $alert    = 'No se pudo encontrar las semanas, intente nuevamente.';
        $status   = false;
        $messages = [];
        $data     = [];

        switch ($id) {
            case 'AllWeeks':
                $weeks = Week::with('weekDetails')->orderBy('week_date', 'desc')->get();
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

    public function update(Request $request, $id)
    {
        $week = new UpdateWeekController();
        return $week->update($request, $id);
    }

    public function destroy($id)
    {
        $alert = 'No se pudo eliminar la semana, intente nuevamente.';
        $status = false;
        $messages = [];
        $data = [];

        $week = Week::find($id);
        if (isset($week)) {

            if ($week->delete()) {
                $alert  =  'La semana se ha eliminado correctamente!';
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
