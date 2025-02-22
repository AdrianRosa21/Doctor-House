function n_mensaje(){
  window.open("../Html/nuevo_mensaje_paciente.html", "AVISO", "toolbar=0, location=500, status=0, menubar=0, scrollbars=yes, resizable=yes, width=270, height=395 ");
}
const mensajes = {
  mensaje1: {
    header: `
      
      `,
      body: `
      <h3><mark>Doctor/a: César Elías</mark></h3>
          <p><strong>¡Buen día!</strong></p>
          <p>Quería informarle que su diagnóstico es: <strong>faringitis crónica.</strong></p>
          <p>Recomendamos:</p>
          <ul>
              <li>Tomar ibuprofeno 400 mg cada 8 horas</li>
              <li>Descanso por 3 días</li>
              <li>Beber líquidos abundantes</li>
          </ul>
          <p><strong>Si tiene alguna consulta puede llamar al +(503) 6376-7234 </strong></p>
      `,
      document: `
      
      `,
  },
  mensaje2: {
    header: `
      
      `,
      body: `
      <h3><mark>Doctor/a: William Mejía</mark></h3>
          <p><strong>¡Buen día!</strong></p>
          <p>Quería informarle que su diagnóstico es: <strong>conjuntivitis.</strong></p>
          <p>Recomendamos:</p>
          <ul>
              <li>Tomar ibuprofeno 400 mg cada 8 horas</li>
              <li>Descanso por 3 días</li>
              <li>Beber líquidos abundantes</li>
          </ul>
          <p><strong>Si tiene alguna consulta puede llamar al +(503) 6376-7234 </strong></p>
      `,
      document: `
      
      `,
  },
  mensaje3: {
    header: `
      
      `,
      body: `
      <h3><mark>Doctor/a: Rebeca Leiva</mark></h3>
          <p><strong>¡Buen día!</strong></p>
          <p>Quería informarle que su diagnóstico es: <strong> hepatitis.</strong></p>
          <p>Recomendamos:</p>
          <ul>
              <li>Tomar ibuprofeno 400 mg cada 8 horas</li>
              <li>Descanso por 3 días</li>
              <li>Beber líquidos abundantes</li>
          </ul>
          <p><strong>Si tiene alguna consulta puede llamar al +(503) 6376-7234 </strong></p>
      `,
      document: `
      
      `,
  },
  mensaje4: {
    header: `
      
      `,
      body: `
      <h3><mark>Doctor/a: Rosa Rivas</mark></h3>
          <p><strong>¡Buen día!</strong></p>
          <p>Quería informarle que su diagnóstico es: <strong>cáncer.</strong></p>
          <p>Recomendamos:</p>
          <ul>
              <li>Tomar ibuprofeno 400 mg cada 8 horas</li>
              <li>Descanso por 3 días</li>
              <li>Beber líquidos abundantes</li>
          </ul>
          <p><strong>Si tiene alguna consulta puede llamar al +(503) 6376-7234 </strong></p>
      `,
      document: `
      
      `,
  }
};

function showMessage(id) {
  const mensaje = mensajes[id];
  const mensajeSeleccionado = document.getElementById('mensajeSeleccionado');

  mensajeSeleccionado.innerHTML = `
      <div class="message-body">${mensaje.body}</div>
      ${mensaje.archivo ? '<div>Archivo adjunto: ' + mensaje.archivo + '</div>' : ''}
  `;
}