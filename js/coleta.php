<?php
// URL que contém o JSON
$url = 'https://script.googleusercontent.com/a/macros/ifsuldeminas.edu.br/echo?user_content_key=qCcdmkhRBFjz8xo-H5qlUPTnBCDTeql2Hzhqf0i2G4F9d8mXcnK2oDkzswUms3hMxjTDGe0Ma357QuPkLXsfQoqALUYPGTYYOJmA1Yb3SEsKFZqtv3DaNYcMrmhZHmUMi80zadyHLKCjEak3mjNoJiXSRvGgDgtmtf450f6mFcuHwklkWyWOSDJZu-DkQFVxrrRhnSdGBKf9WFOmbg3LpT1J6vaJ71QqGDNs2YKChA92zhCJaP5YmvSh_C2I_zquSMSstdfO6boqsuGR6F-yhQ&lib=Ms0CmmrMR_PaYaKGVs8OTaxByP_xFMRvX';


$jsonString = file_get_contents($url);


$array = json_decode($jsonString, true);


foreach ($array['output'] as $evento) {
  echo $evento['nome'] . "<br>";
  echo $evento['data'] . "<br>";
  echo $evento['desc'] . "<br> =========================== <br> start:" . $evento['horario_inicio']. "| End:". $evento['horario_fim']."<br> Unidade Responsavel:".$evento['unidade']."<br> Setor responsavel:".$evento['setor'].'<br> Local:'.$evento['local'].'Email:'.$evento['email'];

}
?>
