<?php

test('the application returns a successful response', function () {
    // Use withoutVite() to prevent Vite manifest errors in tests
    $response = $this->withoutVite()->get('/');

    $response->assertStatus(200);
});
