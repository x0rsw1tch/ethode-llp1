var username;

// Check for possible existing username
(function() {
    var hasUsername = false;
    if (window.localStorage) {
        if (localStorage.getItem("username") && localStorage.getItem("username")) {
            username = localStorage.getItem("username");
            hasUsername = true;
        }
    } else if (window.sessionStorage) {
        if (sessionStorage.getItem("username") && sessionStorage.getItem("username")) {
            username = sessionStorage.getItem("username");
            hasUsername = true;
        }
    }
    if (!username) {
        if (window.location.pathname !== '/login') {
            window.location.pathname = '/login';
        }
    }
})();



$(document).ready(function() {
    $(document).foundation();
    $("[data-menu-underline-from-center] a").addClass("underline-from-center");
});
