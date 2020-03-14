function stickyHeader () {
	if ($('header').length) {
		var strickyScrollPos = $('header').next().offset().top;
		if($(window).scrollTop() > strickyScrollPos) {
			$('header').addClass('sticky');
			$('body').addClass('sticky');
		}
		else if($(window).scrollTop() <= strickyScrollPos) {
		  	$('header').removeClass('sticky');
		  	$('body').removeClass('sticky');
		}
	};
};

    // Scroll to Top
	//Check to see if the window is top if not then display button
    $(window).scroll(function(){
    	stickyHeader();
        if ($(this).scrollTop() > 100) {
            $('.scrollup').fadeIn();
        } else {
            $('.scrollup').fadeOut();
        }
    });
    
    //Click event to scroll to top
    $('.scrollup').on("click",function(){
        $('html, body').animate({scrollTop : 0},800);
        return false;
    });
