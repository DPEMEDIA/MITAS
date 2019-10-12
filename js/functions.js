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
// ============================================================================

// Intialiase Clock
timeClock();

// Intialiase Tooltip
$("[data-toggle='tooltip']").tooltip();

function timeClock() {
	var element =  document.getElementById("clock");
	if (typeof(element) != "undefined" && element != null) {

		var hours, minutes, seconds;
		var hoursNumber, minutesNumber, secondsNumber;
		var today;

		today = new Date();
		hoursNumber = today.getHours();
		minutesNumber = today.getMinutes();
		secondsNumber = today.getSeconds();

		if (hoursNumber < 10) {
			hours = "0" + hoursNumber + ":";
		} else {
			hours = hoursNumber + ":";
		}

		if (minutesNumber < 10) {
			minutes = "0" + minutesNumber + ":";
		} else {
			minutes = minutesNumber + ":";
		}

		if (secondsNumber < 10) {
			seconds = "0" + secondsNumber + " ";
		} else {
			seconds = secondsNumber + " ";
		}

		time = hours + minutes + seconds;

		element.innerHTML = time;
		window.setTimeout("timeClock();", 1000);
	}
}

// ==========================================================================
//
//									LOGIN
//
// ==========================================================================
function checkLogin(response = false) {
	if(response == false || (response.error == true && response.grund == 'empty')) {

		var username = $.trim($("#username").val());
		var password = $.trim($("#password").val());

		if(username.length == 0 && password.length == 0) {
			$("#checkLoginError").show();
			$("#checkLoginError").css({"border-color" : "#a94442"});
			$("#checkLoginError").html("<div class='alert alert-danger'>Die Eingabe ist nicht gültig.</div>");
		} else {
			if(username.length == 0) {
				$("#checkLoginError").show();
				$("#checkLoginError").css({"border-color" : "#a94442"});
				$("#checkLoginError").html("<div class='alert alert-danger'>Der Benutzer ist nicht gültig.</div>");
			} else if(password.length == 0) {
				$("#checkLoginError").show();
				$("#checkLoginError").css({"border-color" : "#a94442"});
				$("#checkLoginError").html("<div class='alert alert-danger'>Das Kennwort ist nicht gültig.</div>");
			} else {
				return true;
			}
		}

	}
	else if(response.error == true && response.grund == 'banned') {
		if(response.grund == 'banned') {
			$("#checkLoginError").show();
			$("#checkLoginError").css({"border-color" : "#a94442"});
			$("#checkLoginError").html("<div class='alert alert-danger'>Der Benutzer ist gesperrt.</div>");
		}
	}
	else {
		if(response.error == true) {
			if(response.grund == 'not exsist') {
				$("#checkLoginError").show();
				$("#checkLoginError").css({"border-color" : "#a94442"});
				$("#checkLoginError").html("<div class='alert alert-danger'>Der Benutzer oder das Kennwort sind nicht gültig.</div>");
			}
		}
	}
}
// ==========================================================================
$(document).on("submit", "#loginForm", function (e)
{
	e.preventDefault();



		var postData = $(this).serialize();

        // Fetch all the forms we want to apply custom Bootstrap validation styles to
        var forms = document.getElementsByClassName('needs-validation');
        // Loop over them and prevent submission
        var validation = Array.prototype.filter.call(forms, function(form) {
            if (form.checkValidity() === false && checkLogin()) {
              event.stopPropagation();
            } else {


		$.ajax({
			url : "inc/asc/login.php",
			type: "post",
			data : postData,
			success: function(response) {

				// var callBack = JSON.parse(atob(response));

				var callBack = JSON.parse(response);

				if(callBack.login == true) {
					$("#checkLoginError").hide();
					$("#checkLoginError").css({"border-color" : "#ccc"});
					$("#loginForm input").attr("disabled", "disabled");
					window.location.href = "";
				} else {
					checkLogin(callBack);
				}
			}
		});

    }
     form.classList.add('was-validated');
    });


});

// ==========================================================================
//
//									LOGOUT
//
// ==========================================================================
function checkLogout()
{
	$.ajax({
		url : "inc/asc/login.php",
		type: "post",
		data: {action: "logout"},
		success: function(response) {

			//var callBack = JSON.parse(atob(response));

			var callBack = JSON.parse(response);

			if(callBack.logout == true) {
				window.location.href = "";
			}
		}
	});
}

// ==========================================================================
//
//									RETURN
//
// ==========================================================================
function checkReturn(response = false)
{
	var state		= $.trim($("#state option:selected").val());
	var firstname	= $.trim($("#firstname").val());
	var surname		= $.trim($("#surname").val());
	var email		= $.trim($("#email").val());
	var telefon		= $.trim($("#telefon").val());
	var bonnr		= $.trim($("#bonnr").val());
	var bondate		= $.trim($("#bondate").val());
	var product		= $.trim($("#product").val());
	var comment		= $.trim($("#comment").val());

	if(response == false || (response.error == true && response.grund == 'empty')) {

		// DEBUGGING
		var error = ['true'];

		if(state.length == 0 || $("#state option:selected").val() == "Auswahl") {
			error[0] = true;
			$(".state-change").addClass("mb-0");
			$("#checkAddReturnState").show();
			$("#checkAddReturnState").html("<div class='alert alert-danger mt-3 mb-0'><i class='fas fa-times-circle'></i> Status nicht gültig</div>");
		} else {
			error[0] = false;
			$(".state-change").addClass("mb-0");
			$("#checkAddReturnState").show();
			$("#checkAddReturnState").html("<div class='alert alert-success mt-3 mb-0'><i class='fas fa-check-circle'></i> Status</div>");
		}

		if(firstname.length == 0) {
			error[0] = true;
			$("#checkAddReturnFirstname").show();
			$("#checkAddReturnFirstname").html("<div class='alert alert-danger mt-3 mb-0'><i class='fas fa-times-circle'></i> Vorname nicht gültig</div>");
		} else {
			error[0] = false;
			$("#checkAddReturnFirstname").show();
			$("#checkAddReturnFirstname").html("<div class='alert alert-success mt-3 mb-0'><i class='fas fa-check-circle'></i> Vorname</div>");
		}

		if(surname.length == 0) {
			error[0] = true;
			$("#checkAddReturnSurname").show();
			$("#checkAddReturnSurname").html("<div class='alert alert-danger mt-3 mb-0'><i class='fas fa-times-circle'></i> Nachname nicht gültig</div>");
		} else {
			error[0] = false;
			$("#checkAddReturnSurname").show();
			$("#checkAddReturnSurname").html("<div class='alert alert-success mt-3 mb-0'><i class='fas fa-check-circle'></i> Nachname</div>");
		}

		// IF EMAIL OR TELEFON IS EMPTY...
		if(email.length == 0 && telefon.length == 0) {
			error[0] = true;
			$(".emtel-change").addClass("mb-0");
			$("#checkAddReturnEmTel").show();
			$("#checkAddReturnEmTel").html("<div class='alert alert-danger mt-3 mb-0'><i class='fas fa-times-circle'></i> E-Mail od. Telefon nicht gültig</div>");
		} else {
			error[0] = false;
			$(".emtel-change").removeClass("mb-0");
			$("#checkAddReturnEmTel").hide();
		}

		/*
		if(email.length == 0) {
			error[0] = true;
			$("#checkAddReturnEmail").show();
			$("#checkAddReturnEmail").html("<div class='alert alert-danger mt-3 mb-0'><i class='fas fa-times-circle'></i> E-Mail nicht gültig</div>");
		} else {
			error[0] = false;
			$("#checkAddReturnEmail").hide();
		}

		if(telefon.length == 0) {
			error[0] = true;
			$("#checkAddReturnTelefon").show();
			$("#checkAddReturnTelefon").html("<div class='alert alert-danger mt-3 mb-0'><i class='fas fa-times-circle'></i> Telefon nicht gültig</div>");
		} else {
			error[0] = false;
			$("#checkAddReturnTelefon").hide();
		} */
		// IF EMAIL OR TELEFON IS EMPTY...

		if(bonnr.length == 0) {
			error[0] = true;
			$("#checkAddReturnBonnr").show();
			$("#checkAddReturnBonnr").html("<div class='alert alert-danger mt-3 mb-0'><i class='fas fa-times-circle'></i> Bon-Nr. nicht gültig</div>");
		} else {
			error[0] = false;
			$("#checkAddReturnBonnr").show();
			$("#checkAddReturnBonnr").html("<div class='alert alert-success mt-3 mb-0'><i class='fas fa-check-circle'></i> Bon-Nr.</div>");
		}

		if(bondate.length == 0) {
			error[0] = true;
			$("#checkAddReturnBondate").show();
			$("#checkAddReturnBondate").html("<div class='alert alert-danger mt-3 mb-0'><i class='fas fa-times-circle'></i> Bon-Datum nicht gültig</div>");
		} else {
			error[0] = false;
			$("#checkAddReturnBondate").show();
			$("#checkAddReturnBondate").html("<div class='alert alert-success mt-3 mb-0'><i class='fas fa-check-circle'></i> Bon-Datum</div>");
		}

		if(product.length == 0) {
			error[0] = true;
			$("#checkAddReturnProduct").show();
			$("#checkAddReturnProduct").html("<div class='alert alert-danger mt-3 mb-0'><i class='fas fa-times-circle'></i> Artikel nicht gültig</div>");
		} else {
			error[0] = false;
			$("#checkAddReturnProduct").show();
			$("#checkAddReturnProduct").html("<div class='alert alert-success mt-3 mb-0'><i class='fas fa-check-circle'></i> Artikel</div>");
		}

		if(comment.length == 0) {
			error[0] = true;
			$("#checkAddReturnComment").show();
			$("#checkAddReturnComment").html("<div class='alert alert-danger mt-3 mb-0'><i class='fas fa-times-circle'></i> Kommentar nicht gültig</div>");
		} else {
			error[0] = false;
			$("#checkAddReturnComment").show();
			$("#checkAddReturnComment").html("<div class='alert alert-success mt-3 mb-0'><i class='fas fa-check-circle'></i> Kommentar</div>");
		}

		if(error[0] == false) {
			return true;
		}

	}
}
// ==========================================================================
$(document).on("submit", "#returnForm", function (e)
{
	e.preventDefault();

	if(checkReturn()) {
		var postData = $(this).serialize();

		$.ajax({
			url : "inc/async.php",
			type: "post",
			data : postData,
			success: function(response) {
				// var callBack = JSON.parse(atob(response));

				var callBack = JSON.parse(response);

				if(callBack.revert == true) {
					alert('success');
					$("#returnAddModal").modal("hide");
				} else {
					checkReturn(callBack);
				}
			}
		});

	}
});
// ==========================================================================
// ==========================================================================
// GET MYSQL FOR RETURN
// ==========================================================================
// ==========================================================================
function rowReturn(returnid)
{
	$.ajax({
		url : "inc/async.php",
		type: "post",
		data: {getReturnId: returnid},
		success: function(response) {
			$(".container").after("<div id='testo'></div>");
			$("#testo").html(response);
			$("#testo > #ttt").modal("show").on('hidden.bs.modal', function () {
				$("#testo").remove();
				// $('.table-returns tbody tr').removeClass("testbg");
			});
		}
	});
}
// ==========================================================================
// ==========================================================================
// ==========================================================================


$('#drucker, #edit').click(function() {
	$(this).parent().parent().addClass('testbg2').siblings().each(function() {
		$(this).removeClass('testbg2');
		if($(this).find('#returnCheck').is(':checked')) {
			$(this).addClass("testbg");
		}
	});

});

$('.table-returns tbody tr #returnCheck').click(function() {
	if($(this).is(':checked')) {
		$(this).parent().parent().parent().addClass('testbg');
	} else {
		$(this).parent().parent().parent().removeClass('testbg');
	}
	$('.testbg2').removeClass('testbg2');
});

function CheckBG() {
	$('.table-returns tbody tr').each(function() {
		if($(this).find('#returnCheck').is(':checked') == false) {
			$(this).removeClass("testbg");
		}
	});
}

function toggle(source) {
	if($(source).is(':checked')) {
		$('.table-returns tbody tr').addClass('testbg').find('#returnCheck').prop('checked', true);
	} else {
		$('.table-returns tbody tr').removeClass('testbg').find('#returnCheck').prop('checked', false);
	}
}

// Delete Input & Remove Warning after closing the Modal
$('#returnAddModal').on('hidden.bs.modal', function () {
	$(".state-change").removeClass("mb-0");
	$(".emtel-change").removeClass("mb-0");
	$(this).find("#firstname, #surname, #email, #telefon, #bonnr, #bondate, #product, #comment").val('').end();
	$(this).find("#checkAddReturnState, #checkAddReturnFirstname, #checkAddReturnSurname, #checkAddReturnEmTel, #checkAddReturnEmail, #checkAddReturnTelefon, #checkAddReturnBonnr, #checkAddReturnBondate, #checkAddReturnProduct, #checkAddReturnComment").hide();
});

function resetReturn() {
	$(".state-change").removeClass("mb-0");
	$(".emtel-change").removeClass("mb-0");
    $('#categoryAddModal').find("#name").val('').end();
    $('#productAddModal').find("#name").val('').end();
	$('#returnAddModal').find("#firstname, #surname, #email, #telefon, #bonnr, #bondate, #product, #comment").val('').end();
	$('#returnAddModal').find("#checkAddReturnState, #checkAddReturnFirstname, #checkAddReturnSurname, #checkAddReturnEmTel, #checkAddReturnEmail, #checkAddReturnTelefon, #checkAddReturnBonnr, #checkAddReturnBondate, #checkAddReturnProduct, #checkAddReturnComment").hide();
}
// DEBBUGING ==================================================================================================
