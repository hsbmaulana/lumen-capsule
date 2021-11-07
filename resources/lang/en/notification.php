<?php

return [

'activation' =>
[
    'title' => 'Your account has been activated successfully.',

    'mail' =>
    [
        'subject' => config('app.name') . ' - ' . 'Your Account Activation Information',
        'object' => 'This is a confirmation that your account (:id - :username) has been activated.',
    ]
],

'deactivation' =>
[
    'mail' =>
    [
        'subject' => config('app.name') . ' - ' . 'Your Account Deactivation Information',
        'object' => 'Your account is temporary in deactivate mode.',
    ]
],

];