angular.module('myApp').controller("categoryCompetitions",function($location,$route,categories,$scope,$http,posts,$rootScope,$q){

    Competitions.getAllCompetitions().then(function (data) {
        // $scope.posts = data.posts;
        console.log("data posts",data );
    }, function (err) {
        console.log(err);
    });

    $scope.newcompetition = function(vaild) {
        if (vaild) {
            $scope.competition.category_id=$routeParams['category_id'];
            $scope.competition.mentor_id=JSON.parse(localStorage.getItem("cur_user")).id;

            Competitions.createCompetition($scope.competition).then(function(data){
                console.log("the post request from server is ",data);
            } , function(err){
                console.log(err);
            });
        }
    };

});
