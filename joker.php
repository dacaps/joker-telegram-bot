<?php
/**
 * @package joker-telegram-bot
 * @author Sergei Miami <miami@blackcrystal.net>
 */

require 'autoload.php';

$bot = new Joker\Bot( getenv( 'TELEGRAM_TOKEN' ) );
$bot->plug([

  // something that must be executed everytime, must stay at top
  new Joker\Plugin\Log( ['file' =>'data/log/log.json'] ),

  // your plugins, order is important
  new Joker\Plugin\Temp( ['api_key' => getenv( 'OPENWEATHER_API_KEY' ),'default' => 'Tallinn'] ),
  new Joker\Plugin\Spotify( ['client_id' => getenv( 'SPOTIFY_CLIENT_ID' ),'secret' =>getenv( 'SPOTIFY_SECRET' )] ),
  new Joker\Plugin\Lurk(),
  new Joker\Plugin\Bash(),
  new Joker\Plugin\Cowsay( ['bg_color' =>'#222222','text_color' =>'#dadada']),
  new Joker\Plugin\Hello(),
  new Joker\Plugin\Sticker(),
  new Joker\Plugin\Quote( ['dir' =>'data/jokes'] ),
  new Joker\Plugin\Corona( ['file' => 'data/corona/today.csv', 'update_hours'=>3]),
  new Joker\Plugin\Currency(),

  new Joker\Plugin\Callback(['trigger'=>'callbacktest', 'callback' => function(Joker\Event $event){
    $event->answerMessage('test ok');
    return;
  }]),

  // somethingg wide, without triggers, must stay in the end
  new Joker\Plugin\Pasta( ['minimum_time' => 60 * 60] ),
  new Joker\Plugin\Beer( ['minimum_time'=>15*60] ),

]);

do { $bot->loop(); } while(true);