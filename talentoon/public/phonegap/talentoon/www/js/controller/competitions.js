angular.module('talentoon').controller("competitions",function(Competitions,$scope){

    Competitions.getAllCompetitions().then(function (data) {
        $scope.competitions = data.data;
        console.log("Compooo dataa controller",$scope.competitions );
    }, function (err) {
        console.log(err);
    });

});
