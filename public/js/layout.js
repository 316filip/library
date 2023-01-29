/**
 * Changes navbar classes according to scroll position
 */
function navbar() {
    var scroll = $(window).scrollTop();
    if (scroll === 0) {
        $("#navbar-backdrop")
            .addClass("bg-sky-100")
            .removeClass("bg-sky-100/80")
            .removeClass("shadow-lg");
    } else {
        $("#navbar-backdrop")
            .addClass("bg-sky-100/80")
            .removeClass("bg-sky-100")
            .addClass("shadow-lg");
    }
}

/**
 * Shows live search results frame
 */
function showResults() {
    $("#search-frame").addClass("shadow-lg").addClass("backdrop-blur-xl");
    $("#search-results").stop().slideDown("fast");
}

/**
 * Hides live search results frame, hides search bar on smaller screens
 */
function hideResults() {
    setTimeout(() => {
        $("#search-results").slideUp("fast", function () {
            $("#search-frame")
                .removeClass("shadow-lg")
                .removeClass("backdrop-blur-xl")
                .removeClass("-top-2");
        });
    }, 100);
}

/**
 * Shows search results
 */
function showSearchBar() {
    $("#search-frame").addClass("-top-2");
    $("#search-input").focus();
}

/**
 * Fetches quick search results and displays them below search field
 */
function search() {
    // Check that the search query is longer than 3 chars
    if ($("#search-input").val().trim().length < 3) {
        $("#search-results")
            .empty()
            .append(
                '<div class="grid place-content-center h-full w-full"><span>Pro vyhledávání začněte psát</span></div>'
            );
        return;
    }

    // Get quick results as JSON from API
    $.getJSON(
        "/api/search?query=" + $("#search-input").val() + "&in=quick",
        function (result) {
            // Refresh results displayed below search field
            $("#search-results").empty();
            if (result["author"].length !== 0) {
                // Show results from authors table
                $("#search-results").append(
                    '<p class="p-2 font-bold text-slate-500">Autoři:</p>'
                );

                $.each(result["author"], function (i, field) {
                    $("#search-results").append(
                        '<a href="/autor/' +
                            field["id"] +
                            '"><p class="p-2 rounded-md hover:bg-yellow-200/80 transition">' +
                            (field["name_prefix"] == null
                                ? ""
                                : field["name_prefix"] + " ") +
                            (field["first_name"] + " ") +
                            (field["middle_name"] == null
                                ? ""
                                : field["middle_name"] + " ") +
                            field["last_name"] +
                            (field["name_suffix"] == null
                                ? ""
                                : " " + field["name_suffix"]) +
                            "</p></a>"
                    );
                });

                $("#search-results").append(
                    '<p class="p-2 text-right text-slate-500"><a href="javascript:void(0)" onclick="go(\'author\')">Zobrazit vše <i class="fa-solid fa-arrow-right"></i></a></p>'
                );
            }

            if (result["work"].length !== 0) {
                // Show results from works table
                $("#search-results").append(
                    '<p class="p-2 font-bold text-slate-500">Díla:</p>'
                );

                $.each(result["work"], function (i, field) {
                    $("#search-results").append(
                        '<a href="/titul/' +
                            field["id"] +
                            '"><p class="p-2 rounded-md hover:bg-yellow-200/80 transition">' +
                            field["title"] +
                            "</p></a>"
                    );
                });

                $("#search-results").append(
                    '<p class="p-2 text-right text-slate-500"><a href="javascript:void(0)" onclick="go(\'work\')">Zobrazit vše <i class="fa-solid fa-arrow-right"></i></a></p>'
                );
            }

            if (result["book"].length !== 0) {
                // Show results from books table
                $("#search-results").append(
                    '<p class="p-2 font-bold text-slate-500">Knihy:</p>'
                );

                $.each(result["book"], function (i, field) {
                    $("#search-results").append(
                        '<a href="/kniha/' +
                            field["id"] +
                            '"><p class="p-2 rounded-md hover:bg-yellow-200/80 transition">' +
                            field["title"] +
                            "</p></a>"
                    );
                });

                $("#search-results").append(
                    '<p class="p-2 text-right text-slate-500"><a href="javascript:void(0)" onclick="go(\'book\')">Zobrazit vše <i class="fa-solid fa-arrow-right"></i></a></p>'
                );
            }

            // If nothing matches the query
            if ($("#search-results").html() == "") {
                $("#search-results").append(
                    '<div class="grid place-content-center h-full w-full"><span>Vašemu hledání neodpovídá žádný výsledek</span></div>'
                );
            }

            // If the query was erased in the meantime
            if ($("#search-input").val().trim().length < 3) {
                search();
            }
        }
    );
}

/**
 * Go to dedicated search page
 *
 * @param {String} what Where to search for results
 */
function go(what = "all") {
    $("#search-area").val(what);
    $("#search-form").submit();
}

function openMenu() {
    $("#fullscreen-menu").fadeIn("fast");
}

function closeMenu() {
    $("#fullscreen-menu").fadeOut("fast");
}

$(document)
    .ready(function () {
        navbar();

        $("#search-input")
            .bind("keydown", "esc", function () {
                $("#search-input").blur();
                return false;
            })
            .bind("keydown", "enter", function () {
                go();
                return false;
            });
    })
    .bind("keydown", "ctrl+k", function () {
        showSearchBar();
        return false;
    });

$(window).scroll(function () {
    navbar();
});
