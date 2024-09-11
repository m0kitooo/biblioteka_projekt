$(document).ready(function() {
    $(".fav").on("click", function() {
        const heartImg = $(this); // `this` odnosi się teraz do klikniętego obrazka
        $.post("changeFav.php", { bookId: heartImg.data("bookId") }, function(data) {
            if (data === "success") {
                heartImg.attr('src', (heartImg.attr('src') === "imgs/nonDatabaseImgs/heart_full.png") ? 
                    "imgs/nonDatabaseImgs/heart.png" : 
                    "imgs/nonDatabaseImgs/heart_full.png");
            }
        });
    });
});