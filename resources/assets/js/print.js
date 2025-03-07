function printById(divId, title) {
  var divToPrint = document.getElementById(divId);

  if (divToPrint) {
    // Capturar os estilos da página original
    var cssLinks = '';
    document.querySelectorAll('link[rel="stylesheet"]').forEach(function(link) {
      cssLinks += `<link rel="stylesheet" href="${link.href}" media="all">`;
    });

    var header = `
      <div style="display: flex; align-items: center; padding: 1rem; background: #eee;">
        <span class="app-brand-logo" style="display: block; flex-grow: 0; flex-shrink: 0; overflow: hidden; min-height: 1px;">
          <svg width="50" version="1.0" xmlns="http://www.w3.org/2000/svg"  viewBox="0 0 19.544 18.75">
            <g fill="#696cff">
              <path d="M1.335 2.24C.89 2.733.827 4.528 1.24 5.338c.175.334.365 1.033.429 1.541.159 1.319.429 1.875 1.255 2.558.477.397.731.715.731.953 0 .477.667 1.144 1.398 1.382.334.095.683.254.794.35.127.095.191.079.191-.064 0-.381-.222-.588-.985-.922-.683-.286-1.224-.874-1.017-1.08.048-.048.302 0 .588.095.62.207.651.191.413-.302-.127-.238-.556-.524-1.208-.779-.588-.238-1.16-.588-1.335-.826-.286-.397-.636-1.732-.493-1.875.079-.079 1.923.461 2.479.731.222.111.524.318.667.445.24.241.255.241.255-.077 0-.191-.238-.588-.524-.858-.381-.397-.747-.572-1.525-.715-.81-.159-1.144-.318-1.573-.747-.508-.508-.54-.604-.477-1.351.111-1.16.27-1.224 1.176-.524.985.763 2.256 1.335 4.354 1.971 2.574.794 3.512 1.446 4.036 2.86l.27.715-1.033 2.78c-.572 1.525-1.144 2.86-1.287 2.955-.397.286-.286.572.207.508.365-.048.493-.191.89-1.208l.445-1.144h.858c.683 0 .826-.048.763-.238-.064-.159-.318-.238-.779-.238h-.683l.413-1.192c.238-.651.461-1.192.508-1.192s.254.477.461 1.065c.683 1.923 1.891 4.131 2.701 4.958.906.937 1.525 1.271 2.574 1.398.651.079.779.048.779-.159 0-.143-.238-.365-.508-.493-1.128-.477-2.002-1.891-3.543-5.657-1.193-2.89-1.94-4.32-2.56-4.876s-1.589-.922-4.163-1.557C5.18 4.036 4.084 3.56 2.781 2.622c-.556-.397-1.033-.715-1.081-.715-.032 0-.191.143-.365.334"/>
              <path d="M8.819 2.383c-.715.143-2.034.636-1.939.731.032.048.334-.048.683-.191 3.035-1.271 6.944.286 8.39 3.353.842 1.748.937 3.766.27 5.45-.334.826-.334.858-.048 1.398l.286.556.429-.874c.763-1.557.953-3.607.493-5.196-1.08-3.671-4.846-5.975-8.565-5.228M3.909 13.188c.604 1.096 2.082 2.463 3.273 3.019 1.668.779 3.893.89 5.561.286.588-.207.588-.207.302-.572l-.27-.381-.937.27c-.953.286-2.526.35-3.432.159-1.398-.318-3.114-1.462-3.941-2.669-.715-1.049-1.096-1.112-.556-.111"/>
            </g>
          </svg>
        </span>
        <div>
          <span style="font-size: 1em; letter-spacing: -0.5px; color: #696cff; display: block;">Associação ARCanjo</span>
          <span style="font-size: 0.8em; letter-spacing: -0.5px; color: #666; display: block;">`+title+`</span>
        </div>
      </div>
    `;

    var newWindow = window.open('', '', 'width=800,height=600');
    // Criar o conteúdo da nova janela com o estilo
    newWindow.document.write('<html><head><title>'+title+'</title>');
    newWindow.document.write(cssLinks); // Inclui os estilos
    newWindow.document.write('</head><body>');
    newWindow.document.write(header);
    newWindow.document.write(divToPrint.innerHTML);
    newWindow.document.write('</body></html>');
    newWindow.document.close();

    // Disparar a impressão e fechar automaticamente a janela após o processo
    newWindow.onload = function() {
      newWindow.focus(); // Focar na nova janela
      newWindow.print(); // Disparar a impressão

      // Adicionar um evento listener para fechar a janela automaticamente após impressão ou cancelamento
      var closeInterval = setInterval(function() {
        if (newWindow.closed) {
          clearInterval(closeInterval); // Para de verificar se a janela já foi fechada
        } else {
          newWindow.close(); // Fecha a janela
        }
      }, 100);
    };
  } else {
    console.error('Div não encontrada: ' + divId);
  }
}
