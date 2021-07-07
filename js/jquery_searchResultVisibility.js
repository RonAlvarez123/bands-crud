$('body').click(function (e) {
    if (e.target.tagName == 'INPUT') {
        document.querySelector('ul.search-results').classList.toggle('hide', false);
    } else {
        document.querySelector('ul.search-results').classList.toggle('hide', true);
    }
});