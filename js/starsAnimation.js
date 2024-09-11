// Get all star images
const stars = document.querySelectorAll('.star-interactive');
let clickedIndex = 0; // Store the index of the clicked star

// Add hover event listener to each star
stars.forEach(star => {
    star.addEventListener('mouseover', highlightStars);
    star.addEventListener('mouseout', resetStars);
    star.addEventListener('click', changeClicked);
});

// Function to highlight the stars on hover
function highlightStars(event) {
    const index = event.target.getAttribute('data-index'); // Get the index of the hovered star

    // Loop through all stars and highlight those up to the hovered one
    stars.forEach(star => {
        if (star.getAttribute('data-index') <= index) {
            star.src = 'imgs/nonDatabaseImgs/star_full.png'; // Change to filled star image
        } else {
            star.src = 'imgs/nonDatabaseImgs/star.png'; // Keep the rest empty
        }
    });
}

// Function to reset stars when mouse leaves
function resetStars() {
    // Reset stars back to the last clicked state
    stars.forEach(star => {
        if (star.getAttribute('data-index') <= clickedIndex) {
            star.src = 'imgs/nonDatabaseImgs/star_full.png'; // Keep clicked stars filled
        } else {
            star.src = 'imgs/nonDatabaseImgs/star.png'; // Keep the rest empty
        }
    });
}

// Function to handle clicking a star
function changeClicked(event) {
    clickedIndex = event.target.getAttribute('data-index'); // Store the clicked star index
    document.getElementById('star-rating').value = clickedIndex;
}
