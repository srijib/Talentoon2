angular.module('myApp').controller("competitions",function($location,$route,Competitions,categories,$scope,$http,posts,$rootScope,$q,user){

    Competitions.getAllCompetitions().then(function (data) {
        $scope.competitions = data.data;
        console.log("Compooo dataa controller",$scope.competitions );
    }, function (err) {
        console.log(err);
    });

});
