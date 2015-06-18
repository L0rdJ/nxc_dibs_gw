<?php
/**
 * @package nxcDIBS
 * @class   nxcDIBSRedirectGateway
 * @author  Serhey Dolgushev <serhey.dolgushev@nxc.no>
 * @date    25 Oct 2010
 **/

class nxcDIBSRedirectGateway extends eZRedirectGateway {

	const TYPE_DIBS = 'dibs';

	public function __construct() {
		$this->logger = eZPaymentLogger::CreateForAdd( 'var/log/dibsType.log' );
		$this->logger->writeTimedString( 'nxcDIBSRedirectGateway::__construct()' );
	}

	public function createPaymentObject( $processID, $orderID ) {
		$this->logger->writeTimedString( 'nxcDIBSRedirectGateway::createPaymentObject' );
        return eZPaymentObject::createNew( $processID, $orderID, self::TYPE_DIBS );
	}

	public function createRedirectionUrl( $process ) {
		$this->logger->writeTimedString( 'nxcDIBSRedirectGateway::createRedirectionUrl' );

		$processParams = $process->attribute( 'parameter_list' );
		$order = eZOrder::fetch( $processParams['order_id'] );

		$transaction = new nxcNetaxeptTransaction(
			array(
				'amount'     => $order->attribute( 'total_inc_vat' ) * 100,
				'order_id'   => $order->attribute( 'id' ),
				'order_text' => $this->createShortDescription( $order, 1500 ),
				'user_id'    => $order->attribute( 'user_id' )
			)
		);
		$transaction->store();

		$redirectURL = '/dibs/redirect/' . $transaction->attribute( 'id' );
		eZURI::transformURI( $redirectURL, false, 'full' );
		return $redirectURL;
	}
}
?>