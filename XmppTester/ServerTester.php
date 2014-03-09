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
 * From Kadet, with love.
 */

namespace XmppTester;

use Kadet\Utils\Event;
use Kadet\Xmpp\Jid;
use Kadet\Xmpp\XmppClient;
use XmppTester\Test\TestSuite;

class ServerTester {
    /**
     * @var TestSuite[]
     */
    private $_tests = [];

    private $_server;

    private $_username;
    private $_password;

    function __construct($server)
    {
        $this->_server = $server;

        $this->onLoginTestResult = new Event;

        if(file_exists('./Config/'.$this->_server.'.json')) {
            $config = json_decode(file_get_contents('./Config/'.$this->_server.'.json'));

            $this->_username = $config->username;
            $this->_password = $config->password;
        }
    }

    public function addTest(TestSuite $test)
    {
        $this->_tests[basename(get_class($test))] = $test;
    }

    public function doTests()
    {
        foreach($this->_tests as $test)
            $test->run(new XmppClient(new Jid($this->_server, $this->_username, 'xmpp-server-test'), $this->_password));
    }

    public function save() {
        file_put_contents('./Servers/'.$this->_server.'.json', json_encode([
            'server' => $this->_server,
            'date'   => time(),
            'tests'  => $this->_tests
        ], JSON_PRETTY_PRINT));
    }

    public function saveConfig() {
        file_put_contents('./Config/'.$this->_server.'.json', json_encode([
            'username' => $this->_username,
            'password' => $this->_password,
        ], JSON_PRETTY_PRINT));
    }
}