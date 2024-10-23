$('.toggle-button').on('click', function() {
    $('.left-sidebar').toggleClass('minimize');
});

$('.user-profile').on('click', function() {
    $('.left-sidebar').toggleClass('minimize');
});

$('.close-chat-btn').on('click', function() {
    $('.direct-messaging ').addClass('minimize');
});

$('.open-chat-btn').on('click', function() {
    $('.direct-messaging ').toggleClass('minimize');
});

$('.open-profile-btn').on('click', function() {
    $('.profile-card').addClass('show');
    $('.menu-display').removeClass('show');
});

$('.open-menu-btn').on('click', function() {
    $('.menu-display').addClass('show');
    $('.profile-card').removeClass('show');

});