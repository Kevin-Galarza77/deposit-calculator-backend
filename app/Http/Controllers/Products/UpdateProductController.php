<?php

namespace App\Http\Controllers\Products;

use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;

class UpdateProductController extends Controller
{
    public function update(Request $request, $id)
    {
        $alert = 'No se pudo actualizar el producto, intente nuevamente.';
        $status = false;
        $messages = [];
        $data = [];

        $validator = $this->validateData($request->all());

        if (!$validator['status']) {

            $messages = $validator['messaes'];
        } else {

            $product = Product::find($id);

            $product_data = Product::where('product_name', strtoupper($request->get('product_name')))->first();

            if (isset($product_data) && $product_data['product_id'] != $id) {

                array_push($messages, 'El nombre ya se encuentra registrado en otro producto');
            } else {

                $product->product_purchase_price = $request->get('product_purchase_price');
                $product->product_sale_price     = $request->get('product_sale_price');
                $product->product_status         = $request->get('product_status');
                $product->product_name           = strtoupper($request->get('product_name'));
                $product->product_img            = $request->get('product_img');

                if ($product->update()) {
                    $alert = 'El producto se ha actualizado correctamente!';
                    $status = true;
                    $data = $product;
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
            'product_name.required'             =>  'El nombre del producto es requerido',
            'product_sale_price.required'       =>  'El precio de venta del producto es requerido',
            'product_purchase_price.required'   =>  'El precio de compra del producto es requerido',
            'product_img.required'              =>  'La url de la imagen del producto es requerido',
            'product_status.required'           =>  'El estado del producto es requerido',
        ];

        $infoData = [
            'product_name'              =>  'required',
            'product_sale_price'        =>  'required',
            'product_purchase_price'    =>  'required',
            'product_img'               =>  'required',
            'product_status'            =>  'required'
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
