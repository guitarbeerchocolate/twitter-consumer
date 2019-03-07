<?php
require_once 'twitter.class.php';

$account = 'guitarbeerchoco';
$hash = 'webpack';

if(isset($_GET['acc'])) $account = $_GET['acc'];
if(isset($_GET['hash'])) $hash = '#'.$_GET['hash'];

$t = new twitter($account);

foreach ($t->json as $item)
{
  if (strpos($item['text'], $hash) !== false) {
    echo '<p>'.$t->turnIntoLinks($item['text']).'</p>';
    echo '<p><small>On '.$t->getShorterDate($item['created_at']).'</small></p>';
    echo '<p><small>By '.$t->turnIntoLinks('@'.$item['user']['screen_name']).'</small></p>';
  }
}
?>
