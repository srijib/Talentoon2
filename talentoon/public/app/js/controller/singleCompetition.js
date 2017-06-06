angular.module('myApp').controller("singleCompetition",function($location,$route,categories,$scope,$http,posts,$rootScope,$q){

    $scope.cat_id= $routeParams['category_id'];
    $scope.competition_id= $routeParams['competition_id'];

    Competitions.getSingleCompetition($scope.cat_id,$scope.competition_id).then(function (data) {
        // $scope.competition = data.post;
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

    $scope.newCompetitionPost = function(vaild) {
        if (vaild) {
            $scope.post.category_id=$routeParams['category_id'];
            $scope.post.competition_id=$routeParams['competition_id'];

            Competitions.createCompetitionPost($scope.post).then(function(data){
                console.log("the post request from server is ",data);
            } , function(err){
                console.log(err);
            });
            $location.url('/category/'+$scope.post.category_id+'/competitions/'+$scope.post.competition_id);
        }
    };
    $scope.deleteCompetitionPost = function(post_id) {
            $scope.post.category_id=$routeParams['category_id'];
            $scope.post.competition_id=$routeParams['competition_id'];

            Competitions.deleteCompetitionPost($scope.post.competition_id,post_id).then(function(data){
                console.log("the post request from server is ",data);
            } , function(err){
                console.log(err);
            });
    };


});
