function eventSheet(callback) {
  fetch('https://script.google.com/macros/s/AKfycbxsPUtmqIaj5GZkhT2vN3NPkZvSa1M7RDbLpfXyAN4MKLuFFHBOEpge2xlR7nbvYouFGQ/exec')
    .then(response => response.json())
    .then(data => {
      const eventos = data.output.map(evento => ({
        title: evento.nome,
        start: evento.data,
        end: evento.data,
        description: evento.desc,
        local: evento.local,
        horario_inicio: evento.horario_inicio,
        horario_fim: evento.horario_fim,
        unidade: evento.unidade,
        setor: evento.setor,
        num: evento.num,
        tipo: evento.tipo,    
        outros: evento.outros,
        email: evento.email
      }));

      callback(eventos);
      console.log(eventos);
    })
    .catch(error => {
      console.error('Erro ao obter os eventos', error);
      callback([]);
    });
}

document.addEventListener('DOMContentLoaded', function () {
  eventSheet(function (eventos) {
    var today = new Date();
    var prevClickedDay = null;

    var calendarEl = document.getElementById('calendar');

    var cabecalho = document.getElementById('cabecalho');
    var loader = document.getElementById('loader');
    var iflogo = document.getElementById('iflogo').style.display="block";
    loader.style.display = "none";
    cabecalho.style.display = "flex";
  
    var calendar = new FullCalendar.Calendar(calendarEl, {
      timeZone: 'America/Sao_Paulo',
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
        prev: 'left',
        next: 'right'
      },
      eventColor: 'green',
      eventTextColor: 'white',
      headerToolbar: {
        left: 'prev,next,today',
        center: 'title',
        right: 'multiMonthYear,dayGridMonth,timeGridWeek' 
      },
      views: {
        listDay: {
          buttonText: 'list day'
        },
        listWeek: {
          buttonText: 'list week'
        },
        multiMonthYear: {
          type: 'dayGrid',
          duration: {
            months: 12
          },
          eventTimeFormat: { 
            hour: '2-digit',
            minute: '2-digit',
            hour12: false 
          },
          slotLabelFormat: { 
            hour: '2-digit',  
            minute: '2-digit',
            hour12: false 
          },
          timeGrid: {
            slotLabelFormat: { hour: '1-digit', minute: '1-digit', omitZeroMinute: false, meridiem: 'short' }
          },
        
          buttonText: 'Ano'
        },
        validRange: function (nowDate) {
          var thisYear = nowDate.getFullYear();
          var minDate = new Date(thisYear, 0, 1);
          var maxDate = new Date(thisYear, 11, 31);

          return {
            start: minDate,
            end: maxDate
          };
        },
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
      dateClick: function (info) {
        if (prevClickedDay) {
          prevClickedDay.classList.remove('day-select');
        }
        info.dayEl.classList.add('day-select');
        prevClickedDay = info.dayEl;
        calendar.gotoDate(info.date);

      },

      eventClick: function (info) {
        const modalTitle = document.getElementById('staticBackdropLabel');
        const modalBody = document.querySelector('.modal-body');
        var urls = [
          'https://www.google.com/maps/search/?api=1&query=Instituto+Federal+de+Educação+Ciência+e+Tecnologia+do+Sul+de+Minas+Gerais+REITORIA',
          'https://www.google.com/maps/search/?api=1&query=Unidade+2',
          'https://www.google.com/maps/search/?api=1&query=Unidade+3',
        ];

        urls = urls.map(function (url) {
          return url.toLowerCase();
        });

        function getUrl(unidade) {
          console.log(unidade.toLowerCase().trim());
          let unidade_url = "";
          switch (unidade.toLowerCase().trim()) {

            case 'reitoria':
              unidade_url = 'https://www.google.com/maps/search/?api=1&query=Instituto+Federal+de+Educação+Ciência+e+Tecnologia+do+Sul+de+Minas+Gerais+REITORIA';
              break
            case 'carmo de minas':
              unidade_url = 'https://www.google.com/maps/search/?api=1&query=IFSULDEMINAS+-+Campus+Avançado+Carmo+de+Minas';
              break
            case 'inconfidentes':
              unidade_url = 'https://www.google.com/maps/search/?api=1&query=Instituto+Federal+do+Sul+de+Minas+Gerais+-+Campus+Inconfidentes';
              break
            case 'machado':
              unidade_url = 'https://www.google.com/maps/search/?api=1&query=IFSULDEMINAS+-+Campus+Machado';
              break
            case 'muzambinho':
              unidade_url = 'https://www.google.com/maps/search/?api=1&query=Instituto+Federal+de+Educação,+Ciência+e+Tecnologia+do+Sul+de+Minas+Gerais+-+Campus+Muzambinho';
              break
            case 'passos':
              unidade_url = 'https://www.google.com/maps/search/?api=1&query=IFSULDEMINAS+-+Campus+Passos';
              break
            case 'poços de caldas':
              unidade_url = 'https://www.google.com/maps/search/?api=1&query=IFSULDEMINAS+-+CAMPUS+POÇOS+DE+CALDAS';
              break
            case 'pouso alegre':
              unidade_url = 'https://www.google.com/maps/search/?api=1&query=Instituto+Federal+de+Educação,+Ciência+e+Tecnologia+do+Sul+de+Minas+-+Campus+Pouso+Alegre';
              break
            case 'três corações':
              unidade_url = 'https://www.google.com/maps/search/?api=1&query=IFSULDEMINAS+-+Campus+Avançado+Três+Corações';
              break


            default:
              console.log('teste')
          }

          return unidade_url;
        }
        function formatacao(arg, limite) {
          if (typeof arg !== 'string') {
            return '';
          }

          let formattedString = '';
          for (let i = 0; i < arg.length; i += limite) {
            formattedString += arg.substring(i, i + limite) + '\n';
          }
          return formattedString;
        }
        // var google_local = `https://www.google.com/maps/search/?api=1&query=${encodeURIComponent(info.event.extendedProps.local)}`;

        const content_title = formatacao(info.event.title, 30);


        modalTitle.innerHTML = String(content_title);

        const setor_responsavel_frmtd = formatacao(info.event.extendedProps.setor, 39);
        const local_frmtd = formatacao(info.event.extendedProps.local, 39);
        const unidade_frmtd = formatacao(info.event.extendedProps.unidade, 39);
        const num_frmtd = info.event.extendedProps.num;
        const tipo_frmtd = formatacao(info.event.extendedProps.tipo, 39);
        const outros_frmtd = formatacao(info.event.extendedProps.outros, 39);
        const email_frmtd = formatacao(info.event.extendedProps.email, 39);
        const desc_frmtd = formatacao(info.event.extendedProps.description.toString(), 39);
        console.log(info.event.extendedProps.horario_fim);



        var uni_url = getUrl(unidade_frmtd);
        console.log(desc_frmtd);
        console.log(uni_url);
        modalBody.innerHTML = `
        

<div class="conthr">

  <div class="img_cont"> <strong class="hour-title">Horários</strong><img class="icon_clock" src="assets/img/clock.png"></div>

  <div class="horario-container" >
  <strong style="color:#2b825d; margin:5px;">INICIO:</strong> ${info.event.extendedProps.horario_inicio}.
  <strong style="color:#2b825d; margin:5px;">FIM:</strong> ${info.event.extendedProps.horario_fim}.
  </div>
</div>

<span class="justify">
  <p><div class="iconarea"><img class="icon_ i" alt="icon_setor" src="assets/img/responsavel_icon.png"></div><strong>Setor/Responsavel:</strong> ${setor_responsavel_frmtd}
</span>
<span class="justify">
  <p><div class="iconarea"><img class="icon_unidade i" alt="icon_unidade" src="assets/img/unidade_icon.png"></div><strong>Unidade responsavel:</strong> <a id="unidade_resp" href="${uni_url}" class="anchor_decoration" target="_blank">${unidade_frmtd}</a>.</p>
</span>
<span class="justify">
  <p><div class="iconarea"><img class="icon_local i" alt="icon_local" src="assets/img/local_icon.png"></div><strong>Local do evento:</strong>${local_frmtd}.</p> 
</span>
<span class="justify">
  <p><div class="iconarea"><img class="icon_quantidade i" alt="icon_quantidade" src="assets/img/quantidade_icon.png"></div><strong>Quantidade de pessoas:</strong> ${num_frmtd}.</p>
</span>
<span class="justify">
  <p><div class="iconarea"><img class="icon_tipo i" alt="icon_tipo" src="assets/img/tipo_icon.png"></div><strong>Tipo:  </strong>${ console.log(tipo_frmtd),  tipo_frmtd.trim() === 'Outros' ? outros_frmtd : tipo_frmtd}.</p>
</span>
<span class="justify">
  <p><div class="iconarea"><img class="icon_email i" alt="icon_email" src="assets/img/email_icon.png"></div><strong>Email: </strong> <a class="anchor_decoration" style="cursor:pointer;" href="mailto:${email_frmtd}">${email_frmtd}</a>.</p>
</span>
<hr>
<strong style="color:#2b825d;border-bottom:2px solid #2b825d;">Descrição</strong>
<p>${desc_frmtd}.</p>
`;

        const modalevent = new bootstrap.Modal(document.getElementById('modalevent'));

        modalevent.show();
      },
      events: eventos
    });

    calendar.render();

    document.querySelectorAll('.fc-prev-button, .fc-next-button, .fc-today-button, .fc-dayGridMonth-button, .fc-timeGridWeek-button, .fc-timeGridDay-button, .fc-listWeek-button').forEach(function (button) {
      button.classList.remove('btn-primary');
      button.classList.add('btn', 'btn-success');
    });
  });
});








