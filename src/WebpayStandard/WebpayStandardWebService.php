<?php
namespace Freshwork\Transbank\WebpayStandard;

use Freshwork\Transbank\TransbankWebService;

/**
 * Class WebpayNormal
 * @package Freshwork\Transbank\WebpayNormal
 */
class WebpayStandardWebService extends TransbankWebService
{
    /**
     * Integration URL
     */
    const INTEGRATION_WSDL  = 'https://webpay3gint.transbank.cl/WSWebpayTransaction/cxf/WSWebpayService?wsdl';

    /**
     * Production URL
     */
    const PRODUCTION_WSDL   = 'https://webpay3g.transbank.cl/WSWebpayTransaction/cxf/WSWebpayService?wsdl';

    /**
     * @var array
     */
    protected static $classmap = [
        'getTransactionResult' => getTransactionResult::class,
        'getTransactionResultResponse' => getTransactionResultResponse::class,
        'transactionResultOutput' => transactionResultOutput::class,
        'cardDetail' => cardDetail::class,
        'wsTransactionDetailOutput' => wsTransactionDetailOutput::class,
        'wsTransactionDetail' => wsTransactionDetail::class,
        'acknowledgeTransaction' => acknowledgeTransaction::class,
        'acknowledgeTransactionResponse' => acknowledgeTransactionResponse::class,
        'initTransaction' => initTransaction::class,
        'wsInitTransactionInput' => wsInitTransactionInput::class,
        'wpmDetailInput' => wpmDetailInput::class,
        'initTransactionResponse' => initTransactionResponse::class,
        'wsInitTransactionOutput' => wsInitTransactionOutput::class
    ];

    /**
     * Método que permite iniciar una transacción de pago Webpay.
     *
     * @param wsInitTransactionInput $initTransactionInput
     * @return initTransactionResponse
     */
    function initTransaction(wsInitTransactionInput $initTransactionInput)
    {
        $initInscription = new initTransaction();
        $initInscription->wsInitTransactionInput = $initTransactionInput;

        return $this->callSoapMethod('initTransaction', $initInscription);
    }

    /**
     * Método que permite obtener el resultado de la transacción y los datos de la misma.
     *
     * @param string $token
     * @return getTransactionResultResponse
     */
    function getTransactionResult($token)
    {
        $getTransactionResult = new getTransactionResult();
        $getTransactionResult->tokenInput = $token;

        return $this->callSoapMethod('getTransactionResult', $getTransactionResult);
    }

    /**
     * Método que permite informar a Webpay la correcta recepción del resultado de la transacción.
     *
     * @param string $token
     * @return acknowledgeTransactionResponse
     */
    function acknowledgeTransaction($token)
    {
        $acknowledgeTransactionInput = new acknowledgeTransaction();
        $acknowledgeTransactionInput->tokenInput = $token;

        return $this->callSoapMethod('acknowledgeTransaction', $acknowledgeTransactionInput);
    }


    /**
     * Método para capturar el monto previamente autorizado.
     *
     * @param params con datos de autorización.
     * @return captureresponse
     */

    function initCaptureCall($params)
    {
        return $this->callSoapMethod('capture', $params);
    }


     /**
     * Método para anular el monto previamente autorizado.
     *
     * @param params con datos de autorización.
     * @return nullifyresponse
     */

     function initNullifyCall($params)
    {
        return $this->callSoapMethod('nullify', $params);
    }



}

?>