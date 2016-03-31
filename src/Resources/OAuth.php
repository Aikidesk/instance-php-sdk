<?php
namespace Aikidesk\SDK\Instance\Resources;

use Aikidesk\SDK\Instance\Contracts\RequestInterface;

class OAuth
{

    /**
     * @var null|int
     */
    protected $oauthId = null;

    /**
     * @var \Aikidesk\SDK\Instance\Contracts\RequestInterface
     */
    private $request;

    /**
     * OAuth constructor.
     * @param int|null $oauthId
     * @param \Aikidesk\SDK\Instance\Contracts\RequestInterface $request
     */
    public function __construct($oauthId = null, RequestInterface $request)
    {
        $this->setOAuthId($oauthId);
        $this->request = $request;
    }

    /**
     * Scopes: role_owner, role_admin, www
     *
     * @param array $filter
     * @return \Aikidesk\SDK\Instance\Contracts\ResponseInterface
     */
    public function all($filter = [])
    {
        $input = [];

        if (isset($filter['page'])) {
            $input['page'] = $filter['page'];
        }

        if (isset($filter['with'])) {
            $input['with'] = $filter['with'];
        }

        return $this->request->get('oauth', $input);
    }

    /**
     * Scopes: role_owner, role_admin, www
     *
     * @param string $name
     * @param array $optional
     * @return \Aikidesk\SDK\Instance\Contracts\ResponseInterface
     */
    public function create($name, $optional = [])
    {
        $input = [];
        $input['name'] = $name;

        return $this->request->post('oauth', $input);
    }

    /**
     * Scopes: role_owner, role_admin, www
     *
     * @param array $optional
     * @return \Aikidesk\SDK\Instance\Contracts\ResponseInterface
     */
    public function get($optional = [])
    {
        $oauthId = $this->getOAuthId();
        $input = [];
        if (isset($optional['with'])) {
            $input['with'] = $optional['with'];
        }

        return $this->request->get(sprintf('oauth/%1d', $oauthId), $input);
    }

    /**
     * @return int|null
     */
    public function getOAuthId()
    {
        return $this->oauthId;
    }

    /**
     * @param int|null $id
     * @return $this
     */
    public function setOAuthId($id)
    {
        $this->oauthId = $id;

        return $this;
    }

    /**
     * Scopes: role_owner, role_admin, www
     *
     * @return \Aikidesk\SDK\Instance\Contracts\ResponseInterface
     */
    public function delete()
    {
        $oauthId = $this->getOAuthId();
        $input = [];

        return $this->request->delete(sprintf('oauth/%1d', $oauthId), $input);
    }
}
