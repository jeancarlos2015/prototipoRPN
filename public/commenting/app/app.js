import $ from 'jquery';


// require the viewer, make sure you added it to your project
// dependencies via npm install --save-dev bpmn-js
import BpmnViewer from 'bpmn-js/lib/NavigatedViewer';

import EmbeddedComments from 'bpmn-js-embedded-comments';

var viewer = new BpmnViewer({
  container: '#canvas',
  additionalModules: [
    EmbeddedComments
  ]
});
var diagrama_comentado;

function openDiagram(diagram) {

  viewer.importXML(diagram, function(err) {
    if (err) {

      alert('could not import BPMN 2.0 XML, see console');
      return console.log('could not import BPMN 2.0 XML', err);
    }
	
    console.log('success!');
    viewer.get('canvas').zoom('fit-viewport');
  });
}


// file save handling

var $download = $('[data-download]');

function serialize() {

  viewer.saveXML(function(err, xml) {

    var encodedData = err ? '' : encodeURIComponent(xml);
	diagrama_comentado = xml;
    $download.attr({
      'href': encodedData ? 'data:application/bpmn20-xml;charset=UTF-8,' + encodedData : '',
    });

    if (err) {
      console.log('failed to serialize BPMN 2.0 xml', err);
    }
  });
}

viewer.on('comments.updated', serialize);
viewer.on('commandStack.changed', serialize);

viewer.on('canvas.click', function() {
  viewer.get('comments').collapseAll();
});


// file open handling

var $file = $('[data-open-file]');

function readFile(file, done) {

  if (!file) {
    return done(new Error('no file chosen'));
  }

  var reader = new FileReader();

  reader.onload = function(e) {
    done(null, e.target.result);
  };

  reader.readAsText(file);
}

$file.on('change', function() {
  readFile(this.files[0], function(err, xml) {

    if (err) {
      alert('could not read file, see console');
      return console.error('could not read file', err);
    }

    openDiagram(xml);
  });

});


// we use stringify to inline a simple BPMN diagram
//import pizzaDiagram from '../resources/pizza-collaboration-annotated.bpmn';
let pizzaDiagram = $('#diagramaBaixado').val();
openDiagram(pizzaDiagram);


// file drag / drop ///////////////////////

function openFile(file, callback) {

  // check file api availability
  if (!window.FileReader) {
    return window.alert(
      'Looks like you use an older browser that does not support drag and drop. ' +
      'Try using a modern browser such as Chrome, Firefox or Internet Explorer > 10.');
  }

  // no file chosen
  if (!file) {
    return;
  }

  var reader = new FileReader();

  reader.onload = function(e) {

    var xml = e.target.result;

    callback(xml);
  };

  reader.readAsText(file);
}

(function onFileDrop(container, callback) {

  function handleFileSelect(e) {
    e.stopPropagation();
    e.preventDefault();

    var files = e.dataTransfer.files;
    openFile(files[0], callback);
  }

  function handleDragOver(e) {
    e.stopPropagation();
    e.preventDefault();

    e.dataTransfer.dropEffect = 'copy'; // Explicitly show this is a copy.
  }

  container.get(0).addEventListener('dragover', handleDragOver, false);
  container.get(0).addEventListener('drop', handleFileSelect, false);

})($('body'), openDiagram);


$('#btnSalvarDiagrama').click(function (){
	
	Swal.fire({
  title: 'Deseja Salvar as alterações?',
  icon: 'warning',
  showCancelButton: false,
  confirmButtonColor: '#3085d6',
  cancelButtonColor: '#d33',
  confirmButtonText: 'Confirmar?'
}).then((result) => {
  if (result.value) {
	  console.log(diagrama_comentado);
	  let codmodelodiagramatico = $('#codmodelodiagramatico').val();
	  $.ajax({

            url: 'edicao_modelo_diagramatico_comentario/gravar',
            type: "POST",
            cache: false,
            dataType: "json",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },

            data: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') ,
                xml_modelo_comentado: diagrama_comentado,
                codmodelodiagramatico: codmodelodiagramatico
            },

            success: function () {
                // alert('ModeloDiagramatico Salvo Com suceso!!');
                Swal.fire({
                    type: 'success',
                    title: 'Diagrama Salvo com sucesso!!',
                    timer: 1500
                });

            },
            error: function () {
                // alert('Erro ao salvar modelo');
                Swal.fire({
                    type: 'error',
                    title: 'Erro ao tentar salvar o digrama',
                    timer: 1500
                });
            }

        });
  }
})
});