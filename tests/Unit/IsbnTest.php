<?php

use App\Rules\Isbn;

beforeEach(function(){
    $this->failMessage = '';
    $this->rule =  new Isbn();
});

test('Isbn rule succeeds with valid ISBN', function () {
    //example valid isbn copied from wikipedia
    $isbn = '978-3-16-148410-0';
    $this->rule->validate('isbn', $isbn, fn($message) => $this->failMessage = $message);
    expect($this->failMessage)->toBeEmpty();
});
test('Isbn rule fails with invalid length string', function(){
    $isbn = '00000';
    $this->rule->validate('isbn', $isbn, fn($message) => $this->failMessage = $message);
    expect($this->failMessage)->toEqual('The :attribute value must be exactly 10 or 13 characters');
});
test('Isbn rule fails with invalid characters', function(){
    $isbn = 'Abc1234534145';
    $this->rule->validate('isbn', $isbn, fn($message) => $this->failMessage = $message);
    expect($this->failMessage)->toEqual('The :attribute must only contain numbers and the - character');
});
