<?php

namespace App\Http\Controllers\CreditsDetail;

use App\Http\Controllers\Controller;
use App\Models\CreditDetail;
use Illuminate\Http\Request;

class ApiCreditDetailController extends Controller
{
    public function store(Request $request)
    {
        $creditDetail = new CreateCreditDetailController();
        return $creditDetail->store($request);
    }

    public function update(Request $request, $id)
    {
        $creditDetail = new UpdateCreditDetailController();
        return $creditDetail->update($request, $id);
    }

    public function destroy($id)
    {
        $alert = 'No se pudo eliminar el detalle, intente nuevamente.';
        $status = false;
        $messages = [];
        $data = [];

        $credit_details = CreditDetail::find($id);
        if (isset($credit_details)) {
            if ($credit_details->delete()) {
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
