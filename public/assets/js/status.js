$(document).ready(function() { 
    $(document).foundation();
    $("[data-menu-underline-from-center] a").addClass("underline-from-center");
});

var testRunner = new Vue({
    el: '#status-app',
    data: {
        vueWelcome: 'Vue.js is working',
        ajaxResponse: false,
        http404Response: false,
        dbAccessResponse: false,
        dbReadResponse: false
    },
    methods: {
        testValidAjax: function () {
            console.log('Starting test: AJAX response');
            var vm = this;
            if (vm.ajaxResponse === 'Success!') return false;
            vm.ajaxResponse = 'Testing in progress...';
            $.ajax({
                url: '/',
                type: 'GET',
                success: function (data) {
                    console.log('Test success: AJAX response');
                    console.log(data);
                    vm.ajaxResponse = 'Success!';
                },
                error: function (xhr, status, error) {
                    console.error('Test failed: AJAX response');
                    console.error('XHR: '+ xhr + ' Status: ' + status + ' Error:' + error);
                    vm.ajaxResponse = 'Failed!';
                }
            });
        },
        testHttp404: function () {
            console.log('Starting test: 404 response');
            var vm = this;
            if (vm.http404Response === 'Success!') return false;
            vm.http404Response = 'Testing in progress...';
            $.ajax({
                url: '/i-dont-exist',
                type: 'GET',
                statusCode: {
                    404: function (data) {
                        console.log('Test success: 404 response');
                        console.log(data);
                        vm.http404Response = 'Success!';
                    }
                },
                success: function (data) {
                    console.error('Test failed: 404 response');
                    console.error('XHR: '+ xhr + ' Status: ' + status + ' Error:' + error);
                    vm.http404Response = 'FAILED!';
                },
                error: function (xhr, status, error) {
                    if (error !== 'Not Found') {
                        console.error('Test failed: 404 response');
                        console.error('XHR: '+ xhr + ' Status: ' + status + ' Error:' + error);
                        vm.http404Response = 'FAILED!';
                    }
                }
            });
        },
        testDbAccess: function () {
            console.log('Starting test: Database Access');
            var vm = this;
            if (vm.dbAccessResponse === 'Success!') return false;
            vm.dbAccessResponse = 'Testing in progress...';
            $.ajax({
                url: '/status/dbaccess',
                type: 'GET',
                success: function (data) {
                    console.log('Test success: DB Access');
                    console.log(data);
                    vm.dbAccessResponse = 'Success!';
                },
                error: function (xhr, status, error) {
                    console.error('Test failed: DB Access');
                    console.error('XHR: '+ xhr + ' Status: ' + status + ' Error:' + error);
                    vm.dbAccessResponse = 'FAILED! (' + error + ')';
                }
            });
        },
        testDbRead: function () {
            console.log('Starting test: Database Read');
            var vm = this;
            if (vm.dbReadResponse === 'Success!') return false;
            vm.dbReadResponse = 'Testing in progress...';
            var vm = this;
            $.ajax({
                url: '/status/dbread',
                type: 'GET',
                success: function (data) {
                    console.log('Test success: DB Read');
                    console.table(data);
                    vm.dbReadResponse = 'Success!';
                },
                error: function (xhr, status, error) {
                    console.error('Test failed: DB Read');
                    console.error('XHR: '+ xhr + ' Status: ' + status + ' Error:' + error);
                    vm.dbReadResponse = 'FAILED! (' + error + ')';
                }
            });
        },
        checkResponse: function (response) {
            if (response === false) { 
                return 'Test not run...';
            } else {
                return response;
            }
        }
    },
    computed: {
        ajaxTestResponse: function () {
            return this.checkResponse(this.ajaxResponse);
        },
        http404TestResponse: function () {
            return this.checkResponse(this.http404Response);
        },
        dbAccessTestResponse: function () {
            return this.checkResponse(this.dbAccessResponse);
        },
        dbReadTestResponse: function () {
            return this.checkResponse(this.dbReadResponse);
        }
    }
});;

