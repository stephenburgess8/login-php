/*
function accordian(accordianDiv) {
    $(accordianDiv).accordion({
        collapsible: true,
        heightStyle: "content"
    });
}
/*
function healthBar(healthBarDiv) {

    var hBar = $(healthBarDiv);

    $(hBar).progressbar({
        value: (1 / 12) * 100
    });

    $(hBar).height(20);

    var healthBarValue = hBar.find(".ui-progressbar-value");

    healthBarValue.css({
        "background": '#86937C'
    });

}
/*
		function manaBar(manaBarDiv) {

		    var mBar = $(manaBarDiv);

		    $(mBar).progressbar({
		        value: (1 / 10) * 100
		    });

		    $(mBar).height(20);

		    var manaBarValue = mBar.find(".ui-progressbar-value");

		    manaBarValue.css({
		        "background": '#2D2775'
		    });

		}
*/
function login() {
    $('#loginForm').on('submit', function(e) {
    	e.preventDefault();

        var formObject = $(this);
        var formURL = formObject.attr("action");
        $.ajax({
            url: formURL,
            type: "POST",
            data: formObject.serialize(),
            dataType: 'json',
            success: function (data) {
                if (data.new) {
                	console.log(document.getElementById("loginDiv"));
                	// Hide the Login div
	                document.getElementById("loginDiv").style.display = "none";
	            	// Now that the player is logged in, show the logout link.
	                document.getElementById('logout').style.display = "block";
	                // Hide the Login div
	                document.getElementById("loginDiv").style.display = "none";
	                // Show the div containing information about the user
	                document.getElementById('info').style.display = "block";
	                document.getElementById('cardinals').style.display = "block";
                    document.getElementById('setupDiv').style.display = "block";
                } else {
                    statusUpdate();
                }

            },
            error: function (data, id, jqXHR, textStatus, errorThrown) {
                $("#loginDiv").append('Incorrect Login Info: ' + textStatus + " / " + id);
                console.log("Response Text: " + data.responseText);
            }
        });

    });

}
/*
		function setup() {
		    $('#setupForm').on('submit', function (e) {
		        //e.preventDefault();


		        var formObject = $(this);
		        var formURL = formObject.attr("action");

		        $.ajax({
		            url: formURL,
		            type: "POST",
		            data: formObject.serialize(),
		            dataType: 'json',
		            success: function (data) {
		            	console.log(data);
		                $("#hero").html(data.user.heroName);
		                $("#hp").html(data.user.hp);
		                $("#maxHP").html(data.user.maxhp);
		                $("#mp").html(data.user.mp);
		                $("#maxMP").html(data.user.maxmp);
		                $("#money").html(data.user.money);

		                $('#healthBar').progressbar({
		                    value: (data.user.hp / data.user.maxhp) * 100
		                });

		                $('#manaBar').progressbar({
		                    value: (data.user.mp / data.user.maxmp) * 100
		                });

		                //$('#weapon').find('.name').text(data.inventory.equipment.stuff.weapon.wName);
		                //$('#weapon').find('.icon').attr('src', 'icons/'+data.inventory.equipment.stuff.weapon.kind+'.jpg');

		                //$('#belt').text(data.inventory.belt.name);

		                //$('#beltHead').find('.filledSlots').text(data.inventory.belt.filledSlots);
		                //$('#beltHead').find('.slots').text(data.inventory.belt.slots);

		                /*$.each(data.inventory.belt.stuff, function (index, value) {
		                    $('#b'.index).find("a").attr('id', value.kind);
		                    $('#b'.index).find('a').text(value.oName);
		                    $('#b'.index).find('.filledSlots').text(value.quantity);
		                    $('#b'.index).find('.slots').text(value.maxStack);
		                });
		                /*
							    $("#b1").find("a").attr(id, data.inventory.0.stuff.0.type);
							    $("#b1").find("a").text(data.inventory.0.stuff.0.name);
							    $('#b1').find('.filledSlots').text(data.inventory.0.stuff.0.filledSlots);
							    $('#b1').find('.slots').text(data.inventory.0.stuff.0.slots);

							    $("#b2").find("a").attr(id, data.inventory.0.stuff.2.type);
							    $("#b2").find("a").text(data.inventory.0.stuff.2.name);
							    $('#b2').find('.filledSlots').text(data.inventory.0.stuff.2.filledSlots);
							    $('#b2').find('.slots').text(data.inventory.0.stuff.2.slots);

							    $("#b3").find("a").attr(id, data.inventory.0.stuff.0.type);
							    $("#b3").find("a").text(data.inventory.0.stuff.0.name);
							    $('#b1').find('.filledSlots').text(data.inventory.0.stuff.0.filledSlots);
							    $('#b1').find('.slots').text(data.inventory.0.stuff.0.slots);
		*//*
		                $("#setupDiv").remove();
		                $("#state" + data.user.state).show();
		            },
		            error: function (jqXHR, textStatus, errorThrown) {
		                $("#setupDiv").append('<br />Something went wrong.');
		            }
		        });

		    });

		}
*/
		function statusUpdate() {
		    $.ajax({
		        url: 'checkStatus.php',
		        dataType: 'json',
		        success: function (data) {
		        	//console.log(data);
		        	// If player has not gone through setup
		        	if (data.user != '0') {
/*
		                // Show Info Sidebar
		                $('#info').show();
		                
		                // Hide the previously shown state
		                $(".story").hide();

		                // No longer show the login div
		                $("#loginDiv").remove();

		                // If the user has been through setup
		                if (data.user != -1) {
		                	// Update info bar
		                    $("#hero").html(data.user.heroName);
		                    $("#hp").html(data.user.hp);
		                    $("#maxHP").html(data.user.maxhp);
		                    //$("#mp").html(data.user.mp);
		                    //$("#maxMP").html(data.user.maxmp);
		                    $("#money").html(data.user.money);

		                    // Dealing with weapons
		                    //$('#weapon').find('.name').text(data.inventory.equipment.stuff.weapon.wName);
		                    //$('#weapon').find('.icon').attr('src', 'icons/'+data.inventory.equipment.stuff.weapon.kind+'.jpg');

		                    // Finds state 
		                    var newState = $("#state" + data.user.state);
		                    
		                    // Hides Last State
		                   	$('#state' + data.user.lastState).hide();

		                    // Changes div corresponding to new state display: block;        	
		                    newState.show();

		                    $('#location').html(newState.attr("title"));

		                    $('#healthBar').progressbar({
		                        value: (data.user.hp / data.user.maxhp) * 100
		                    });
/*
		                    $('#manaBar').progressbar({
		                        value: (data.user.mp / data.user.maxmp) * 100
		                    }); 
		                } else {
		                    $('#setupDiv').show();
		                } 
		                */
		            }

		        },
		        error: function(jqXHR, textStatus, errorThrown) {
		        	console.log ('wtf?');
		        }
		    });
		}

document.addEventListener("DOMContentLoaded", function(event) { 

    statusUpdate();

    login();


});