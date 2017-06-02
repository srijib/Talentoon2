angular.module('myApp').controller("main", function ($scope,$rootScope, user,$location) {


    $scope.loginFn = function (valid) {
        if (valid) {
            var userdata = $scope.user
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

    user.getAllCountry().then(function (data) {
        //console.log("countries:", data);
        $scope.countries = data;
        console.log("countries", $scope.countries);
    }, function (err) {
        console.log(err);

    });

    $scope.registerFn = function (valid) {

//      $scope.user={};
        console.log($scope.user);
        console.log(valid);
        if (valid) {
            //console.log("ssssssssssssss");
            var userdata = $scope.user
            console.log("userdata",userdata);
            // $scope.user.date_of_birthday=	 dateFilter(date_of_birthday, 'yyyy-MM-dd')
            // console.log($scope.user.date_of_birthday);
            user.register(userdata).then(function(data){
                console.log("inside controller:",data);
                $location.url('/login');
            },function(err){
               console.log(err);
            });

        }

    }

    //console.log(resolvedProducts);

})
