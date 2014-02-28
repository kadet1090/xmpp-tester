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

/**
 * Class Result
 * @package XmppTester\Result
 *
 * @property-read mixed $result Result of test/benchmark whatever.
 */
abstract class Result implements \JsonSerializable {
    protected $_type;

    public $comment;

    abstract public function _get_result();

    /**
     * (PHP 5 &gt;= 5.4.0)<br/>
     * Specify data which should be serialized to JSON
     * @link http://php.net/manual/en/jsonserializable.jsonserialize.php
     * @return mixed data which can be serialized by <b>json_encode</b>,
     * which is a value of any type other than a resource.
     */
    public function jsonSerialize()
    {
        return [
            'type'    => $this->_type,
            'result'  => $this->result,
            'comment' => $this->comment
        ];
    }
} 