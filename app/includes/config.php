<?php

define("ROOT", str_replace("index.php", "", $_SERVER["SCRIPT_FILENAME"]));


const JWT_SECRET = "Kh8nFw86PCfLFCthB_c4jX7hdt9zKH.yuX7AsQpe";


const JWT_HEADER = ["typ" => "JWT", "alg" => "HS256"];


const CHAR_MIN = 8;


const UPPER_MIN = 1;


const LOWER_MIN = 1;


const SPE_CHAR_MIN = 1;

const NUM_MIN = 1;
