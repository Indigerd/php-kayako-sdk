<?php
/**
 * @author Alexander Stepanenko <alex.stepanenko@gmail.com>
 */

namespace indigerd\kayako;

use GuzzleHttp\Client;
use Psr\Log\LoggerInterface;

class ServiceFactory
{
    protected $services = [
        'user'         => 'indigerd\kayako\services\User',
        'ticket'       => 'indigerd\kayako\services\Ticket',
        'department'   => 'indigerd\kayako\services\Department',
        'custom-field' => 'indigerd\kayako\services\CustomField',
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
        $secretKey,
        $services = []
    ) {
        $this->client = $client;
        $this->logger = $logger;
        $this->kayakoAddress = $kayakoAddress;
        $this->apiKey = $apiKey;
        $this->secretKey = $secretKey;
        $this->services = array_merge($this->services, $services);
    }

    public function get($service, $params = [])
    {
        if (!array_key_exists($service, $this->services)) {
            throw new \InvalidArgumentException(sprintf('The service "%s" is not available.', $service));
        }
        $class = $this->services[$service];
        $args = [$this->client, $this->logger, $this->kayakoAddress, $this->apiKey, $this->secretKey];
        foreach ($params as $param) {
            $args[] = $param;
        }
        return new $class(...$args);
    }
}
