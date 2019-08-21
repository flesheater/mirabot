<?php

namespace Webham\Mirabot;

use BotMan\BotMan\BotManFactory;
use BotMan\Drivers\Web\WebDriver;
use BotMan\BotMan\Drivers\DriverManager;
use BotMan\Drivers\Facebook\FacebookDriver;
use Symfony\Component\HttpFoundation\Request;

/**
 * The code for the bot.
 */
class Mirabot {

  private $botman;

  /**
   * Constructing.
   */
  public function __construct($config, $drivers, $request = '') {

    $this->loadNeededDrivers($drivers);

    $this->botman = BotManFactory::create(
      $config,
      NULL,
      !empty($request) ? $request : Request::createFromGlobals()
    );
  }

  /**
   * Main function for listening of the bot.
   */
  public function attachQuestionResponces() {

    $this->botman->hears('.*(\bHi\b|\bHello\b).*', "\Webham\Mirabot\QuestionResponses@sayHi");

    $this->botman->hears('what( the)? cat say\??', "\Webham\Mirabot\QuestionResponses@randomCatNoise");

    $this->botman->hears('.*(how are you|how r u).*', "\Webham\Mirabot\QuestionResponses@sayHowAreYou");

    $this->botman->hears('.*(want to play|wanna play)\??.*', "\Webham\Mirabot\QuestionResponses@sayWantToPlay");

    $this->botman->hears('who is a good cat\??', "\Webham\Mirabot\QuestionResponses@sayWhoIsAGoodCat");

    $this->botman->hears('ask me (a question|something)((,)? please)?', "\Webham\Mirabot\QuestionResponses@sayAskMeAQuestion");

    $this->botman->hears('left', "\Webham\Mirabot\QuestionResponses@goLeft");

    $this->botman->hears('right', "\Webham\Mirabot\QuestionResponses@goRight");

    $this->botman->fallback("\Webham\Mirabot\QuestionResponses@fallback");
  }

  protected function loadNeededDrivers($drivers) {
    if (in_array('web', $drivers)) {
      DriverManager::loadDriver(WebDriver::class);
    }
    
    if (in_array('fb', $drivers)) {
      DriverManager::loadDriver(FacebookDriver::class);
    }
  }

  public function listen() {
    $this->botman->listen();
  }

}
