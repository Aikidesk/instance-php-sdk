<?php
namespace Aikidesk\SDK\Instance\Resources;

use Aikidesk\SDK\Instance\Contracts\RequestInterface;

/**
 * Class Departments
 */
class Departments
{

    /**
     * @var null|int
     */
    protected $id = null;

    /**
     * @var \Aikidesk\SDK\Instance\Contracts\RequestInterface
     */
    private $request;

    public function __construct(RequestInterface $request, $departmentId = null)
    {
        $this->setId($departmentId);
        $this->request = $request;
    }

    /**
     * Scopes: role_admin, role_owner
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

        if (isset($filter['sort'])) {
            $input['sort'] = $filter['sort'];
        }

        if (isset($filter['archived'])) {
            $input['archived'] = $filter['archived'];
        }

        if (isset($filter['created_at'])) {
            $input['created_at'] = $filter['created_at'];
        }

        if (isset($filter['with'])) {
            $input['with'] = $filter['with'];
        }

        return $this->request->get('department', $input);
    }

    /**
     * Scopes: role_admin, role_owner
     *
     * @param string $name
     * @param string $mailbox
     * @param array $leadStaff
     * @param array $optional
     * @return \Aikidesk\SDK\Instance\Contracts\ResponseInterface
     */
    public function create($name, $mailbox, $leadStaff, $optional = [])
    {
        $input = [];
        $input['name'] = $name;
        $input['mailbox'] = $mailbox;
        $input['lead_staff'] = $leadStaff;

        if (isset($optional['description'])) {
            $input['description'] = $optional['description'];
        }

        if (isset($optional['forwarders'])) {
            $input['forwarders'] = $optional['forwarders'];
        }

        if (isset($optional['smtpType'])) {
            $input['smtpType'] = $optional['smtpType'];
        }

        if (isset($optional['visibility'])) {
            $input['visibility'] = $optional['visibility'];
        }

        if (isset($optional['slas'])) {
            $input['slas'] = $optional['slas'];
        }

        return $this->request->post('department', $input);
    }

    /**
     * Scopes: role_admin, role_owner
     *
     * @param array $optional
     * @return \Aikidesk\SDK\Instance\Contracts\ResponseInterface
     */
    public function get($optional = [])
    {
        $departmentId = $this->getId();
        $input = [];
        if (isset($optional['with'])) {
            $input['with'] = $optional['with'];
        }

        return $this->request->get(sprintf('department/%1d', $departmentId), $input);
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
     * Scopes: role_admin, role_owner
     *
     * @return \Aikidesk\SDK\Instance\Contracts\ResponseInterface
     */
    public function archive()
    {
        $departmentId = $this->getId();
        $input = [];
        $input['archive'] = true;

        return $this->request->put(sprintf('department/%1d/archive', $departmentId), $input);
    }

    /**
     * Scopes: role_admin, role_owner
     *
     * @return \Aikidesk\SDK\Instance\Contracts\ResponseInterface
     */
    public function unarchive()
    {
        $departmentId = $this->getId();
        $input = [];
        $input['archive'] = false;

        return $this->request->put(sprintf('department/%1d/archive', $departmentId), $input);
    }

    /**
     * Scopes: role_admin, role_owner
     *
     * @param int $newDepartmentId
     * @return \Aikidesk\SDK\Instance\Contracts\ResponseInterface
     */
    public function moveOpenTickets($newDepartmentId)
    {
        $departmentId = $this->getId();
        $input = [];
        $input['newDepartmentId'] = $newDepartmentId;

        return $this->request->put(sprintf('department/%1d/moveTickets', $departmentId), $input);
    }
}
