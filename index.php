<?php
//Include https://github.com/milo/github-api
include('src/github-api.php');
use Milo\Github;
$api = new Github\Api;
if ($_GET['id'])
{
	$response = $api->get('/gists/' . $_GET['id']);
	try 
	{
		$gist = $api->decode($response);
	}
	catch(Exception $e) 
	{
  		if ($e->getMessage()=="Resource not found or not authorized to access.")
  		{
  			echo "Gist not found!";
  		}
  		else
  		{
  			echo "Unknown Error";
  		}
  		return;
	}
	if ($response)
	{
		foreach($gist->files as $key => $value)
		{
			echo "<code>";
			print_r(nl2br(htmlspecialchars($value->content)));
			echo "</code>";
		}
	}
}
else
{
	echo "Use /id to display gist.";
}
?>