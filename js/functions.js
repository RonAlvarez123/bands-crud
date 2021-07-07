function fetchAllBands() {
    let bandValues = {
        allBands: [],
        allBandCodes: [],
        allBandNames: []
    };

    xhr = new XMLHttpRequest();
    xhr.onload = function () {
        if (this.status == 200) {
            let response = xhr.responseXML
            let bands = Array.from(response.getElementsByTagName('band'));
            bands.forEach(band => {
                let genres = [];
                Array.from(band.children[3].children).forEach(genre => {
                    genres.push(genre.innerHTML);
                });

                bandValues.allBands.push({
                    code: band.getAttribute('bandCode'),
                    name: band.children[0].innerHTML,
                    debut: band.children[1].innerHTML,
                    hitSong: band.children[2].innerHTML,
                    genres: genres
                });

                bandValues.allBandCodes.push(band.getAttribute('bandCode'));
                bandValues.allBandNames.push(band.children[0].innerHTML);
            });
        }
    }
    xhr.open('GET', 'IconicOpmBands.xml', false);
    xhr.send();

    return bandValues;
}

function findBandMatches(word, bandData) {
    let result = [];
    const regex = new RegExp(word, 'gi');
    bandData.allBandNames.forEach((item, index) => {
        if (item.match(regex)) {
            result.push([item, bandData.allBands[index].debut]);
        }
    });

    return result;
}