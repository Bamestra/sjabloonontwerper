<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Sjabloon bewerken</title>

        <link rel="stylesheet" href="{{ URL::asset('assets/jstree/themes/default/style.min.css') }}" />
        <link rel="stylesheet" href="{{ URL::asset('assets/bootstrap/css/bootstrap.min.css') }}" />
        <link rel="stylesheet" href="{{ URL::asset('css/style.css') }}" />
    </head>
    <body>
        <h1>Sjabloon bewerken</h1>


        <div id="linkerkolom" class="col-md-6">
            <div id="knoppen">
                <button id="button_toevoegen" class="btn btn-success">Toevoegen</button>
                <button id="button_verwijderen" class="btn btn-danger">Verwijderen</button>
            </div>

            <div id="jstree_onderdelen"></div>
        </div>



        <div id="rechterkolom" class="col-md-6">

            <div class="form-group">
                <label for="input_naam">Naam</label>
                <input type="text" class="form-control" id="input_naam">

                <label for="input_soort">Soort</label>
                <select class="form-control" id="input_soort">
                    <option value="0">Groep</option>
                    <option value="1">Onderdeel</option>
                </select>

                <button class="btn btn-info">Opslaan</button>
            </div>
        </div>

        <script src="{{ URL::asset('assets/jquery/jquery.min.js') }}"></script>
        <script src="{{ URL::asset('assets/jstree/jstree.min.js') }}"></script>
        <script src="{{ URL::asset('assets/bootstrap/js/bootstrap.min.js') }}"></script>

        <script type="text/javascript">
var geselecteerdeNode;

$('#jstree_onderdelen').jstree({
    core: {
        data: {
            url: function (node) {
                if (node.id === "#") {
                    return "{{ URL::to('onderdelen/paginas') }}/<?= $sjabloon->id ?>";
                } else {
                    return "{{ URL::to('onderdelen/children') }}/" + node.id;
                }
            }
        },
        check_callback: true, // Deze regel is nodig om .create_node te laten werken.
        multiple: false // Niet meerdere nodes tegelijk selecteren.
    }
});

$('#jstree_onderdelen').bind("select_node.jstree", function (event, data) {
    geselecteerdeNode = data.node;
});

$("#button_toevoegen").click(function () {
    // Het nieuwe element komt op hetzelfde niveau als de geselecteerde.

    $.ajax({
        url: "{{ URL::to('onderdelen/create') }}/" + geselecteerdeNode.id,
        type: 'GET',
        complete: function (jqXHR, textStatus) {
            if (textStatus === 'success') {
                
                var node = JSON.parse(jqXHR.responseText);
                
                $('#jstree_onderdelen').jstree().create_node(geselecteerdeNode.parent, node.naam, node.volgorde - 1);
            }
        }
    })

    //var geselecteerdeNode = $('#jstree_onderdelen').jstree('get_selected');

    //$('#jstree_onderdelen').jstree().create_node(geselecteerdeNode, {"id": "ajson5", "text": "newly added"});
});

        </script>
    </body>
</html>