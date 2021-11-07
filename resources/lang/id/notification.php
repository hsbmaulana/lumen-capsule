<?php

return [

'activation' =>
[
    'title' => 'Akun anda telah berhasil diaktifkan.',

    'mail' =>
    [
        'subject' => config('app.name') . ' - ' . 'Informasi Aktivasi Akun Anda',
        'object' => 'Ini adalah sebuah informasi bahwa akun anda (:id - :username) telah berhasil diaktifkan.',
    ]
],

'deactivation' =>
[
    'mail' =>
    [
        'subject' => config('app.name') . ' - ' . 'Informasi Deaktivasi Akun Anda',
        'object' => 'Akun anda sementara dalam mode deaktivasi.',
    ]
],

];