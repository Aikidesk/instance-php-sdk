<?php
namespace Aikidesk\SDK\Instance\Exceptions;

class BadGatewayException extends ApiException
{
    /**
     * BadGatewayException constructor.
     * @param string $msg
     * @param string $code
     * @param string $url
     * @param array $meta
     */
    public function __construct($msg = 'Bad Gateway', $code = '502', $url = '', $meta = [])
    {
        parent::__construct($msg, $code, $url, $meta);
    }
}
