<?php
declare(strict_types=1);

namespace App\Services\JsonRpc;

use Illuminate\Http\Request;

class JsonRpcServer
{
    const PATH_CONTROLLER_JSONRPC = 'App\Http\Controllers\JsonRpc\\';

    public function handle(Request $request)
    {
        try {
            $content = json_decode($request->getContent(), true);

            if (empty($content)) {
                throw new \Exception('Empty request');
            }

            list($strcontroller, $method) = explode('.', $content[ 'method' ]);

            if (empty($strcontroller)) {
                throw new \Exception('Bad controller');
            }

            $strcontroller = ucfirst($strcontroller);

            if (empty($method)) {
                throw new \Exception('Bad method');
            }

            foreach ($content[ 'params'] as $name => $var) {
                $request->offsetSet($name, $var);
            }

            $controller = app()->make(self::PATH_CONTROLLER_JSONRPC . $strcontroller . 'Controller');
            $result = $controller->callAction($method, [ $request ]);

            return JsonRpcResponse::success($result, (string)$content['id']);
        } catch (\Exception $e) {
            return JsonRpcResponse::error($e->getMessage());
        }
    }
}
