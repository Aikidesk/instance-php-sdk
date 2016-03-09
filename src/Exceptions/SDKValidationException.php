<?php
namespace Aikidesk\SDK\Instance\Exceptions;

class SDKValidationException extends ApiException
{
    /**
     * SDKValidationException constructor.
     * @param string $msg
     * @param string $code
     * @param string $url
     * @param array $meta
     */
    public function __construct($msg = 'SDK Validation Error', $code = '400', $url = '', $meta = [])
    {
        parent::__construct($msg, $code, $url, $meta);
    }
}
