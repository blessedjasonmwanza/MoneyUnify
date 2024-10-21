<?php

use Blessedjasonmwanza\MoneyUnify\MoneyUnify;

require 'vendor/autoload.php';

describe('Expect verifyPayment feature to work properly', function () {
    $muid = '123'; // Presumably invalid muid for testing
    $moneyUnify = new MoneyUnify ($muid);
    $requestToPay = $moneyUnify->verifyPayment('0975555555_1713447717');

    // Test if the result is a valid object
    it('is a valid object', function () use ($requestToPay) {
        expect($requestToPay)->toBeObject(); // Ensure the response is an object
    });

    // Test if the object has required properties
    it('has message and isError properties', function () use ($requestToPay) {
        expect($requestToPay)->toHaveProperty('message'); // Checks if 'message' exists
        expect($requestToPay)->toHaveProperty('isError'); // Checks if 'isError' exists
    });

    // Test for invalid muid resulting in isError being true
    it('isError property is true due to invalid muid', function () use ($requestToPay) {
        expect($requestToPay->isError)->toBeTrue(); // As the muid is invalid, isError should be true
    });

    // Test if the 'console' property is present in case of an error
    it('has console property due to invalid muid', function () use ($requestToPay) {
        expect($requestToPay)->toHaveProperty('console'); // Error responses typically include console data
    });
});
