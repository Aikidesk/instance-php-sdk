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
     * @var \Aikidesk\SDK\Instance\Resources\Users
     */
    private $usersResources;

    /**
     * @var \Aikidesk\SDK\Instance\Resources\Instances
     */
    private $instancesResources;

    /**
     * Api constructor.
     * @param \Aikidesk\SDK\Instance\Contracts\RequestInterface $request
     * @param null $oauthResources
     * @param null $usersResources
     * @param null $instancesResources
     */
    public function __construct(
        RequestInterface $request,
        $oauthResources = null,
        $usersResources = null,
        $instancesResources = null
    ) {
        $this->request = $request;
        $this->oauthResources = $oauthResources ?: new \Aikidesk\SDK\Instance\Resources\OAuth($this->request);
        $this->usersResources = $usersResources ?: new \Aikidesk\SDK\Instance\Resources\Users(null, $this->request);
        $this->instancesResources = $instancesResources ?: new \Aikidesk\SDK\Instance\Resources\Instances(null, null, $this->request);
//        $this->sessionResources = $sessionResources ?: new \Aikidesk\SDK\Instance\Resources\Sessions(null, $this->request);
//        $this->roomResources = $roomResources ?: new \Aikidesk\SDK\Instance\Resources\Rooms(null, $this->request);
//        $this->userResources = $userResources ?: new \Aikidesk\SDK\Instance\Resources\Users(null, $this->request);
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
     * @return \Aikidesk\SDK\Instance\Resources\OAuth
     */
    public function oauth()
    {
        return $this->oauthResources;
    }

    /**
     * @param int|null $userId
     * @return \Aikidesk\SDK\Instance\Resources\Users
     */
    public function users($userId = null)
    {
        $this->usersResources->setId($userId);

        return $this->usersResources;
    }

    /**
     * @param int|null $instanceId
     * @return \Aikidesk\SDK\Instance\Resources\Instances
     */
    public function instances($instanceId = null)
    {
        $this->instancesResources->setId($instanceId);

        return $this->instancesResources;
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
