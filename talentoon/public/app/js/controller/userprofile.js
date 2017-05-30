angular.module('myApp').controller("userprofile", function ($scope, $http, user, $routeParams,$location) {

  user.userprofile().then(function(data){
		 console.log(data);
		$scope.userprofile=data.data;
                console.log("categories array",$scope.userprofile);
        console.log("user profile",$scope.userprofile);
	} , function(err){
		console.log(err);

	});


  user.userposts().then(function(data){
     console.log(data.data);
    $scope.userposts=data.data.post;
    $scope.userinfo=data.data;
        console.log("user profile posts",$scope.userposts);
        console.log("user profile info",$scope.userinfo);

  } , function(err){
    console.log(err);

  });


})
