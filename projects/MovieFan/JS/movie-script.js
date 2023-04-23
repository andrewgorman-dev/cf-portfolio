// Parse json movie data to create array
let moviesParse = JSON.parse(movies);
// console.log(moviesParse) // Test

// Call on page load:
printToGrid(moviesParse);
likesCounter();

// FUNCTIONS
// Print Bootstrap cards to grid
function printToGrid(array) {
    const row = document.getElementById('grid-row');
    for (let x of array) {
        row.innerHTML
            += `
                <div class="col-sm-12 col-md-6 col-lg-4">
                    <div class="card">
                        <div class="img-container" style="background-image: url('img/${x.name}.jpeg');"></div>
                        <div class="card-body">
                            <h5 class="card-title">${x.name}</h5>
                            <p class="card-title">(${x.year})</p>
                            <hr>
                            <p class="card-title"><i>${x.genre}</i></p>
                            <hr>
                            <p class="card-text" id="card-desc">${x.description}</p>
                            <p class="card-text"><small class="text-muted"><i>Rotten Tomatoes: ${x.rottenTomatoes}%</i></small></p>
                        </div>
                        <div class="likes">
                            <div>
                                <button class="likesBtn"><img src="img/icons/hand-thumbs-up.svg" alt="thumbs up icon"></button>
                            </div>
                            <div class="likes-counter">
                                <div class="likes-count">
                                    <div><p class="likes-number">${x.likes}</p></div>
                                </div>
                                <div class="likes-likes"><small><i>like(s)</i></small></div>
                            </div>
                        </div>
                    </div>
                </div > 
            `;
    };
}

// Count and update likes
function likesCounter() {
    const likesBtn = document.getElementsByClassName('likesBtn');
    let likesNum = document.getElementsByClassName('likes-number');
    for (let i = 0; i < likesNum.length; i++) {
        likesBtn[i].addEventListener('click', function () {
            moviesParse[i].likes += 1;
            likesNum[i].innerHTML = moviesParse[i].likes;

            sortByLikes(i, moviesParse[i].likes);
        });
    };
}

// function sortLikes(arr){
//     arr.sort((a,b) => a.likes - b.likes);
// }

// Re-sort json data
function sortByLikes(a, b) {
    moviesParse[a].likes = b;
    // console.log(moviesParse); // Test
    return moviesParse;
}

// Re-order in browser
const sortBtn = document.getElementById('burgerBtn');
sortBtn.addEventListener('click', function () {
    // Sort
    orderArray(moviesParse);
    // Clear Grid
    clearGrid();
    // Reprint
    printToGrid(moviesParse);
    // re-initialize likes counter start from new position
    likesCounter();
})

function orderArray(array) {
    array.sort(function (a, b) {
        return a.likes - b.likes;
    });
    array.reverse();
}

function clearGrid() {
    const row = document.getElementById('grid-row');
    row.innerHTML = '';
}

// Burger Toggle
const burgerBtn = document.querySelector('.burgerBtn');
const burger = document.querySelector('.burger');
burgerBtn.addEventListener('click', () => {
    // Add toggle class to activate CSS transition
    burger.classList.toggle('toggle');
});
