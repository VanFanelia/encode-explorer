<?php
/***************************************************************************
 *
 * Encode Explorer
 *
 * Author : Marek Rei (marek ät marekrei dot com)
 * Version : 6.4.1
 * Homepage : encode-explorer.siineiolekala.net
 *
 * NB!:If you change anything, save with UTF-8! Otherwise you may
 *     encounter problems, especially when displaying images.
 *
 * Bootstrap version by VanFanel
 *
 ***************************************************************************/

/***************************************************************************/
/*   HERE ARE THE SETTINGS FOR CONFIGURATION                               */
/***************************************************************************/
$_CONFIG = array();
require_once('src/config.php');

/***************************************************************************/
/*   TRANSLATIONS.                                                         */
/***************************************************************************/
$_TRANSLATIONS = array();
require_once('src/language.php');

/***************************************************************************/
/*   Images (base64)                                                         */
/***************************************************************************/
$_IMAGES = array();
require_once('src/images.php');

/***************************************************************************/
/*   HERE COMES THE CODE.                                                  */
/*   DON'T CHANGE UNLESS YOU KNOW WHAT YOU ARE DOING ;)                    */
/***************************************************************************/
require_once('src/classes/Dir.class.php');
require_once('src/classes/EncodeExplorer.class.php');
require_once('src/classes/File.class.php');
require_once('src/classes/FileManager.class.php');
require_once('src/classes/GateKeeper.class.php');
require_once('src/classes/ImageServer.class.php');
require_once('src/classes/Location.class.php');
require_once('src/classes/Logger.class.php');

//
// This is where the system is activated.
// We check if the user wants an image and show it. If not, we show the explorer.
//
$encodeExplorer = new EncodeExplorer();
$encodeExplorer->init();

GateKeeper::init();

if(!ImageServer::showImage() && !Logger::logQuery())
{
	$location = new Location();
	$location->init();
	if(GateKeeper::isAccessAllowed())
	{
		Logger::logAccess($location->getDir(true, false, false, 0), true);
		$fileManager = new FileManager();
		$fileManager->run($location);
	}
	$encodeExplorer->run($location);
}
?>
