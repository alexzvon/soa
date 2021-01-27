<?php
declare(strict_types=1);

namespace App\Http\Controllers\JsonRpc;

use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;

class CoreController extends Controller
{
    protected function validateInput($input, array $rules, $messages = [], $customAttributes = []): array
    {
        $validator = Validator::make($input, $rules, $messages, $customAttributes);

        if ($validator->fails()) {
            throw new \Exception('Bad params');
        }

        return $validator->validated();
    }

}
