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
use indigerd\kayako\models\ModelInterface;

abstract class BaseService
{
    /** @var Client  */
    protected $client;

    /** @var LoggerInterface  */
    protected $logger;

    protected $kayakoAddress;

    protected $modelClas;

    protected $collectionTag;

    public function __construct(
        Client $client = null,
        LoggerInterface $logger = null,
        $kayakoAddress = null
    ) {
        if (empty($this->modelClas)) {
            throw new \InvalidArgumentException('Model class not set');
        }
        if (empty($this->collectionTag)) {
            throw new \InvalidArgumentException('Collection tag not set');
        }
        $this->client = $client ?: new Client();
        $this->logger = $logger ?: new NullLogger();
        $this->kayakoAddress = $kayakoAddress;
    }

    protected function get($url, $params = [])
    {
        return $this->request('get', $url, $params);
    }

    protected function post($url, $params = [])
    {
        return $this->request('post', $url, $params);
    }

    protected function put($url, $params = [])
    {
        return $this->request('put', $url, $params);
    }

    protected function delete($url, $params = [])
    {
        return $this->request('delete', $url, $params);
    }

    protected function request($method, $url, $params, $decode = false)
    {
        $url = $this->kayakoAddress . $url;
        try {
            /** @var \GuzzleHttp\Message\ResponseInterface $request */
            $request = $this->client->{$method}($url, $params);
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

        $data = $request->getBody();
        if ($decode) {
            libxml_use_internal_errors(true);
            $data = simplexml_load_string($request->getBody());
        }
        return $data;
    }

    protected function parseResponse($response)
    {
        libxml_use_internal_errors(true);
        $xml = simplexml_load_string($response);
        $result = [];
        foreach ($xml->{$this->collectionTag} as $child) {
            /** @var ModelInterface $class */
            $class = $this->modelClas;
            $result[] = $class::fromXml($child);
        }
        return $result;
    }
}
