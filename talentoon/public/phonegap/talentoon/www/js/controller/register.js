angular.module('talentoon').controller("register", function ($scope, $http, user,dateFilter,$state) {

    user.getAllCountry().then(function (data) {
        //console.log("countries:", data);
        $scope.countries = data;
        console.log("countries", $scope.countries);
    }, function (err) {
        console.log(err);

    });
 $scope.user={};
    $scope.registerFn = function (valid) {


        console.log($scope.user);
        console.log(valid);
        if (valid) {
            var userdata = $scope.user
            console.log("userdata",userdata);
            user.register(userdata).then(function(data){
                console.log("inside controller:",data);
                $state.go('login');
            },function(err){
               console.log(err);
            });

        }

    }



})
