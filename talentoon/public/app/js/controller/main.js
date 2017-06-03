angular.module('myApp').controller("main", function ($scope,$rootScope, user,categories,$location) {

    categories.getAllCategory().then(function (data) {
        $scope.categories = data.data;
        console.log("categoriesNames array", $scope.categories);
    }, function (err) {
        console.log(err);
    });

    $scope.loginFn = function (valid) {
        if (valid) {
            var userdata = $scope.user
            console.log("inside login:", userdata);
            user.login(userdata).then(function (data) {
                console.log("dataaaaa minA",data);
                localStorage.setItem('cur_user', JSON.stringify(data.user));
                localStorage.setItem('token', JSON.stringify(data.token));
                $location.url('/');
            }, function (err) {
                console.log(err);
            });

        }

    }

    $scope.logoutFn = function () {
            console.log("inside logout");
            localStorage.removeItem('cur_user');
            localStorage.removeItem('token');
            $location.url('/');
    }

    user.getAllCountry().then(function (data) {
        //console.log("countries:", data);
        $scope.countries = data;
        console.log("countries", $scope.countries);
    }, function (err) {
        console.log(err);

    });

    $scope.registerFn = function (valid) {
        console.log('inside register fn');
        console.log($scope.user);
        if($scope.user.password && $scope.user.password.length>5){
            $scope.pass=true;
        }
        if($scope.user.password==$scope.user.repassword){
            $scope.repass=true;
        }
        if (valid && $scope.repass && $scope.pass) {
            console.log('inside valid');
            var userdata = $scope.user
            console.log("userdata",userdata);
            user.register(userdata).then(function(data){
                console.log("inside controller:",data);
                $location.url('/login');
            },function(err){
               console.log(err);
            });
        }
    }
})
