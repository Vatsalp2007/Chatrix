<?php
/**
 * This code was generated by
 * ___ _ _ _ _ _    _ ____    ____ ____ _    ____ ____ _  _ ____ ____ ____ ___ __   __
 *  |  | | | | |    | |  | __ |  | |__| | __ | __ |___ |\ | |___ |__/ |__|  | |  | |__/
 *  |  |_|_| | |___ | |__|    |__| |  | |    |__] |___ | \| |___ |  \ |  |  | |__| |  \
 *
 * Twilio - Intelligence
 * This is the public Twilio REST API.
 *
 * NOTE: This class is auto generated by OpenAPI Generator.
 * https://openapi-generator.tech
 * Do not edit the class manually.
 */

namespace Twilio\Rest\Intelligence;

use Twilio\Domain;
use Twilio\Exceptions\TwilioException;
use Twilio\InstanceContext;
use Twilio\Rest\Intelligence\V2\CustomOperatorList;
use Twilio\Rest\Intelligence\V2\OperatorList;
use Twilio\Rest\Intelligence\V2\OperatorAttachmentList;
use Twilio\Rest\Intelligence\V2\OperatorAttachmentsList;
use Twilio\Rest\Intelligence\V2\OperatorTypeList;
use Twilio\Rest\Intelligence\V2\PrebuiltOperatorList;
use Twilio\Rest\Intelligence\V2\ServiceList;
use Twilio\Rest\Intelligence\V2\TranscriptList;
use Twilio\Version;

/**
 * @property CustomOperatorList $customOperators
 * @property OperatorList $operators
 * @property OperatorAttachmentList $operatorAttachment
 * @property OperatorAttachmentsList $operatorAttachments
 * @property OperatorTypeList $operatorType
 * @property PrebuiltOperatorList $prebuiltOperators
 * @property ServiceList $services
 * @property TranscriptList $transcripts
 * @method \Twilio\Rest\Intelligence\V2\CustomOperatorContext customOperators(string $sid)
 * @method \Twilio\Rest\Intelligence\V2\OperatorContext operators(string $sid)
 * @method \Twilio\Rest\Intelligence\V2\OperatorAttachmentContext operatorAttachment(string $serviceSid, string $operatorSid)
 * @method \Twilio\Rest\Intelligence\V2\OperatorTypeContext operatorType(string $sid)
 * @method \Twilio\Rest\Intelligence\V2\PrebuiltOperatorContext prebuiltOperators(string $sid)
 * @method \Twilio\Rest\Intelligence\V2\ServiceContext services(string $sid)
 * @method \Twilio\Rest\Intelligence\V2\TranscriptContext transcripts(string $sid)
 */
class V2 extends Version
{
    protected $_customOperators;
    protected $_operators;
    protected $_operatorAttachment;
    protected $_operatorAttachments;
    protected $_operatorType;
    protected $_prebuiltOperators;
    protected $_services;
    protected $_transcripts;

    /**
     * Construct the V2 version of Intelligence
     *
     * @param Domain $domain Domain that contains the version
     */
    public function __construct(Domain $domain)
    {
        parent::__construct($domain);
        $this->version = 'v2';
    }

    protected function getCustomOperators(): CustomOperatorList
    {
        if (!$this->_customOperators) {
            $this->_customOperators = new CustomOperatorList($this);
        }
        return $this->_customOperators;
    }

    protected function getOperators(): OperatorList
    {
        if (!$this->_operators) {
            $this->_operators = new OperatorList($this);
        }
        return $this->_operators;
    }

    protected function getOperatorAttachment(): OperatorAttachmentList
    {
        if (!$this->_operatorAttachment) {
            $this->_operatorAttachment = new OperatorAttachmentList($this);
        }
        return $this->_operatorAttachment;
    }

    protected function getOperatorAttachments(): OperatorAttachmentsList
    {
        if (!$this->_operatorAttachments) {
            $this->_operatorAttachments = new OperatorAttachmentsList($this);
        }
        return $this->_operatorAttachments;
    }

    protected function getOperatorType(): OperatorTypeList
    {
        if (!$this->_operatorType) {
            $this->_operatorType = new OperatorTypeList($this);
        }
        return $this->_operatorType;
    }

    protected function getPrebuiltOperators(): PrebuiltOperatorList
    {
        if (!$this->_prebuiltOperators) {
            $this->_prebuiltOperators = new PrebuiltOperatorList($this);
        }
        return $this->_prebuiltOperators;
    }

    protected function getServices(): ServiceList
    {
        if (!$this->_services) {
            $this->_services = new ServiceList($this);
        }
        return $this->_services;
    }

    protected function getTranscripts(): TranscriptList
    {
        if (!$this->_transcripts) {
            $this->_transcripts = new TranscriptList($this);
        }
        return $this->_transcripts;
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
        return '[Twilio.Intelligence.V2]';
    }
}
