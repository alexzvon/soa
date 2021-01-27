<?php

namespace App\Http\Controllers\JsonRpc;

use App\Services\JsonRpc\JsonRpcClient;
use App\Http\Controllers\Controller;
use App\Http\Requests\JsonRpc\WHRequest;

class WHController extends Controller
{
    protected $client;

    public function __construct() {
        $this->client = app(JsonRpcClient::class);
    }

    public function index() {
        $data = $this->client->send('weather.getHistory', [ 'lastDays' => 30 ]);
        $params=  [];

        if (isset($data[ 'result' ])) {
            $params = [ 'temps' => $data[ 'result' ] ];
        }
        else if (isset($data[ 'error' ])) {
            $params = [ 'error' => $data[ 'error' ] ];
        }

        return view('weater', $params);
    }

    public function getByDate(WHRequest $request)
    {
        $data = $this->client->send('weather.getByDate', [ 'date' => $request->date ]);

        $status = 200;

        if (isset($data[ 'result' ])) {
            $params = [ 'success' => $data[ 'result' ] ];
        }
        else if (isset($data[ 'error' ])) {
            $params = [ 'errors' => [ 'date' => [ $data[ 'error' ] ] ] ];
            $status = 422;
        }

        return response()->json($params, $status);
    }
}
