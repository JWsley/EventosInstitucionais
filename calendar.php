<?php


function eventSheet()
{
  $url = 'https://script.googleusercontent.com/a/macros/ifsuldeminas.edu.br/echo?user_content_key=qCcdmkhRBFjz8xo-H5qlUPTnBCDTeql2Hzhqf0i2G4F9d8mXcnK2oDkzswUms3hMxjTDGe0Ma357QuPkLXsfQoqALUYPGTYYOJmA1Yb3SEsKFZqtv3DaNYcMrmhZHmUMi80zadyHLKCjEak3mjNoJiXSRvGgDgtmtf450f6mFcuHwklkWyWOSDJZu-DkQFVxrrRhnSdGBKf9WFOmbg3LpT1J6vaJ71QqGDNs2YKChA92zhCJaP5YmvSh_C2I_zquSMSstdfO6boqsuGR6F-yhQ&lib=Ms0CmmrMR_PaYaKGVs8OTaxByP_xFMRvX';
  $response = file_get_contents($url);
  $data = json_decode($response);

  $eventos = array_map(function ($evento) {
    return array(
      'title' => $evento->nome,
      'start' => $evento->data,
      'end' => $evento->data,
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

  return json_encode($eventos);
};


?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>CALENDÁRIO</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="css/style.css">

</head>

<body>

  <script>
    
    document.addEventListener('DOMContentLoaded', function() {
      var eventos = <?php echo eventSheet() ?>;
      var today = new Date();



      var calendarEl = document.getElementById('calendar');

      var calendar = new FullCalendar.Calendar(calendarEl, {

      
     

        




        eventRender: function(info) {
          var eventText = info.event.title;
          if (eventText.length > 15) { 
            info.el.querySelector('.fc-title').innerHTML = eventText.substring(0, 1) + '<br>' + eventText.substring(10);
          }
        },
        
        themeSystem: 'bootstrap5',
        buttonText: {
          today: 'Hoje',
          month: 'Mês',
          week: 'Semana',
          day: 'Dia',
          list: 'Lista',
          prev: '<', 
          next: '>' 
        },
        buttonIcons: {
<<<<<<< HEAD
          prev: 'left', 
          next: 'right' 
=======
          prev: 'arrow-left-square-fill', // Ícone para a seta "prev"
          next: 'arrow-right-square-fill' // Ícone para a seta "next"
>>>>>>> 2c5fcc934e2c4dad54e2bf9241fa98f04d93cec9
        },
        eventColor: 'green',
        eventTextColor: 'white',
        headerToolbar: {
          left: 'prev,next,today',
          center: 'title',
          right: 'multiMonthYear,dayGridMonth,timeGridWeek,timeGridDay'
        },
        views: {
          listDay: {
            buttonText: 'list day'
          },
          listWeek: { 
            buttonText: 'list week'
          }
        },
        initialView: 'dayGridMonth',
        initialDate: today,
        navLinks: false,
        editable: false,
        locale: 'pt-br',
        dayHeaderFormat: {
          weekday: 'short'
        },
        dayMaxEvents: true,
        eventClick: function(info) {
          const modalTitle = document.getElementById('staticBackdropLabel');
          const modalBody = document.querySelector('.modal-body');

          // Atualize o título do modal com o título do evento
<<<<<<< HEAD
          modalTitle.textContent = info.event.title;


          const startTime = new Date(info.event.horario_inicio);
          const endTime = new Date(info.event.horario_fim);


          const starTime = startTime.toLocaleTimeString('pt-br', {
            hour: '2-digit',
            min: '2-digit'
          });
          const endtime = endTime.toLocaleTimeString('pt-br', {
            hour: '2-digit',
            min: '2-digit'
          });

          modalBody.innerHTML = `
    <p><strong>Descrição:</strong> ${info.event.extendedProps.description}</p>
    <p><strong>Local:</strong> ${info.event.extendedProps.local}</p>
    <p><strong>Horário de início:</strong> ${starTime}</p>
    <p><strong>Horário de fim:</strong> ${endtime}</p>
    <p><strong>Unidade:</strong> ${info.event.extendedProps.unidade}</p>
    <p><strong>Setor:</strong> ${info.event.extendedProps.setor}</p>
    <p><strong>Número:</strong> ${info.event.extendedProps.num}</p>
    <p><strong>Tipo:</strong> ${info.event.extendedProps.tipo}</p>
    <p><strong>Outros:</strong> ${info.event.extendedProps.outros}</p>
    <p><strong>Email:</strong> ${info.event.extendedProps.email}</p>
=======


          const startDateTime = new Date(info.event.start);
          const endDateTime = new Date(info.event.end);

          // Formatar a hora no formato "hora:minuto"

          // Função para formatar a hora no formato "hora:minuto"
          function formatTime(dateTime) {
            const hours = dateTime.getHours().toString().padStart(2, '0');
            const minutes = dateTime.getMinutes().toString().padStart(2, '0');
            return `${hours}:${minutes}`;
          }
          const startTime = formatTime(startDateTime);
          const endTime = formatTime(endDateTime);
          modalBody.innerHTML = `
                    <p><strong>Nome:</strong> ${info.event.title}</p>
                    <p><strong>DESCRIÇÃO GERAL DO EVENTO:</strong> ${info.event.extendedProps.description}</p>
                    <p><strong>Local:</strong> ${info.event.extendedProps.local}</p>
                    <p><strong>Horário de início:</strong> ${startTime}</p>
                    <p><strong>Horário de fim:</strong> ${endTime}</p>
                    <p><strong>Unidade:</strong> ${info.event.extendedProps.unidade}</p>
                    <p><strong>Setor:</strong> ${info.event.extendedProps.setor}</p>
                    <p><strong>Número:</strong> ${info.event.extendedProps.num}</p>
                    <p><strong>Tipo:</strong> ${info.event.extendedProps.tipo}</p>
                    <p><strong>Outros:</strong> ${info.event.extendedProps.outros}</p>
                    <p><strong>Email:</strong> ${info.event.extendedProps.email}</p>
>>>>>>> 2c5fcc934e2c4dad54e2bf9241fa98f04d93cec9
  `;

          const modalevent = new bootstrap.Modal(document.getElementById('modalevent'));
          modalevent.show();
        },


        events: eventos


        
      });

      calendar.render();
    });
   
    document.querySelectorAll('.fc-prev-button, .fc-next-button, .fc-today-button, .fc-dayGridMonth-button, .fc-timeGridWeek-button, .fc-timeGridDay-button, .fc-listWeek-button').forEach(function(button) {
    button.classList.remove('btn-primary'); // Remove a classe btn-primary
    button.classList.add('btn', 'btn-success'); // Adiciona a classe btn-success
  });

  </script>
  <header class="cabecalho">

    <div class="instituto">
      <img src="" alt="" class="logo">
    </div>


  </header>

  <div id="calendar"></div>


  <div class="modal fade" id="modalevent" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="staticBackdropLabel">DETALHES DO EVENTO</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
<<<<<<< HEAD
        <div class="modal-body">
          <span class="detail" id="nome"></span>
          <span class="detail" id="descrição"></span>

        </div>
        <div class="modal-footer">
          
=======
        <div class="modal-body"></div>
        <div class="modal-footer" style="background: green;">

>>>>>>> 2c5fcc934e2c4dad54e2bf9241fa98f04d93cec9
        </div>
      </div>
    </div>
  </div>





  <footer class="rodape">

    <div class="dev">
      <img src="" alt="" class="giticon">
    </div>
    <span class="devname"></span>



  </footer>



  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>

  <script src="./fullcalendar-6.1.10/packages/bootstrap5/index.global.min.js"></script>
  <script src="js/index.global.js"></script>

  <script src="js/core/locales/pt-br.global.min.js"></script>

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
</body>



</html>