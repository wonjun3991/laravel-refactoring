<?php

use function Pest\Laravel\get;

it('has users page', function () {
    get('/')->assertStatus(200);
});
