<?php

namespace App\Http\Controllers;

use App\Http\Repositories\SaleRepository;
use App\Http\Resources\SaleResource;
use App\Http\Rules\SaleRules;
use App\Mappers\SaleMapper;
use App\Mappers\SummaryMapper;
use App\Models\Sale;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SaleController extends Controller
{
    public function index()
    {
        // pagination
        $sales = Sale::all();
        return response(SaleResource::collection($sales), 200);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), SaleRules::rules);

        if ($validator->fails()) {
            return response(['message' => 'Bad request'], 400);
        }

        $values = SaleMapper::map($request, true);

        $sale = new Sale();
        $sale->saveInstance($values);

        return response(['message' => 'Sale created'], 201);
    }

    public function show(Sale $sale)
    {
        return response(new SaleResource($sale), 200);
    }

    public function update(Request $request, Sale $sale)
    {
        $validator = Validator::make($request->all(), SaleRules::rules);

        if ($validator->fails()) {
            return response(['message' => 'Bad request'], 400);
        }

        $values = SaleMapper::map($request);
        $sale->saveInstance($values);

        return response(['message' => 'Sale updated'], 200);
    }

    public function retrieveSales()
    {
        $username = 'tzinch';
        $password = 'r#eD21mA%gNU';

        $URL='https://www.become.co/api/rest/test/';

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $URL);
        curl_setopt($ch, CURLOPT_TIMEOUT, 30);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
        curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_ANY);
        curl_setopt($ch, CURLOPT_USERPWD, "$username:$password");

        $result = curl_exec ($ch);
        $statusCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);

        curl_close ($ch);

        $result = json_decode($result, true);

        if ($statusCode === 200 && $result['success']) {
            Sale::insert($result['data']);
            return response(SaleResource::collection($result['data']), 200);
        }

        return response(['message' => 'Server error, try again'], 500);
    }

    public function summary(Request $request)
    {
        $from = $request->input('from');
        $to = $request->input('to');

        if ($from) {
            $from = Carbon::createFromFormat('d/m/Y', $from)->startOfDay();
        }

        if ($to) {
            $to = Carbon::createFromFormat('d/m/Y', $to)->startOfDay();
        }

        return response(SummaryMapper::map(SaleRepository::summary($from, $to)), 200);
    }

    public function destroy(Sale $sale)
    {
        $sale->delete();
        return response(['message' => 'Sale deleted'], 200);
    }
}
