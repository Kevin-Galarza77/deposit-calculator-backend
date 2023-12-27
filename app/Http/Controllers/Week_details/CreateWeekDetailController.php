<?php

namespace App\Http\Controllers\Week_details;

use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Week_details;
use App\Models\Product;

class CreateWeekDetailController extends Controller
{
    public function store(Request $request)
    {
        $alert    = 'No se pudo crear del detalle de la semana, intente nuevamente.';
        $status   = false;
        $messages = [];
        $data     = [];

        $validator = $this->validateData($request->all());

        if (!$validator['status']) {

            $messages = $validator['messages'];
        } else {

            $product = Product::find($request->get('product_id'));
            $detail = new Week_details();
            $detail->product_id               = $request->get('product_id');
            $detail->week_id                  = $request->get('week_id');
            $detail->week_detail_quantity     = $request->get('week_detail_quantity');
            $detail->week_detail_product_name = $product->product_name;
            $detail->week_detail_product_sale_price     = $product->product_sale_price;
            $detail->week_detail_product_purchase_price = $product->product_purchase_price;

            if ($detail->save()) {
                $alert  = 'El detalle se ha creado correctamente!';
                $status = true;
                $data   = $detail;
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
            'product_id.required'             =>  'El producto es requerido',
            'week_detail_quantity.required'   =>  'La cantidad es requerida',
            'week_id.required'                =>  'La semana es requerida'
        ];

        $infoData = [
            'product_id'              =>  'required',
            'week_detail_quantity'    =>  'required',
            'week_id'                 =>  'required'
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
