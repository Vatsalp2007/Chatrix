<?php

/**
 * This code was generated by
 * \ / _    _  _|   _  _
 * | (_)\/(_)(_|\/| |(/_  v1.0.0
 * /       /
 */

namespace Twilio\TwiML\Voice;

use Twilio\TwiML\TwiML;

class Task extends TwiML {
    /**
     * Task constructor.
     *
     * @param string $body TaskRouter task attributes
     * @param array $attributes Optional attributes
     */
    public function __construct($body, $attributes = []) {
        parent::__construct('Task', $body, $attributes);
    }

    /**
     * Add Priority attribute.
     *
     * @param int $priority Task priority
     */
    public function setPriority($priority): self {
        return $this->setAttribute('priority', $priority);
    }

    /**
     * Add Timeout attribute.
     *
     * @param int $timeout Timeout associated with task
     */
    public function setTimeout($timeout): self {
        return $this->setAttribute('timeout', $timeout);
    }
}
