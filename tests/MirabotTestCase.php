<?php

namespace Webham\Mirabot\Tests;

use Webham\Mirabot\Mirabot;
use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpFoundation\Request;

/**
 * Our version of the PHPUnit test case class.
 */
class MirabotTestCase extends TestCase {

    protected function messageRecieves(String $message) {
        $request = Request::create(
            '/',
            'POST',
            ['message' => $message]
          );

        $chatbot = new Mirabot([], ['web'], $request);
        $chatbot->attachQuestionResponces();
        $chatbot->listen();
        return $chatbot;
    }

    protected function assertReplay($expectedReplay) {
        $this->assertContains(
            $expectedReplay,
            $this->getActualOutput()
        );
    }
}