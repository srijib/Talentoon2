angular.module('myApp').controller("login", function ($scope, $http, user, $routeParams,$location) {


    $rootScope.loginFn = function (valid) {
        console.log('before validation');
        if (valid) {
            console.log('ana sa7');
            var userdata = $rootScope.user
            console.log("inside login:", userdata);
            user.login(userdata).then(function (data) {
                //console.log("blaaaaaaaaaaaa");
                //console.log("data inside login-controller:", data.token);
                console.log("dataaaaa minA",data);
                localStorage.setItem('cur_user', JSON.stringify(data.user));
                localStorage.setItem('token', JSON.stringify(data.token));
                $location.url('/');
            }, function (err) {
                console.log(err);
            });

        }



    }

    //console.log(resolvedProducts);

})
