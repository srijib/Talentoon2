angular.module('myApp').controller("mentors",function($location,$scope,$http,categories,$routeParams,$rootScope,$timeout,user){


    mentor.mentor_id = $rootScope.cur_user.id;
	mentor.category_id = $routeParams['category_id'];
	mentor.years_of_experience = $scope.mentor.years_of_experience;
	mentor.experience = $scope.mentor.experience;
	mentor.status = 0;

	console.log("Mentor Object is ", mentor);

	categories.complete_mentor_profile(mentor).then(function (data) {
		console.log(data)
		console.log("in complete mentor profile")

	}, function (err) {
		console.log(err)
		console.log("in complete mentor profile error");
        // $location.url('/500');
	});

})
