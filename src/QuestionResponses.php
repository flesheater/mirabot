<?php

namespace Webham\Mirabot;

use BotMan\BotMan\BotMan;
use BotMan\Drivers\Facebook\Extensions\ElementButton;
use BotMan\Drivers\Facebook\Extensions\ButtonTemplate;

class QuestionResponses {
    
    const CAT_NOISES = ['Meow', 'Purr', 'Mrr...', 'Yowl'];

    public function sayHi(BotMan $bot) {
      $bot->reply('Hi 🐈 I am Mira and I am a cat. Oh ... I mean ... mau ?');
    }

    public function randomCatNoise(BotMan $bot) {
      $bot->randomReply(self::CAT_NOISES);
    }

    public function sayHowAreYou(BotMan $bot) {
      $bot->reply('I am fine but I think I need a nap 😴 ');
    }
    
    public function sayWantToPlay(BotMan $bot) {
      $bot->reply('Yes ... with 🐹 ... 😻 ');
    }
    
    public function sayWhoIsAGoodCat(BotMan $bot) {
      $bot->reply('me 🐈');
    }

    public function sayAskMeAQuestion(BotMan $bot) {
      $bot->reply(
        ButtonTemplate::create('Which way do you want to go?')
          ->addButton(ElementButton::create('Left')->type('postback')->payload('left'))
          ->addButton(ElementButton::create('Right')->type('postback')->payload('right'))
      );
    }

    public function goRight(BotMan $bot) {
      $bot->reply('You went right :) ➡️');
    }
    
    public function goLeft(BotMan $bot) {
      $bot->reply('You went left :) ⬅️');
    }

    public function fallback(BotMan $bot) {
      $bot->reply('Mau ?');
    }
}