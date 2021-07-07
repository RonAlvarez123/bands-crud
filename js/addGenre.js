const inputGenre = document.querySelector('.inputGenre');
const Genres = document.querySelector('.genres');

inputGenre.addEventListener('keydown', addGenre);

function addGenre(e) {
    if (e.keyCode == 13) {
        e.preventDefault();

        let inputValue = inputGenre.value;
        if (inputValue) {
            let genreElement = document.createElement('article');
            genreElement.classList.add('pill');
            genreElement.innerText = inputValue;
            Genres.appendChild(genreElement);
            inputGenre.value = '';
            updateGenre();
        }

    }
}