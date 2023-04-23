populateGrid();
animateGrid();

//  Sliding Grid
function animateGrid() {
    const bg = document.getElementsByClassName('gridBg');
    const slideBtn = document.getElementsByClassName('slideBtn');
    const surface = document.getElementsByClassName('surface');
    const surfImg = document.getElementsByClassName('surf-img');

    for (let i = 0; i < slideBtn.length; i++) {
        slideBtn[i].addEventListener('click', () => {
            if (i === 0) {
                surface[i].classList.toggle('shift0');
                resetGrid(i);

            }
            else if (i === 1) {
                surface[i].classList.toggle('shift1');
                resetGrid(i);

            }
            else if (i === 2) {
                surface[i].classList.toggle('shift2');
                resetGrid(i);

            }
            else if (i === 3) {
                surface[i].classList.toggle('shift3');
                resetGrid(i);

            }
            else if (i === 4) {
                surface[i].classList.toggle('shift4');
                resetGrid(i);

            }
            else {
                surface[i].classList.toggle('shift5');
                resetGrid(i);

            }
            setTimeout(zBoost, 1760, i);
            surface[i].style.transition = 'all 1.8s ease-in-out';
            surfImg[i].classList.toggle('rotate');
            surfImg[i].style.transition = 'all 1.8s ease-in-out';
        });
    }
    function zBoost(i) {
        bg[i].classList.toggle('zBoost');
    }
    function resetGrid(i) {
        for (let j = 0; j < slideBtn.length; j++) {
            if (j === i) {
                continue;
            }
            surface[j].classList.remove('shift0');
            surface[j].classList.remove('shift1');
            surface[j].classList.remove('shift2');
            surface[j].classList.remove('shift3');
            surface[j].classList.remove('shift4');
            surface[j].classList.remove('shift5');
            bg[j].classList.remove('zBoost');
        }

    }

}

// Grid (Project) Info
function populateGrid() {
    let itemInfo = [
        {
            "gridRef": 0,
            "title": "Musician Portfolio Site",
            "tech": "Built with HTML SCSS Vanilla JS",
            "describe": "My live musician's portfolio site built autodidactically and documenting some of the highlights from my career as a musician between 2012-2020.",
            "tag": "Front-End Live Site",
            "link": "https://www.andrewgorman.art",
            "image": "main-img/main-icons/play-icon-color-orange-scaled.png"

        },
        {
            "gridRef": 1,
            "title": "Tutor for the Future",
            "tech": "Built with Angular 12",
            "describe": "A single-page application showcasing my decade of experience with tuition in over three disciplines of expertise.",
            "tag": "Angular E-commerce SPA",
            "link": "/PlayToLearn/",
            "image": "main-img/main-icons/angular2.jpeg"
        },
        {
            "gridRef": 2,
            "title": "Travel Agent",
            "tech": "Built with Typescript, Swiper JS HTML & SASS",
            "describe": "A template for a greek travel agent's website using strict typing with sorting filters. Features use of the Swiper JS library.",
            "tag": "Front-End Travel App created with Typescript and Swiper JS",
            "link": "projects/TravelAgent/",
            "image": "main-img/main-icons/ts.jpeg"
        },
        {
            "gridRef": 3,
            "title": "Login Library",
            "tech": "Built with HTML5 CSS3 MySQL, PHP",
            "describe": "Full-Stack c.r.u.d media library inside a c.r.u.d login system using procedural php",
            "tag": "Full-Stack Library App with API and AJAX Filters",
            "link": "projects/CrudLibrary/",
            "image": "main-img/main-icons/mysqlPHP.jpeg"
        },
        {
            "gridRef": 4,
            "title": "AJAX and API",
            "tech": "Built with AJAX PHP",
            "describe": "Full Stack Travel-Agency Crud App with Google Maps and Darkskies APIs providing realtime weather at location updates.",
            "tag": "Full Stack App with AJAX features and weather APIs",
            "link": "projects/MountEverest/",
            "image": "main-img/main-icons/ajax.jpeg"
        },
        {
            "gridRef": 5,
            "title": "Symfony Login System and crud",
            "tech": "Symfony 5 Backend PHP framework.",
            "describe": "2 Applications built with symfony 5. One manual. One showcasing symfony's powerful crud-making tool",
            "tag": "Full-Stack CRUD App built with the Symfony 5 back-end framework (Coming soon)",
            "link": "https://github.com/andrewgorman-dev/symfony5-projects.git",
            "image": "main-img/main-icons/symfony.jpeg"
        },
    ];

    // rows to populate
    const gridBg = document.getElementById('puz-grid-bg');
    const gridSurf = document.getElementById('puz-grid-surf');

    for (let x of itemInfo) {

        gridBg.innerHTML += `
                            <div class="col-sm-12 col-md-6 col-lg-4 col-xl-4 col-xxl-4 m-auto outer-col-bg my-3 item-bg${x.gridRef} gridBg animate__animated animate__rotateIn">
                                <div class="item-title">
                                    <h3 class="text-center">${x.title}</h3>
                                </div>
                                <div class="item-subtitle">
                                    <p class="text-center">Technologies: ${x.tech}</p>
                                </div>
                                <div class="item-text text-justify">
                                    <p>${x.describe}</p>
                                </div>
                                <div class="text-center mt-3">
                                    <a href="${x.link}" target="_blank" class="btn btn-outline-info rounded shadow">View Project</a>
                                </div>
                            </div>`

        gridSurf.innerHTML += `
                            <div class="col-sm-12 col-md-6 col-lg-4 col-xl-4 col-xxl-4 m-auto my-2 justify-content-center outer-col-surf item-surf${x.gridRef} surface slideBtn">
                                <div class="surf-title">
                                    <h5 class="text-light">${x.title}</h5>
                                </div>
                                <div class="surf-img mt-3">
                                    <img src="${x.image}" alt="">
                                </div>
                                <div class="text-center mt-3">
                                <p class="text-light text-center">
                                <i>${x.tag}</i>
                                </p>
                                </div>
                            </div>`
    }
}