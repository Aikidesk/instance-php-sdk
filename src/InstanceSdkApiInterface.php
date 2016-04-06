<?php
namespace Aikidesk\SDK\Instance;

interface InstanceSdkApiInterface
{

    /**
     * @return \Aikidesk\SDK\Instance\Resources\Settings
     */
    public function setting();

    /**
     * @param int|null $customerId
     * @return \Aikidesk\SDK\Instance\Resources\Customers
     */
    public function customer($customerId = null);

    /**
     * @param int|null $departmentId
     * @return \Aikidesk\SDK\Instance\Resources\Departments
     */
    public function department($departmentId = null);

    /**
     * @param int|null $staffId
     * @return \Aikidesk\SDK\Instance\Resources\Staff
     */
    public function staff($staffId = null);

    /**
     * @return \Aikidesk\SDK\Instance\Resources\Stats
     */
    public function stats();

    /**
     * @param int|null $ticketId
     * @return \Aikidesk\SDK\Instance\Resources\Tickets
     */
    public function ticket($ticketId = null);

    /**
     * @param string $access_token
     */
    public function setAccessToken($access_token);

    /**
     * @return string
     */
    public function getAccessToken();

    /**
     * @return \Aikidesk\SDK\Instance\Resources\OAuth
     */
    public function oauth($oauthId = null);
}
