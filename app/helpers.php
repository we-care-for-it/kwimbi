<?php

 

    if (! function_exists('formatLicensePlate')) {
      

function formatLicensePlate($licensePlate) {

    $arrSC = array();
    $scUitz = '';
    $sideCode = 0;

    $licensePlate = strtoupper(str_replace('-','',$licensePlate));

    $arrSC[] = "/^[a-zA-Z]{2}[\\d]{2}[\\d]{2}$/";        // SideCode1    XX-99-99
    $arrSC[] = "/^[\\d]{2}[\\d]{2}[a-zA-Z]{2}$/";        // SideCode2    99-99-XX
    $arrSC[] = "/^[\\d]{2}[a-zA-Z]{2}[\\d]{2}$/";        // SideCode3    99-XX-99
    $arrSC[] = "/^[a-zA-Z]{2}[\\d]{2}[a-zA-Z]{2}$/";     // SideCode4    XX-99-XX
    $arrSC[] = "/^[a-zA-Z]{2}[a-zA-Z]{2}[\\d]{2}$/";     // SideCode5    XX-XX-99
    $arrSC[] = "/^[\\d]{2}[a-zA-Z]{2}[a-zA-Z]{2}$/";     // SideCode6    99-XX-XX
    $arrSC[] = "/^[\\d]{2}[a-zA-Z]{3}[\\d]{1}$/";        // SideCode7    99-XXX-9
    $arrSC[] = "/^[\\d]{1}[a-zA-Z]{3}[\\d]{2}$/";        // SideCode8    9-XXX-99
    $arrSC[] = "/^[a-zA-Z]{2}[\\d]{3}[a-zA-Z]{1}$/";     // SideCode9    XX-999-X
    $arrSC[] = "/^[a-zA-Z]{1}[\\d]{3}[a-zA-Z]{2}$/";     // SideCode10   X-999-XX
    $arrSC[] = "/^[a-zA-Z]{3}[\\d]{2}[a-zA-Z]{1}$/";     // SideCode11   XXX-99-X
    $arrSC[] = "/^[a-zA-Z]{1}[\\d]{2}[a-zA-Z]{3}$/";     // SideCode12   X-99-XXX
    $arrSC[] = "/^[\\d]{1}[a-zA-Z]{2}[\\d]{3}$/";        // SideCode13   9-XX-999
    $arrSC[] = "/^[\\d]{3}[a-zA-Z]{2}[\\d]{1}$/";        // SideCode14   999-XX-9

    //except licenseplates for diplomats
    $scUitz = '/^CD[ABFJNST][0-9]{1,3}$/';              //for example: CDB1 of CDJ45

    for($i=0; $i < count($arrSC); $i++){
      if (preg_match($arrSC[$i], $licensePlate)) {
      $sideCode = $i+1;
        //     echo  $sideCode;
       }
    }
     if (preg_match($scUitz, $licensePlate)) {
     $sideCode = 'CD';
    //     echo  $sideCode;
  }

    if ($sideCode <= 6) {
        return substr($licensePlate, 0, 2) . '-' . substr($licensePlate, 2, 2) . '-' . substr($licensePlate, 4, 2);
    }
    if ($sideCode == 7 || $sideCode == 9) {
        return substr($licensePlate, 0, 2) . '-' . substr($licensePlate, 2, 3) . '-' . substr($licensePlate, 5, 1);
    }
    if ($sideCode == 8 || $sideCode == 10) {
        return substr($licensePlate, 0, 1) . '-' . substr($licensePlate, 1, 3) . '-' . substr($licensePlate, 4, 2);
    }
    if ($sideCode == 11 || $sideCode == 13) {
        return substr($licensePlate, 0, 2) . '-' . substr($licensePlate, 2, 3) . '-' . substr($licensePlate, 5, 1);
    }
    if ($sideCode == 12 || $sideCode == 14) {
        return substr($licensePlate, 0, 1) . '-' . substr($licensePlate, 1, 3) . '-' . substr($licensePlate, 4, 2);
    }
    return $licensePlate;

}
    }

 