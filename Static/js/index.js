$(function () {
	$(".registrarse").click(function(){
        $(".hidden").fadeOut();
        $(".hidden-registrar").fadeIn();
        $(".hidden-registrar").css({
            display: "flex",
        });
    });
	$(".signIn").click(function () {
        $(".hidden-registrar").fadeOut();
		$(".hidden").fadeIn();
		$(".hidden").css({
			display: "flex",
		});
	});
	$(".hidden").mouseup(function(e) {
		if(e.target.className == "hidden" ){
			$(".hidden").fadeOut();
		}
	});
	$(".hidden-registrar").mouseup(function(e) {
		if(e.target.className == "hidden-registrar" ){
			$(".hidden-registrar").fadeOut();
		}
	});
});
