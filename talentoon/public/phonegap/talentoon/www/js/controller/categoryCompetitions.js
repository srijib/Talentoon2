angular.module('talentoon').controller("categoryCompetitions",function($state,Competitions,$scope,$rootScope,$stateParams){
    $scope.cat_id = $stateParams['category_id'];

    Competitions.getCategoryCompetitions($scope.cat_id).then(function (data) {
        $scope.categoryCompetitions = data.data;
        console.log("compo new dataaaa",$scope.categoryCompetitions );
    }, function (err) {
        console.log(err);
    });

    $scope.newcompetition = function(vaild) {
        if (vaild) {
            $scope.competition.category_id=$stateParams['category_id'];
            $scope.competition.mentor_id=$rootScope.cur_user.id;

            Competitions.createCompetition($scope.competition).then(function(data){
                console.log("the post request from server is ",data);
            } , function(err){
                console.log(err);
            });
        }
    };

});
