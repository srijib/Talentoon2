angular.module('myApp').controller("register", function ($scope, $http, user, $routeParams, dateFilter,$location) {

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



})
