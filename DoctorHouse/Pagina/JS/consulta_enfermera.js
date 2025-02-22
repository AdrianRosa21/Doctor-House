function n_mensaje(){
  window.open("../Html/nuevo_mensaje_enfermera.html", "AVISO", "toolbar=0, location=500, status=0, menubar=0, scrollbars=yes, resizable=yes, width=270, height=340 ");
}
const mensajes = {
  mensaje1: {
    header: `
      
      `,
      body: `
      <h3><mark>Paciente: César Elías</mark></h3>
      <b>Número de expediente: </b>1
      <p>Tnego dolor de cabeza y mucho vómito y fiebre</p>
      `,
      document: `
      
      `,
  },
  mensaje2: {
    header: `
      
      `,
      body: `
      <h3><mark>Paciente: William Mejía</mark></h3>
      <b>Número de expediente: </b>2
      <p>Tnego dolor de cabeza y mucho vómito y fiebre</p>
      `,
      document: `
      
      `,
  },
  mensaje3: {
    header: `
      
      `,
      body: `
      <h3><mark>Paciente: Rebeca Leiva</mark></h3>
      <b>Número de expediente: </b>3
          <p>Tnego dolor de cabeza y mucho vómito y fiebre</p>
      `,
      document: `
      
      `,
  },
  mensaje4: {
    header: `
      
      `,
      body: `
      <h3><mark>Paciente: Rosa Rivas</mark></h3>
      <b>Número de expediente: </b>4
          <p>Tnego dolor de cabeza y mucho vómito y fiebre</p>
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