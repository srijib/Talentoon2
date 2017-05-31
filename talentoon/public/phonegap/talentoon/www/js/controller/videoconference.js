angular.module('myApp').controller("videoconference",function($scope,$http,videoconference,$routeParams,$rootScope,$timeout,$window){


    //create wiziq Session with teacher ID set already in local storage
    //Warning there is only one teacher session can be scheduled at one time
    //because the teacher numbers are limited and the local storage is set once not for every mentor login
    $scope.create_wiziq_session = function() {
        var teacher_id = $window.localStorage.getItem("wiziq_teacher_id");
        var teacher_email = $window.localStorage.getItem("wiziq_teacher_email");
        if(teacher_id){
            $scope.class.teacher_id = teacher_id;
            $scope.class.teacher_email = teacher_email;
            //means there is teacher id set in local storage and a class can be scheduled
            videoconference.create_class($scope.class).then(function(data){
                console.log("iam here",data)
            } , function(err){
                console.log(err);
            });
        }
    }




})
