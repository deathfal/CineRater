document.addEventListener("DOMContentLoaded", function() {
    const carousel = document.querySelector('.carousel');
    const prevButton = document.querySelector('.carousel-prev');
    const nextButton = document.querySelector('.carousel-next');
    const items = carousel.querySelectorAll('.carousel-item');
    let currentIndex = 0;
    const totalItems = items.length;

    // Function to handle the transition to the next item
    function showNextItem() {
        const currentItem = items[currentIndex];
        currentItem.classList.add('outgoing-next');

        currentIndex = (currentIndex + 1) % totalItems;
        const nextItem = items[currentIndex];
        nextItem.classList.add('active');

        setTimeout(() => {
            currentItem.classList.remove('outgoing-next', 'active');
        }, 800);
    }

    
    function showPrevItem() {
        const currentItem = items[currentIndex];
        currentItem.classList.add('outgoing-prev'); 

        currentIndex = (currentIndex - 1 + totalItems) % totalItems;
        const prevItem = items[currentIndex];
        prevItem.classList.add('active', 'incoming-prev');  


        setTimeout(() => {
            currentItem.classList.remove('outgoing-prev', 'active'); 
            prevItem.classList.remove('incoming-prev'); 
        }, 800); 
    }

    items[currentIndex].classList.add('active');

    const autoSlide = setInterval(showNextItem, 5000);

   
    nextButton.addEventListener('click', function() {
        clearInterval(autoSlide); 
        showNextItem();
    });

    prevButton.addEventListener('click', function() {
        clearInterval(autoSlide); 
        showPrevItem();
    });
});
