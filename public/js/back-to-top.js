let scrollTrigger = 100; // px

backToTop(scrollTrigger);

$(window).on('scroll', function () {
    backToTop(scrollTrigger);
});

// html ID: #back-to-top => c'est la fleche qui renvoie vers le haut
$('#back-to-top').on('click', function (e) {
    e.preventDefault();
    $('html,body').animate(
        {
            scrollTop: 0,
        },
        700
    );
});

function backToTop(scrollTrigger) {
    let scrollTop = $(window).scrollTop();
    if (scrollTop > scrollTrigger) {
        $('#back-to-top').addClass('show');
    } else {
        $('#back-to-top').removeClass('show');
    }
}
