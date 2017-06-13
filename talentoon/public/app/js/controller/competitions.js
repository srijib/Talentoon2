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
    $scope.deletecompetition = function(competition_id,cat_id) {
        console.log('da5lnaaaaaaaaaa');
        $scope.competition_id= $routeParams['competition_id'];

        Competitions.deletecompetition(competition_id,cat_id).then(function(data){
            console.log("the competition request from server is ",data);

        } , function(err){
            console.log(err);
            // $location.url('/500');
        });
    };

    Competitions.getAllCompetitions().then(function (data) {
        $scope.competitions = data.data;
        console.log("Compooo dataa controller",$scope.competitions );
    }, function (err) {
        console.log(err);
    });

});
