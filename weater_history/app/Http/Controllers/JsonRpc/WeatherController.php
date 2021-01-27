<?php

namespace App\Http\Controllers\JsonRpc;

use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

use App\Repository\JsonRpc\HistoryRepositories;

class WeatherController extends CoreController
{
    private $historyRepository;

    public function __construct() {
        $this->historyRepository = app(HistoryRepositories::class);
    }

    public function getHistory(Request $request) : array {
        $input = $this->validateInput($request->all(), [
            'lastDays' => 'required|integer|min:1',
        ]);

        return $this->historyRepository->getListDays($request->lastDays);
    }

    public function getByDate(Request $request) : float {
        $input = $this->validateInput($request->all(), [
            'date' => 'required|date',
        ]);

        $date = Carbon::parse($input[ 'date' ]);

        $result = $this->historyRepository->getTempDay($date);

        if (0.0 == $result) {
            throw new \Exception('Not temp');
        }

        return $result;
    }

}
