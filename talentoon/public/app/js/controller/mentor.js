angular.module('myApp').controller("mentors",function($scope,$http,categories,$routeParams,$rootScope,$timeout,videoconference){

    var mentor = {}
    $rootScope.cur_user = JSON.parse(localStorage.getItem("cur_user"));

    $scope.completeMentorProfile = function(valid) {

        mentor.mentor_id = $rootScope.cur_user.id;
        mentor.category_id = $routeParams['category_id'];
        mentor.years_of_experience = $scope.mentor.years_of_experience;
        mentor.experience = $scope.mentor.experience;
        mentor.status = 0;

        console.log("Mentor Object is ", mentor);

        categories.complete_mentor_profile(mentor).then(function (data) {
            console.log(data)
            console.log("in complete mentor profile")

            //Add Him into Wiz IQ as Teacher

            var mentor_id = $rootScope.cur_user.id;
            var teacher_name = $rootScope.cur_user.first_name + $rootScope.cur_user.last_name;
            var teacher_email = $rootScope.cur_user.email;
            console.log("Add Wiziq Teacher");
            videoconference.add_teacher(mentor_id,teacher_email,teacher_name).then(function (data) {

            }, function (err) {
                console.log("Add Wiziq Teacher ERROR section");
                console.log(err);
            });

            //End of being teacher


        }, function (err) {
            console.log(err)
            console.log("in complete mentor profile error")
        });

    }

})
