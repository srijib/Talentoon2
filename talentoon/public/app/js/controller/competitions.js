angular.module('myApp').controller("competitions",function($location,$route,Competitions,categories,$scope,$http,posts,$rootScope,$q,user){

    Competitions.getAllCompetitions().then(function (data) {
        $scope.competitions = data.data;
        console.log("Compooo dataa controller",$scope.competitions );
    }, function (err) {
        console.log(err);
    });


    $scope.joinCompetition = function(category_id,competition_id){
        Competitions.joinCompetition(competition_id).then(function (data) {
            $location.url('/category/'+category_id+'/competitions/'+competition_id);
            console.log(data);
        }, function (err) {
            console.log(err);
            // $location.url('/500');
        });
    }

});
