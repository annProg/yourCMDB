<?php
/********************************************************************
* This file is part of yourCMDB.
*
* Copyright 2013-2015 Michael Batz
*
*
* yourCMDB is free software: you can redistribute it and/or modify
* it under the terms of the GNU General Public License as published by
* the Free Software Foundation, either version 3 of the License, or
* (at your option) any later version.
*
* yourCMDB is distributed in the hope that it will be useful,
* but WITHOUT ANY WARRANTY; without even the implied warranty of
* MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
* GNU General Public License for more details.
*
* You should have received a copy of the GNU General Public License
* along with yourCMDB.  If not, see <http://www.gnu.org/licenses/>.
*
*********************************************************************/

/**
* definitions of useful functions for WebUI
* @author Michael Batz <michael@yourcmdb.org>
*/

/**
* gets an HTTP GET variable or returns a default value
*/
function getHttpGetVar($variableName, $defaultValue)
{
	if(isset($_GET["$variableName"]))
	{
		return $_GET["$variableName"];
	}
	else
	{
		return $defaultValue;
	}
}

/**
* gets an HTTP POST variable or returns a default value
*/
function getHttpPostVar($variableName, $defaultValue)
{
	if(isset($_POST["$variableName"]))
	{
		return $_POST["$variableName"];
	}
	else
	{
		return $defaultValue;
	}
}

/**
* Prints an info message
*/
function printInfoMessage($message)
{
	echo "<div class=\"alert alert-success alert-dismissbile\" role=\"alert\">";
	echo "<button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"".gettext("close")."\">";
	echo "<span aria-hidden=\"true\">&times;</span></button>";
	echo $message;
	echo "</div>";
}

/**
* Prints an error message
*/
function printErrorMessage($message)
{
	echo "<div class=\"alert alert-danger alert-dismissbile\" role=\"alert\">";
	echo "<button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"".gettext("close")."\">";
	echo "<span aria-hidden=\"true\">&times;</span></button>";
	echo $message;
	echo "</div>";
}

/**
 * check unique field(uniq field must be unique and not null)
 * @param string $type  object type
 * @param mixed[] $fields  array with  all fields of a object
 */
function checkUniqFields($type, $fields, $objectId=0)
{
	global $config, $objectController;
	//check unique field
	$uniq = $config->getObjectTypeConfig()->getUniqFields($type);
	$notUniq = false;
	$emptyFiled = false;
	foreach($uniq as $key => $value)
	{   
		if($fields[$key]=="")
		{
			$emptyFiled = true;
			break;
		}
		$objects = $objectController->getObjectsByField($key, $fields[$key], $type, null, 0, 0, '');
		foreach($objects as $k => $v)
		{
			//print_r(gettype($v));
			$id = $v -> getID();
			if($id == $objectId)
				unset($objects[$k]);
		}
		//die(print_r(json_encode($objects)));
		if(!empty($objects))
		{   
			$notUniq = true;
			break;
		}   
	}   

	//die(json_encode($notUniq));
	if($notUniq || $emptyFiled)
	{   
		return $key;
	}
	return false;
}


function checkRestUniqFields($requestData)
{
	$requestDataArray = json_decode($requestData, true);
	$objectType = $requestDataArray['objectType'];
	$objectFields = array();
	if(array_key_exists("objectId", $requestDataArray))
		$id = $requestDataArray['objectId'];
	else
		$id = 0;
	$fieldsAry = $requestDataArray['objectFields'];
	foreach($fieldsAry as $groupname => $groupvalue)
	{
		if(gettype($groupname) != "string")
			die("post data error");
		foreach($fieldsAry[$groupname] as $fieldkey => $fieldvalue)
		{
			$objectFields[$fieldvalue["name"]] = $fieldvalue["value"];
		}
	}	

	$key = checkUniqFields($objectType, $objectFields, $id);
	return $key;
}

?>
