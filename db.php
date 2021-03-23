<?php


$db = new mysqli("localhost", "root", "chatbot");
if($db->connect_error) {
    die("Connection failed". $db->connect_error);
};

$result = array();
$message = isset($_POST['message']) ? $_POST['message'] : null;
$who = isset($_POST['who']) ? $_POST['who'] : null;

if(!empty($message) && !empty($who)) {
    $sql = "INSERT INTO `chat` (`message`,`who`) VALUES ('".$message."','".$who."')";
    $result['send_status'] = $db->query($sql);
};

//println
$start = isset($_GET['start']) ? intval($_GET['start']) : 0;
$items = $db->query("SELECT * FROM `chat` WHERE `id` > ".$start);
while($row = $items->fetch_assoc()) {
    $result['items'][] = $row;

}
$db->close();

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

echo json_encode($result);
