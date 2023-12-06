<?php 

  include('./js/coleta.php');


?>


<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>CALENDÁRIO</title>
  <link rel="stylesheet" href="css/style.css">
</head>


<script>

    document.addEventListener('DOMContentLoaded', function() {
      var calendarEl = document.getElementById('calendar');

      var calendar = new FullCalendar.Calendar(calendarEl, {
        headerToolbar: {
          left: 'prev,next today',
          center: 'title',
          right: 'dayGridMonth,timeGridWeek,timeGridDay'
        },
        initialDate: '2023-01-12',
        navLinks: true,
        selectable: true,
        selectMirror: true,
        locale: 'pt-br',
        events: {
          url: './js/coleta.php',
          method: 'GET'
        }
      });

      calendar.render();
    });
  </script>

<body>
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


<script src="js/script.js"></script>
<script src="js/core/index.global.min.js"></script>
<script src="js/index.global.min.js"></script>
<script src="js/core/locales/pt-br.global.min.js"></script>
</body>



</html>