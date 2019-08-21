<?php

namespace Webham\Mirabot\Tests;

use Webham\Mirabot\Mirabot;
use Webham\Mirabot\QuestionResponses;
use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpFoundation\Request;

/**
 * 
 */
class MirabotTest extends TestCase {

    protected $chatbot;

    public function setUp()
    {
        $this->setOutputCallback(function() {});
    }

    /**
     * 
     */
    public function testSayingHi() {
        $this->messageRecieves('Hi');
        $this->assertReplay('I am Mira and I am a cat.');
    }

    public function testSayingHello() {
        $this->messageRecieves('Hello');
        $this->assertReplay('I am Mira and I am a cat.');
    }

    public function testSayingRandomCatNoise() {
        $this->messageRecieves('what cat say');
        $this->assertThat($this->getActualOutput(),
            $this->logicalOr(
                $this->stringContains('Meow'),
                $this->stringContains('Purr'),
                $this->stringContains('Mrr...'),
                $this->stringContains('Yowl')
            )
        );
    }

    public function testFallback() {
        $this->messageRecieves('Some random stuff');
        $this->assertReplay('Mau ?');
    }

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