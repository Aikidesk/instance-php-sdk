<?php
namespace Aikidesk\SDK\Instance\Resources;

use Aikidesk\SDK\Instance\Contracts\RequestInterface;

/**
 * Class Users
 */
class Staff
{

    /**
     * @var null|int
     */
    protected $id = null;

    /**
     * @var \Aikidesk\SDK\Instance\Contracts\RequestInterface
     */
    private $request;

    /**
     * Users constructor.
     * @param int|null $userId
     * @param \Aikidesk\SDK\Instance\Contracts\RequestInterface $request
     */
    public function __construct($userId = null, RequestInterface $request)
    {
        $this->setId($userId);
        $this->request = $request;
    }

    /**
     * Scopes: role_owner, role_admin
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

        if (isset($filter['keyword'])) {
            $input['keyword'] = $filter['keyword'];
        }

        if (isset($filter['archived'])) {
            $input['archived'] = $filter['archived'];
        }

        if (isset($filter['role'])) {
            $input['role'] = $filter['role'];
        }

        if (isset($filter['departments'])) {
            $input['departments'] = $filter['departments'];
        }

        if (isset($filter['tags'])) {
            $input['tags'] = $filter['tags'];
        }

        if (isset($filter['created_at'])) {
            $input['created_at'] = $filter['created_at'];
        }

        if (isset($filter['sort'])) {
            $input['sort'] = $filter['sort'];
        }

        if (isset($filter['with'])) {
            $input['with'] = $filter['with'];
        }

        return $this->request->get('staff', $input);
    }

    /**
     * Scopes: role_owner, role_admin
     * Roles: 10, 20
     *
     * @param string $name
     * @param string $email
     * @param int $role
     * @param array $optional
     * @return \Aikidesk\SDK\Instance\Contracts\ResponseInterface
     */
    public function invite($name, $email, $role, $optional = [])
    {
        $input = [];
        $input['name'] = $name;
        $input['email'] = $email;
        $input['role'] = $role;

        if (isset($optional['departments'])) {
            $input['departments'] = $optional['departments'];
        }

        if (isset($optional['departments_add_public'])) {
            $input['departments_add_public'] = $optional['departments_add_public'];
        }

        if (isset($optional['departments_add_private'])) {
            $input['departments_add_private'] = $optional['departments_add_private'];
        }

        return $this->request->post('staff', $input);
    }

    /**
     * Scopes: role_owner, role_admin
     *
     * @param array $optional
     * @return \Aikidesk\SDK\Instance\Contracts\ResponseInterface
     */
    public function get($optional = [])
    {
        $staffId = $this->getId();
        $input = [];
        if (isset($optional['with'])) {
            $input['with'] = $optional['with'];
        }

        return $this->request->get(sprintf('staff/%1d', $staffId), $input);
    }

    /**
     * @return int|null
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int|null $id
     * @return $this
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Scopes: role_owner, role_admin
     *
     * @return \Aikidesk\SDK\Instance\Contracts\ResponseInterface
     */
    public function archive()
    {
        $staffId = $this->getId();
        $input = [];
        $input['archive'] = true;

        return $this->request->put(sprintf('staff/%1d/archive', $staffId), $input);
    }

    /**
     * Scopes: role_owner, role_admin
     *
     * @return \Aikidesk\SDK\Instance\Contracts\ResponseInterface
     */
    public function unarchive()
    {
        $staffId = $this->getId();
        $input = [];
        $input['archive'] = false;

        return $this->request->put(sprintf('staff/%1d/archive', $staffId), $input);
    }

    /**
     * Scopes: role_owner, role_admin
     *
     * @param array $tags
     * @return \Aikidesk\SDK\Instance\Contracts\ResponseInterface
     */
    public function syncTags($tags = [])
    {
        $staffId = $this->getId();
        $input = [];
        $input['tags'] = false;

        return $this->request->put(sprintf('staff/%1d/tags', $staffId), $input);
    }

    /**
     * Scopes: role_owner, role_admin
     *
     * @param string $action
     * @param array $ids
     * @param array $data
     * @return \Aikidesk\SDK\Instance\Contracts\ResponseInterface
     */
    public function mass($action, $ids, $data = [])
    {
        $input = [];
        $input['action'] = $action;
        $input['ids'] = $ids;
        $input['data'] = [];

        if (isset($data['tags_add'])) {
            $input['data']['tags_add'] - $data['tags_add'];
        }

        if (isset($data['tags_remove'])) {
            $input['data']['tags_remove'] - $data['tags_remove'];
        }

        if (isset($data['departments_add'])) {
            $input['data']['departments_add'] - $data['departments_add'];
        }

        if (isset($data['departments_remove'])) {
            $input['data']['departments_remove'] - $data['departments_remove'];
        }

        return $this->request->put('staff/mass', $input);
    }

    /**
     * Scopes: role_owner, role_admin
     *
     * @param array $optional
     * @return \Aikidesk\SDK\Instance\Contracts\ResponseInterface
     */
    public function invites($optional = [])
    {
        $input = [];

        if (isset($optional['page'])) {
            $input['page'] = $optional['page'];
        }

        return $this->request->get('staff/invite', $input);
    }
}
