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
* WebUI element: search form
* @author Michael Batz <michael@yourcmdb.org>
*/

	//ToDo: migrate to bootstrap
	//HTML output
	echo "<div class=\"searchbar\">";
	echo "<h1>";
	echo gettext("Search");
	echo "</h1>";
	echo "<form id=\"searchbarForm\" action=\"javascript:void(0);\" method=\"get\" accept-charset=\"UTF-8\" onsubmit=\"javascript:cmdbSearchbarSubmit('#searchbarForm','#searchbarResult')\">";


	//default  search field
	echo "<table id=\"searchbarOptions\">";
	echo "<tr>";
	echo "<td>".gettext("searchstring")."</td>";
	echo "<td><input type=\"text\" value=\"$paramSearchString\" name=\"searchstring\" id=\"searchbarSearchstring\" ";
	echo "			onfocus=\"javascript:showAutocompleter('#searchbarSearchstring', 'autocomplete.php?object=quicksearch')\"/></td>";
	echo "</tr>";
	//active objects
	echo "<tr>";
	echo "<td>".gettext("show inactive objects")."</td>";
	if($paramActiveOnly == "1")
	{
		echo "<td><input type=\"checkbox\" name=\"activeonly\" value=\"0\"/></td>";
	}
	else
	{
		echo "<td><input type=\"checkbox\" name=\"activeonly\" value=\"0\" checked=\"checked\" /></td>";
	}
	echo "</tr>";
	//objecttype group
	echo "<tr>";
	echo "<td>".gettext("objecttype group")."</td>";
	echo "<td><select name=\"typegroup\">";
	echo "<option></option>";
        foreach(array_keys($objectTypes) as $group)
        {
		if($paramTypeGroup == $group)
		{
                	echo "<option selected=\"selected\">$group</option>";
		}
		else
		{
                	echo "<option>$group</option>";
		}
        }
        echo "</select></td>";
	echo "</tr>";
	//objecttype
	echo "<tr>";
	echo "<td>".gettext("Type:")."</td>";
	echo "<td><select name=\"type\">";
	echo "<option></option>";
	foreach(array_keys($objectTypes) as $group)
	{
		echo "<optgroup label=\"$group\">";
		foreach($objectTypes[$group] as $type)
		{
			if($paramType == $type)
			{
				echo "<option selected=\"selected\">$type</option>";
			}
			else
			{
				echo "<option>$type</option>";
			}
		}
		echo "</optgroup>";
	}
	echo "</select></td>";
	echo "</tr>";
	echo "</table>";

	//searchform footer
	echo "<p id=\"searchbarFooter\">";
	echo "<input type=\"submit\" value=\"".gettext("Go")."\" />";
	echo "<input type=\"button\" value=\"".gettext("Clear Search")."\" onclick=\"javascript:cmdbSearchbarClear()\" />";
	echo "</p>";
	echo "</form>";
?>