<?php
/********************************************************************
* This file is part of yourCMDB.
*
* Copyright 2013-2014 Michael Batz
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
* Defines some helper functions for object section in WebUI
* @author Michael Batz <michael@yourcmdb.org>
*/

	/**
	* Creates the HTML element for a given datatype
	* @param $objectType	type of object (used for autocomplete functions)
	* @param $name		name of the field
	* @param $value		value of the field
	* @param $type		type of the field
	* @param $writable	true, if an edit view should be created
	*/
	function showFieldForDataType($objectType, $name, $value, $type, $writable=true)
	{
		switch($type)
		{
			case "boolean":
				showFieldForBoolean($name, $value, $writable);
				break;

			case "date":
				showFieldForDate($name, $value, $writable);
				break;

			case "text":
				showFieldForText($objectType, $name, $value, $writable);
				break;

			default:
				showFieldForText($objectType, $name, $value, $writable);
				break;
		}
	}

	function showFieldForText($objectType, $name, $value, $writable)
	{
		if($writable)
		{
			?>
				<input id="<?php echo $name; ?>" 
					type="text" 
					name="<?php echo $name; ?>" 
					value="<?php echo $value; ?>" 
					onfocus="javascript:showAutocompleter('#<?php echo $name; ?>', 'autocomplete.php?object=object&amp;var1=<?php echo $objectType;?>&amp;var2=<?php echo $name?>')" />
			<?php
		}
		else
		{
			echo $value;
		}
	}

	function showFieldForDate($name, $value, $writable)
	{
		if($writable)
		{
			?>
				<input id="<?php echo $name; ?>" 
					type="text" 
					name="<?php echo $name; ?>" 
					value="<?php echo $value; ?>" 
					onfocus="javascript:showDatepicker('#<?php echo $name; ?>')" />
			<?php
		}
		else
		{
			echo $value;
		}
	}

	function showFieldForBoolean($name, $value, $writable)
	{
		$checkboxString = "<input type=\"checkbox\" id=\"$name\" name=\"$name\" value=\"true\" ";
		if($value == "TRUE" || $value == "true" || $value == "1")
		{
			$checkboxString.= "checked=\"checked\" ";
		}
		if(!$writable)
		{
			$checkboxString.= "disabled=\"disabled\" ";
		}
		$checkboxString.= "/>";
		echo $checkboxString;
	}
?>
