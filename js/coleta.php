<?php

function listar() {
  $url = 'https://sheetdb.io/api/v1/o66xzvvp9v2x9';
  $username = 'vypt00vc';
  $password = 'ldofh8p69yaput1cti9v';

  $ch = curl_init($url);
  curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
  curl_setopt($ch, CURLOPT_USERPWD, "$username:$password");
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

  $response = curl_exec($ch);
  if($response === false) {
    echo 'Erro: ' . curl_error($ch);
  } else {
    $data = json_decode($response, true);

    if ($data !== null) {
        $id = 1;
        foreach ($data as $evento) {
            echo "ID: " . $id . "<br>";
            echo "Nome do evento: " . $nome = $evento['NOME DO EVENTO'] . "<br>";
            echo "Data: " . $data = $evento['DATA'] . "<br>";
            echo "Horário de início: " . $horario_inicio = $evento['HORÁRIO - INICIO'] . "<br>";
            echo "Horário de término: " . $horario_fim =  $evento['HORÁRIO - FIM'] . "<br>";
            echo "Descrição: " . $desc = $evento['DESCRIÇÃO GERAL DO EVENTO'] . "<br>";
            echo "Unidade responsável: " . $unidade = $evento['UNIDADE RESPONSÁVEL PELO EVENTO'] . "<br>";
            echo "Número de participantes: " . $num = $evento['NÚMERO DE PARTICIPANTES'] . "<br>";
            echo "Local do evento: " . $local = $evento['LOCAL DO EVENTO'] . "<br>";
            echo "Tipo do evento: " . $tipo = $evento['TIPO DO EVENTO'] . "<br>";
            echo "Endereço de e-mail: " . $email = $evento['Endereço de e-mail'] . "<br>";
            
            $id++;

            $list_even[] = [
                'id' => $id,
                'title' => $nome,
                'start' => $horario_inicio,
                'end' => $horario_fim,
                'description' => "Descrição: " . $desc . "<br> ====================== <br> Unidade Responsável: ". $unidade . "<br> Número de participantes:" . $num . " | Tipo de evento:" . $tipo . "<br> Email:". $email . "<br>  Local:". $local
                




            ];
            echo json_encode($list_even);
            echo $list_even;
        }
    } else {
        echo "Erro ao decodificar JSON";
    }
  }




}


?>
