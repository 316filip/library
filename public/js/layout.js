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
    $("#search-frame")
        .addClass("shadow-lg")
        .addClass("backdrop-blur-xl")
        .addClass("bg-yellow-100/30");
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
                .removeClass("bg-yellow-100/30")
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
        "/search?query=" + $("#search-input").val() + "&in=quick",
        function (result) {
            // Refresh results displayed below search field
            $("#search-results").empty();

            if (result["category"].length !== 0) {
                // Show results from categories table
                $("#search-results").append(
                    '<p class="p-2 font-bold text-slate-500">Kategorie:</p>' +
                        '<div class="overflow-auto"><div class="flex px-2 gap-2 flex-nowrap" id="category-results"></div></div>'
                );

                $.each(result["category"], function (i, field) {
                    $("#category-results").append(
                        '<a class="flex-none" href="/knihovna?filter=category&query=' +
                            field["slug"] +
                            '"><p class="px-4 py-1 rounded-full bg-yellow-400">' +
                            field["name"] +
                            "</p></a>"
                    );
                });
            }

            if (result["author"].length !== 0) {
                // Show results from authors table
                $("#search-results").append(
                    '<p class="p-2 font-bold text-slate-500">Autoři:</p>'
                );

                $.each(result["author"], function (i, field) {
                    $("#search-results").append(
                        '<a href="/autor/' +
                            field["slug"] +
                            '"><p class="p-2 rounded-lg hover:bg-yellow-200/80 transition">' +
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
                    '<p class="p-2 font-bold text-slate-500">Tituly:</p>'
                );

                $.each(result["work"], function (i, field) {
                    $("#search-results").append(
                        '<a href="/titul/' +
                            field["slug"] +
                            '"><p class="p-2 rounded-lg hover:bg-yellow-200/80 transition">' +
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
                            field["work"]["slug"] +
                            "/" +
                            field["id"] +
                            '"><p class="p-2 rounded-lg hover:bg-yellow-200/80 transition">' +
                            field["title"] +
                            "</p></a>"
                    );
                });

                $("#search-results").append(
                    '<p class="p-2 text-right text-slate-500"><a href="javascript:void(0)" onclick="go(\'book\')">Zobrazit vše <i class="fa-solid fa-arrow-right"></i></a></p>'
                );
            }

            if (result["user"].length !== 0) {
                // Show results from users table
                $("#search-results").append(
                    '<p class="p-2 font-bold text-slate-500">Uživatelé:</p>'
                );

                $.each(result["user"], function (i, field) {
                    $("#search-results").append(
                        '<a href="/ucet/' +
                            field["code"] +
                            '"><p class="p-2 rounded-lg hover:bg-yellow-200/80 transition">' +
                            field["first_name"] +
                            " " +
                            field["last_name"] +
                            "</p></a>"
                    );
                });

                $("#search-results").append(
                    '<p class="p-2 text-right text-slate-500"><a href="javascript:void(0)" onclick="go(\'user\')">Zobrazit vše <i class="fa-solid fa-arrow-right"></i></a></p>'
                );
            }

            if (result["booking"].length !== 0) {
                // Show results from bookings table
                $("#search-results").append(
                    '<p class="p-2 font-bold text-slate-500">Rezervace:</p>'
                );

                $.each(result["booking"], function (i, field) {
                    $("#search-results").append(
                        '<a href="/rezervace/' +
                            field["code"] +
                            '"><p class="p-2 rounded-lg hover:bg-yellow-200/80 transition">' +
                            field["code"] +
                            "</p></a>"
                    );
                });

                $("#search-results").append(
                    '<p class="p-2 text-right text-slate-500"><a href="javascript:void(0)" onclick="go(\'booking\')">Zobrazit vše <i class="fa-solid fa-arrow-right"></i></a></p>'
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
