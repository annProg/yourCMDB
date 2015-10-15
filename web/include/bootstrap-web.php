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
* yourCMDB bootstrap for WebUI
* must be included
* @author Michael Batz <michael@yourcmdb.org>
*/

//imports
use yourCMDB\config\CmdbConfig;
use yourCMDB\controller\AccessGroupController;
use yourCMDB\controller\ObjectController;
use yourCMDB\controller\ObjectLinkController;
use yourCMDB\controller\ObjectLogController;
use yourCMDB\security\AuthorisationProviderLocal;
use yourCMDB\taskscheduler\EventProcessor;
use yourCMDB\info\InfoController;

//define base directories
$webScriptBaseDir = dirname(__FILE__);
$coreBaseDir = realpath("$webScriptBaseDir/../../core");

//include yourCMDB bootstrap
include "$coreBaseDir/bootstrap.php";

//include function definitions
include "functions.inc.php";

//define variables
$config = CmdbConfig::create();
$accessGroupController = AccessGroupController::create();
$objectController = ObjectController::create();
$objectLinkController = ObjectLinkController::create();
$objectLogController = ObjectLogController::create();
$authorisationProvider = new AuthorisationProviderLocal();
$eventProcessor = new EventProcessor();
$infoController = new InfoController();

//set default values of some variables
$authUser = "";

//get configuration
$installTitle = $config->getViewConfig()->getInstallTitle();
$baseUrl = $config->getViewConfig()->getBaseUrl();

//setup i18n with gettext
$i18nLocale = $config->getViewConfig()->getLocale();
$i18nDomain = "web";
$i18nCodeset = "utf-8";
$i18nBaseDir = realpath("$webScriptBaseDir/../../i18n");

setlocale(LC_ALL, $i18nLocale);
bindtextdomain($i18nDomain, $i18nBaseDir);
bind_textdomain_codeset($i18nDomain, $i18nCodeset);
textdomain($i18nDomain);


?>
