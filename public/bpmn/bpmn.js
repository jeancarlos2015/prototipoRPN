
var bpmnModeler = new BpmnJS({
    container: '#canvas',
    keyboard: {
        bindTo: window
    }
});

var container = bpmnModeler.get('canvas');
function exportDiagram(codmodelodiagramatico) {

    bpmnModeler.saveXML({ format: true }, function(err, xml) {
        $.ajax({

            url: 'gravar',
            type: "POST",
            cache: false,
            dataType: "json",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },

            data: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') ,
                strXml: xml,
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

    });
}

function donwload(name, codmodelodiagramatico,tipo) {
   $.ajax({

        url: "baixar/"+codmodelodiagramatico+"/"+tipo,
        type: "GET",
        dataType: "text",
        success: function (resposta) {
            console.log(resposta);
            var link = document.createElement('a');
            link.setAttribute('href', 'data:text/plain;charset=utf-8,' + encodeURIComponent(resposta));
            link.setAttribute('download', name);
            link.style.display = 'none';
            document.body.appendChild(link);
            link.click();
            document.body.removeChild(link);
        },
        error: function (request, status, error) {
            console.log(request.responseText);
            console.log(status);
            console.log(error);
        }

    });
}
function donwloadXML(name, codmodelodiagramatico) {
    return $.ajax({
        url: "baixar/"+codmodelodiagramatico,
        type: "GET",
        dataType: "text",
        success: function (resposta) {
            return resposta;
        },
        error: function (request, status, error) {
            console.log(request.responseText);
            console.log(status);
            console.log(error);
        }
    });
}
/**
 * Open diagram in our modeler instance.
 *
 * @param {String} bpmnXML diagram to display
 */
function openDiagramAuxiliar(bpmnXML){

    bpmnModeler.importXML(bpmnXML, function (err) {
        console.log(bpmnXML);
        if (err) {
            return console.error('could not import BPMN 2.0 diagram', err);
        }
        // access modeler components
        var canvas = bpmnModeler.get('canvas');
        canvas.zoom('fit-viewport');
        canvas.addMarker('SCAN_OK', 'needs-discussion');
        bpmnModeler.attachTo('#canvas');
        bpmnModeler.detach();
    });
}

function openDiagram(codmodelodiagramatico) {
    return $.ajax({
        url: "baixar/"+codmodelodiagramatico,
        type: "GET",
        dataType: "text",
        success: function (resposta) {
            console.log(resposta);
            openDiagramAuxiliar(resposta);
        },
        error: function (request, status, error) {
            console.log(request.responseText);
            console.log(status);
            console.log(error);
        }});
}

function saveSVG(done) {
    bpmnModeler.saveSVG(done);
}


function registerFileDrop(container, callback) {

    function handleFileSelect(e) {
        e.stopPropagation();
        e.preventDefault();

        var files = e.dataTransfer.files;

        var file = files[0];

        var reader = new FileReader();

        reader.onload = function(e) {

            var xml = e.target.result;

            callback(xml);
        };

        reader.readAsText(file);
    }

    function handleDragOver(e) {
        e.stopPropagation();
        e.preventDefault();

        e.dataTransfer.dropEffect = 'copy'; // Explicitly show this is a copy.
    }

    container.get(0).addEventListener('dragover', handleDragOver, false);
    container.get(0).addEventListener('drop', handleFileSelect, false);
}


if (!window.FileList || !window.FileReader) {
    window.alert(
        'Looks like you use an older browser that does not support drag and drop. ' +
        'Try using Chrome, Firefox or the Internet Explorer > 10.');
} else {
    registerFileDrop(container, openDiagram);
}


$(function() {

    var downloadSvgLink = $('#js-download-svg');

    $('.buttons a').click(function(e) {
        if (!$(this).is('.active')) {
            e.preventDefault();
            e.stopPropagation();
        }
    });

    function setEncoded(link, name, data) {
        var encodedData = encodeURIComponent(data);

        if (data) {
            link.addClass('active').attr({
                'href': 'data:application/bpmn20-xml;charset=UTF-8,' + encodedData,
                'download': name
            });
        } else {
            link.removeClass('active');
        }
    }

    var exportArtifacts = debounce(function() {

        saveSVG(function(err, svg) {
            setEncoded(downloadSvgLink, 'diagram.svg', err ? null : svg);
        });
    }, 500);

    bpmnModeler.on('commandStack.changed', exportArtifacts);
});


// helpers //////////////////////

function debounce(fn, timeout) {

    var timer;

    return function() {
        if (timer) {
            clearTimeout(timer);
        }

        timer = setTimeout(fn, timeout);
    };
}
