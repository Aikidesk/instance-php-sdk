<?php
namespace Aikidesk\SDK\Instance\Resources;

use Aikidesk\SDK\Instance\Contracts\RequestInterface;

class Stats
{

    /**
     * @var \Aikidesk\SDK\Instance\Contracts\RequestInterface
     */
    private $request;

    /**
     * OAuth constructor.
     * @param \Aikidesk\SDK\Instance\Contracts\RequestInterface $request
     */
    public function __construct(RequestInterface $request)
    {
        $this->request = $request;
    }

    /**
     * Scopes: stats_unread_messages, role_operator, role_owner, role_admin
     *
     * @param int $customerId
     * @return \Aikidesk\SDK\Instance\Contracts\ResponseInterface
     */
    public function unreadMessages($customerId)
    {
        return $this->request->get(sprintf('stats/unreadMessages/%1d', $customerId));
    }
}
