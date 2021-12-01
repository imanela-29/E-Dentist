$(function(){
	$("#wizard").steps({
        headerTag: "h4",
        bodyTag: "section",
        transitionEffect: "fade",
        enableAllSteps: true,
        transitionEffectSpeed: 300,
        labels: {
            next: "Suivant",
            previous: "Précedent"
        },
        onStepChanging: function (event, currentIndex, newIndex) { 
            if ( newIndex >= 1 ) {
                $('.steps ul li:first-child a img').attr('src','assets/img/1-actif.png');
            } else {
                $('.steps ul li:first-child a img').attr('src','assets/img/1.png');
            }

            if ( newIndex === 1 ) {
                $('.steps ul li:nth-child(2) a img').attr('src','assets/img/2.png');
            } else {
                $('.steps ul li:nth-child(2) a img').attr('src','assets/img/2-actif.png');
            }

            if ( newIndex === 2 ) {
                $('.steps ul li:nth-child(3) a img').attr('src','assets/img/3.png');
            } else {
                $('.steps ul li:nth-child(3) a img').attr('src','assets/img/3-actif.png');
            }

            if ( newIndex === 3 ) {
                $('.steps ul li:nth-child(4) a img').attr('src','assets/img/4.png');
                $('.actions ul').addClass('step-4');
            } else {
                $('.steps ul li:nth-child(4) a img').attr('src','assets/img/4-actif.png');
                $('.actions ul').removeClass('step-4');
            }
            return true; 
        }
    });
    // Custom Button Jquery Steps
    $('.forward').click(function(){
    	$("#wizard").steps('next');
    })
    $('.backward').click(function(){
        $("#wizard").steps('previous');
    })

    // Create Steps Image
    $('.steps ul li:first-child').append('<img src="assets/img/step-arrow.png" alt="" class="img-fluid step-arrow">').find('a').append('<img src="assets/img/1.png" class="img-fluid" alt="">').append('<span class="img-fluid step-order"></span>');
    $('.steps ul li:nth-child(2)').append('<img src="assets/img/step-arrow.png" alt="" class="img-fluid step-arrow">').find('a').append('<img src="assets/img/2-actif.png" class="img-fluid" alt="">').append('<span class="img-fluid step-order"></span>');
    $('.steps ul li:nth-child(3)').append('<img src="assets/img/step-arrow.png" alt="" class="img-fluid step-arrow">').find('a').append('<img src="assets/img/3-actif.png" class="img-fluid" alt="">').append('<span class="img-fluid step-order"></span>');
    $('.steps ul li:last-child a').append('<img src="assets/img/4-actif.png" class="img-fluid" alt="">').append('<span class="img-fluid step-order"></span>');
    
})
