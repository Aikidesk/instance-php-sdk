<?php
namespace Aikidesk\SDK\Instance\Resources;

use Aikidesk\SDK\Instance\Contracts\RequestInterface;

/**
 * Class Tickets
 */
class Tickets
{

    /**
     * @var null|int
     */
    protected $id = null;

    /**
     * @var \Aikidesk\SDK\Instance\Resources\TicketsMessages
     */
    private $ticketsMessagesResources;

    /**
     * @var \Aikidesk\SDK\Instance\Contracts\RequestInterface
     */
    private $request;

    public function __construct(RequestInterface $request, $ticketId = null, $ticketMessageResources = null)
    {
        $this->setId($ticketId);
        $this->request = $request;
        $this->ticketsMessagesResources = $ticketMessageResources ?: new \Aikidesk\SDK\Instance\Resources\TicketsMessages(null,
            null, $this->request);
    }

    /**
     * Scopes: role_customer, role_operator, role_admin, role_owner
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

        if (isset($filter['statusType'])) {
            $input['statusType'] = $filter['statusType'];
        }

        if (isset($filter['archived'])) {
            $input['archived'] = $filter['archived'];
        }

        if (isset($filter['created_at'])) {
            $input['created_at'] = $filter['created_at'];
        }

        if (isset($filter['updated_at'])) {
            $input['updated_at'] = $filter['updated_at'];
        }

        if (isset($filter['spam'])) {
            $input['spam'] = $filter['spam'];
        }

        if (isset($filter['unread'])) {
            $input['unread'] = $filter['unread'];
        }

        if (isset($filter['department'])) {
            $input['department'] = $filter['department'];
        }

        if (isset($filter['assigned_staff'])) {
            $input['assigned_staff'] = $filter['assigned_staff'];
        }

        if (isset($filter['lead_staff'])) {
            $input['lead_staff'] = $filter['lead_staff'];
        }

        if (isset($filter['priority'])) {
            $input['priority'] = $filter['priority'];
        }

        if (isset($filter['sender'])) {
            $input['sender'] = $filter['sender'];
        }

        if (isset($filter['sender_organization'])) {
            $input['sender_organization'] = $filter['sender_organization'];
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

        return $this->request->get('ticket', $input);
    }

    /**
     * Scopes: role_customer, role_operator, role_admin, role_owner
     *
     * @param string $topic
     * @param string $text
     * @param int $department
     * @param array $optional
     * @return \Aikidesk\SDK\Instance\Contracts\ResponseInterface
     */
    public function create($topic, $text, $department, $optional = [])
    {
        $input = [];
        $input['topic'] = $topic;
        $input['text'] = $text;
        $input['department'] = $department;
        $input['priority'] = 0;

        if (isset($optional['priority'])) {
            $input['priority'] = $optional['priority'];
        }

        if (isset($optional['sender'])) {
            $input['sender'] = $optional['sender'];
        }

        return $this->request->post('ticket', $input);
    }

    /**
     * Scopes: role_customer, role_operator, role_admin, role_owner
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

        return $this->request->get(sprintf('ticket/%1d', $customerId), $input);
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
     * Scopes: role_operator, role_admin, role_owner
     *
     * @return \Aikidesk\SDK\Instance\Contracts\ResponseInterface
     */
    public function archive()
    {
        $customerId = $this->getId();
        $input = [];
        $input['archive'] = true;

        return $this->request->put(sprintf('ticket/%1d/archive', $customerId), $input);
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

        return $this->request->put(sprintf('ticket/%1d/archive', $customerId), $input);
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

        return $this->request->put(sprintf('ticket/%1d/tags', $customerId), $input);
    }

    /**
     * Scopes: role_operator, role_owner, role_admin
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

        if (isset($data['status'])) {
            $input['data']['status'] - $data['status'];
        }

        if (isset($data['priority'])) {
            $input['data']['priority'] - $data['priority'];
        }

        if (isset($data['department'])) {
            $input['data']['department'] - $data['department'];
        }

        if (isset($data['tags_add'])) {
            $input['data']['tags_add'] - $data['tags_add'];
        }

        if (isset($data['tags_remove'])) {
            $input['data']['tags_remove'] - $data['tags_remove'];
        }

        if (isset($data['staff_add'])) {
            $input['data']['staff_add'] - $data['staff_add'];
        }

        if (isset($data['staff_remove'])) {
            $input['data']['staff_remove'] - $data['staff_remove'];
        }

        return $this->request->put('ticket/mass', $input);
    }

    /**
     * Scopes: role_customer, role_operator, role_owner, role_admin
     *
     * @param int|null $messageId
     * @return \Aikidesk\SDK\Instance\Resources\TicketsMessages
     */
    public function message($messageId = null)
    {
        $this->ticketsMessagesResources->setTicketId($this->getId());
        $this->ticketsMessagesResources->setMessageId($messageId);

        return $this->ticketsMessagesResources;
    }
}
