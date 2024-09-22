<section class="movie-details container">
    <div class="row">
        <div class="col col-12 col-md-6">
            <img src="<?= $movie->getImage() ?>" alt="<?= $movie->getTitle() ?>" class="movie-poster">
        </div>
        <div class="col col-12 col-md-6">
            <h1><?= $movie->getTitle() ?></h1>
            <p><?= $movie->getDescription() ?></p>
        </div>
    </div>
</section>

<section class="comments-section container">
    <div class="row">
        <div class="col col-12">
            <h2>Comments</h2>
        </div>
        <div class="row">
            <div class="col col-12 col-md-6">
                <div class="comment">
                    <div class="comment-header">
                        <h3>John Doe</h3>
                        <span>2 days ago</span>
                    </div>
                    <div class="comment-body">
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam nec purus ac libero ultricies
                            ultricies. Nullam nec purus ac libero ultricies ultricies.</p>
                    </div>
                </div>
            </div>
            <div class="col col-12 col-md-6">
                <div class="comment">
                    <div class="comment-header">
                        <h3>Jane Doe</h3>
                        <span>3 days ago</span>
                    </div>
                    <div class="comment-body">
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam nec purus ac libero ultricies
                            ultricies. Nullam nec purus ac libero ultricies ultricies.</p>
                    </div>
                </div>
            </div>
        </div>