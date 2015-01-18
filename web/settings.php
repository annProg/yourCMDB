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

	//get header
	include "include/base.inc.php";
	include "include/auth.inc.php";
	include "include/htmlheader.inc.php";
	include "include/yourcmdbheader.inc.php";

	//<!-- title -->
	echo "<h1>".gettext("User settings")."</h1>";

	//<!-- start tabs -->
	echo "<div id=\"jsAccordion\">";

	//tab: change password
	echo "<h3>".gettext("user details")."</h3>";
	echo "<div id=\"settingsTabUserDetails\">";
	echo "<script language=\"JavaScript\">";
	echo "openUrlAjax('settings/UserDetails.php?', '#settingsTabUserDetails', false, true);";
	echo "</script>";
	echo "</div>";

	//<!-- end tabs -->
	echo "</div>";


	//include footer
	include "include/yourcmdbfooter.inc.php";
	include "include/htmlfooter.inc.php";
?>
