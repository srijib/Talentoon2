angular.module('myApp').controller("singleCompetition",function($location,$routeParams,$route,categories,Competitions,$scope,$http,posts,$rootScope,$q){
    $scope.cat_id= $routeParams['category_id'];
    $scope.competition_id= $routeParams['competition_id'];
    // $scope.cur_user = JSON.parse(localStorage.getItem("cur_user"));
        console.log("CURRENT USER",$scope.cur_user.id );
        console.log("CURRENT COMPETITION",$scope.competition_id );
    Competitions.getSingleCompetition($scope.cat_id,$scope.competition_id).then(function (data) {
        $scope.competition = data.data[0];
        console.log("single comppoooooooo data ",data.data[0] );
    }, function (err) {
        console.log(err);
    });

    Competitions.getSingleCompetitionPosts($scope.competition_id).then(function (data) {
        $scope.competitionPosts = data.data;
        console.log("single comppoooooooo popooo data ",data );
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

    $scope.newCompetitionPost = function(vaild) {
        if (vaild) {
            $scope.post.category_id=$routeParams['category_id'];
            $scope.post.competition_id=$routeParams['competition_id'];

            Competitions.createCompetitionPost($scope.post).then(function(data){
                console.log("the post request from server is ",data);
            } , function(err){
                console.log(err);
            });
            $location.url('/category/'+$scope.post.category_id+'/competitions/'+$scope.post.competition_id);
        }
    };
    $scope.deleteCompetitionPost = function(post_id) {
            $scope.competition_id= $routeParams['competition_id'];

            Competitions.deleteCompetitionPost($scope.competition_id,post_id).then(function(data){
                console.log("the post request from server is ",data);
                if (data.status == 'ok') {
                    $route.reload();
                }else {
                    alert("sorry it's not your post")
                }
            } , function(err){
                console.log(err);
            });
    };

    $scope.vote = function(post_id) {
        console.log('POST ID',post_id);
            Competitions.vote(post_id).then(function(data){
                console.log("VOTE CONTROLLERRR",data);
            } , function(err){
                console.log(err);
            });
    };


});
