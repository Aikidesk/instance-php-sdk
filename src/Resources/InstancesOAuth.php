<?php
namespace Aikidesk\SDK\Instance\Resources;

use Aikidesk\SDK\Instance\Contracts\RequestInterface;

/**
 * Class InstancesOAuth
 */
class InstancesOAuth
{

    /**
     * @var null|int
     */
    protected $instanceId = null;

    /**
     * @var null|int
     */
    protected $oauthId = null;

    /**
     * @var \Aikidesk\SDK\Instance\Contracts\RequestInterface
     */
    private $request;

    /**
     * Users constructor.
     * @param int|null $instanceId
     * @param int|null $oauthId
     * @param \Aikidesk\SDK\Instance\Contracts\RequestInterface $request
     */
    public function __construct($instanceId = null, $oauthId = null, RequestInterface $request)
    {
        $this->setInstanceId($instanceId);
        $this->setOAuthId($oauthId);
        $this->request = $request;
    }

    /**
     * Scopes Instance: instance_get_own, instance_get_all
     * Scopes Instance OAuth: instance_oauth_get_own, instance_oauth_get_all
     *
     * @param array $filter
     * @return \Aikidesk\SDK\Instance\Contracts\ResponseInterface
     */
    public function all($filter = [])
    {
        $instance_id = $this->getInstanceId();
        $input = [];

        if (isset($filter['page'])) {
            $input['page'] = $filter['page'];
        }

        if (isset($filter['with'])) {
            $input['with'] = $filter['with'];
        }

        return $this->request->get(sprintf('instance/%1s/oauth', $instance_id), $input);
    }

    /**
     * @return int|null
     */
    public function getInstanceId()
    {
        return $this->instanceId;
    }

    /**
     * @param int|null $id
     * @return $this
     */
    public function setInstanceId($id)
    {
        $this->instanceId = $id;

        return $this;
    }

    /**
     * Scopes: instance_create
     *
     * @param string $name
     * @param array $optional
     * @return \Aikidesk\SDK\Instance\Contracts\ResponseInterface
     */
    public function create($name, $optional = [])
    {
        $instance_id = $this->getInstanceId();
        $input = [];
        $input['name'] = $name;

        return $this->request->post(sprintf('instance/%1s/oauth', $instance_id), $input);
    }

    /**
     * Scopes Instance: instance_get_own, instance_get_all
     * Scopes Instance OAuth: instance_oauth_get_own, instance_oauth_get_all
     *
     * @return \Aikidesk\SDK\Instance\Contracts\ResponseInterface
     */
    public function get()
    {
        $instance_id = $this->getInstanceId();
        $oauth_id = $this->getOAuthId();
        $input = [];

        return $this->request->get(sprintf('instance/%1s/oauth/%2s', $instance_id, $oauth_id), $input);
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
     * Scopes: instance_archive_own, instance_archive_all
     *
     * @return \Aikidesk\SDK\Instance\Contracts\ResponseInterface
     */
    public function delete()
    {
        $instance_id = $this->getInstanceId();
        $oauth_id = $this->getOAuthId();
        $input = [];

        return $this->request->delete(sprintf('instance/%1s/oauth/%2s', $instance_id, $oauth_id), $input);
    }
}