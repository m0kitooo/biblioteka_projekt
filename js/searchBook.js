$(document).ready(function() {
    document.getElementById("dynamic-search-results-container").style.display = "none";
    
    function abc() {
        const params = new URLSearchParams(window.location.search);
        const categoryId = params.get('categoryId');
        
        const searchInputVal = document.getElementById("search-input").value;
        $("#dynamic-search-results-container").load("searchBook.php", { searchInputVal: searchInputVal, categoryId: categoryId }, function(){
            const dynamicSearchResCnt = document.getElementById("dynamic-search-results-container");
            if(dynamicSearchResCnt.childElementCount == 0) {
                dynamicSearchResCnt.style.display = "none";
            } else {
                dynamicSearchResCnt.style.display = "block";
            }
        });
    }

    $("#search-input").on("input", function() {
        abc();
    });

    $("#search-input").on("click", function() {
        abc();
    });

    $(document).on("click", function(event) {
        const searchInput = $("#search-input");
        const dynamicSearchResCnt = $("#dynamic-search-results-container");
        
        if((!dynamicSearchResCnt.is(event.target) && dynamicSearchResCnt.has(event.target).length === 0) && !searchInput.is(event.target))
            document.getElementById("dynamic-search-results-container").style.display = "none";
    })
});
