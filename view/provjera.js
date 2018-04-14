$(document).ready( function()
{
	$("#korisnicko_ime").on("input", provjeriIme);

	provjeriIme();

} );

provjeriIme = function()
{
		var input = $("#korisnicko_ime").val();

		if(/^[a-zA-Z0-9 čćžšđ]{1,20}$/.test( input ))
		{
			$( "#alert")
				.html("");
		}

		else
		{
			$( "#alert")
			.css("color", "red")
				.html("Korisničko ime se sastoji od slova i brojki!");
		}
}
