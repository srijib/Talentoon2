angular.module('talentoon').controller("categoryCompetitions",function($location,$route,Competitions,categories,$scope,$http,posts,$rootScope,$q, $routeParams){
    $scope.cat_id = $routeParams['category_id'];

    Competitions.getCategoryCompetitions($scope.cat_id).then(function (data) {
        $scope.categoryCompetitions = data.data;
        console.log("compo new dataaaa",$scope.categoryCompetitions );
    }, function (err) {
        console.log(err);
    });

    $scope.newcompetition = function(vaild) {
        if (vaild) {
            $scope.competition.category_id=$routeParams['category_id'];
            $scope.competition.mentor_id=$rootScope.cur_user.id;

            Competitions.createCompetition($scope.competition).then(function(data){
                console.log("the post request from server is ",data);
            } , function(err){
                console.log(err);
            });
        }
    };

});
