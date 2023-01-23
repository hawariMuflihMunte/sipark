    <script>
        const navbar = document.getElementById('navbar');
        const sidenav = document.getElementById('sidenav');
        let sidenavTrigger = document.getElementById('sidenav-trigger');
        let sidenavCloser = document.getElementById('sidenav-close');
        sidenavTrigger.addEventListener('click', function() {
            sidenav.classList.add('show-sidenav');
            navbar.classList.add('disable');
            sidenav.classList.add('background-fader');
        });

        sidenavCloser.addEventListener('click', function() {
            sidenav.classList.remove('show-sidenav');
            navbar.classList.remove('disable');
            sidenav.classList.remove('background-fader');
        });
    </script>
</body>
</html>