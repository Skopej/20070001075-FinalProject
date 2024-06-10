<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MSN News</title>
    <link rel="stylesheet" href="styles.css">
    <script src="https://apis.google.com/js/platform.js" async defer></script>
    <meta name="google-signin-client_id" content="874318790387-8l407u3nlrb1d282ddpeg3k8r3q5oo7q.apps.googleusercontent.com">
    <script>
        function onSignIn(googleUser) {
            window.location.href = 'index.html';
        }

        function performSearch() {
            const query = document.querySelector('.search-box input').value;
            $.ajax({
                type: "GET",
                url: "newsByContent.php",
                data: { query: query },
                success: function(response) {
                    Info(response);
                }
            });
        }
    </script>
    <style>
        .hidden { display: none; }
    </style>
</head>
<body>
<header>
    <nav>
        <div class="logo">
            <img src="logo.png" alt="MSN Logo">
            <span data-en="MSN News" data-tr="MSN Haber">MSN News</span>
        </div>
        <ul class="nav-links">
            <li data-en="World" data-tr="Dünya">World</li>
            <li data-en="Politics" data-tr="Siyaset">Politics</li>
            <li data-en="Business" data-tr="İş">Business</li>
            <li data-en="Technology" data-tr="Teknoloji">Technology</li>
            <li data-en="Entertainment" data-tr="Eğlence">Entertainment</li>
            <li data-en="Sports" data-tr="Spor">Sports</li>
            <li data-en="Health" data-tr="Sağlık">Health</li>
        </ul>
        <div class="right-nav">
            <div class="search-box">
                <input type="text" placeholder="Search..." data-en="Search..." data-tr="Ara...">
                <button id="search" data-en="Search" data-tr="Ara" onclick="performSearch()">Search</button>
            </div>
            <div class="profile">
                <a href="user.php">
                    <img src="profile-icon.png" alt="Profile Icon">
                </a>
            </div>
            <div class="language-selector">
                <button onclick="toggleLanguage()">Türkçe</button>
            </div>
        </div>
    </nav>
</header>
<main>
    <section class="carousel">
        <div class="carousel-container"></div>
        <div class="carousel-controls">
            <button id="prev">❮</button>
            <button id="next">❯</button>
        </div>
    </section>
    <section class="news">
        <h2 data-en="Latest News" data-tr="Son Haberler">Latest News</h2>
        <div class="news-articles"></div>
    </section>
</main>
<script src="../plugins/jquery/jquery.js"></script>
<script src="scripts.js"></script>
<script>
    function Info(response) {
        const articles = document.getElementsByClassName('news-articles')[0];
        const container = document.getElementsByClassName('carousel-container')[0];
        articles.innerHTML = '';
        container.innerHTML = '';
        const data = JSON.parse(response);
        data.forEach(function (value){
            const carouselSlide = document.createElement('div');
            carouselSlide.classList.add('carousel-slide');

            const image = document.createElement('img');
            image.setAttribute('src', "../images/"+value[2]);
            image.setAttribute('alt', value[0]);
            carouselSlide.appendChild(image);
            container.appendChild(carouselSlide);
        });
        initializeCarousel();

        data.sort(function(a, b) {
            const dateA = new Date(a[3]);
            const dateB = new Date(b[3]);
            return dateB - dateA;
        });
        const top3Data = data.slice(0, 3);
        top3Data.forEach(function (value){
            const article = document.createElement('article');
            const image = document.createElement('img');
            image.setAttribute('src', "../images/"+value[2]);
            image.setAttribute('alt', value[0]);
            article.appendChild(image);

            const heading = document.createElement('h3');
            heading.textContent = value[0];
            article.appendChild(heading);

            const paragraph = document.createElement('p');
            paragraph.textContent = value[1];
            article.appendChild(paragraph);
            articles.appendChild(article);
        });
    }

    $.ajax({
        type: "POST",
        url: "../functions/allNews.php",
        data: { },
        success: function(response) {
            Info(response);
        }
    });

    document.querySelectorAll(".nav-links li").forEach(function (category){
        category.addEventListener("click", function (){
            $.ajax({
                type: "POST",
                url: "../functions/newsByCategory.php",
                data: { categoryName: this.innerHTML },
                success: function(response) {
                    Info(response);
                }
            });
        });
    });

    function setLanguage(language) {
        document.querySelectorAll('[data-en]').forEach(function(element) {
            element.classList.add('hidden');
        });
        document.querySelectorAll('[data-tr]').forEach(function(element) {
            element.classList.add('hidden');
        });
        document.querySelectorAll('[data-' + language + ']').forEach(function(element) {
            element.textContent = element.getAttribute('data-' + language);
            element.classList.remove('hidden');
        });
        localStorage.setItem('preferredLanguage', language);
    }

    document.addEventListener('DOMContentLoaded', () => {
        const savedLanguage = localStorage.getItem('preferredLanguage') || 'en';
        setLanguage(savedLanguage);
    });

    function toggleLanguage() {
        const currentLanguage = localStorage.getItem('preferredLanguage') || 'en';
        const newLanguage = currentLanguage === 'en' ? 'tr' : 'en';
        setLanguage(newLanguage);
        document.querySelector('.language-selector button').textContent = newLanguage === 'en' ? 'Türkçe' : 'English';
    }
</script>
</body>
</html>
