angular.module('myApp').controller("workshop", function ($route,$scope, $http, workshops, $routeParams,$location,$rootScope) {

	$scope.cat_id = $routeParams['category_id'];

	categories.getUserRoles($scope.cat_id).then(function (data) {
		console.log("ROLESSSSS FROM CONTROLLER", data)
		if(data.is_sub.length){
            $scope.is_subscribed = data.is_sub[0].subscribed;
        }

        if(data.is_talent.length != 0){
            $scope.is_talent = data.is_talent[0].status;
        }

        if(data.is_mentor.length != 0 ){
            $scope.is_mentor = data.is_mentor[0].status;
        }
	}, function (err) {
		console.log(err);
	});

	$scope.workshop_enroll = function(workshop_id,userId) {

	var obj={userId,workshop_id}
	console.log("objjjjjjjjjjjjjjjjjjjjjjj",obj);
			workshops.workshop_enroll(obj).then(function(data){
				console.log("dataaaaaaaaaaaa",data);
				$route.reload();
			} , function(err){
				console.log(err);

			});

	}







});
