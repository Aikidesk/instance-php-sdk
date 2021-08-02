<?php
namespace Aikidesk\SDK\Instance\Resources;

use Aikidesk\SDK\Instance\Contracts\RequestInterface;

/**
 * Class TicketsMessages
 */
class TicketsMessages
{

    /**
     * @var int
     */
    protected $ticketId;

    /**
     * @var null|int
     */
    protected $messageId = null;

    /**
     * @var \Aikidesk\SDK\Instance\Contracts\RequestInterface
     */
    private $request;

    public function __construct(RequestInterface $request, $ticketId, $messageId = null)
    {
        $this->setTicketId($ticketId);
        $this->setMessageId($messageId);
        $this->request = $request;
    }

    /**
     * Scopes: role_customer, role_operator, role_admin, role_owner
     *
     * @param array $filter
     * @return \Aikidesk\SDK\Instance\Contracts\ResponseInterface
     */
    public function all($filter = [])
    {
        $ticketId = $this->getTicketId();
        $input = [];

        if (isset($filter['page'])) {
            $input['page'] = $filter['page'];
        }

        if (isset($filter['with'])) {
            $input['with'] = $filter['with'];
        }

        return $this->request->get(sprintf('ticket/%1d/message', $ticketId), $input);
    }

    /**
     * @return int
     */
    public function getTicketId()
    {
        return $this->ticketId;
    }

    /**
     * @param int ticketId
     * @return $this
     */
    public function setTicketId($ticketId)
    {
        $this->ticketId = $ticketId;

        return $this;
    }

    /**
     * Scopes: role_customer, role_operator, role_admin, role_owner
     *
     * @param string $text
     * @param array $optional
     * @return \Aikidesk\SDK\Instance\Contracts\ResponseInterface
     */
    public function reply($text, $optional = [])
    {
        $ticketId = $this->getTicketId();
        $input = [];
        $input['text'] = $text;

        if (isset($optional['close'])) {
            $input['close'] = $optional['close'];
        }

        if (isset($optional['private'])) {
            $input['private'] = $optional['private'];
        }

        return $this->request->post(sprintf('ticket/%1d/message', $ticketId), $input);
    }

    /**
     * Scopes: role_customer, role_operator, role_admin, role_owner
     *
     * @param array $optional
     * @return \Aikidesk\SDK\Instance\Contracts\ResponseInterface
     */
    public function get($optional = [])
    {
        $ticketId = $this->getTicketId();
        $messageId = $this->getMessageId();
        $input = [];
        if (isset($optional['with'])) {
            $input['with'] = $optional['with'];
        }

        return $this->request->get(sprintf('ticket/%1d/message/%1d', $ticketId, $messageId), $input);
    }

    /**
     * @return int|null
     */
    public function getMessageId()
    {
        return $this->messageId;
    }

    /**
     * @param int| $messageId
     * @return $this
     */
    public function setMessageId($messageId)
    {
        $this->messageId = $messageId;

        return $this;
    }
}
