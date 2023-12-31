<?php

namespace App\Http\Controllers\CreditsDetail;

use App\Http\Controllers\Controller;
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
    
}
