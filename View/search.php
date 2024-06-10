<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search Results - MSN News</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
<header>
    <nav>
        <div class="logo">
            <img src="logo.png" alt="MSN Logo">
            <span>MSN News</span>
        </div>
        <ul class="nav-links">

        </ul>
        <div class="right-nav">
            <div class="search-box">
                <input type="text" placeholder="Search..." data-en="Search..." data-tr="Ara...">
                <button id="search" data-en="Search" data-tr="Ara">Search</button>
            </div>
        </div>
    </nav>
</header>
<main>
    <section class="search-results">

    </section>
</main>
<script src="../plugins/jquery/jquery.js"></script>
<script src="scripts.js"></script>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        const urlParams = new URLSearchParams(window.location.search);
        const query = urlParams.get('query');

        if (query) {
            $.ajax({
                type: "GET",
                url: "../functions/newsByContent.php",
                data: { query: query },
                success: function(response) {
                    const data = JSON.parse(response);
                    const resultsSection = document.querySelector('.search-results');
                    resultsSection.innerHTML = '';

                    if (data.length > 0) {
                        data.forEach(function (value) {
                            const article = document.createElement('article');
                            const image = document.createElement('img');
                            image.setAttribute('src', "../images/" + value[2]);
                            image.setAttribute('alt', value[0]);
                            article.appendChild(image);

                            const heading = document.createElement('h3');
                            heading.textContent = value[0];
                            article.appendChild(heading);

                            const paragraph = document.createElement('p');
                            paragraph.textContent = value[1];
                            article.appendChild(paragraph);
                            resultsSection.appendChild(article);
                        });
                    } else {
                        resultsSection.innerHTML = '<p>No results found.</p>';
                    }
                }
            });
        }
    });
</script>
</body>
</html>
