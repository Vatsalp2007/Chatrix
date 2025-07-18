<?php
/**
 * This code was generated by
 * ___ _ _ _ _ _    _ ____    ____ ____ _    ____ ____ _  _ ____ ____ ____ ___ __   __
 *  |  | | | | |    | |  | __ |  | |__| | __ | __ |___ |\ | |___ |__/ |__|  | |  | |__/
 *  |  |_|_| | |___ | |__|    |__| |  | |    |__] |___ | \| |___ |  \ |  |  | |__| |  \
 *
 * Twilio - Accounts
 * This is the public Twilio REST API.
 *
 * NOTE: This class is auto generated by OpenAPI Generator.
 * https://openapi-generator.tech
 * Do not edit the class manually.
 */

namespace Twilio\Rest\Accounts;

use Twilio\Domain;
use Twilio\Exceptions\TwilioException;
use Twilio\InstanceContext;
use Twilio\Rest\Accounts\V1\AuthTokenPromotionList;
use Twilio\Rest\Accounts\V1\BulkConsentsList;
use Twilio\Rest\Accounts\V1\BulkContactsList;
use Twilio\Rest\Accounts\V1\CredentialList;
use Twilio\Rest\Accounts\V1\SafelistList;
use Twilio\Rest\Accounts\V1\SecondaryAuthTokenList;
use Twilio\Version;

/**
 * @property AuthTokenPromotionList $authTokenPromotion
 * @property BulkConsentsList $bulkConsents
 * @property BulkContactsList $bulkContacts
 * @property CredentialList $credentials
 * @property SafelistList $safelist
 * @property SecondaryAuthTokenList $secondaryAuthToken
 */
class V1 extends Version
{
    protected $_authTokenPromotion;
    protected $_bulkConsents;
    protected $_bulkContacts;
    protected $_credentials;
    protected $_safelist;
    protected $_secondaryAuthToken;

    /**
     * Construct the V1 version of Accounts
     *
     * @param Domain $domain Domain that contains the version
     */
    public function __construct(Domain $domain)
    {
        parent::__construct($domain);
        $this->version = 'v1';
    }

    protected function getAuthTokenPromotion(): AuthTokenPromotionList
    {
        if (!$this->_authTokenPromotion) {
            $this->_authTokenPromotion = new AuthTokenPromotionList($this);
        }
        return $this->_authTokenPromotion;
    }

    protected function getBulkConsents(): BulkConsentsList
    {
        if (!$this->_bulkConsents) {
            $this->_bulkConsents = new BulkConsentsList($this);
        }
        return $this->_bulkConsents;
    }

    protected function getBulkContacts(): BulkContactsList
    {
        if (!$this->_bulkContacts) {
            $this->_bulkContacts = new BulkContactsList($this);
        }
        return $this->_bulkContacts;
    }

    protected function getCredentials(): CredentialList
    {
        if (!$this->_credentials) {
            $this->_credentials = new CredentialList($this);
        }
        return $this->_credentials;
    }

    protected function getSafelist(): SafelistList
    {
        if (!$this->_safelist) {
            $this->_safelist = new SafelistList($this);
        }
        return $this->_safelist;
    }

    protected function getSecondaryAuthToken(): SecondaryAuthTokenList
    {
        if (!$this->_secondaryAuthToken) {
            $this->_secondaryAuthToken = new SecondaryAuthTokenList($this);
        }
        return $this->_secondaryAuthToken;
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
        return '[Twilio.Accounts.V1]';
    }
}
