<?php

test('it validates request', function () {
    $response = $this->postJson(route('arca.account.debits'), []);
    $response->assertStatus(422);
    $response->assertJsonValidationErrors(['fromAccountNumber', 'amount', 'currency', 'toAccountNumber']);
});
