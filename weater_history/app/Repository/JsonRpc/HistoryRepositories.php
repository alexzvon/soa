<?php
declare(strict_types=1);

namespace App\Repository\JsonRpc;

use Illuminate\Support\Carbon;

use App\Repository\CoreRepositories;
use App\Models\HistoryModel as Model;
use function PHPUnit\Framework\isNull;

class HistoryRepositories extends CoreRepositories
{
    public function getModelClass() : string {
        return Model::class;
    }

    public function getListDays(int $days) : array {
        $columns = [ 'date_at', 'temp' ];

        $history = $this->startConditions()
            ->select($columns)
            ->orderby('date_at', 'desc')
            ->limit($days)
            ->get()
            ->toArray()
        ;

        foreach ($history as $item) {
            $result[] = [ $item[ 'date_at' ], $item[ 'temp'] ];
        }

        return $result;
    }

    public function getTempDay(Carbon $day) : float {
        $temp = $this->startConditions()
            ->select('temp')
            ->where('date_at', '=', $day)
            ->first();

        return is_null($temp) ? 0.0 : $temp->temp;
    }
}
