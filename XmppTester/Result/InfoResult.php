<?php
/**
 * Copyright (C) 2014, Some right reserved.
 * @author Kacper "Kadet" Donat <kadet1090@gmail.com>
 * @license http://creativecommons.org/licenses/by-sa/4.0/legalcode CC BY-SA
 *
 * Contact with author:
 * Xmpp: kadet@jid.pl
 * E-mail: kadet1090@gmail.com
 *
 * From Kadet with love.
 */

namespace XmppTester\Result;

use Kadet\Utils\Property;

class InfoResult extends Result {
    use Property;

    protected $_type = 'info';

    private $_result;

    function __construct($result)
    {
        $this->_result = (string)$result;
    }

    public function set($result) {
        $this->_result = $result;
    }

    public function _get_result()
    {
        return $this->_result;
    }


}