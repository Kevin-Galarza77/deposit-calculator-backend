<?php

namespace App\Http\Controllers\Products;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;

class ApiProductController extends Controller
{
    public function store(Request $request)
    {
        $product = new CreateProductController();
        return $product->store($request);
    }

    public function show($id, Request $request)
    {
        $alert = 'No se pudo encontrar los productos, intente nuevamente.';
        $status = false;
        $messages = [];
        $data = [];

        switch ($id) {
            case 'allProducts':
                $products = Product::where('product_status', 1)->get();
                if (isset($products)) {
                    $alert  = 'Se han encontrado los productos.';
                    $data   = $products;
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
        $product = new UpdateProductController();
        return $product->update($request, $id);
    }

    public function destroy($id)
    {
        $alert = 'No se pudo eliminar el producto, intente nuevamente.';
        $status = false;
        $messages = [];
        $data = [];

        $product = Product::find($id);
        if (isset($product)) {

            $product->product_status = 2;

            if ($product->save()) {
                $status =  true;
                $alert  =  'El producto se ha eliminado correctamente!';
                $data   =  ['product_id' => $product['product_id'], "product_status" => $product['product_status']];
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
