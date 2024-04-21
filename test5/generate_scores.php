<?php
$participants = $_POST['participants'];
$participantsArray = explode(',', $participants);

$participantsData = [];
foreach ($participantsArray as $participant) {
    $points = mt_rand(1, 100);
    $participantsData[] = ['name' => trim($participant), 'points' => $points];
}

echo json_encode($participantsData);
