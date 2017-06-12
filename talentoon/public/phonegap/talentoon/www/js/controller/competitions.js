angular.module('talentoon').controller("competitions",function(Competitions,$scope,$rootScope){
  $rootScope.token = localStorage.getItem('token');

    Competitions.getAllCompetitions().then(function (data) {
        $scope.competitions = data.data;
        console.log("all compition  controller",$scope.competitions );
    }, function (err) {
        console.log(err);
    });

});
