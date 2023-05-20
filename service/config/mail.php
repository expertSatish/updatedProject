<?php

return [

  'driver' => 'smtp',
  'host' => 'smtp.sendgrid.net',
  'port' => 587,
  'encryption' => 'tls',
  'username' =>'ictcircles@gmail.com',
  'password' => 'ICT@786#?',


  'stream' => [
      'ssl' => [
         'allow_self_signed' => true,
         'verify_peer' => false,
         'verify_peer_name' => false,
       ],
    ],

]


?>
