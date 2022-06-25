<?php
function create_response()
{
	$response = new stdClass;
	$response->success		= FALSE;
	$response->type_message = "error";
	$response->message 		= "Terjadi kejanggalan";
	$response->data 		= [];
	
	return $response;
}


function dd($value)
{
	echo "<pre>";
	print_r($value);
	echo "</pre>";
	die();
}
