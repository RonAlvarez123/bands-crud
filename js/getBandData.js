const bandCodeSelect = document.querySelector('.bandCodeSelect');
let fetchedData = fetchAllBands();

populateBandCode();
bandCodeSelect.addEventListener('change', getBandData);

function getBandData(e) {
    const bandNameInput = document.querySelector("input[name='bandName']");
    const debutInput = document.querySelector("input[name='debut']");
    const hitSongInput = document.querySelector("input[name='hitSong']");
    const genreInput = document.querySelector("input[name='genres']");
    const pillContainer = document.querySelector('.genres');

    pillContainer.innerHTML = '';
    bandNameInput.value = '';
    debutInput.value = '';
    hitSongInput.value = '';

    fetchedData.allBands.forEach(band => {
        if (e.target.value && e.target.value == band.code) {
            pillContainer.innerHTML = '';

            bandNameInput.value = band.name;
            debutInput.value = band.debut;
            hitSongInput.value = band.hitSong;

            let genreInputValue = '';
            band.genres.forEach((genre, index) => {
                console.log(index, genre);
                if (index === 0) {
                    genreInputValue += genre;
                } else {
                    genreInputValue += ', ' + genre;
                }
                genreInput.value = genreInputValue;
                let genreElement = document.createElement('article');
                genreElement.classList.add('pill');
                genreElement.innerText = genre;
                pillContainer.appendChild(genreElement);

            });

            return true;
        }
    });
}

function populateBandCode() {
    for (let code of fetchedData.allBandCodes) {
        let option = document.createElement('option');
        option.value = code;
        option.innerText = code;

        bandCodeSelect.appendChild(option);
    }
}