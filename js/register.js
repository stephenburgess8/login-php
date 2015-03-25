function register () {
	$('#signupForm').on('submit', function(e){
		e.preventDefault();

		var formObject = $(this);
		var formURL = formObject.attr("action");

		$.ajax({
			url: formURL,
			type: "POST",
			data: formObject.serialize(),
			success: function(data, id, textStatus, jqXHR)
			{
				console.log("Hi " + data);
			},
			error: function(jqXHR, textStatus, errorThrown)
			{
				console.log('Form Error');
			}
		});
	});
}
