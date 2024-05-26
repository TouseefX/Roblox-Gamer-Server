<?php
/**
 * ApiProxy text moderation endpoint
 * By genosmrpg7899 for frickinfire's Sodikm+
 */

// Define a variable for the text passed in POST data
$text = $_POST['text'] ?? '';

// Define the object returned as JSON for the chat filter
$data = new stdClass;

/**
 * In most cases, you won't actually have to implement this, but I'll set a head start
 * $data->white represents the chat filter for users over the age of 13
 * $data->black in data represents the chat filter for users under the age of 13
 */
$data->white = $text;
$data->black = $text;

// Return the object as JSON
die(json_encode(['data' => $data]));
?>