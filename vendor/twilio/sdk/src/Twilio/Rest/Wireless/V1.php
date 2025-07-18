<?php
/**
 * This code was generated by
 * ___ _ _ _ _ _    _ ____    ____ ____ _    ____ ____ _  _ ____ ____ ____ ___ __   __
 *  |  | | | | |    | |  | __ |  | |__| | __ | __ |___ |\ | |___ |__/ |__|  | |  | |__/
 *  |  |_|_| | |___ | |__|    |__| |  | |    |__] |___ | \| |___ |  \ |  |  | |__| |  \
 *
 * Twilio - Wireless
 * This is the public Twilio REST API.
 *
 * NOTE: This class is auto generated by OpenAPI Generator.
 * https://openapi-generator.tech
 * Do not edit the class manually.
 */

namespace Twilio\Rest\Wireless;

use Twilio\Domain;
use Twilio\Exceptions\TwilioException;
use Twilio\InstanceContext;
use Twilio\Rest\Wireless\V1\CommandList;
use Twilio\Rest\Wireless\V1\RatePlanList;
use Twilio\Rest\Wireless\V1\SimList;
use Twilio\Rest\Wireless\V1\UsageRecordList;
use Twilio\Version;

/**
 * @property CommandList $commands
 * @property RatePlanList $ratePlans
 * @property SimList $sims
 * @property UsageRecordList $usageRecords
 * @method \Twilio\Rest\Wireless\V1\CommandContext commands(string $sid)
 * @method \Twilio\Rest\Wireless\V1\RatePlanContext ratePlans(string $sid)
 * @method \Twilio\Rest\Wireless\V1\SimContext sims(string $sid)
 */
class V1 extends Version
{
    protected $_commands;
    protected $_ratePlans;
    protected $_sims;
    protected $_usageRecords;

    /**
     * Construct the V1 version of Wireless
     *
     * @param Domain $domain Domain that contains the version
     */
    public function __construct(Domain $domain)
    {
        parent::__construct($domain);
        $this->version = 'v1';
    }

    protected function getCommands(): CommandList
    {
        if (!$this->_commands) {
            $this->_commands = new CommandList($this);
        }
        return $this->_commands;
    }

    protected function getRatePlans(): RatePlanList
    {
        if (!$this->_ratePlans) {
            $this->_ratePlans = new RatePlanList($this);
        }
        return $this->_ratePlans;
    }

    protected function getSims(): SimList
    {
        if (!$this->_sims) {
            $this->_sims = new SimList($this);
        }
        return $this->_sims;
    }

    protected function getUsageRecords(): UsageRecordList
    {
        if (!$this->_usageRecords) {
            $this->_usageRecords = new UsageRecordList($this);
        }
        return $this->_usageRecords;
    }

    /**
     * Magic getter to lazy load if0_39413194 resources
     *
     * @param string $name Resource to return
     * @return \Twilio\ListResource The requested resource
     * @throws TwilioException For unknown resource
     */
    public function __get(string $name)
    {
        $method = 'get' . \ucfirst($name);
        if (\method_exists($this, $method)) {
            return $this->$method();
        }

        throw new TwilioException('Unknown resource ' . $name);
    }

    /**
     * Magic caller to get resource contexts
     *
     * @param string $name Resource to return
     * @param array $arguments Context parameters
     * @return InstanceContext The requested resource context
     * @throws TwilioException For unknown resource
     */
    public function __call(string $name, array $arguments): InstanceContext
    {
        $property = $this->$name;
        if (\method_exists($property, 'getContext')) {
            return \call_user_func_array(array($property, 'getContext'), $arguments);
        }

        throw new TwilioException('Resource does not have a context');
    }

    /**
     * Provide a friendly representation
     *
     * @return string Machine friendly representation
     */
    public function __toString(): string
    {
        return '[Twilio.Wireless.V1]';
    }
}
