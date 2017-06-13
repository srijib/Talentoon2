angular.module('myApp').controller("forget_password",function($scope,Password,$rootScope){
    $scope.forget_password = function() {
        var obj = {email:$scope.email}
        console.log('EMAAAAIL',$scope.email);
        Password.forget_password(obj).then(function (data) {
    		console.log("FORGET PASSWORD CONTROLLER", data)

    	}, function (err) {
    		console.log(err);
    	});
    }


});
