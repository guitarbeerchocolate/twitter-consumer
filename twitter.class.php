<?php
class twitter
{
	private $settings, $url, $getfield, $requestMethod;
	public $json;
	function __construct($user = 'guitarbeerchoco')
	{
		require_once('TwitterAPIExchange.php');
		$this->settings = array('oauth_access_token'=>'YOUR_OAUTH_ACCESS_TOKEN','oauth_access_token_secret'=>'YOUR_OAUTH_ACCESS_TOKEN_SECRET','consumer_key'=>'YOUR_CONSUMER_KEY','consumer_secret'=>'YOUR_CONSUMER_SECRET');
		$this->url = 'https://api.twitter.com/1.1/statuses/user_timeline.json';
		$this->getfield = '?screen_name='.$user;
		$this->requestMethod = 'GET';
		$tweeter = new TwitterAPIExchange($this->settings);
		$this->json = json_decode($tweeter->setGetfield($this->getfield)->buildOauth($this->url, $this->requestMethod)->performRequest(),$assoc = TRUE);
	}

	public function turnIntoLinks($s)
	{
	    $words = explode(' ', $s);
	    foreach($words  as $key => $word)
	    {
	        if(0 === strpos($word, '@'))
	        {
	            $newString = '<a href="http://twitter.com/'.ltrim($word,'@').'" target="_blank">'.$word.'</a>';
	            $words[$key] = $newString;
	        }
	        elseif(0 === strpos($word, 'http'))
	        {
	            $newString = '<a href="'.$word.'" target="_blank">'.$word.'</a>';
	            $words[$key] = $newString;
	        }
	    }
	    $res = implode(' ',$words);
	    return $res;
	}

	public function getShorterDate($sDate)
	{
	    $expDate = explode(' ',$sDate);
	    $retDate = $expDate[0].' '.$expDate[1].' '.$expDate[2].' ';
	    $justMinutes = explode(':',$expDate[3]);
	    $retDate .= $justMinutes[0].':'.$justMinutes[1];
	    return $retDate;
	}

	function __destruct()
	{

	}
}
?>
