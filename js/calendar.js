function eventSheet(callback) {
    fetch('https://script.googleusercontent.com/a/macros/ifsuldeminas.edu.br/echo?user_content_key=qCcdmkhRBFjz8xo-H5qlUPTnBCDTeql2Hzhqf0i2G4F9d8mXcnK2oDkzswUms3hMxjTDGe0Ma357QuPkLXsfQoqALUYPGTYYOJmA1Yb3SEsKFZqtv3DaNYcMrmhZHmUMi80zadyHLKCjEak3mjNoJiXSRvGgDgtmtf450f6mFcuHwklkWyWOSDJZu-DkQFVxrrRhnSdGBKf9WFOmbg3LpT1J6vaJ71QqGDNs2YKChA92zhCJaP5YmvSh_C2I_zquSMSstdfO6boqsuGR6F-yhQ&lib=Ms0CmmrMR_PaYaKGVs8OTaxByP_xFMRvX')
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

      var calendar = new FullCalendar.Calendar(calendarEl, {
        eventRender: function (info) {
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
          prev: 'left',
          next: 'right'
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
          },
          multiMonthYear: {
            type: 'dayGrid',
            duration: {
              months: 12
            },
            buttonText: 'Ano'
          },
          validRange: function (nowDate) {
            var thisYear = nowDate.getFullYear();
            return {
              start: thisYear + '-01-01',
              end: thisYear + '-12-31'
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
        },
        eventClick: function (info) {
          const modalTitle = document.getElementById('staticBackdropLabel');
          const modalBody = document.querySelector('.modal-body');

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


          var google_local = `https://www.google.com/maps/search/?api=1&query=${encodeURIComponent(info.event.extendedProps.local)}`;



          const content_title = formatacao(info.event.title, 30);


          modalTitle.innerHTML = String(content_title);

          const startTime = new Date(info.event.extendedProps.horario_inicio);
          const endTime = new Date(info.event.extendedProps.horario_fim);

          const starTime = startTime.toLocaleTimeString('pt-br', {
            hour: '2-digit',
            minute: '2-digit'
          });
          const endtTime = endTime.toLocaleTimeString('pt-br', {
            hour: '2-digit',
            minute: '2-digit'
          });


          const setor_responsavel_frmtd = formatacao(info.event.extendedProps.setor, 39);
          const local_frmtd = formatacao(info.event.extendedProps.localizacao, 39);
          const unidade_frmtd = formatacao(info.event.extendedProps.unidade, 39);
          const num_frmtd = formatacao(info.event.extendedProps.num, 39);
          const tipo_frmtd = formatacao(info.event.extendedProps.tipo, 39);
          const outros_frmtd = formatacao(info.event.extendedProps.outros, 39);
          const email_frmtd = formatacao(info.event.extendedProps.email, 39);
          const desc_frmtd = formatacao(info.event.extendedProps.description, 39);
          console.log(google_local);

          modalBody.innerHTML = `
  <p><strong>Setor/Responsavel:</strong> ${setor_responsavel_frmtd}</p>
  <div class="conthr">

    <div class="img_cont"> <strong class="hour-title">Horários</strong><img class="icon_clock" src="assets/img/clock.png"></div>

    <div class="horario-container" >
    <strong style="color:#1e7e34; margin:5px;">INICIO:</strong> ${starTime}.
    <strong style="color:#1e7e34; margin:5px;">FIM:</strong> ${endtTime}.
    </div>
  </div>
  <p><strong>Local do evento:</strong> <a href="${google_local}" target="_blank">${info.event.extendedProps.local}</a>.</p>
  <p><strong>Unidade:</strong> ${unidade_frmtd}.</p>
  <p><strong>Quantidade de pessoas:</strong> ${num_frmtd}.</p>
  <p><strong>Tipo:</strong> ${tipo_frmtd}.</p>
  <p><strong>Outros:</strong> ${outros_frmtd}.</p>
  <p><strong>Email :</strong> ${email_frmtd}.</p>
  <hr>
  <strong style="color:#1e7e34;border-bottom:2px solid #1e7e34;">Descrição</strong>
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