<?php
namespace Aikidesk\SDK\Instance\Resources;

use Aikidesk\SDK\Instance\Contracts\RequestInterface;

/**
 * Class Customers
 */
class Customers
{

    /**
     * @var null|int
     */
    protected $id = null;

    /**
     * @var \Aikidesk\SDK\Instance\Resources\CustomersEmails
     */
    private $customersEmailsResponse;

    /**
     * @var \Aikidesk\SDK\Instance\Resources\CustomersAutoLogin
     */
    private $customersAutologinResponse;

    /**
     * @var \Aikidesk\SDK\Instance\Contracts\RequestInterface
     */
    private $request;

    /**
     * Users constructor.
     * @param int|null $customerId
     * @param null $customerEmailResources
     * @param null $customerAutologinResources
     * @param \Aikidesk\SDK\Instance\Contracts\RequestInterface $request
     */
    public function __construct(
        $customerId = null,
        $customerEmailResources = null,
        $customerAutologinResources = null,
        RequestInterface $request
    ) {
        $this->setId($customerId);
        $this->request = $request;
        $this->customersEmailsResponse = $customerEmailResources ?: new \Aikidesk\SDK\Instance\Resources\CustomersEmails(null,
            null, $this->request);
        $this->customersAutologinResponse = $customerAutologinResources ?: new \Aikidesk\SDK\Instance\Resources\CustomersAutoLogin(null,
            null, $this->request);
    }

    /**
     * Scopes: role_operator, role_admin, role_owner
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

        if (isset($filter['organization'])) {
            $input['organization'] = $filter['organization'];
        }

        if (isset($filter['tags'])) {
            $input['tags'] = $filter['tags'];
        }

        if (isset($filter['with'])) {
            $input['with'] = $filter['with'];
        }

        return $this->request->get('customer', $input);
    }

    /**
     * Scopes: role_operator, role_admin, role_owner
     *
     * @param string $name
     * @param string $email
     * @param array $optional
     * @return \Aikidesk\SDK\Instance\Contracts\ResponseInterface
     */
    public function create($name, $email, $optional = [])
    {
        $input = [];
        $input['name'] = $name;
        $input['email'] = $email;
        $input['sendPassword'] = false;

        if (isset($optional['timezone'])) {
            $input['timezone'] = $optional['timezone'];
        }

        if (isset($optional['locale'])) {
            $input['locale'] = $optional['locale'];
        }

        if (isset($optional['organization'])) {
            $input['organization'] = $optional['organization'];
        }

        if (isset($optional['sendPassword'])) {
            $input['sendPassword'] = $optional['sendPassword'];
        }

        return $this->request->post('customer', $input);
    }

    /**
     * Scopes: role_operator, role_admin, role_owner
     *
     * @param array $optional
     * @return \Aikidesk\SDK\Instance\Contracts\ResponseInterface
     */
    public function get($optional = [])
    {
        $customerId = $this->getId();
        $input = [];
        if (isset($optional['with'])) {
            $input['with'] = $optional['with'];
        }

        return $this->request->get(sprintf('customer/%1d', $customerId), $input);
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
     * Scopes: role_operator, role_owner, role_admin
     *
     * @return \Aikidesk\SDK\Instance\Contracts\ResponseInterface
     */
    public function archive()
    {
        $customerId = $this->getId();
        $input = [];
        $input['archive'] = true;

        return $this->request->put(sprintf('customer/%1d/archive', $customerId), $input);
    }

    /**
     * Scopes: role_operator, role_owner, role_admin
     *
     * @return \Aikidesk\SDK\Instance\Contracts\ResponseInterface
     */
    public function unarchive()
    {
        $customerId = $this->getId();
        $input = [];
        $input['archive'] = false;

        return $this->request->put(sprintf('customer/%1d/archive', $customerId), $input);
    }

    /**
     * Scopes: role_operator, role_owner, role_admin
     *
     * @param array $tags
     * @return \Aikidesk\SDK\Instance\Contracts\ResponseInterface
     */
    public function syncTags($tags = [])
    {
        $customerId = $this->getId();
        $input = [];
        $input['tags'] = false;

        return $this->request->put(sprintf('customer/%1d/tags', $customerId), $input);
    }

    /**
     * Scopes: role_operator, role_owner, role_admin
     * @TODO: TBD
     * @param string $action
     * @param array $ids
     * @param array $data
     * @return \Aikidesk\SDK\Instance\Contracts\ResponseInterface
     */
    public function mass($action, $ids, $data = [])
    {
        $input = [];

        return $this->request->put('customer/mass', $input);
    }

    /**
     * Scopes: role_operator, role_owner, role_admin
     * @TODO: TBD
     * @param string $keyword_or_ids
     * @param string $type
     * @return \Aikidesk\SDK\Instance\Contracts\ResponseInterface
     */
    public function autocomplete($keyword_or_ids, $type)
    {
        $input = [];
        $input['keyword'] = $keyword_or_ids;
        $input['ids'] = $keyword_or_ids;
        $input['type'] = $type;

        return $this->request->get('customer/autocomplete', $input);
    }

    /**
     * Scopes: role_operator, role_owner, role_admin
     *
     * @return \Aikidesk\SDK\Instance\Contracts\ResponseInterface
     */
    public function generateNewPassword()
    {
        $customerId = $this->getId();
        $input = [];

        return $this->request->put(sprintf('customer/%1d/newPassword', $customerId), $input);
    }

    /**
     * Scopes: role_operator, role_owner, role_admin
     *
     * @param int|null $emailId
     * @return \Aikidesk\SDK\Instance\Resources\CustomersEmails
     */
    public function email($emailId = null)
    {
        $this->customersEmailsResponse->setCustomerId($this->getId());
        $this->customersEmailsResponse->setEmailId($emailId);

        return $this->customersEmailsResponse;
    }

    /**
     * Scopes: role_operator, role_owner, role_admin
     *
     * @param string $email
     *
     * @return \Aikidesk\SDK\Instance\Contracts\ResponseInterface
     * @throws \Aikidesk\SDK\Instance\Exceptions\ApiException
     */
    public function searchByEmail($email)
    {
        return $this->request->get('customer/email', ['email' => $email]);
    }

    /**
     * Scopes: role_operator, role_owner, role_admin, customer_autologin
     *
     * @param int|null $autologinId
     * @return \Aikidesk\SDK\Instance\Resources\CustomersAutoLogin
     */
    public function autologin($autologinId = null)
    {
        $this->customersAutologinResponse->setCustomerId($this->getId());
        $this->customersAutologinResponse->setAutoLoginId($autologinId);

        return $this->customersAutologinResponse;
    }

    /**
     * Scopes: customer_get_own, customer_get_all, customer_oauth_grant_internal
     * New Scopes: customer_oauth_grant_internal
     *
     * @param array $scopes
     * @param array $optional
     * @return \Aikidesk\SDK\Instance\Contracts\ResponseInterface
     */
    public function oauthGrantInternal($scopes = [], $optional = [])
    {
        $customerId = $this->getId();
        $input = [];
        $input['scope'] = implode(',', $scopes);

        return $this->request->post(sprintf('customer/%1d/oauth/grant/internal', $customerId), $input);
    }

    /**
     * Scopes: www
     *
     * @return \Aikidesk\SDK\Instance\Contracts\ResponseInterface
     */
    public function activate()
    {
        $customerId = $this->getId();
        $input = [];
        $input['activate'] = true;

        return $this->request->post(sprintf('customer/%1d/activate', $customerId), $input);
    }
}
