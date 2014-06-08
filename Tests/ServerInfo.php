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
use Kadet\Xmpp\XmppClient;
use XmppTester\Result\InfoResult;
use XmppTester\Test\TestSuite;

class ServerInfo extends TestSuite {

    public function run(XmppClient $client)
    {
        $client->connect();
        $client->onReady->add([$this, '_onReady']);

        $result = json_decode(file_get_contents("http://freegeoip.net/json/{$client->jid->server}"));

        $this->results['country'] = new InfoResult($result->country_code);
        $this->results['ip']      = new InfoResult($result->ip);

        while($client->isConnected) {
            $client->read();
        }
    }

    /**
     * @param XmppClient $client
     */
    public function _onReady($client)
    {
        $client->version(new Address($client->jid->server), function ($response) use ($client) {
            $this->results["system"]   = new InfoResult($response->query->os);
            $this->results["version"]  = new InfoResult($response->query->version);
            $this->results["software"] = new InfoResult($response->query->name);

            $client->disconnect();
        });
    }
}