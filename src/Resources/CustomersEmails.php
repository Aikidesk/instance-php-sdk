<?php
namespace Aikidesk\SDK\Instance\Resources;

use Aikidesk\SDK\Instance\Contracts\RequestInterface;

/**
 * Class CustomersEmails
 */
class CustomersEmails
{

    /**
     * @var int
     */
    protected $customerId;

    /**
     * @var null|int
     */
    protected $emailId = null;

    /**
     * @var \Aikidesk\SDK\Instance\Contracts\RequestInterface
     */
    private $request;

    /**
     * Customers Emails constructor.
     *
     * @param int                                               $customerId
     * @param int|null                                          $emailId
     * @param \Aikidesk\SDK\Instance\Contracts\RequestInterface $request
     */
    public function __construct($customerId, $emailId = null, RequestInterface $request)
    {
        $this->setCustomerId($customerId);
        $this->setEmailId($emailId);
        $this->request = $request;
    }

    /**
     * Scopes: role_operator, role_admin, role_owner
     *
     * @param array $filter
     *
     * @return \Aikidesk\SDK\Instance\Contracts\ResponseInterface
     */
    public function all($filter = [])
    {
        $customerId = $this->getCustomerId();
        $input = [];

        if (isset($filter['page'])) {
            $input['page'] = $filter['page'];
        }

        if (isset($filter['keyword'])) {
            $input['keyword'] = $filter['keyword'];
        }

        if (isset($filter['with'])) {
            $input['with'] = $filter['with'];
        }

        return $this->request->get(sprintf('customer/%1d/email', $customerId), $input);
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
     *
     * @return $this
     */
    public function setCustomerId($customerId)
    {
        $this->customerId = $customerId;

        return $this;
    }

    /**
     * Scopes: role_operator, role_admin, role_owner
     *
     * @param string $email
     * @param array  $optional
     *
     * @return \Aikidesk\SDK\Instance\Contracts\ResponseInterface
     */
    public function create($email, $optional = [])
    {
        $customerId = $this->getCustomerId();
        $input = [];
        $input['value'] = $email;

        if (isset($optional['confirmed'])) {
            $input['confirmed'] = (bool) $optional['confirmed'];
        }

        return $this->request->post(sprintf('customer/%1d/email', $customerId), $input);
    }

    /**
     * Scopes: role_operator, role_admin, role_owner
     *
     * @param array $optional
     *
     * @return \Aikidesk\SDK\Instance\Contracts\ResponseInterface
     */
    public function get($optional = [])
    {
        $customerId = $this->getCustomerId();
        $emailId = $this->getEmailId();
        $input = [];
        if (isset($optional['with'])) {
            $input['with'] = $optional['with'];
        }

        return $this->request->get(sprintf('customer/%1d/email/%1d', $customerId, $emailId), $input);
    }

    /**
     * @return int|null
     */
    public function getEmailId()
    {
        return $this->emailId;
    }

    /**
     * @param int|null $emailId
     *
     * @return $this
     */
    public function setEmailId($emailId)
    {
        $this->emailId = $emailId;

        return $this;
    }

    /**
     * Scopes: role_operator, role_owner, role_admin
     * @return \Aikidesk\SDK\Instance\Contracts\ResponseInterface
     */
    public function remove()
    {
        $customerId = $this->getCustomerId();
        $emailId = $this->getEmailId();
        $input = [];

        return $this->request->delete(sprintf('customer/%1d/email/%1d', $customerId, $emailId), $input);
    }

    /**
     * Scopes: role_operator, role_owner, role_admin
     * @return \Aikidesk\SDK\Instance\Contracts\ResponseInterface
     */
    public function reverify()
    {
        $customerId = $this->getCustomerId();
        $emailId = $this->getEmailId();
        $input = [];

        return $this->request->put(sprintf('customer/%1d/email/%1d/reverify', $customerId, $emailId), $input);
    }

    /**
     * Scopes: role_operator, role_owner, role_admin
     * @return \Aikidesk\SDK\Instance\Contracts\ResponseInterface
     */
    public function makeDefault()
    {
        $customerId = $this->getCustomerId();
        $emailId = $this->getEmailId();
        $input = [];

        return $this->request->put(sprintf('customer/%1d/email/%1d/default', $customerId, $emailId), $input);
    }
}
