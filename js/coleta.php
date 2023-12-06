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
        $list_event = array(); // Inicialize o array fora do loop

        foreach ($data as $evento) {
            $id = 1;
            $nome = $evento['NOME DO EVENTO'];
            $horario_inicio = $evento['HORÁRIO - INICIO'];
            $horario_fim = $evento['HORÁRIO - FIM'];
            $desc = $evento['DESCRIÇÃO GERAL DO EVENTO'];
            $unidade = $evento['UNIDADE RESPONSÁVEL PELO EVENTO'];
            $num = $evento['NÚMERO DE PARTICIPANTES'];
            $local = $evento['LOCAL DO EVENTO'];
            $tipo = $evento['TIPO DO EVENTO'];
            $email = $evento['Endereço de e-mail'];

            $list_even[] = [
                'id' => $id,
                'title' => $nome,
                'start' => $horario_inicio,
                'end' => $horario_fim,  
                'description' => "Descrição: " . $desc . "<br> ====================== <br> Unidade Responsável: ". $unidade . "<br> Número de participantes:" . $num . " | Tipo de evento:" . $tipo . "<br> Email:". $email . "<br>  Local:". $local
            ];
        }

         echo json_encode($list_even); // Envie o JSON uma vez, fora do loop
    } else {
        echo "Erro ao decodificar JSON";
    }
  }
}

listar();

?>
