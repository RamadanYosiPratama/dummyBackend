<?php

namespace App\Http\Controllers\Api\Payment;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Xendit\Xendit;

class XenditController extends Controller
{
    //
    private $token = 'xnd_development_t6eSxjIiUj0QK4YSxEXSXxzfXXqlExSm6BeSKvoZipKLTZZk3qoxHZaDGFn0ML';

    public function getListVal()
    {

        Xendit::setApiKey($this->token);

        $getVABanks = \Xendit\VirtualAccounts::getVABanks();
        return response()->json([
            'data' => $getVABanks
        ])->setStatusCode(200);
    }

    public function createVa(Request $request)
    {
        Xendit::setApiKey($this->token);
        $params = [
            "external_id" => \uniqid(),
            "bank_code" => "MANDIRI",
            "name" => "Ahmad"
        ];
        $createVa = \Xendit\VirtualAccounts::create($params);
        return response()->json([
            'data' => $createVa
        ])->setStatusCode(200);
    }
}
