<?php
/**
 * Copyright (C) 2014, Some right reserved.
 * @author  Kacper "Kadet" Donat <kadet1090@gmail.com>
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

/**
 * Class TestResult
 * @package XmppTester\Result
 *
 * @property-read int $max
 */
class TestResult extends Result
{
    use Property;

    protected $_type = 'test';

    private $_score;
    private $_max;

    public function _get_result()
    {
        return $this->_score;
    }

    public function _get_max()
    {
        return $this->_max;
    }

    public function set($score)
    {
        $this->_score = floatval($score) > $this->_max ? $this->_max : floatval($score);
    }

    public function add($points)
    {
        $this->set($this->_score + $points);
    }

    function __construct($max, $score = 0)
    {
        $this->_max   = $max;
        $this->_score = $score;
    }


    /**
     * (PHP 5 &gt;= 5.4.0)<br/>
     * Specify data which should be serialized to JSON
     * @link http://php.net/manual/en/jsonserializable.jsonserialize.php
     * @return mixed data which can be serialized by <b>json_encode</b>,
     * which is a value of any type other than a resource.
     */
    public function jsonSerialize()
    {
        return array_merge(parent::jsonSerialize(), [
            'max' => $this->_max
        ]);
    }
}