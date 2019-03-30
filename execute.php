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
"Per quanto posso vedere, sì",
"È certo",
"È decisamente così",
"Molto probabilmente",
"Le prospettive sono buone",
"I segni indicano di sì",
"Senza alcun dubbio",
"Sì",
"Sì",
"Ci puoi contare",
"È difficile rispondere, prova di nuovo",
"Rifai la domanda più tardi",
"Meglio non risponderti adesso",
"Non posso predirlo ora",
"Concentrati e rifai la domanda",
"Non ci contare",
"La mia risposta è no",
"Le mie fonti dicono di no",
"Le prospettive non sono buone",
"Molto incerto"
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
$answer = "Per poterti rispondere, mi devi fare una domanda...";
}


$parameters = array('chat_id' => $chatId, "text" => $answer);
$parameters["method"] = "sendMessage";
echo json_encode($parameters);