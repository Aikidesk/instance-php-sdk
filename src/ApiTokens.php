<?php
namespace Aikidesk\SDK\Instance;

use Aikidesk\SDK\Instance\Contracts\RequestInterface;

class ApiTokens
{
    /**
     * @var string
     */
    const BASE_URL = 'https://*.aikidesk.com/api';

    /**
     * @var string
     */
    const API_VERSION = 'oauth';

    /**
     * @var \Aikidesk\SDK\Instance\Contracts\RequestInterface|null
     */
    protected $request = null;

    /**
     * ApiTokens constructor.
     * @param \Aikidesk\SDK\Instance\Contracts\RequestInterface $request
     */
    public function __construct(RequestInterface $request)
    {
        $this->request = $request;
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
                throw new \Aikidesk\WWW\Exceptions\ForbiddenException($msg, $code, $url, $meta);
                break;
            case 404:
                throw new \Aikidesk\SDK\Instance\Exceptions\NotFoundException($msg, $code, $url, $meta);
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
     * @return \Aikidesk\SDK\Instance\Contracts\ResponseInterface
     */
    public function current()
    {
        return $this->request->get('test');
    }

    /**
     * @param string $oauthId
     * @param string $oauthSecret
     * @param array $scopes
     * @return \Aikidesk\SDK\Instance\Contracts\Resp
     */
    public function createClientCredentialsToken($oauthId, $oauthSecret, $scopes = [])
    {
        $postFormData = [
            'client_id' => $oauthId,
            'client_secret' => $oauthSecret,
            'grant_type' => 'client_credentials',
            'state' => 'PhEbakeb4azeqAtUPrewabuxUwruqahA',
            'scope' => implode(',', $scopes),
        ];

        return $this->request->post('oauth/client_credentials', $postFormData);
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
