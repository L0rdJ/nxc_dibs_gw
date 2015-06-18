<?php
/**
 * @package nxcDIBS
 * @author  Serhey Dolgushev <serhey.dolgushev@nxc.no>
 * @date    25 Oct 2010
 **/

eZPaymentGatewayType::registerGateway( nxcDIBSRedirectGateway::TYPE_DIBS, 'nxcDIBSRedirectGateway', 'DIBS' );
?>