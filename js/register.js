function register () {
	$('#signupForm').on('submit', function(e){
		e.preventDefault();

		var formObject = $(this);
		var formURL = formObject.attr("action");

		$.ajax({
			url: formURL,
			type: "POST",
			data: formObject.serialize(),
			success: function(id, textStatus, jqXHR)
			{
				window.location = "index.html";
			},
			error: function(jqXHR, textStatus, errorThrown)
			{
				console.log('Form Error');
			}
		});

	});
}