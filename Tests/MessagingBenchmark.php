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

namespace Tests;


use Kadet\Xmpp\Address;
use Kadet\Xmpp\Jid;
use Kadet\Xmpp\XmppClient;
use XmppTester\Result\BenchmarkResult;
use XmppTester\Result\InfoResult;
use XmppTester\Test\TestSuite;

class MessagingBenchmark extends TestSuite {
    private $time;
    private $client;
    private $count = 0;

    public function run(XmppClient $client)
    {
        $this->client = $client;

        $this->client->connect();
        $this->client->onReady->add([$this, '_onReady']);

        $this->results["self"] = new BenchmarkResult();

        while($client->isConnected) { $client->read(); }

        return;
    }

    /**
     * @param XmppClient $client
     */
    public function _onReady($client)
    {
        for($i = 0; $i < 30; $i++) {
            usleep(500000);
            $start = microtime(true);
            $this->client->blockWait('message', $client->message($client->jid, 'test'), 5);
            $this->results['self']->append(microtime(true) - $start);
        }

        $client->disconnect();
    }


}