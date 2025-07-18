<?php

/**
 * This code was generated by
 * \ / _    _  _|   _  _
 * | (_)\/(_)(_|\/| |(/_  v1.0.0
 * /       /
 */

namespace Twilio\TwiML\Voice;

use Twilio\TwiML\TwiML;

class ReferSip extends TwiML {
    /**
     * ReferSip constructor.
     *
     * @param string $sipUrl SIP URL
     */
    public function __construct($sipUrl) {
        parent::__construct('Sip', $sipUrl);
    }
}
