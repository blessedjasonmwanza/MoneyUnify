<?php

namespace Blessedjasonmwanza\MoneyUnify;

/**
 * Class MoneyUnify
 *
 * This class provides methods to interact with the Money Unify API for processing payments.
 */
class MoneyUnify {
    private const BASE_URL = 'https://api.moneyunify.com/v2';
    private string $muid; // The unique identifier for the Money Unify account
    private string $request_payment_url = self::BASE_URL."/request_payment"; // URL for payment requests
    private string $verify_payment_url = self::BASE_URL."/verify_transaction";
    public \stdClass $response; // Response object for API calls

    /**
     * MoneyUnify constructor.
     *
     * @param string $muid The unique identifier for the Money Unify account.
     */
    public function __construct(string $muid) {
        $this->muid = $muid;
        $this->response = new \stdClass();
    }

    /**
     * Requests a payment from the Money Unify API.
     *
     * @param string $payer_phone_number The phone number of the payer.
     * @param string $amount_to_pay The amount to be paid.
     * @return \stdClass Transaction details of the response from the API.
     */
    public function requestPayment(string $payer_phone_number, string $amount_to_pay): \stdClass {
        $body_fields = http_build_query([
            'muid' => $this->muid,
            'phone_number' => $payer_phone_number,
            'amount' => $amount_to_pay
        ]);

        $requestResponse = $this->urlRequest($this->request_payment_url, $body_fields);
        return $this->urlRequestResponse($requestResponse);
    }

    /**
     * verify and get payment details of a transaction.
     *
     * @param string $transaction_reference id of the transaction.
     * @return \stdClass transaction details the response from the API.
     */
    public function verifyPayment(string $transaction_reference): \stdClass{
        $body_fields = http_build_query([
            'muid' => $this->muid,
            'reference' => $transaction_reference,
        ]);

        $requestResponse = $this->urlRequest($this->verify_payment_url, $body_fields);
        return $this->urlRequestResponse($requestResponse);
    }

        /**
     * Settle current virtual account balance.
     * This will move all your collections to a specified account 
     * and zero your current balance (use with caution).
     *
     * @param array $params - An associative array containing the required parameters:
     *                       - 'moneyunify_email': Your MoneyUnify email associated with your MoneyUnify ID (muid).
     *                       - 'receiver_first_name': The first name of the receiver.
     *                       - 'receiver_last_name': The last name of the receiver.
     *                       - 'receiver_phone_number': The phone number of the receiver.
     *                       - 'transaction_details': Details about the transaction.
     * @return \stdClass transaction details of the response from the API.
     * @throws InvalidArgumentException if any required parameters are missing.
     */
    public function settleFunds(array $params): \stdClass {
        // Define the required parameters
        $requiredParams = ['moneyunify_email', 'receiver_first_name', 'receiver_last_name', 'receiver_phone_number', 'transaction_details'];

        // Check if all required parameters are present in $params
        $missingParams = array_diff($requiredParams, array_keys($params));
        if (!empty($missingParams)) {
            $this->response->message = 'Missing required parameter(s)';
            $this->response->console = $missingParams;
            $this->response->isError = true;
            return $this->response;
        }
        $body_fields = http_build_query([
            'muid' => $this->muid,
            'email' => $params['moneyunify_email'],
            'first_name' => $params['receiver_first_name'],
            'last_name' => $params['receiver_last_name'],
            'phone_number' => $params['receiver_phone_number'],
            'transaction_details' => $params['transaction_details']
        ]);

        $requestResponse = $this->urlRequest($this->verify_payment_url, $body_fields);
        return $this->urlRequestResponse($requestResponse);
    }

    /**
     * Processes the response from the API request.
     *
     * @param string $request The raw response from the API.
     * @return \stdClass The processed response with message, error status, and data if applicable.
     */
    private function urlRequestResponse(string $request): \stdClass {
        $req = json_decode($request);

        // Set response properties based on the API response
        $this->response->message = $req->message ?? 'No message returned.';
        $this->response->isError = $req->isError ?? true;

        if (!$this->response->isError) {
            $this->response->data = $req->data ?? null;
        } else {
            $this->response->console = $req->console ?? null;
        }

        return $this->response;
    }

    /**
     * Makes a URL request using cURL.
     *
     * @param string $url The URL to send the request to.
     * @param string|null $body_payload The payload to send with the request.
     * @return string The response from the cURL request, or an error message.
     */
    private function urlRequest(string $url, string $body_payload = null): string {
        $curl = curl_init();
        
        curl_setopt_array($curl, [
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => $body_payload,
            CURLOPT_HTTPHEADER => [],
        ]);

        $response = curl_exec($curl);
        $error = curl_error($curl);
        curl_close($curl);

        // Check if cURL request failed
        if ($response === false) {
            return json_encode([
                'message' => $error,
                'console' => null,
                'isError' => true
            ]);
        }

        return $response;
    }
}
