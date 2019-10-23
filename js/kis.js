var treeData;
$(document).ready(function(){

    // Treeview
    $.ajax({
        type: "GET",
        url : "inc/asc/kis.php",
        dataType: "json",
        beforeSend: function() {
            $("#treeview").html("Lade Treeview...");
        },
        success: function(response) {

            initTree(response);
            treeData = response;

            $("#addCategory").click(function() {
                var checkName = document.getElementById('name').value;
                if(checkName.length > 0) {
                    var selectNode = $('#treeview').treeview('getSelected')[0];

                    if(selectNode != undefined) {
                        addNode(checkName, selectNode['id']);
                    } else {
                        addNode(checkName);
                    }

                    $('#categoryAddModal').modal('toggle');
                    resetReturn();
                }
            });
            // =================================================================
            $("#addProduct").click(function() {
                var nameee = document.getElementById('productName').value;
                if(nameee.length > 0) {
                    var selectNode = $('#treeview').treeview('getSelected')[0];

                    if(selectNode != undefined) {
                        addProduct(nameee, selectNode['id']);
                    }

                    $('#productAddModal').modal('toggle');
                    resetReturn();
                }
            });
            // =================================================================
            $("#removeCategory").click(function() {
                var check = confirm('Kategorie löschen?');
                if (check == true) {
                    var selectNode = $('#treeview').treeview('getSelected')[0];
                    treeData = delNode(selectNode['id']);
                    initTree(treeData);
                }
            });

            console.log(treeData);
        }
    });

    function initTree(treeData) {
        $("#treeview").treeview({
            color: "#428bca",
            expandIcon: 'fa fa-chevron-right',
            collapseIcon: 'fa fa-chevron-down',
            data: treeData,
            onNodeSelected: function(event, node) {
                var number = 0;
                var x = node.product;
                if(x != undefined) {
                var table = '<table class="table table-returns table-hover table-bordered mb-0"><thead><tr><th scope="col">Nr.</th><th scope="col">Bild</th><th scope="col">Name</th><th scope="col">Preis</th><th scope="col"><div class="form-check text-center"><input class="form-check-input position-static" type="checkbox" onclick="toggle(this);"></div></th></tr></thead>';
                for (xyz in x) {
                    number ++;
                    table +='<tr><td>'+ number +'</td><td><img src="'+ x[xyz]['picture'] +'" width="100" height="87.5" class="img-fluid"></td><td>'+ x[xyz]['name'] +'</td><td>&euro; '+ x[xyz]['price'] +'</td><td><div class="form-check text-center"><input class="form-check-input position-static" type="checkbox" id="returnCheck" name="returnCheck"></div></td></tr>';
                }
                table += '</table>';
                $("#treeviewProducts").html(table);
                $("#treeviewProductsToolbar").html('<div class="mt-3"><div class="btn-group d-flex" role="group"><button type="button" class="btn btn-success w-50" data-toggle="modal" data-target="#productAddModal">Produkt hinzufügen</button><button type="button" class="btn btn-danger w-50" id="productCategory">Produkt löschen</button></div></div>');
                } else {
                    $("#treeviewProducts").html("Keine Daten vorhanden...");
                    $("#treeviewProductsToolbar").html('<div class="mt-3"><div class="btn-group d-flex" role="group"><button type="button" class="btn btn-success w-50" data-toggle="modal" data-target="#productAddModal">Produkt hinzufügen</button><button type="button" class="btn btn-danger w-50" id="productCategory">Produkt löschen</button></div></div>');
                }
            }
        });
    }

    function addNode(name, id = 0) {
        $.post('inc/asc/kisAdd.php', {aktion: 'AddNode', ID: id, Name: name}, function(response) {
            var newTree = JSON.parse(response);
            initTree(newTree);
            treeData = newTree;
        });
    }

    function delNode(id, tmp = treeData) {
        for(var key in tmp) {
            if(tmp[key]['id'] == id) {
                tmp[key] = 'MustDie';
                var index = tmp.indexOf('MustDie');
                tmp.splice(index, 1);
                $.post('inc/asc/kisDel.php', {aktion: 'DelNode', ID: id});
                break;
            } else if(tmp[key]['nodes'] != undefined) {
                tmp[key]['nodes'] = delNode(id, tmp[key]['nodes']);

                if(tmp[key]['nodes'].length == 0)
                    delete tmp[key]['nodes'];
            }
        }
        return tmp;
    }


    function addProduct(name, id) {
      console.log('alright ' + name + ' ' + id);
      $.post('inc/asc/kisAdd.php', {aktion: 'AddProduct', ID: id, Name: name}, function(response) {
          var newTree = JSON.parse(response);
          initTree(newTree);
          treeData = newTree;
      });
    }

    function delProduct() {
        // TODO
    }

});
