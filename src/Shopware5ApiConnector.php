<?php

namespace MennenOnline\Shopware5ApiConnector;

use GuzzleHttp\Promise\PromiseInterface;
use Illuminate\Http\Client\PendingRequest;
use Illuminate\Http\Client\Response;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use MennenOnline\LaravelResponseModels\Models\BaseModel;
use MennenOnline\Shopware5ApiConnector\Endpoints\Endpoint;
use MennenOnline\Shopware5ApiConnector\Enums\EndpointEnum;
use MennenOnline\Shopware5ApiConnector\Enums\Model;
use MennenOnline\Shopware5ApiConnector\Exceptions\Connector\EmptyShopware5ResponseException;
use MennenOnline\Shopware5ApiConnector\Exceptions\NoShopware5CredentialsProvidedException;
use MennenOnline\Shopware5ApiConnector\Exceptions\Shopware5EndpointNotFoundException;
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
 * @property string|null $username
 * @property string|null $password
 * @property EndpointEnum|null $endpoint
 *
 * @method Shopware5ApiConnector addresses(Shopware5ApiConnector|null $client = null, string|null $url = null, string|null $username = null, string|null $password = null)
 * @method Shopware5ApiConnector articles(Shopware5ApiConnector|null $client = null, string|null $url = null, string|null $username = null, string|null $password = null)
 * @method Shopware5ApiConnector cache(Shopware5ApiConnector|null $client = null, string|null $url = null, string|null $username = null, string|null $password = null)
 * @method Shopware5ApiConnector categories(Shopware5ApiConnector|null $client = null, string|null $url = null, string|null $username = null, string|null $password = null)
 * @method Shopware5ApiConnector countries(Shopware5ApiConnector|null $client = null, string|null $url = null, string|null $username = null, string|null $password = null)
 * @method Shopware5ApiConnector customerGroup(Shopware5ApiConnector|null $client = null, string|null $url = null, string|null $username = null, string|null $password = null)
 * @method Shopware5ApiConnector generateArticleImages(Shopware5ApiConnector|null $client = null, string|null $url = null, string|null $username = null, string|null $password = null)
 * @method Shopware5ApiConnector manufacturers(Shopware5ApiConnector|null $client = null, string|null $url = null, string|null $username = null, string|null $password = null)
 * @method Shopware5ApiConnector media(Shopware5ApiConnector|null $client = null, string|null $url = null, string|null $username = null, string|null $password = null)
 * @method Shopware5ApiConnector orders(Shopware5ApiConnector|null $client = null, string|null $url = null, string|null $username = null, string|null $password = null)
 * @method Shopware5ApiConnector paymentMethods(Shopware5ApiConnector|null $client = null, string|null $url = null, string|null $username = null, string|null $password = null)
 * @method Shopware5ApiConnector propertyGroups(Shopware5ApiConnector|null $client = null, string|null $url = null, string|null $username = null, string|null $password = null)
 * @method Shopware5ApiConnector shops(Shopware5ApiConnector|null $client = null, string|null $url = null, string|null $username = null, string|null $password = null)
 * @method Shopware5ApiConnector translations(Shopware5ApiConnector|null $client = null, string|null $url = null, string|null $username = null, string|null $password = null)
 * @method Shopware5ApiConnector users(Shopware5ApiConnector|null $client = null, string|null $url = null, string|null $username = null, string|null $password = null)
 * @method Shopware5ApiConnector version(Shopware5ApiConnector|null $client = null, string|null $url = null, string|null $username = null, string|null $password = null)
 * @method Shopware5ApiConnector product(Shopware5ApiConnector|null $client = null, string|null $url = null, string|null $username = null, string|null $password = null)
 * @method Shopware5ApiConnector propertyGroup(Shopware5ApiConnector|null $client = null, string|null $url = null, string|null $username = null, string|null $password = null)
 * @method Shopware5ApiConnector propertyGroupOption(Shopware5ApiConnector|null $client = null, string|null $url = null, string|null $username = null, string|null $password = null)
 * @method Shopware5ApiConnector tax(Shopware5ApiConnector|null $client = null, string|null $url = null, string|null $username = null, string|null $password = null)
 * @method Shopware5ApiConnector taxRule(Shopware5ApiConnector|null $client = null, string|null $url = null, string|null $username = null, string|null $password = null)
 */
abstract class Shopware5ApiConnector
{
    protected const SHOPWARE5_USERNAME = 'shopware5.username';

    protected const SHOPWARE5_PASSWORD = 'shopware5.password';

    /**
     * @throws NoShopware5CredentialsProvidedException
     */
    public function __construct(
        protected PendingRequest|null $client = null,
        protected int|null $expires_in = null,
        protected string|null $token = null,
        protected string|null $id = null,
        protected bool $auth = false,
        protected string|null $url = null,
        protected string|null $username = null,
        protected string|null $password = null,
        protected EndpointEnum|null $endpoint = null,
        protected bool $initializeLater = false,
    ) {
        if ($this->client === null && ! $this->initializeLater) {
            $this->initialize($url, $username, $password);
        }
    }

    public function initialize(string|null $url = null, string|null $username = null, string|null $password = null): self
    {
        if ($url) {
            $this->url = $url;
        } else {
            $this->url = config('shopware5.url');
        }

        if ($username) {
            $this->username = $username;
        }

        if ($password) {
            $this->password = $password;
        }

        $baseUrl = $this->url;

        if (
            ! $this->username || ! $this->password
        ) {
            throw new NoShopware5CredentialsProvidedException('Username or Password missing');
        }

        $this->client = Http::baseUrl($baseUrl.'/api')
            ->timeout(0)
            ->withToken(base64_encode($this->username.':'.$this->password), 'Basic')
            ->acceptJson();

        return $this;
    }

    public function getEndpoint(): EndpointEnum|null
    {
        return $this->endpoint;
    }

    public function getClient(): PendingRequest
    {
        return $this->client;
    }

    public function __call(string $name, array $arguments): Shopware5ApiConnector|AuthResponseModel|BaseResponseModel
    {
        if (method_exists($this, $name)) {
            return $this->$name($arguments);
        }

        $instance = self::__callStatic($name, $arguments);

        return new (get_class($instance)($this->client, $this->expires_in, $this->token));
    }

    public static function __callStatic(string $name, array $arguments): Shopware5ApiConnector|null
    {
        return new Endpoint(
            client       : Arr::get($arguments, 'client'),
            username    : Arr::get($arguments, 'username'),
            password: Arr::get($arguments, 'password'),
            endpoint     : $name
        );
    }

    private function logger(PromiseInterface|Response $response): BaseResponseModel|AuthResponseModel|null
    {
        $logData = [
            'status' => $response->status(),
            'response' => $response->object(),
        ];

        if ($response->object() === null) {
            Log::warning('The Response was Empty', $logData);
            throw new EmptyShopware5ResponseException('The Response was Empty', $response->status());
        }

        if ($response->successful()) {
            if (config('app.debug')) {
                Log::info('Shopware 5 API Call OK', $logData);
            }
        } else {
            Log::emergency('Shopware 5 API Call not OK', $logData);

            return match ($response->status()) {
                404 => throw new NotFoundHttpException('The requested URL cannot be found'),
                default => $this->auth ? new AuthResponseModel() : new BaseResponseModel(Model::EMPTY)
            };
        }

        if ($this->auth) {
            $this->auth = false;

            return new AuthResponseModel($response->object());
        }

        return new BaseResponseModel(
            model: $this->id !== null ? Model::SINGLE : Model::INDEX,
            attributes: $response->object(),
            mapClassForData: EndpointEnum::getModelForEndpoint($this->endpoint, $this->id !== null ? Model::SINGLE : Model::INDEX)
        );
    }

    private function buildUrl(EndpointEnum $endpoint, int|string|null $id = null): string
    {
        $string = str(EndpointEnum::convertEndpointToUrl($endpoint));

        $this->id = $id;

        if (! $id) {
            return $string->toString();
        }

        return $string->append('/'.$id)->toString();
    }

    protected function index(EndpointEnum $endpoint, int $limit = null): BaseResponseModel
    {
        $this->auth = false;

        if ($limit === null) {
            $limitRequest = $this->client->get(str($this->buildUrl($endpoint))->append('?'.Arr::query(['limit' => $limit]))->toString());

            $limitResponse = $limitRequest->object();

            if(is_object($limitResponse) && property_exists($limitResponse, 'total')) {
                $limit = $limitResponse?->total;
            }
        }

        $url = str($this->buildUrl($endpoint));

        if($limit) {
            $url = $url->append('?'.Arr::query(['limit' => $limit]));
        }

        return $this->logger(
            $this->client->get($url->toString())
        );
    }

    protected function get(EndpointEnum $endpoint, int|string $id): BaseResponseModel
    {
        $this->auth = false;

        $this->id = $id;

        return $this->logger(
            $this->client->get($this->buildUrl($endpoint, $id))
        );
    }

    protected function post(EndpointEnum $endpoint, array $data): BaseResponseModel|AuthResponseModel
    {
        return $this->logger(
            $this->client->post($this->buildUrl($endpoint), $data)
        );
    }
}
