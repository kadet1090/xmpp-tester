<?php
define("DEBUG_MODE", 2);
require 'vendor/autoload.php';

$tester = new XmppTester\ServerTester($argv[1]);
$tester->addTest(new Tests\ServerInfo());
$tester->addTest(new Tests\MessagingBenchmark());
$tester->doTests();
$tester->save();

