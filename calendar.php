<?php


  function eventSheet(){
    $url = 'https://script.googleusercontent.com/a/macros/ifsuldeminas.edu.br/echo?user_content_key=qCcdmkhRBFjz8xo-H5qlUPTnBCDTeql2Hzhqf0i2G4F9d8mXcnK2oDkzswUms3hMxjTDGe0Ma357QuPkLXsfQoqALUYPGTYYOJmA1Yb3SEsKFZqtv3DaNYcMrmhZHmUMi80zadyHLKCjEak3mjNoJiXSRvGgDgtmtf450f6mFcuHwklkWyWOSDJZu-DkQFVxrrRhnSdGBKf9WFOmbg3LpT1J6vaJ71QqGDNs2YKChA92zhCJaP5YmvSh_C2I_zquSMSstdfO6boqsuGR6F-yhQ&lib=Ms0CmmrMR_PaYaKGVs8OTaxByP_xFMRvX';
    $response = file_get_contents($url);
    $data = json_decode($response);
  
    $eventos = array_map(function($evento) {
      return array(
         'title' => $evento->nome,
         'start' => date('c', strtotime($evento->data)),
         'end' => date('c', strtotime($evento->data)),
         'description' => $evento->desc,
         'local' => $evento->local,
         'horario_inicio' => $evento->horario_inicio,
         'horario_fim' => $evento->horario_fim,
         'unidade' => $evento->unidade,
         'setor' => $evento->setor,
         'num' => $evento->num,
         'tipo' => $evento->tipo,
         'outros' => $evento->outros,
         'email' => $evento->email,
      );
    }, $data->output);
  
    return $eventos_json = json_encode($eventos);
  

  };
 



?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>CALENDÁRIO</title>
  <link rel="stylesheet" href="css/style.css">
  
</head>

<body>

<script>
    document.addEventListener('DOMContentLoaded', function() {
      var eventos = <?php echo eventSheet() ?>;

      var calendarEl = document.getElementById('calendar');

      var calendar = new FullCalendar.Calendar(calendarEl, {
        themeSystem: 'slate', 
          buttonText: {
            today: 'Hoje',
            month: 'Mês',
            week: 'Semana',
            day: 'Dia',
            list: 'Lista'
          }, 
          eventColor: 'green',
          eventTextColor: 'whtie', 
          headerToolbar: {
            left: 'prev,next today',
            center: 'title',
            right: 'dayGridMonth,timeGridWeek,timeGridDay,listWeek'
          },
        views: {
          listDay: { buttonText: 'list day' },
          listWeek: { buttonText: 'list week' }
        },  
        initialView: 'dayGridMonth',
        initialDate: '2023-01-12',
        navLinks: true,
        editable: false,
        locale: 'pt-br',
        dayHeaderFormat: { weekday: 'short', day: 'numeric', month: 'numeric' },
        dayMaxEvents: true,
        eventClick: function(info) {
          alert('Descrição: ' + info.event.extendedProps.description + info.event.extendedProps.start + info.event.extendedProps.end); // Exibe a descrição ao clicar no evento
        },
        events: eventos
      });

      calendar.render();
    });
  </script>
<header class="cabecalho">

    <div class="instituto">
      <img src="" alt="" class="logo">
    </div>


</header>
  



  <div id="calendar"></div>


<footer class="rodape">

  <div class="dev">
    <img src="" alt="" class="giticon">
  </div>
  <span class="devname"></span>



</footer>



<script src="js/core/index.global.min.js"></script>
<script src="js/index.global.min.js"></script>
<script src="js/core/locales/pt-br.global.min.js"></script>
</body>



</html>