<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NYX</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    @yield('css')
</head>
<body class="d-flex flex-column min-vh-100">
    <header>
    @include('layout.partials.header')
    </header>
    <main>
        @yield('contents')
    </main>
    <footer>
        @include('layout.partials.footer')
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script>
    document.addEventListener("DOMContentLoaded", function() {
        /* Initialize collapse elements */
        const categoriesMenu = document.getElementById('categoriesMenu');
        const searchBar = document.getElementById('navbarSearch');

        let categoriesCollapse = bootstrap.Collapse.getInstance(categoriesMenu);
        if (!categoriesCollapse) {
            categoriesCollapse = new bootstrap.Collapse(categoriesMenu, { toggle: false });
        }

        let searchCollapse = bootstrap.Collapse.getInstance(searchBar);
        if (!searchCollapse) {
            searchCollapse = new bootstrap.Collapse(searchBar, { toggle: false });
        }

        /* Toggle buttons for collapsible sections */
        const searchLink = document.querySelector('[data-bs-target="#navbarSearch"]');
        const hamburgerToggler = document.querySelector('.navbar-toggler[data-bs-target="#categoriesMenu"]');

        searchLink.addEventListener("click", function(e) {
            e.preventDefault();
            if (categoriesMenu.classList.contains("show")) {
                categoriesCollapse.hide();
            }
            searchCollapse.toggle();
        });

        hamburgerToggler.addEventListener("click", function(e) {
            e.preventDefault();
            if (searchBar.classList.contains("show")) {
                searchCollapse.hide();
            }
            categoriesCollapse.toggle();
        });

        /* Close collapsible panels when clicking outside */
        document.addEventListener("click", function(e) {
            if (searchBar.classList.contains("show") &&
                !searchBar.contains(e.target) &&
                !searchLink.contains(e.target)) {
                searchCollapse.hide();
            }
            if (categoriesMenu.classList.contains("show") &&
                !categoriesMenu.contains(e.target) &&
                !hamburgerToggler.contains(e.target)) {
                categoriesCollapse.hide();
            }
        });
    });
</script>
</body>
</html>
