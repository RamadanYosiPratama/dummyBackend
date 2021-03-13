<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Helpers\ResponseFormatter;
use App\Models\khitan;

class KhitanController extends Controller
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
            $khitan = khitan::find($id);

            if ($khitan)
                return ResponseFormatter::success(
                    $khitan,
                    'Data produk berhasil diambil'
                );
            else
                return ResponseFormatter::error(
                    null,
                    'Data produk tidak ada',
                    404
                );
        }

        $khitan = khitan::query();

        if ($name)
            $khitan->where('name', 'like', '%' . $name . '%');

        if ($types)
            $khitan->where('types', 'like', '%' . $types . '%');

        if ($price_from)
            $khitan->where('price', '>=', $price_from);

        if ($price_to)
            $khitan->where('price', '<=', $price_to);

        return ResponseFormatter::success(
            $khitan->paginate($limit),
            'Data list produk berhasil diambil'
        );
    }
}
