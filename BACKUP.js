// ==========================================================================
//
//									Clock
//
// ==========================================================================
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
	} else {
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

	if(response == false || response.error == true) {
	// 	if(response == false || (response.error == true && response.grund == 'empty')) {

		var error = ['true'];

		if(state.length == 0 || $("#state option:selected").val() == "Status") {
			error[0] = true;
			$(".state-change").addClass("mb-0");
			$("#checkAddReturnState").show();
			$("#checkAddReturnState").html("<div class='alert alert-danger mb-3'><i class='fas fa-times-circle'></i> Status nicht gültig</div>");
		} else if(state != "Offen" && state != "Ausgetauscht") {
            error[0] = true;
			$("#checkAddReturnState").show();
			$("#checkAddReturnState").html("<div class='alert alert-danger mb-3'><i class='fas fa-times-circle'></i> Status nicht gültig</div>");
		} else {
			error[0] = false;
			$(".state-change").addClass("mb-0");
			$("#checkAddReturnState").show();
			$("#checkAddReturnState").html("<div class='alert alert-success mb-3'><i class='fas fa-check-circle'></i> Status</div>");
		}

		if(firstname.length == 0) {
			error[0] = true;
			$("#checkAddReturnFirstname").show();
			$("#checkAddReturnFirstname").html("<div class='alert alert-danger'><i class='fas fa-times-circle'></i> Vorname nicht gültig</div>");
		} else if (firstname.length > 32){
			error[0] = true;
			$("#checkAddReturnFirstname").show();
			$("#checkAddReturnFirstname").html("<div class='alert alert-danger'><i class='fas fa-times-circle'></i> Vorname nicht gültig</div>");
		} else {

			error[0] = false;
			$("#checkAddReturnFirstname").show();
			$("#checkAddReturnFirstname").html("<div class='alert alert-success'><i class='fas fa-check-circle'></i> Vorname</div>");
		}

		if(surname.length == 0) {
			error[0] = true;
			$("#checkAddReturnSurname").show();
			$("#checkAddReturnSurname").html("<div class='alert alert-danger'><i class='fas fa-times-circle'></i> Nachname nicht gültig</div>");
        } else if (surname.length > 32){
			error[0] = true;
			$("#checkAddReturnSurname").show();
			$("#checkAddReturnSurname").html("<div class='alert alert-danger'><i class='fas fa-times-circle'></i> Nachname nicht gültig</div>");
		} else {
			error[0] = false;
			$("#checkAddReturnSurname").show();
			$("#checkAddReturnSurname").html("<div class='alert alert-success'><i class='fas fa-check-circle'></i> Nachname</div>");
		}

		// IF EMAIL OR TELEFON IS EMPTY...
		if(noemail.checked == false || nophone.checked == false) {

		$("#checkAddReturnEmTel").hide();

		if(noemail.checked == false) {
        if(email.length == 0) {
            error[0] = true;
            $("#checkAddReturnEmail").show();
            $("#checkAddReturnEmail").html("<div class='alert alert-danger'><i class='fas fa-times-circle'></i> E-Mail nicht gültig</div>");
        } else if(emailValidation(email) == false) {
            error[0] = true;
			$("#checkAddReturnEmail").show();
            $("#checkAddReturnEmail").html("<div class='alert alert-danger'><i class='fas fa-times-circle'></i> E-Mail - Format nicht gültig</div>");
        } else {
            error[0] = false;
			$("#checkAddReturnEmail").show();
            $("#checkAddReturnEmail").html("<div class='alert alert-success'><i class='fas fa-check-circle'></i> E-Mail</div>");
        }
		} else {
			error[0] = false;
			$("#checkAddReturnEmail").show();
            $("#checkAddReturnEmail").html("<div class='alert alert-success'><i class='fas fa-check-circle'></i> E-Mail</div>");
		}

		if(nophone.checked == false) {
        if(telefon.length == 0) {
            error[0] = true;
            $("#checkAddReturnTelefon").show();
            $("#checkAddReturnTelefon").html("<div class='alert alert-danger'><i class='fas fa-times-circle'></i> Telefon nicht gültig</div>");
        } else if(phoneValidation(telefon) == false) {
            error[0] = true;
			$("#checkAddReturnTelefon").show();
            $("#checkAddReturnTelefon").html("<div class='alert alert-danger'><i class='fas fa-times-circle'></i> Telefon - Format nicht gültig</div>");
        } else {
            error[0] = false;
			$("#checkAddReturnTelefon").show();
            $("#checkAddReturnTelefon").html("<div class='alert alert-success'><i class='fas fa-check-circle'></i> Telefon</div>");
        }
		} else {
			error[0] = false;
			$("#checkAddReturnTelefon").show();
            $("#checkAddReturnTelefon").html("<div class='alert alert-success'><i class='fas fa-check-circle'></i> Telefon</div>");
		}

		} else {
			error[0] = false;
			$("#checkAddReturnEmail").hide();
			$("#checkAddReturnTelefon").hide();
			$("#checkAddReturnEmTel").show();
            $("#checkAddReturnEmTel").html("<div class='alert alert-success'><i class='fas fa-check-circle'></i> E-Mail / Telefon</div>");
		}
		// IF EMAIL OR TELEFON IS EMPTY...

		if(bonnr.length == 0) {
			error[0] = true;
			$("#checkAddReturnBonnr").show();
			$("#checkAddReturnBonnr").html("<div class='alert alert-danger mt-3 mb-0'><i class='fas fa-times-circle'></i> Bon-Nr. nicht gültig</div>");
		} else if(bonValidation(bonnr) == false) {
            error[0] = true;
			$("#checkAddReturnBonnr").show();
            $("#checkAddReturnBonnr").html("<div class='alert alert-danger mt-3 mb-0'><i class='fas fa-times-circle'></i> Bon-Nr. - Format nicht gültig</div>");
        } else {
			error[0] = false;
			$("#checkAddReturnBonnr").show();
			$("#checkAddReturnBonnr").html("<div class='alert alert-success mt-3 mb-0'><i class='fas fa-check-circle'></i> Bon-Nr.</div>");
		}

		if(bondate.length == 0) {
			error[0] = true;
			$("#checkAddReturnBondate").show();
			$("#checkAddReturnBondate").html("<div class='alert alert-danger mt-3 mb-0'><i class='fas fa-times-circle'></i> Bon-Datum nicht gültig</div>");
        } else if(bonDateValidation(bondate) == false) {
            error[0] = true;
			$("#checkAddReturnBondate").show();
            $("#checkAddReturnBondate").html("<div class='alert alert-danger mt-3 mb-0'><i class='fas fa-times-circle'></i> Bon-Datum - Format nicht gültig</div>");
        } else {
			error[0] = false;
			$("#checkAddReturnBondate").show();
			$("#checkAddReturnBondate").html("<div class='alert alert-success mt-3 mb-0'><i class='fas fa-check-circle'></i> Bon-Datum</div>");
		}

		if(product.length == 0) {
			error[0] = true;
			$("#checkAddReturnProduct").show();
			$("#checkAddReturnProduct").html("<div class='alert alert-danger mt-3 mb-0'><i class='fas fa-times-circle'></i> Artikel nicht gültig</div>");
        } else if (product.length > 255){
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
        } else if (comment.length > 255){
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

// if(checkReturn()) { // BUG LAST INPUT ONLY SENDS
		var postData = $(this).serialize();

		$.ajax({
			url : "inc/asc/returnAdd.php",
			type: "post",
			data : postData,
			success: function(response) {
				// var callBack = JSON.parse(atob(response));

				var callBack = JSON.parse(response);

				if(callBack.revert == true) {
					// alert('success');
					$("#returnAddModal").modal("hide");
                    location.reload();
				} else {
					checkReturn(callBack);
				}
			}
		});

// }

});
// ==========================================================================
// ==========================================================================
// GET MYSQL FOR RETURN
// ==========================================================================
// ==========================================================================
function rowReturn(returnid)
{
	$.ajax({
		url : "inc/asc/returnEdit.php",
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
	$(this).find("#state").val($('select').children().eq(0).val());

	$(this).find("#noemail").prop("checked", false);
	$(this).find("#nophone").prop("checked", false);
	$(this).find("#email").prop("disabled", false);
	$(this).find("#telefon").prop("disabled", false);

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
// FUNCTIONS ==================================================================================================
function emailValidation(email) {
    return /\S+@\S+\.\S+/.test(email);
}

function phoneValidation(phone) {
    return /^\+?([0-9]{2})\)?([0-9]{8,13})$/.test(phone);
}

function bonValidation(bon) {
	return /^([0-9]{4,8})$/.test(bon);
}

function bonDateValidation(bonDate) {
    return /^(\d{2}).(\d{2}).(\d{4})$/.test(bonDate);
}

function checkboxToggle(checkboxID, toggleID) {
	var checkbox = $("#" + checkboxID)[0];
	var toggle = $("#" + toggleID)[0];
	$(toggle).val('');
	updateToggle = checkbox.checked ? toggle.disabled=true : toggle.disabled=false;
}

// DEBBUGING ==================================================================================================

/*
$(document).ready( function () {
    $(document).ready(function(){
       $('#returnTable').DataTable({
          'processing': true,
          'serverSide': true,
          'serverMethod': 'post',
          'ajax': {
              'url':'inc/TESTTABLE.php'
          },
          'columns': [
             { data: 'returnID' },
             { data: 'returnDate' },
             { data: 'returnFirstname' },
             { data: 'returnLastname' },
             { data: 'returnEmail' },
             { data: 'returnProduct' },
             { data: 'returnStatus' },
             { data: 'returnPrint' },
             { data: 'returnEdit' },
             { data: 'returnDel' }
          ]
       });
    });
} );
*/
