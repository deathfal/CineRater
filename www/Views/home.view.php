<!-- Home View -->

<!-- Carousel Section -->
<section class="carousel">
    <div class="carousel-item">
        <img src="../../assets/img/carousel/car1.png" alt="Featured Image">
        <div class="carousel-content">
            <h1>The Big Blue</h1>
            <p>The rivalry between Enzo and Jacques, two childhood friends...</p>
            <button>Watch Now</button>
        </div>
    </div>
    <div class="carousel-item">
        <img src="../../assets/img/carousel/car2.png" alt="Featured Image">
        <div class="carousel-content">
            <h1>Tron Legacy</h1>
            <p>The son of a virtual world designer goes looking for his father...</p>
            <button>Watch Now</button>
        </div>
    </div>
    <div class="carousel-item">
        <img src="../../assets/img/carousel/car3.png" alt="Featured Image">
        <div class="carousel-content">
            <h1>Fight Club</h1>
            <p>An insomniac office worker and a devil-may-care soapmaker...</p>
            <button>Watch Now</button>
        </div>
    </div>
    <div class="carousel-item">
        <img src="../../assets/img/carousel/car4.png" alt="Featured Image">
        <div class="carousel-content">
            <h1>Taxi Driver</h1>
            <p>A mentally unstable veteran works as a nighttime taxi driver...</p>
            <button>Watch Now</button>
        </div>
    </div>

    <div class="carousel-item">
        <img src="../../assets/img/carousel/car5.png" alt="Featured Image">
        <div class="carousel-content">
            <h1>Inception</h1>
            <p>A thief who steals corporate secrets through the use of dream-sharing technology...</p>
            <button>Watch Now</button>
        </div>
    </div>

    <div class="carousel-item">
        <img src="../../assets/img/carousel/car6.png" alt="Featured Image">
        <div class="carousel-content">
            <h1>Interstellar</h1>
            <p>A team of explorers travel through a wormhole in space...</p>
            <button>Watch Now</button>
        </div>
    </div>
    

    

    <button class="carousel-prev">Prev</button>
    <button class="carousel-next">Next</button>
</section>


<!-- Featured Section -->
<section class="featured">
    <h2>Featured Today</h2>
    <div class="featured-carousel">
        <?php foreach ($movies as $movie): ?>
            <div class="featured-item">
                <a href="/movie/<?= $movie->getId() ?>">
                    <img src="<?= $movie->getImage() ?>" alt="<?= $movie->getTitle() ?>">
                    <h3><?= $movie->getTitle() ?></h3>
                </a>
            </div>
        <?php endforeach; ?>
    </div>
</section>

<!-- Up Next Section -->
<section class="up-next">
    <h2>Up Next</h2>
    <div class="up-next-item">
        <img src="../../assets/img/upnext/upnext1.png" alt="Upcoming Movie">
        <div class="up-next-content">
            <h3>Tron : Ares</h3>
            <p>Get ready for this!</p>
        </div>
    </div>
    <div class="up-next-item">
        <img src="../../assets/img/upnext/upnext2.png" alt="Upcoming Movie">
        <div class="up-next-content">
            <h3>Avengers : Doomsday</h3>
            <p>Don’t miss it!</p>
        </div>
    </div>
    <!-- More Up Next items -->
</section>

<!-- Popular Section -->
<section class="popular">
    <h2>Most Popular Celebrities</h2>
    <div class="popular-grid">
        <div class="popular-item">
            <img src="../../assets/img/celebrities/keanu-reeves.png" alt="Celebrity 1">
            <h3>Keanu Reeves</h3>
        </div>
        <div class="popular-item">
            <img src="../../assets/img/celebrities/Tim-Burton.png" alt="Celebrity 2">
            <h3>Tim Burton</h3>
        </div>
        <div class="popular-item">
            <img src="../../assets/img/celebrities/Eve-Hewson.png" alt="Celebrity 3">
            <h3>Eve Hewson</h3>
        </div>
        <div class="popular-item">
            <img src="../../assets/img/celebrities/Michael-Keaton.png" alt="Celebrity 4">
            <h3>Michael Keaton</h3>
        </div>
    </div>
</section>
