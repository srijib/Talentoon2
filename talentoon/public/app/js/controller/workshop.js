angular.module('myApp').controller("workshop", function ($route,$scope, $http, workshops, $routeParams,$location,$rootScope,videoconference) {

	$rootScope.cur_user = JSON.parse(localStorage.getItem("cur_user"));
	$rootScope.wiziq_class_id = JSON.parse(localStorage.getItem("wiziq_class_id"));


	var class_id = $rootScope.wiziq_class_id
	var user_id = $rootScope.cur_user.id;
	var name = $rootScope.cur_user.first_name;





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

			//i need to enroll the student to be attendee in class
			var attendee_obj = {class_id,user_id,name}
			videoconference.add_wiziq_attendee_class(attendee_obj).then(function(data){
				console.log(data)
			} , function(err){
				console.log(err)
			});
			//i need to enroll the student to be attendee in class

			$route.reload();
		} , function(err){
			console.log(err);

		});
	}

});
