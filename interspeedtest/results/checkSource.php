<?php
// $ipFrom = array();
// if (($handle = fopen("CMUipaddress.csv", "r")) !== FALSE) {
//     while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
//         $a = array();
//         $num = count($data);
//         for ($c=0; $c < $num; $c++) {
//             array_push($a,$data[$c]);
//         }
//         array_push($ipFrom,$a);
//     }
//     fclose($handle);
// }
// print_r($ipFrom);
// echo $ipFrom[1][0];
// echo gettype((int)$ipFrom[1][5]);
// $x = $ipFrom[0][2];
// echo ip2long($x);
// echo count($ipFrom);

function checksource($ip){
    $ipFrom = array();
    if (($handle = fopen("CMUipaddress.csv", "r")) !== FALSE) {
        while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
            $a = array();
            $num = count($data);
            for ($c=0; $c < $num; $c++) {
                array_push($a,$data[$c]);
            }
            array_push($ipFrom,$a);
        }
        fclose($handle);
    }
    $nip = ip2long($ip);
    for($i=0; $i<count($ipFrom); $i++){
        if($nip>=(int)$ipFrom[$i][4]&&$nip<=(int)$ipFrom[$i][5]){
            return $ipFrom[$i][0];
        }
    }
    return "undefine";
}
?>