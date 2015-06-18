<?php
/**
 * @package nxcDIBS
 * @author  Serhey Dolgushev <serhey.dolgushev@nxc.no>
 * @date    25 Oct 2010
 **/

class nxc_dibs_gwSettings extends nxcExtensionSettings {

	public $defaultOrder = 25;
	public $dependencies = array( 'nxc_dibs' );

	public function activate() {}

	public function deactivate() {}
}
?>