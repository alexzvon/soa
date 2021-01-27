<?php
declare(strict_types=1);

namespace App\Services\JsonRpc;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Psr7;
use GuzzleHttp\RequestOptions;

class JsonRpcClient
{
    const JSON_RPC_VERSION = '2.0';

    const METHOD_URI = 'POST';

    protected $id;

    protected $base_uri;

    protected $client;

    public function __construct()
    {
        $this->client = new Client([
            'headers' => ['Content-Type' => 'application/json'],
            'base_uri' => config('services.wh.base_uri'),
        ]);

        $this->base_uri = 'api/jsonrpc';
        $this->id = config('services.wh.id');
    }

    public function send(string $method, array $params): array
    {
        try {
            $res = $this->client->request(self::METHOD_URI, $this->base_uri, [
                    RequestOptions::JSON => [
                        'jsonrpc' => self::JSON_RPC_VERSION,
                        'id' => $this->id,
                        'method' => $method,
                        'params' => $params
                    ]
            ]);
        } catch (RequestException $e) {
            dd($e->getMessage(), Psr7\str($e->getRequest()));
        }

        $content = $res->getBody()->getContents();

        return json_decode($content, true);
    }
}
