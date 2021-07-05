const hiddenGenreInput = document.querySelector("input[name='genres']");

function updateGenre(e) {
    const pills = Array.from(document.querySelectorAll('.pill'));
    let pillValues = '';
    pills.forEach((pill, index) => {
        if (index === 0) {
            pillValues += pill.innerText;
        } else {
            pillValues += ', ' + pill.innerText;
        }
    });
    hiddenGenreInput.setAttribute('value', pillValues);
    console.log(hiddenGenreInput);
}