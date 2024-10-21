<?php

use Blessedjasonmwanza\MoneyUnify\MoneyUnify;

require 'vendor/autoload.php';

describe('Expect settle funds feature to work properly', function () {
    $muid = '123'; // Presumably invalid muid for testing
    $moneyUnify = new MoneyUnify($muid);

    // Define valid parameters for the settleFunds method
    $validParams = [
        'moneyunify_email' => 'test@example.com',
        'receiver_first_name' => 'John',
        'receiver_last_name' => 'Doe',
        'receiver_phone_number' => '0975555555',
        'transaction_details' => 'Settlement of funds.'
    ];

    // Test if the settleFunds method returns a valid object
    it('returns a valid object', function () use ($moneyUnify, $validParams) {
        $response = $moneyUnify->settleFunds($validParams);
        expect($response)->toBeObject(); // Ensure the response is an object
    });

    // Test if the object has required properties
    it('has message and isError properties', function () use ($moneyUnify, $validParams) {
        $response = $moneyUnify->settleFunds($validParams);
        expect($response)->toHaveProperty('message'); // Checks if 'message' exists
        expect($response)->toHaveProperty('isError'); // Checks if 'isError' exists
    });

    // Test for missing required parameters
    it('returns error for missing parameters', function () use ($moneyUnify) {
        $response = $moneyUnify->settleFunds([]); // No parameters passed
        expect($response->isError)->toBeTrue(); // Should return an error
        expect($response->message)->toEqual('Missing required parameter(s)'); // Should specify missing params
        expect($response)->toHaveProperty('console'); // Error responses should include console data
    });

    // Test with incomplete parameters
    it('returns error for incomplete parameters', function () use ($moneyUnify) {
        $response = $moneyUnify->settleFunds([
            'moneyunify_email' => 'test@example.com',
            // Missing other parameters...
        ]);
        expect($response->isError)->toBeTrue(); // Should return an error
        expect($response->message)->toEqual('Missing required parameter(s)'); // Should specify missing params
    });
});
