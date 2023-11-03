<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once('../static.php');
require_once('../sql/createAccTable.php');
require_once('../sql/insertUser.php');
require_once('../sql/insertFriend.php');
require_once('../sql/selectMyFriendsTableName.php');
require_once('../sql/selectUser_id.php');
require_once('../sql/selectUser_id.php');
require_once('../php/rand.php');
require_once('../sql/selectFriends.php');
require_once('../sql/createChat.php');
require_once('../sql/selectMyChats.php');

createAccTable();
insertUser("user_a", "pass1");
insertUser("user_b", "pass1");
insertUser("user_c", "pass1");

$user_idA = selectUser_id("user_a");
$user_idB = selectUser_id("user_b");
$myFriendsTableName = selectMyFriendsTableName($user_idA); 
insertFriend($myFriendsTableName, $user_idB);
$friendsId = selectFriends($myFriendsTableName);
foreach($friendsId as $id){
    echo $id;
}

createChat("mychat1", $user_idA, $user_idB);
$chatsArr = selectMyChats($user_idA);
foreach($chatsArr as $yourChats){
    echo $yourChats;
}
?>
