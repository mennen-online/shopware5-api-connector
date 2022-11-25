<?php

namespace MennenOnline\Shopware5ApiConnector;

use Illuminate\Support\Arr;
use MennenOnline\Shopware5ApiConnector\Enums\Model;
use GuzzleHttp\Promise\PromiseInterface;
use Illuminate\Http\Client\PendingRequest;
use Illuminate\Http\Client\Response;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use MennenOnline\LaravelResponseModels\Models\BaseModel;
use MennenOnline\Shopware5ApiConnector\Enums\EndpointEnum;
use MennenOnline\Shopware5ApiConnector\Exceptions\Connector\EmptyShopware5ResponseException;
use MennenOnline\Shopware5ApiConnector\Exceptions\Shopware5EndpointNotFoundException;
use MennenOnline\Shopware5ApiConnector\Endpoints\Endpoint;
use MennenOnline\Shopware5ApiConnector\Models\AuthResponseModel;
use MennenOnline\Shopware5ApiConnector\Models\BaseResponseModel;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

/**
 * @property PendingRequest $client
 * @property int|null $expires_in
 * @property string|null $token
 * @property BaseModel|null $responseModel
 * @property string|null $id
 * @property bool $auth = false
 * @property string|null $url
 * @property string|null $client_id
 * @property string|null $client_secret
 * @property EndpointEnum|null $endpoint
 *
 * @method Shopware5ApiConnector category(Shopware5ApiConnector|null $client = null, string|null $url = null, string|null $client_id = null, string|null $client_secret = null)
 * @method Shopware5ApiConnector customerGroup(Shopware5ApiConnector|null $client = null, string|null $url = null, string|null $client_id = null, string|null $client_secret = null)
 * @method Shopware5ApiConnector media(Shopware5ApiConnector|null $client = null, string|null $url = null, string|null $client_id = null, string|null $client_secret = null)
 * @method Shopware5ApiConnector product(Shopware5ApiConnector|null $client = null, string|null $url = null, string|null $client_id = null, string|null $client_secret = null)
 * @method Shopware5ApiConnector propertyGroup(Shopware5ApiConnector|null $client = null, string|null $url = null, string|null $client_id = null, string|null $client_secret = null)
 * @method Shopware5ApiConnector propertyGroupOption(Shopware5ApiConnector|null $client = null, string|null $url = null, string|null $client_id = null, string|null $client_secret = null)
 * @method Shopware5ApiConnector tax(Shopware5ApiConnector|null $client = null, string|null $url = null, string|null $client_id = null, string|null $client_secret = null)
 * @method Shopware5ApiConnector taxRule(Shopware5ApiConnector|null $client = null, string|null $url = null, string|null $client_id = null, string|null $client_secret = null)
 */

abstract class Shopware5ApiConnector
{
    protected const SHOPWARE6_CLIENT_ID = 'shopware6.client_id';

    protected const SHOPWARE6_CLIENT_SECRET = 'shopware6.client_secret';

    public function __construct(
        protected PendingRequest|null $client = null,
        protected int|null $expires_in = null,
        protected string|null $token = null,
        protected BaseModel|null $responseModel = null,
        protected string|null $id = null,
        protected bool $auth = false,
        protected string|null $url = null,
        protected string|null $client_id = null,
        protected string|null $client_secret = null,
        protected EndpointEnum|null $endpoint = null,
    ) {
        if($this->client === null) {
            $baseUrl = $this->url ?? config('shopware6.url');

            $this->client = Http::baseUrl($baseUrl.'/api')
                ->withToken(base64_encode($this->client_id.':'.$this->client_secret), 'Basic')
                ->acceptJson();
        }
    }

    public function getExpiresIn(): int|null {
        return $this->expires_in;
    }

    public function getToken(): string|null {
        return $this->token;
    }

    public function getClient(): PendingRequest {
        return $this->client;
    }

    public function __call(string $name, array $arguments): Shopware5ApiConnector|AuthResponseModel|BaseResponseModel {
        if(method_exists($this, $name)) {
            return $this->$name($arguments);
        }
        $instance = self::__callStatic($name, $arguments);
        if(!$instance) {
            throw new Shopware5EndpointNotFoundException("Shopware 5 Endpoint " . $name . " not available yet");
        }
        return new (get_class($instance)($this->client, $this->expires_in, $this->token));
    }

    public static function __callStatic(string $name, array $arguments): Shopware5ApiConnector|null {
        return new Endpoint(
            client       : Arr::get($arguments, 'client'),
            client_id    : Arr::get($arguments, 'client_id'),
            client_secret: Arr::get($arguments, 'client_secret'),
            endpoint     : $name
        );
    }

    private function logger(PromiseInterface|Response $response): BaseResponseModel|AuthResponseModel|null {
        $logData = [
            'status' => $response->status(),
            'response' => $response->object(),
        ];

        if($response->object() === null) {
            Log::warning("The Response was Empty", $logData);
            throw new EmptyShopware5ResponseException("The Response was Empty", $response->status());
        }

        if($response->successful()) {
            if(config('app.debug')) {
                Log::info("Shopware 5 API Call OK", $logData);
            }
        } else {
            Log::emergency("Shopware 5 API Call not OK", $logData);

            return match($response->status()) {
                404 => throw new NotFoundHttpException("The requested URL cannot be found"),
                default => $this->auth ? new AuthResponseModel() : new BaseResponseModel(Model::EMPTY)
            };
        }

        if($this->auth) {
            $this->auth = false;
            return new AuthResponseModel($response->object());
        }

        return new BaseResponseModel(
            model: $this->id !== null ? Model::SINGLE : Model::INDEX,
            attributes: $response->object(),
            mapClassForData: $this->responseModel
        );
    }

    private function buildUrl(EndpointEnum $endpoint, int|string|null $id = null): string {
        $string = str(EndpointEnum::convertEndpointToUrl($endpoint));

        $this->id = $id;

        if(!$id) {
            return $string->toString();
        }

        $string = $string->append('/'.$id);

        return is_string($id)
            ? $string->append('?useNumberAsId=true')->toString()
            : $string->toString();
    }

    protected function index(EndpointEnum $endpoint, int $limit = null): BaseResponseModel {
        $this->auth = false;

        if($limit === null) {
            $limitRequest = $this->client->get(str($this->buildUrl($endpoint))->append('?'.Arr::query(['limit' => $limit]))->toString());

            $limitResponse = $limitRequest->object();

            $limit = $limitResponse?->total;
        }
        return $this->logger(
            $this->client->get(str($this->buildUrl($endpoint))->append('?' . Arr::query(['limit' => $limit]))->toString())
        );
    }

    protected function get(EndpointEnum $endpoint, int|string $id): BaseResponseModel {
        $this->auth = false;

        $this->id = $id;

        return $this->logger(
            $this->client->get($this->buildUrl($endpoint, $id))
        );
    }

    protected function post(EndpointEnum $endpoint, array $data): BaseResponseModel|AuthResponseModel {
        return $this->logger(
            $this->client->post($this->buildUrl($endpoint), $data)
        );
    }
}