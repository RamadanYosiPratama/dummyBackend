<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Helpers\ResponseFormatter;
use App\Models\vaksin;

class VaksinController extends Controller
{
    public function all(Request $request)
    {
        $id = $request->input('id');
        $limit = $request->input('limit', 6);
        $name = $request->input('name');
        $types = $request->input('types');

        $price_from = $request->input('price_from');
        $price_to = $request->input('price_to');

        // $rate_from = $request->input('rate_from');
        // $rate_to = $request->input('rate_to');

        if ($id) {
            $vaksin = vaksin::find($id);

            if ($vaksin)
                return ResponseFormatter::success(
                    $vaksin,
                    'Data produk berhasil diambil'
                );
            else
                return ResponseFormatter::error(
                    null,
                    'Data produk tidak ada',
                    404
                );
        }

        $vaksin = vaksin::query();

        if ($name)
            $vaksin->where('name', 'like', '%' . $name . '%');

        if ($types)
            $vaksin->where('types', 'like', '%' . $types . '%');

        if ($price_from)
            $vaksin->where('price', '>=', $price_from);

        if ($price_to)
            $vaksin->where('price', '<=', $price_to);

        return ResponseFormatter::success(
            $vaksin->paginate($limit),
            'Data list produk berhasil diambil'
        );
    }
}
