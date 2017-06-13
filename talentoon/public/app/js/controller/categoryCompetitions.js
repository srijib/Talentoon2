angular.module('myApp').controller("categoryCompetitions",function($location,$route,Competitions,categories,$scope,$http,posts,$rootScope,$q, $routeParams,user){
    $scope.cat_id = $routeParams['category_id'];

    Competitions.getCategoryCompetitions($scope.cat_id).then(function (data) {
        $scope.categoryCompetitions = data.data;
        console.log("compo new dataaaa",$scope.categoryCompetitions );
    }, function (err) {
        console.log(err);
    });

    categories.getUserRoles($scope.cat_id).then(function (data) {
        console.log("ROLESSSSS FROM CONTROLLER", data)
        if(data.is_sub.length){
            $scope.is_subscribed = data.is_sub[0].subscribed;
        }

        if(data.is_talent.length != 0){
            $scope.is_talent = data.is_talent[0].status;
        }

        if(data.is_mentor.length != 0 ){
            $scope.is_mentor = data.is_mentor[0].status;
            console.log('is_mentorrrrr',$scope.is_mentor);
        }
    }, function (err) {
        console.log(err);
    });


    $scope.newcompetition = function(vaild) {
        console.log('aywa ro7na mlena al competition form',$rootScope.cur_user);
        if (vaild) {
            $rootScope.competition.category_id=$routeParams['category_id'];
            $rootScope.competition.mentor_id=$rootScope.cur_user.id;
            console.log('el competition',$scope.competition);
            Competitions.createCompetition($rootScope.competition).then(function(data){
                console.log("the competition request from server is ",data);
                $location.url('/category/'+$rootScope.competition.category_id);
            } , function(err){
                console.log(err);
                // $location.url('/500');
            });
        }
    };

});
