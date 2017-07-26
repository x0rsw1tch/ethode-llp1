<!doctype html>
<html lang="{{ config('app.locale') }}">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Status</title>
    <!-- Styles -->
    <link rel="stylesheet" href="/assets/css/vendor/foundation.css">
    <link rel="stylesheet" href="/assets/css/components.css">
    <link rel="stylesheet" href="/assets/css/app.css">
</head>

<body>
    <div id="status-app">
        <nav class="hover-underline-menu" data-menu-underline-from-center>
            <ul class="menu align-center">
                <li>
                    <img class="logo" src="/assets/img/ethode-logo.png">
                    <a class="nav-heading">Ethode L&amp;L Project 1</a>
                </li>
                <li><a href="/">Home</a></li>
                <li><a href="/stats">Stats</a></li>
                <li><a href="/status">Status</a></li>
            </ul>
        </nav>
        <div class="grid-container">
            <div class="grid-x grid-margin-x">
                <!-- Left Column -->
                <div class="small-4 cell">

                    <div class="card-basic">
                        <img class="card-basic-img" src="/assets/img/testing.png" alt="picture of space" />
                        <div class="card-basic-content card-section">
                            <p class="card-basic-title">The Status Quo</p>
                            <p class="card-basic-body">Below are cards that will run individual tests for you. Response data is sent to the browser console.</p>
                        </div>
                    </div>

                    <div class="card-basic">
                        <div class="card-basic-content card-section">
                            <p class="card-basic-title">Test AJAX</p>
                            <p class="card-basic-body">Go to a valid page</p>
                        </div>
                        <a class="button card-basic-button" v-bind:class="{ disabled: ajaxResponse == 'Success!' }" @click="testValidAjax()">Test AJAX</a>
                    </div>

                    <div class="card-basic">
                        <div class="card-basic-content card-section">
                            <p class="card-basic-title">Test 404</p>
                            <p class="card-basic-body">Go to a page that should be a 404</p>
                        </div>
                        <a class="button card-basic-button" v-bind:class="{ disabled: http404Response == 'Success!' }"  @click="testHttp404()">Test 404</a>
                    </div>

                    <div class="card-basic">
                        <div class="card-basic-content card-section">
                            <p class="card-basic-title">Test Database Access</p>
                            <p class="card-basic-body">Verfies PHP/Laravel can access database</p>
                        </div>
                        <a class="button card-basic-button" v-bind:class="{ disabled: dbAccessResponse == 'Success!' }" @click="testDbAccess()">Test DB Access</a>
                    </div>

                    <div class="card-basic">
                        <div class="card-basic-content card-section">
                            <p class="card-basic-title">Read from test data</p>
                            <p class="card-basic-body">Pulls some rows from MySQL. Verifies Laravel routes and DB interaction.</p>
                        </div>
                        <a class=" button card-basic-button" v-bind:class="{ disabled: dbReadResponse == 'Success!' }" @click="testDbRead()">Test DB Read</a>
                    </div>

                </div>
                <!-- Right column -->
                <div class="auto cell">

                    <h2>HTTP/AJAX Tests</h2>
                    <ul>
                        <li>This page Vue.js instance message: @{{ vueWelcome }}</li>
                        <li>This page HTTP Test:
                            <ul>
                                <li>Server Side Response according to PHP:
                                    <?php echo http_response_code() ?>
                                </li>
                                <li>AJAX Request Test: @{{ ajaxTestResponse }}</li>
                                <li>404 Test: @{{ http404TestResponse }}</li>
                            </ul>
                        </li>
                    </ul>
                    <h3>DB Tests</h3>
                    <ul>
                        <li>DB Access: @{{ dbAccessTestResponse }}</li>
                        <li>DB Read: @{{ dbReadTestResponse }}</li>
                    </ul>
                </div>

            </div>
        </div>
    </div>
    </div>
    <script src="/assets/js/vendor/jquery.js"></script>
    <script src="/assets/js/vendor/foundation.js"></script>
    <script src="/assets/js/vendor/vue.js"></script>
    <script src="/assets/js/status.js"></script>
</body>

</html>
