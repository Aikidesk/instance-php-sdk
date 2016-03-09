<?php
namespace Aikidesk\SDK\Instance;

use Aikidesk\SDK\Instance\Contracts\RequestInterface;

class Api
{
    /**
     * @var string
     */
    const BASE_URL = 'https://*.aikidesk.com/api';
    /**
     * @var string
     */
    const API_VERSION = '1.0';

    /**
     * @var \Aikidesk\SDK\Instance\Contracts\RequestInterface|null
     */
    protected $request = null;

    /**
     * @var \Aikidesk\SDK\Instance\Resources\OAuth
     */
    private $oauthResources;

    /**
     * @var \Aikidesk\SDK\Instance\Resources\Customers
     */
    private $customersResources;

    /**
     * @var \Aikidesk\SDK\Instance\Resources\Staff
     */
    private $staffResources;

    /**
     * @var \Aikidesk\SDK\Instance\Resources\Departments
     */
    private $departmentsResources;

    /**
     * @var \Aikidesk\SDK\Instance\Resources\Stats
     */
    private $statsResources;

    /**
     * @var \Aikidesk\SDK\Instance\Resources\Settings
     */
    private $settingsResources;

    /**
     * Api constructor.
     * @param \Aikidesk\SDK\Instance\Contracts\RequestInterface $request
     * @param null $customersResources
     * @param null $staffResources
     * @param null $departmentsResources
     * @param null $statsResources
     * @param null $settingsResources
     */
    public function __construct(
        RequestInterface $request,
        $customersResources = null,
        $staffResources = null,
        $departmentsResources = null,
        $statsResources = null,
        $settingsResources = null
    ) {
        $this->request = $request;
        $this->customersResources = $customersResources ?: new \Aikidesk\SDK\Instance\Resources\Customers(null, null,
            null,
            $this->request);
        $this->staffResources = $staffResources ?: new \Aikidesk\SDK\Instance\Resources\Staff(null, $this->request);
        $this->settingsResources = $settingsResources ?: new \Aikidesk\SDK\Instance\Resources\Settings($this->request);
        $this->departmentsResources = $departmentsResources ?: new \Aikidesk\SDK\Instance\Resources\Departments(null,
            $this->request);
        $this->statsResources = $statsResources ?: new \Aikidesk\SDK\Instance\Resources\Stats($this->request);
    }

    /**
     * @param int $code
     * @param string $msg
     * @param string $url
     * @param array $meta
     * @throws \Aikidesk\SDK\Instance\Exceptions\ApiException
     * @throws \Aikidesk\SDK\Instance\Exceptions\BadRequestException
     * @throws \Aikidesk\SDK\Instance\Exceptions\ForbiddenException
     * @throws \Aikidesk\SDK\Instance\Exceptions\InternalServerErrorException
     * @throws \Aikidesk\SDK\Instance\Exceptions\NotFoundException
     * @throws \Aikidesk\SDK\Instance\Exceptions\ServerValidationException
     * @throws \Aikidesk\SDK\Instance\Exceptions\ServerUnavailableException
     * @throws \Aikidesk\SDK\Instance\Exceptions\UnauthorizedException
     */
    public static function throwException($code, $msg, $url = '', $meta = [])
    {
        switch ($code) {
            case 400:
                throw new \Aikidesk\SDK\Instance\Exceptions\BadRequestException($msg, $code, $url, $meta);
                break;
            case 401:
                throw new \Aikidesk\SDK\Instance\Exceptions\UnauthorizedException($msg, $code, $url, $meta);
                break;
            case 403:
                throw new \Aikidesk\SDK\Instance\Exceptions\ForbiddenException($msg, $code, $url, $meta);
                break;
            case 404:
                throw new \Aikidesk\SDK\Instance\Exceptions\NotFoundException($msg, $code, $url, $meta);
                break;
            case 422:
                throw new \Aikidesk\SDK\Instance\Exceptions\ServerValidationException($msg, $code, $url, $meta);
                break;
            case 500:
                throw new \Aikidesk\SDK\Instance\Exceptions\InternalServerErrorException($msg, $code, $url, $meta);
                break;
            case 503:
                throw new \Aikidesk\SDK\Instance\Exceptions\ServerUnavailableException($msg, $code, $url, $meta);
                break;
            default:
                throw new \Aikidesk\SDK\Instance\Exceptions\ApiException($msg, $code, $url, $meta);
        }
    }

    /**
     * @return \Aikidesk\SDK\Instance\Resources\Settings
     */
    public function setting()
    {
        return $this->settingsResources;
    }

    /**
     * @param int|null $customerId
     * @return \Aikidesk\SDK\Instance\Resources\Customers
     */
    public function customer($customerId = null)
    {
        $this->customersResources->setId($customerId);

        return $this->customersResources;
    }

    /**
     * @param int|null $departmentId
     * @return \Aikidesk\SDK\Instance\Resources\Departments
     */
    public function department($departmentId = null)
    {
        $this->departmentsResources->setId($departmentId);

        return $this->departmentsResources;
    }

    /**
     * @param int|null $staffId
     * @return \Aikidesk\SDK\Instance\Resources\Staff
     */
    public function staff($staffId = null)
    {
        $this->staffResources->setId($staffId);

        return $this->staffResources;
    }

    /**
     * @return \Aikidesk\SDK\Instance\Resources\Stats
     */
    public function stats()
    {
        return $this->statsResources;
    }

    /**
     * @param string $access_token
     */
    public function setAccessToken($access_token)
    {
        $this->request->setAccessToken($access_token);
    }

    /**
     * @return string
     */
    public function getAccessToken()
    {
        return $this->request->getAccessToken();
    }
}
