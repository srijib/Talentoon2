angular.module('myApp').controller("competitions",function($location,$route,categories,$scope,$http,posts,$rootScope,$q){

    Competitions.getAllCompetitions().then(function (data) {
        // $scope.posts = data.posts;
        console.log("data posts",data );
    }, function (err) {
        console.log(err);
    });


});
