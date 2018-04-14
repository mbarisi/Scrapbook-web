if(window.addEventListener) {
window.addEventListener('load', function () {
  var canvas, context, canvaso, contexto;
  function downloadCanvas(link, canvasId, filename) {
      link.href = document.getElementById(canvasId).toDataURL();
      link.download = filename;
  }


  document.getElementById('download').addEventListener('click', function() {
      downloadCanvas(this, 'imageView', 'test.png');
  }, false);

  // Aktivirana je olovka.
  var tool;
  var tool_default = 'pencil';

  function init () {
    // nadji canvas.
    canvaso = document.getElementById('imageView');
    if (!canvaso) {
      alert('Error: I cannot find the canvas element!');
      return;
    }

    if (!canvaso.getContext) {
      alert('Error: no canvas.getContext!');
      return;
    }

    // Dohvati 2D canvas context.
    contexto = canvaso.getContext('2d');
    if (!contexto) {
      alert('Error: failed to getContext!');
      return;
    }

    // dodaj privremeni canvas.
    var container = canvaso.parentNode;
    canvas = document.createElement('canvas');
    if (!canvas) {
      alert('Error: I cannot create a new canvas element!');
      return;
    }

    canvas.id     = 'imageTemp';
    canvas.width  = canvaso.width;
    canvas.height = canvaso.height;
    container.appendChild(canvas);

    context = canvas.getContext('2d');

    // koji je tool aktiviran
    var tool_select = document.getElementById('dtool');
    if (!tool_select) {
      alert('Error: failed to get the dtool element!');
      return;
    }

    // aktiviraj po defaultu
    if (tools[tool_default]) {
      tool = new tools[tool_default]();
      tool_select.value = tool_default;
    }

    // Dodaj mousedown, mousemove i mouseup event
    canvas.addEventListener('mousedown', ev_canvas, false);
    canvas.addEventListener('mousemove', ev_canvas, false);
    canvas.addEventListener('mouseup',   ev_canvas, false);
  }

  // pozicija
  function ev_canvas (ev) {
    if (ev.layerX || ev.layerX == 0) {
      ev._x = ev.layerX;
      ev._y = ev.layerY;
    }

    // poziv za vodeći alat
    var func = tool[ev.type];
    if (func) {
      func(ev);
    }
  }

  // Ova funkcija crta #imageTemp canvas na vrh #imageView, nakon cega
  // #imageTemp je obrisan.Ova funkcija se poziva svaki puta kada user završi sa crtanjem
  function img_update () {
		contexto.drawImage(canvas, 0, 0);
		context.clearRect(0, 0, canvas.width, canvas.height);
  }

  // objekt koji sadrži implementaciju crtajućeg alata.
  var tools = {};

  // olovka
  tools.pencil = function () {
    var tool = this;
    this.started = false;

    // Poziva se čim se pritisne gumb miša (za crtanje)
    this.mousedown = function (ev) {
        context.beginPath();
        context.moveTo(ev._x, ev._y);
        tool.started = true;
    };

    //poziva se sve dok je pritisnut gumb miša
    this.mousemove = function (ev) {
      if (tool.started) {
        context.lineTo(ev._x, ev._y);
        context.stroke();
      }
    };

    // poziva se kada se otpusti gumb
    this.mouseup = function (ev) {
      if (tool.started) {
        tool.mousemove(ev);
        tool.started = false;
        img_update();
      }
    };
  };

  init();

}, false); }
