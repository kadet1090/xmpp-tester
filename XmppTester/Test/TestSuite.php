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

namespace XmppTester\Test;


use Kadet\Utils\Property;
use Kadet\Xmpp\XmppClient;
use XmppTester\Result\Result;
use XmppTester\Result\TestResult;

/**
 * Class TestSuite
 * @package XmppTester\Test
 *
 * @property-read int $max
 * @property-read int $score
 */
abstract class TestSuite implements \JsonSerializable
{
    use Property;

    /**
     * @var Result[]
     */
    private $results = [];

    public function _get_score() {
        $iterator = new \RecursiveIteratorIterator(new \RecursiveArrayIterator($this->results), \RecursiveIteratorIterator::SELF_FIRST);
        $result = null;
        foreach($iterator as $element)
            if($element instanceof TestResult)
                $result += $element->result;

        return $result;
    }

    public function _get_max() {
        $iterator = new \RecursiveIteratorIterator(new \RecursiveArrayIterator($this->results), \RecursiveIteratorIterator::SELF_FIRST);
        $result = null;
        foreach($iterator as $element)
            if($element instanceof TestResult)
                $result += $element->max;

        return $result;
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
        $result = [
            'results' => $this->results
        ];

        if($this->score !== null) {
            $result['score'] = $this->score;
            $result['max']   = $this->max;
        }
        
        return $result;
    }

    public abstract function run(XmppClient $client);
}