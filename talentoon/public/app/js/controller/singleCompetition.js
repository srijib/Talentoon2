angular.module('myApp').controller("singleCompetition",function($location,$routeParams,$route,categories,Competitions,$scope,$http,posts,$rootScope,$q,user){
    $scope.cat_id= $routeParams['category_id'];
    $scope.competition_id= $routeParams['competition_id'];

    categories.getUserRoles($scope.cat_id).then(function (data) {
		console.log("ROLESSSSS FROM CONTROLLER", data)

        if(data.is_talent.length != 0){
            $scope.is_talent = data.is_talent[0].status;
        }

        if(data.is_mentor.length != 0 ){
            $scope.is_mentor = data.is_mentor[0].status;
        }
	}, function (err) {
		console.log(err);
	});

    Competitions.getSingleCompetition($scope.cat_id,$scope.competition_id).then(function (data) {
        $scope.competition = data.data[0];
        if (data.is_joined) {
            $scope.is_joined = data.is_joined.joined
        }
        console.log("single comppoooooooo data ",data );
    }, function (err) {
        console.log(err);
        // $location.url('/500');
    });

    Competitions.getSingleCompetitionPosts($scope.competition_id).then(function (data) {
        $scope.competitionPosts = data.data;
        console.log("single comppoooooooo popooo data ",data );
    }, function (err) {
        console.log(err);
        // $location.url('/500');
    });

    $scope.newcompetition = function(vaild) {
        if (vaild) {
            $scope.competition.category_id=$routeParams['category_id'];
            $scope.competition.mentor_id=$rootScope.cur_user.id;

            Competitions.createCompetition($scope.competition).then(function(data){
                console.log("the post request from server is ",data);
            } , function(err){
                console.log(err);
                // $location.url('/500');
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
                // $location.url('/500');
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
                // $location.url('/500');
            });
    };

    $scope.joinCompetition = function(){
        Competitions.joinCompetition($scope.competition_id).then(function (data) {
            $location.url('/category/'+$scope.cat_id+'/competitions/'+$scope.competition_id);
            console.log(data);
        }, function (err) {
            console.log(err);
        });
    }

    $scope.vote = function(post_id) {
        console.log('POST ID',post_id);
            Competitions.vote(post_id).then(function(data){
                console.log("VOTE CONTROLLERRR",data);
            } , function(err){
                console.log(err);
                // $location.url('/500');
            });
    };


});
