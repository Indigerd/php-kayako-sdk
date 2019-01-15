<?php
/**
 * @author Alexander Stepanenko <alex.stepanenko@gmail.com>
 */

namespace indigerd\kayako\services;

use GuzzleHttp\Client;
use Psr\Log\LoggerInterface;
use Psr\Log\NullLogger;
use indigerd\kayako\exceptions\ServerException;
use indigerd\kayako\exceptions\ClientException;
use indigerd\kayako\models\Model;

abstract class BaseService
{
    /** @var Client  */
    protected $client;

    /** @var LoggerInterface  */
    protected $logger;

    protected $kayakoAddress;

    protected $apiKey;

    protected $secretKey;

    public function __construct(
        Client $client = null,
        LoggerInterface $logger = null,
        $kayakoAddress,
        $apiKey,
        $secretKey
    ) {
        $this->client = $client ?: new Client();
        $this->logger = $logger ?: new NullLogger();
        $this->kayakoAddress = $kayakoAddress;
        $this->apiKey = $apiKey;
        $this->secretKey = $secretKey;
    }

    protected function get($path, $params = [])
    {
        return $this->request('get', $path, $params);
    }

    protected function post($path, $params = [])
    {
        return $this->request('post', $path, $params);
    }

    protected function put($path, $params = [])
    {
        return $this->request('put', $path, $params);
    }

    protected function delete($path, $params = [])
    {
        return $this->request('delete', $path, $params);
    }

    protected function request($method, $path, $params, $decode = false)
    {
        $requestParams['query'] = ['e' => $path];
        $params = array_merge($params, $this->getUrlSignParams());
        if (in_array($method, ['post', 'put'])) {
            $requestParams['headers']['Content-Type'] = 'application/x-www-form-urlencoded';
            $requestParams['body'] = http_build_query($params, '', '&');
        } else {
            $requestParams['query'] = array_merge($requestParams['query'], $params);
        }
        try {
            /** @var \GuzzleHttp\Message\ResponseInterface $request */
            //echo $this->kayakoAddress;
            //print_r($requestParams);exit;
            $request = $this->client->{$method}($this->kayakoAddress, $requestParams);
        } catch (\Exception $e) {

            $message = sprintf('Failed to to perform request to kayako (%s).', $e->getMessage());
            $this->logger->error($message);
            throw new ServerException($message);
        }

        $this->logger->debug(sprintf("Response:\n%s", $request->getBody()));
        if (400 <= $request->getStatusCode()) {
            $message = sprintf('Kayako responded with error (%s - %s).', $request->getStatusCode(), $request->getReasonPhrase());
            $this->logger->error($message);
            $message .= "\n" . $request->getBody();
            if (500 <= $request->getStatusCode()) {
                throw new ServerException($message);
            }
            throw new ClientException($message);
        }
        $data = (string)$request->getBody();
        if ($decode) {
            libxml_use_internal_errors(true);
            $data = simplexml_load_string($request->getBody());
        }
        return $data;
    }

    protected function parseResponse($response, $modelClas, $singleResult = true)
    {
        libxml_use_internal_errors(true);
        $xml = simplexml_load_string($response);
        $result = [];
        foreach ($xml as $child) {
            /** @var Model $modelClas */
            $result[] = $modelClas::fromXml($child);
        }
        if (sizeof($result) == 1 and $singleResult) {
            $result = $result[0];
        }
        return $result;
    }

    protected function getUrlSignParams()
    {
        $salt = mt_rand();
        $signature = hash_hmac('sha256', $salt, $this->secretKey, true);
        $encodedSignature = base64_encode($signature);
        return [
            'apikey'    => $this->apiKey,
            'salt'      => $salt,
            'signature' => $encodedSignature
        ];
    }
}
