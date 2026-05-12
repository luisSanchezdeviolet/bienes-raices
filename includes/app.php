<?php

require 'functions.php';
require 'config/database.php';
require __DIR__.'/../vendor/autoload.php';

//Conectarnos a la db
$db = dbConnect();

use App\Propertie;

Propertie::setDB($db);