<?php
/**
 * This code was generated by
 * ___ _ _ _ _ _    _ ____    ____ ____ _    ____ ____ _  _ ____ ____ ____ ___ __   __
 *  |  | | | | |    | |  | __ |  | |__| | __ | __ |___ |\ | |___ |__/ |__|  | |  | |__/
 *  |  |_|_| | |___ | |__|    |__| |  | |    |__] |___ | \| |___ |  \ |  |  | |__| |  \
 *
 * Twilio - Flex
 * This is the public Twilio REST API.
 *
 * NOTE: This class is auto generated by OpenAPI Generator.
 * https://openapi-generator.tech
 * Do not edit the class manually.
 */

namespace Twilio\Rest\FlexApi;

use Twilio\Domain;
use Twilio\Exceptions\TwilioException;
use Twilio\InstanceContext;
use Twilio\Rest\FlexApi\V2\FlexUserList;
use Twilio\Rest\FlexApi\V2\WebChannelsList;
use Twilio\Version;

/**
 * @property FlexUserList $flexUser
 * @property WebChannelsList $webChannels
 * @method \Twilio\Rest\FlexApi\V2\FlexUserContext flexUser(string $instanceSid, string $flexUserSid)
 */
class V2 extends Version
{
    protected $_flexUser;
    protected $_webChannels;

    /**
     * Construct the V2 version of FlexApi
     *
     * @param Domain $domain Domain that contains the version
     */
    public function __construct(Domain $domain)
    {
        parent::__construct($domain);
        $this->version = 'v2';
    }

    protected function getFlexUser(): FlexUserList
    {
        if (!$this->_flexUser) {
            $this->_flexUser = new FlexUserList($this);
        }
        return $this->_flexUser;
    }

    protected function getWebChannels(): WebChannelsList
    {
        if (!$this->_webChannels) {
            $this->_webChannels = new WebChannelsList($this);
        }
        return $this->_webChannels;
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
        return '[Twilio.FlexApi.V2]';
    }
}
