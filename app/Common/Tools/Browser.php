<?php

declare(strict_types=1);

namespace Common\Tools;

use DOMDocument;
use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Response;
use GuzzleHttp\TransferStats;
use Psr\Http\Message\ResponseInterface;

class Browser
{
    /**
     * @var Client
     */
    protected $client;

    /**
     * @var string
     */
    protected $method = 'GET';

    /**
     * @var array
     */
    protected $headers;

    /**
     * @var array
     */
    protected $authorization;

    /**
     * @var array
     */
    protected $params;

    /**
     * @var Response
     */
    protected $response;

    /**
     * @var TransferStats
     */
    protected $stats;

    /**
     * @var DOMDocument
     */
    protected $dom;

    /**
     * @var array
     */
    protected $json;

    public function __construct(string $baseUri = '')
    {
        $this->client = new Client([
            'base_uri' => $baseUri,
            'cookies' => true
        ]);
    }

    public function getStats()
    {
        return $this->stats;
    }

    public function setAuthorization(string $authorization): void
    {
        $this->authorization = $authorization;

        $this->headers['Authorization'] = $this->authorization;
    }

    public function setParams(array $params): Browser
    {
        $this->params = $params;

        return $this;
    }

    public function setHeaders(array $headers): void
    {
        $this->headers = $headers;
    }

    public function setJson(array $json): void
    {
        $this->json = $json;
    }

    public function getParams(): ?array
    {
        return $this->params;
    }

    public function getHeaders(): ?array
    {
        return $this->headers;
    }

    public function go(string $uri = '/', bool $debug = false)
    {
        $requestOptions = [
            'debug' => $debug,
            'form_params' => $this->params,
            'on_stats' => function (TransferStats $stats): void {
                $this->stats = $stats;
            },
            'allow_redirects' => [
                'max' => 10
            ]
        ];

        if ($this->json !== null) {
            $requestOptions['json'] = $this->json;
        }

        if ($this->headers !== null) {
            $requestOptions['headers'] = $this->headers;
        }

        $response = $this->client->request($this->method, $uri, $requestOptions);

        $this->parseResponse($response);

        $this->clear();

        return $this->getJsonResponse();
    }

    public function getStatusCode(): int
    {
        return $this->response->getStatusCode();
    }

    public function getJsonResponse()
    {
        return json_decode($this->getResponse());
    }

    public function getResponse()
    {
        return (string) $this->response->getBody();
    }

    public function getAttributeValueByName(string $tag, string $name)
    {
        $nodes = $this->dom->getElementsByTagName($tag);
        if ($nodes->length !== 0) {
            foreach ($nodes as $node) {
                if ($node->getAttribute('name') === $name) {
                    return $node->getAttribute('value');
                }
            }
        }

        return null;
    }

    public function clear(): void
    {
        $this->params = null;
        $this->json = null;

        $this->headers = $this->getDefaultHeaders();
    }

    public function setMethod(string $method): Browser
    {
        $this->method = $method;

        return $this;
    }

    public function getCookie(string $name): string
    {
        $cookieJar = $this->client->getConfig('cookies');

        $cookie = $cookieJar->getCookieByName($name);

        return $cookie->getValue();
    }

    public function getDefaultHeaders()
    {
        $headers = [
            'user-agent' => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko)' .
                ' Chrome/83.0.4103.116 Safari/537.36'
        ];

        if ($this->authorization !== null) {
            $headers['Authorization'] = $this->authorization;
        }

        return $headers;
    }

    protected function parseResponse(ResponseInterface $response): Browser
    {
        $this->response = $response;

        $this->dom = new DOMDocument();

        $responseBody = $this->getResponse();

        if (!empty($responseBody)) {
            libxml_use_internal_errors(true);
            $this->dom->loadHTML($responseBody);
            libxml_use_internal_errors(false);
        }

        $this->response = $response;

        return $this;
    }
}
