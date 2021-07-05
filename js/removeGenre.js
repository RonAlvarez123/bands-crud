Genres.addEventListener('click', removeGenre);

function removeGenre(e) {
    if (e.target.classList.contains('pill')) {
        e.target.remove();
        updateGenre();
    }
}