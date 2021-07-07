let searchResultsElement = document.querySelector('.search-results');
let fetchedData = fetchAllBands();
let searchLimit = 5;

$('.search-container input').keyup(function (e) {
    searchResultsElement.innerHTML = '';

    if (e.target.value) {
        let searchResults = findBandMatches(e.target.value, fetchedData);

        if (searchResults.length > 0) {
            if (searchResults.length > searchLimit) {
                for (let i = 0; i < searchLimit; i++) {
                    let resultElement = document.createElement('a');
                    resultElement.setAttribute('href', 'index.php?search=' + searchResults[i][0]);
                    resultElement.innerHTML = searchResults[i][0] + ', ' + searchResults[i][1];

                    searchResultsElement.appendChild(resultElement);
                }

                let remainderElement = document.createElement('a');
                remainderElement.setAttribute('href', 'index.php?search=' + e.target.value);
                remainderElement.classList.add('remainder');
                remainderElement.innerText = `There are ${searchResults.length - searchLimit} more results. Click to see all.`;

                searchResultsElement.appendChild(remainderElement);

            } else {
                searchResults.forEach(result => {
                    let resultElement = document.createElement('a');
                    resultElement.setAttribute('href', 'index.php?search=' + result[0]);
                    resultElement.innerHTML = result[0] + ', ' + result[1];

                    searchResultsElement.appendChild(resultElement);
                });
            }
        } else {
            let noResultElement = document.createElement('p');
            noResultElement.innerText = 'No Results Found.'
            searchResultsElement.appendChild(noResultElement);
        }
    }
})