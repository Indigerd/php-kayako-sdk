<?php
/**
 * @author Alexander Stepanenko <alex.stepanenko@gmail.com>
 */

namespace indigerd\kayako;

use GuzzleHttp\Client;
use Psr\Log\LoggerInterface;

class ServiceFactory
{
    protected static $services = [
        'user'       => 'indigerd\kayako\services\User',
        'ticket'     => 'indigerd\kayako\services\Ticket',
        'department' => 'indigerd\kayako\services\Department',
    ];

    /** @var Client  */
    private $client;

    /** @var LoggerInterface  */
    private $logger;

    private $kayakoAddress;

    private $apiKey;

    private $secretKey;

    public function __construct(
        Client $client = null,
        LoggerInterface $logger = null,
        $kayakoAddress,
        $apiKey,
        $secretKey
    ) {
        $this->client = $client;
        $this->logger = $logger;
        $this->kayakoAddress = $kayakoAddress;
        $this->apiKey = $apiKey;
        $this->secretKey = $secretKey;
    }

    public function get($service, $params = [])
    {
        if (!array_key_exists($service, static::$services)) {
            throw new \InvalidArgumentException(sprintf('The service "%s" is not available.', $service));
        }
        $class = static::$services[$service]['class'];
        $args = [$this->client, $this->logger, $this->kayakoAddress, $this->apiKey, $this->secretKey];
        foreach ($params as $param) {
            $args[] = $param;
        }
        return new $class(...$args);
    }
}
