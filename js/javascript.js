document.getElementById('cotizar').addEventListener('click', function() {
  var opcion = document.getElementById('opcion').value;
  var medida = document.querySelector('input[name="medida"]:checked');
  var color = document.querySelector('input[name="color"]:checked');
  var archivo = document.getElementById('imagen').files[0];

  if (medida && color && archivo) {
    var reader = new FileReader();
    reader.onload = function(e) {
      document.getElementById('imagen-previa').src = e.target.result;
    };
    reader.readAsDataURL(archivo);

    // Almacenar opciones seleccionadas en variables
    var opcionSeleccionada = opcion;
    var medidaSeleccionada = medida.value;
    var colorSeleccionado = color.value;

    // Generar código HTML
    var htmlCode = "<!DOCTYPE html>\n";
    htmlCode += "<html>\n";
    htmlCode += "<head>\n";
    htmlCode += "  <title>Cotización</title>\n";
    htmlCode += "</head>\n";
    htmlCode += "<body>\n";
    htmlCode += "  <h1>Cotización Generada</h1>\n";
    htmlCode += "  <p>Opción: " + opcionSeleccionada + "</p>\n";
    htmlCode += "  <p>Medida: " + medidaSeleccionada + "</p>\n";
    htmlCode += "  <p>Color: " + colorSeleccionado + "</p>\n";
    htmlCode += "</body>\n";
    htmlCode += "</html>";

    // Generar código CSS
    var cssCode = "/* Estilos para la cotización */\n";
    cssCode += "body {\n";
    cssCode += "  font-family: Arial, sans-serif;\n";
    cssCode += "  margin: 20px;\n";
    cssCode += "}\n";
    cssCode += "h1 {\n";
    cssCode += "  color: #4CAF50;\n";
    cssCode += "}\n";
    cssCode += "p {\n";
    cssCode += "  margin-bottom: 10px;\n";
    cssCode += "}\n";

    // Generar código JavaScript
    var jsCode = "// No se requiere JavaScript para la cotización";

    // Imprimir opciones en la consola
    console.log("Opción: " + opcionSeleccionada);
    console.log("Medida: " + medidaSeleccionada);
    console.log("Color: " + colorSeleccionado);

    // Abrir una nueva ventana con el código generado
    var cotizacionWindow = window.open();
    cotizacionWindow.document.open();
    cotizacionWindow.document.write("<pre><code>" + htmlCode + "</code></pre>");
    cotizacionWindow.document.write("<pre><code>" + cssCode + "</code></pre>");
    cotizacionWindow.document.write("<pre><code>" + jsCode + "</code></pre>");
    cotizacionWindow.document.close();
  } else {
    alert('Por favor, selecciona todas las opciones y sube un archivo JPG.');
  }
});