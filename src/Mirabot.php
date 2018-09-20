<?php

namespace Webham\Mirabot;

use BotMan\BotMan\BotMan;
use BotMan\BotMan\BotManFactory;
use BotMan\BotMan\Drivers\DriverManager;
use BotMan\Drivers\Web\WebDriver;
use BotMan\Drivers\Facebook\FacebookDriver;
use BotMan\Drivers\Facebook\Extensions\ButtonTemplate;
use BotMan\Drivers\Facebook\Extensions\ElementButton;

/**
 * The code for the bot.
 */
class Mirabot {

  private $config;
  private $botman;
  private $noises = ['Meow', 'Purr', 'Mrr...', 'Yowl'];

  /**
   * Constructing.
   */
  public function __construct($config) {
    // Loading Web and Facebook drivers.
    DriverManager::loadDriver(WebDriver::class);
    DriverManager::loadDriver(FacebookDriver::class);

    // Loading the configuration that we injeted and creating the factory.
    $this->config = $config;
    $this->botman = BotManFactory::create($this->config);
  }

  /**
   * Main function for listening of the bot.
   */
  public function listen() {

    $this->botman->hears('.*(\bHi\b|\bHello\b).*', function (BotMan $bot) {
       $bot->reply('Hi 🐈 I am Mira and I am a cat. Oh ... I mean ... mau ?');
    });

    $this->botman->hears('what( the)? cat say\??', function (BotMan $bot) {
       $bot->reply(
         $this->randomNoise()
       );
    });

    $this->botman->hears('.*(how are you|how r u).*', function (BotMan $bot) {
       $bot->reply('I am fine but I think I need a nap 😴 ');
    });

    $this->botman->hears('.*(want to play|wanna play)\??.*', function (BotMan $bot) {
       $bot->reply('Yes ... with 🐹 ... 😻 ');
    });

    $this->botman->hears('who is a good cat\??', function (BotMan $bot) {
       $bot->reply('me 🐈');
    });

    $this->botman->hears('ask me (a question|something)((,)? please)?', function (BotMan $bot) {
      $bot->reply(
        ButtonTemplate::create('Which way do you want to go?')
          ->addButton(ElementButton::create('Left')->type('postback')->payload('left'))
          ->addButton(ElementButton::create('Right')->type('postback')->payload('right'))
      );
    });

    $this->botman->hears('left', function (BotMan $bot) {
      $bot->reply('You went left :) ⬅️');
    });

    $this->botman->hears('right', function (BotMan $bot) {
      $bot->reply('You went right :) ➡️');
    });

    $this->botman->fallback(function ($bot) {
        $bot->reply('Mau ?');
    });

    // Start listening.
    $this->botman->listen();
  }

  /**
   * Random noise.
   */
  private function randomNoise() {
    return $this->noises[array_rand($this->noises)];
  }

}
