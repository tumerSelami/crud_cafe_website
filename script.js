//OWL CAROUSEL

//Main page image carousel

var main_page_owl_gallery = $('#main-page-carousel-container.owl-carousel');
main_page_owl_gallery.owlCarousel({
    loop:true,
    nav:true,
    margin:20,
    navText:['<img src="./assets/icons-and-logos/arrow.png" alt="icon-of-a-double-arrow" class="icon">', '<img src="./assets/icons-and-logos/arrow.png" alt="icon-of-a-double-arrow" class="icon">'],
    responsive:{
        0:{
            items:1
        },
        600:{
            items:2
        },            
        800:{
            items:3
        },            
        1200:{
            items:4
        }
    }
});

main_page_owl_gallery.on('mousewheel', '.owl-stage', function (e) {
    if (e.deltaY>0) {
        main_page_owl_gallery.trigger('next.owl');
    } else {
        main_page_owl_gallery.trigger('prev.owl');
    }
    e.preventDefault();
});


//Main page testimonials carousel

var owl_testimonials = $('#testimonials .owl-carousel');
owl_testimonials.owlCarousel({
    loop:true,
    nav:true,
    margin:10,
    navText:['<img src="./assets/icons-and-logos/arrow.png" alt="icon-of-a-double-arrow" class="icon">', '<img src="./assets/icons-and-logos/arrow.png" alt="icon-of-a-double-arrow" class="icon">'],
    responsive:{
        0:{
            items:1
        }
    }
});

//About us image carousel

var about_us_owl_gallery = $('#about-us-carousel-container.owl-carousel');
about_us_owl_gallery.owlCarousel({
    loop:true,
    nav:true,
    margin:20,
    navText:['<img src="../assets/icons-and-logos/arrow.png" alt="icon-of-a-double-arrow" class="icon">', '<img src="../assets/icons-and-logos/arrow.png" alt="icon-of-a-double-arrow" class="icon">'],
    responsive:{
        0:{
            items:1
        }
    }
});

//MENU TOGGLE

$('#menu-toggle').click(function() {
    $('#header-nav').toggleClass('active');
});

//CATEGORIES TOGGLE

$("#categories button").click(function() {
    $("#categories button").removeClass('active');
    $(this).addClass('active');
});

