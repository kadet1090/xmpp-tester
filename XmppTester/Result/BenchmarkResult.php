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

class BenchmarkResult extends Result
{
    use Property;

    protected $_type = 'benchmark';

    private $_results;

    public function append($result)
    {
        $this->_results[] = (float)$result;
    }

    public function _get_result()
    {
        return array_sum($this->_results) / count($this->_results);
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
            'max' => max($this->_results),
            'min' => min($this->_results)
        ]);
    }
}