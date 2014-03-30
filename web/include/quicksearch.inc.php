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
* WebUI element: quicksearch
* @author Michael Batz <michael@yourcmdb.org>
*/
?>
	<div class="box">
		<h1>Quicksearch</h1>
			<form action="object.php" method="get" accept-charset="UTF-8">
				<p>
					Asset ID:<br />
					<input type="text" name="id" />
					<input type="hidden" name="action" value="show" />
					<input type="submit" value="Go" />
				</p>
			</form>
			<form action="search.php" method="get" accept-charset="UTF-8">
				<p>
					Searchstring:<br />
					<input id="quicksearch" type="text" name="searchstring" onfocus="javascript:showAutocompleter('#quicksearch', 'autocomplete.php?object=quicksearch')" />
					<input type="submit" value="Go" />
				</p>
			</form>
	</div>