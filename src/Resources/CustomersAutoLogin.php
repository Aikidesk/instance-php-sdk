<?php
namespace Aikidesk\SDK\Instance\Resources;

use Aikidesk\SDK\Instance\Contracts\RequestInterface;

/**
 * Class CustomersAutoLogin
 */
class CustomersAutoLogin
{

    /**
     * @var int
     */
    protected $customerId;

    /**
     * @var null|int
     */
    protected $autologinId = null;

    /**
     * @var \Aikidesk\SDK\Instance\Contracts\RequestInterface
     */
    private $request;

    /**
     * Customers Emails constructor.
     * @param int $customerId
     * @param int|null $autologinId
     * @param \Aikidesk\SDK\Instance\Contracts\RequestInterface $request
     */
    public function __construct($customerId, $autologinId = null, RequestInterface $request)
    {
        $this->setCustomerId($customerId);
        $this->setAutoLoginId($autologinId);
        $this->request = $request;
    }

    /**
     * Scopes: role_operator, role_admin, role_owner, customer_autologin
     *
     * @param array $filter
     * @return \Aikidesk\SDK\Instance\Contracts\ResponseInterface
     */
    public function all($filter = [])
    {
        $customerId = $this->getCustomerId();
        $input = [];

        if (isset($filter['page'])) {
            $input['page'] = $filter['page'];
        }

        if (isset($filter['used'])) {
            $input['used'] = $filter['used'];
        }

        if (isset($filter['expired'])) {
            $input['expired'] = $filter['expired'];
        }

        if (isset($filter['with'])) {
            $input['with'] = $filter['with'];
        }

        return $this->request->get(sprintf('customer/%1d/autologin', $customerId), $input);
    }

    /**
     * @return int|null
     */
    public function getCustomerId()
    {
        return $this->customerId;
    }

    /**
     * @param int|null $customerId
     * @return $this
     */
    public function setCustomerId($customerId)
    {
        $this->customerId = $customerId;

        return $this;
    }

    /**
     * Scopes: role_operator, role_admin, role_owner, customer_autologin
     *
     * @param array $optional
     * @return \Aikidesk\SDK\Instance\Contracts\ResponseInterface
     */
    public function create($optional = [])
    {
        $customerId = $this->getCustomerId();
        $input = [];

        if (isset($optional['expire'])) {
            $input['expire'] = $optional['expire'];
        }

        return $this->request->post(sprintf('customer/%1d/autologin', $customerId), $input);
    }

    /**
     * Scopes: role_operator, role_admin, role_owner, customer_autologin
     *
     * @param array $optional
     * @return \Aikidesk\SDK\Instance\Contracts\ResponseInterface
     */
    public function get($optional = [])
    {
        $customerId = $this->getCustomerId();
        $autologinId = $this->getAutoLoginId();
        $input = [];
        if (isset($optional['with'])) {
            $input['with'] = $optional['with'];
        }

        return $this->request->get(sprintf('customer/%1d/autologin/%1d', $customerId, $autologinId), $input);
    }

    /**
     * @return int|null
     */
    public function getAutoLoginId()
    {
        return $this->autologinId;
    }

    /**
     * @param int|null $emailId
     * @return $this
     */
    public function setAutoLoginId($emailId)
    {
        $this->autologinId = $emailId;

        return $this;
    }

    /**
     * Scopes: role_operator, role_admin, role_owner, customer_autologin
     *
     * @return \Aikidesk\SDK\Instance\Contracts\ResponseInterface
     */
    public function remove()
    {
        $customerId = $this->getCustomerId();
        $autologinId = $this->getAutoLoginId();
        $input = [];

        return $this->request->delete(sprintf('customer/%1d/autologin/%1d', $customerId, $autologinId), $input);
    }
}
