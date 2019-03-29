`<?php
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

$answers = array(
"Sei fantastica",
"Questa giornata andrà benissimo",
"Sarai radiosa",
"Che capelli fantastici oggi",
"Non ti preoccupare, andrà meglio",
"Sei sempre bellissima",
"Riuscirai a portare a termine i tuoi obiettivi",
"Non mollare",
"Sì",
"Ci puoi contare",
"Ce la puoi fare, ne sono certa"
);

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
$answer = "Per poterti rispondere, chiedimi di tirarti su il morale..";
}

header("Content-Type: application/json");
$parameters = array('chat_id' => $chatId, "text" => $answer);
$parameters["method"] = "sendMessage";
echo json_encode($parameters);`