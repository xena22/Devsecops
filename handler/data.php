<?php

function valid_str($str)
{
	return $str;
}
function valid_int($int)
{
	if (!intval($int))
	{
		return false;
	}
	return $str;
}

function valid_email($str)
{
	if (!filter_var($str, FILTER_VALIDATE_EMAIL))
	{
		return false;
	}
	return $str;
}
function valid_password($str)
{
	return $str;
}