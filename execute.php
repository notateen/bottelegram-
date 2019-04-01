<?php
$content = file_get_contents("php://input");
$update = json_decode($content, true);

if(!$update)
{
  exit;
}

$message = isset($update['message']) ? $update['message'] : "";
$messageId = isset($message['message_id']) ? $message['message_id'] : "";
$chatId = isset($message['chat']['id']) ? $message['chat']['id'] : "";
$senderId = isset($message['chat']['id']) ? $message['chat']['id'] : "";
$firstname = isset($message['chat']['first_name']) ? $message['chat']['first_name'] : "";
$lastname = isset($message['chat']['last_name']) ? $message['chat']['last_name'] : "";
$username = isset($message['chat']['username']) ? $message['chat']['username'] : "";
$date = isset($message['date']) ? $message['date'] : "";
$text = isset($message['text']) ? $message['text'] : "";

$answers = array (
"L’unico capolavoro è vivere",
"Sei così bell* che fa male guardarti!",
"Sei sempre incantevole, e i tuoi sorrisi sono i più belli e dolci che abbia mai visto!",
"Sei una persona fantastica",
"Le prospettive sono buone",
"Andrà tutto per il meglio",
"La giornata prenderà una piega inaspettata",
"Mangia un gelato e tutto andrà per il meglio",
"",
"puoi farcela, sei una persona forte",
"Prenditi del tempo per te, te lo meriti"

);

header("Content-Type: application/json");
$answer = '';

// Verificare che l'ultimo carattere sia un punto di domanda
if(strlen($text)>0 && substr($text, -1, 1)=='?')
{
// Da qui mandi la risposta
$answer = $answers[rand(0, count($answers)-1)];
}
else 
{
// Da qui gli mandi "ehy fammi una domanda"
$answer = "Ciao $firstname, benvenuto!\n
Non ho capito, sono un po' bionda, quindi devi chiedermi: puoi rallegrarmi?\n";
}


$parameters = array('chat_id' => $chatId, "text" => $answer);
$parameters["method"] = "sendMessage";
echo json_encode($parameters);