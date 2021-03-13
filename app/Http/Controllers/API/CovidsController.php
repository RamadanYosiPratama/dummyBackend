<?php

namespace App\Http\Controllers\API;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Covid;
use App\Helpers\ResponseFormatter;

class CovidsController extends Controller
{
    public function all(Request $request)
    {
        $id = $request->input('id');
        $limit = $request->input('limit', 6);
        $name = $request->input('name');
        // $diskon = $request->input('diskon');
        $types = $request->input('types');
        $layanan = $request->input('layanan');

        $price_from = $request->input('price_from');
        $price_to = $request->input('price_to');

        // $diskon_to = $request->input('diskon_to');
        // $diskon_from = $request->input('diskon_from');

        // $rate_from = $request->input('rate_from');
        // $rate_to = $request->input('rate_to');

        if ($id) {
            $covid = Covid::find($id);

            if ($covid)
                return ResponseFormatter::success(
                    $covid,
                    'Data produk berhasil diambil'
                );
            else
                return ResponseFormatter::error(
                    null,
                    'Data produk tidak ada',
                    404
                );
        }

        $covid = Covid::query();

        if ($name)
            $covid->where('name', 'like', '%' . $name . '%');

        // if ($diskon)
        //     $covid->where('diskon', 'like', '%' . $diskon . '%');

        if ($types)
            $covid->where('types', 'like', '%' . $types . '%');

        if ($price_from)
            $covid->where('price', '>=', $price_from);

        if ($price_to)
            $covid->where('price', '<=', $price_to);

        if ($layanan)
            $covid->where('layanan', 'like', '%' . $layanan . '%');



        return ResponseFormatter::success(
            $covid->paginate($limit),
            'Data list produk berhasil diambil'
        );
    }
}
