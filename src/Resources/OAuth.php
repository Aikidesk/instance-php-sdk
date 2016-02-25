<?php
namespace Aikidesk\SDK\Instance\Resources;

use Aikidesk\SDK\Instance\Contracts\RequestInterface;

class OAuth
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
     * @return \Aikidesk\SDK\Instance\Contracts\ResponseInterface
     */
    public function current()
    {
        return $this->request->get('test');
    }
}
