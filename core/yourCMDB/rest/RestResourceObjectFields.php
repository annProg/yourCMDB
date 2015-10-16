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
namespace yourCMDB\rest;

use yourCMDB\config\CmdbConfig;
use yourCMDB\exceptions\CmdbObjectNotFoundException;
use \Exception;

/**
* REST resource for a objectFields config
*
* usage:
* /rest.php/objectfields/<type>
* - GET 	/rest.php/objectfields/<type>
*
* @author An He <me@annhe.net>
*/
class RestResourceObjectFields extends RestResource
{

	public function getResource()
	{
		$config = CmdbConfig::create();

		//try to get object and generate output
		try
		{
			$objectType = $this->uri[1];
			@$output = $config->getObjectTypeConfig()->getFields($objectType);
			if(empty($output))
				return new RestResponse(404);
		}
		catch(CmdbObjectNotFoundException $e)
		{
			return new RestResponse(404);
		}
		return new RestResponse(200, json_encode($output));
	}
}
?>
