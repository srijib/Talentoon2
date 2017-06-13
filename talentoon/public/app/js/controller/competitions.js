angular.module('myApp').controller("competitions",function($routeParams,$location,$route,Competitions,categories,$scope,$http,posts,$rootScope,$q,user){

    $rootScope.cat_id = $routeParams['category_id'];
    $rootScope.competition_id = $routeParams['competition_id'];

    Competitions.getcompetition($scope.cat_id,$rootScope.competition_id).then(function (data) {
        console.log('ID,ID',$scope.cat_id,$rootScope.competition_id)
        $rootScope.competition=data;

        console.log("single competition from controller", $rootScope.competition);

    }, function (err) {
        console.log(err);
    });
    Competitions.getAllCompetitions().then(function (data) {
        $scope.competitions = data.data;
        console.log("Compooo dataa controller",$scope.competitions );
    }, function (err) {
        console.log(err);
    });

});
