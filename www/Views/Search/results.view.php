<div class="search-container">
    <h1>Search Results</h1>
    <div class="row">
        <?php if (empty($movies)): ?>
            <p class="no-results">No movies found for this search.</p>
        <?php else: ?>
            <?php foreach ($movies as $movie): ?>
                <div class="col col-3">
                    <div class="movie-item">
                        <a href="/movie/<?= $movie['id'] ?>">
                            <img src="<?= $movie['image'] ?>" alt="<?= $movie['title'] ?>" />
                            <h3><?= $movie['title'] ?></h3>
                        </a>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>
</div>
