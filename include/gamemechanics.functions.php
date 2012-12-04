<?php

/**
 * Generates a random floating point number
 * @param int $intMin Minimum number
 * @param int $intMax Maximum number
 * @param int $intDecimals I don't know what this is. Number of decimals in the return value?
 * @return float
 */
function fprand($intMin,$intMax,$intDecimals) {
  if($intDecimals) {
        $intPowerTen=pow(10,$intDecimals);
        return rand($intMin,$intMax*$intPowerTen)/$intPowerTen;
  }
  else
        return rand($intMin,$intMax);
}

function fun_titlemessages(){
    $fpath = './include/titlequotes.txt';
    if (file_exists($fpath) ){
        $file = file($fpath);
        $rand = rand(0, (count($file)-1));
        return $file[$rand];
    }
    else {
        return 'Logic Errors are for chumps.';
    }
}

function enemyname(){
    $fpath = './include/enemynames.txt';
    if ( file_exists($fpath) ){
        $file = file($fpath);
        $rand = rand(0, (count($file)-1));
        return $file[$rand];
    }
    else {
        return "Leeroy Jenkins";
    }
}

?>
