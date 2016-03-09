<?php
namespace Aikidesk\SDK\Instance\Resources;

use Aikidesk\SDK\Instance\Contracts\RequestInterface;
use Aikidesk\SDK\Instance\Exceptions\SDKValidationException;
use GuzzleHttp\Psr7\Stream;

class Settings
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
     * Scopes: role_owner, role_admin
     *
     * @param array $optional
     * @return \Aikidesk\SDK\Instance\Contracts\ResponseInterface
     */
    public function getBase($optional = [])
    {
        $input = [];

        return $this->request->get('setting/base', $input);
    }

    /**
     * Scopes: role_owner, role_admin
     *
     * @param array $data
     * @return \Aikidesk\SDK\Instance\Contracts\ResponseInterface
     */
    public function updateBase($data = [])
    {
        $input = [];

        if (isset($data['instance_name'])) {
            $input['instance_name'] = $data['instance_name'];
        }

        if (isset($data['company_name'])) {
            $input['company_name'] = $data['company_name'];
        }

        if (isset($data['company_url'])) {
            $input['company_url'] = $data['company_url'];
        }

        if (isset($data['country'])) {
            $input['country'] = $data['country'];
        }

        if (isset($data['lang'])) {
            $input['lang'] = $data['lang'];
        }

        if (isset($data['timezone'])) {
            $input['timezone'] = $data['timezone'];
        }

        if (isset($data['ticket_default_priority'])) {
            $input['ticket_default_priority'] = $data['ticket_default_priority'];
        }

        if (isset($data['ticket_ucode_prefix'])) {
            $input['ticket_ucode_prefix'] = $data['ticket_ucode_prefix'];
        }

        if (isset($data['ticket_ucode_min'])) {
            $input['ticket_ucode_min'] = $data['ticket_ucode_min'];
        }

        if (isset($data['attachments_status'])) {
            $input['attachments_status'] = $data['attachments_status'];
        }

        if (isset($data['attachments_extensions'])) {
            $input['attachments_extensions'] = $data['attachments_extensions'];
        }

        if (isset($data['logo_bg_color'])) {
            $input['logo_bg_color'] = $data['logo_bg_color'];
        }

        return $this->request->put('setting/base', $input);
    }

    /**
     * Scopes: role_owner, role_admin
     *
     * @param string|resource $file
     * @return \Aikidesk\SDK\Instance\Contracts\ResponseInterface
     * @throws \Aikidesk\SDK\Instance\Exceptions\SDKValidationException
     */
    public function logo($file)
    {
        $input = [];
        if (is_string($file)) {
            $resource = fopen($file, 'r');
            $psr7Stream = new Stream($resource);
        } elseif (is_resource($file) and (get_resource_type($file) == 'file' or get_resource_type($file) == 'stream')) {
            $resource = $file;
            $psr7Stream = new Stream($resource);
        } else {
            throw new SDKValidationException('Logo is not file path nor file resource');
        }

        $fileContent = $psr7Stream->getContents();
        $fileType = pathinfo($psr7Stream->getMetadata('uri'), PATHINFO_EXTENSION);
        $fileName = pathinfo($psr7Stream->getMetadata('uri'), PATHINFO_FILENAME);
        $input['logo_img_s3key'] = 'data:image/'.$fileType.';base64,'.base64_encode($fileContent).','.$fileName;

        return $this->request->post('setting/theme', $input);
    }
}
