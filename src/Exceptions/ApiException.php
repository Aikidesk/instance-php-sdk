<?php
namespace Aikidesk\SDK\Instance\Exceptions;

use Exception;

class ApiException extends Exception
{

    /**
     * @var string
     */
    protected $url;

    /**
     * @var array
     */
    protected $meta;

    /**
     * ApiException constructor.
     * @param string $msg
     * @param int $code
     * @param string $url
     * @param array $meta
     */
    public function __construct($msg, $code, $url = '', $meta = [])
    {
        $this->url = $url;
        $this->meta = $meta;

        $prevException = null;
        if (isset($meta['prevException']) and $meta['prevException'] instanceof \Exception) {
            $prevException = $meta['prevException'];
        }

        parent::__construct($msg, (int)$code, $prevException);
    }

    /**
     * @return string
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * @return array
     */
    public function getMeta()
    {
        return $this->meta;
    }
}
