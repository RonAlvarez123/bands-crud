$('.a-click').mouseenter(function (e) {
    e.target.classList.toggle('a-click-on', true);
});

$('.a-click').mouseout(function (e) {
    e.target.classList.toggle('a-click-on', false);
});