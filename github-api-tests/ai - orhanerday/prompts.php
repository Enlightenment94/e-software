<?php
function defaultPrompt($api, $languageName){
  $open_ai = new OpenAi($api);
  
  $languageName = "Polish";
  $content = "Here prompt";

  $chat = $open_ai->chat([
    'model' => 'gpt-3.5-turbo',
    'messages' => [
        [
            "role" => "system",
            "content" => $content
        ],
    ],
    'temperature' => 1.0,
    'max_tokens' => 200,
    'frequency_penalty' => 0,
    'presence_penalty' => 0,
  ]);

  // decode response
  $d = json_decode($chat);
  return $d->choices[0]->message->content;
}
?>