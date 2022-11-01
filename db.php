<?php
$req_to_db_map = array('twitter' => 'twitter', 'mastadon' => 'mastadon');
$instance = new mysqli( '127.0.0.1' , 'root' , '', 'whereaminow' );


/* check connection */
if (mysqli_connect_errno()) {
    printf("Connect failed: %s\n", mysqli_connect_error());
    exit();
}

$twitter_name = $_REQUEST[$req_to_db_map['twitter']];
$mastadon_name = $_REQUEST[$req_to_db_map['mastadon']];

$stmt = $instance->prepare('
INSERT into usernames 
    ( 
    twitter , 
    mastadon 
    ) 
values( ?, ?)');

$stmt->bind_param('ss', $twitter_name  , $mastadon_name );
$stmt->execute();
$output = array('db_response' => true);
if($instance->affected_rows < 1){
    $output['db_response'] = false;
}
echo json_encode($output);
?>

