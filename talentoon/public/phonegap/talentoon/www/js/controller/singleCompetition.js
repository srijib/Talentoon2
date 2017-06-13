angular.module('talentoon').controller("singleCompetition",function(  $window,$state,$stateParams,categories,Competitions,$scope,$rootScope){
  $rootScope.token = localStorage.getItem('token');
  $rootScope.cur_user = localStorage.getItem('id');
  var filesuploaded = [];
$scope.post={};
    $scope.cat_id= $stateParams['category_id'];
    $scope.competition_id= $stateParams['competition_id'];

    categories.getUserRoles($scope.cat_id).then(function (data) {
		// console.log("ROLESSSSS FROM CONTROLLER", data)

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
        if(data.talent ==null){

  	$rootScope.talent_id=0;

  	}
  	else{
  		$rootScope.talent_id=data.talent.talent_id;
  	}

    console.log("talent id in category",$rootScope.talent_id);
    console.log("curent user id  in category",$rootScope.cur_user);
        if (data.is_joined) {
            $scope.is_joined = data.is_joined.joined
        }
        console.log("single competition data ",data );
    }, function (err) {
        console.log(err);
    });

    Competitions.getSingleCompetitionPosts($scope.competition_id).then(function (data) {
        $scope.competitionPosts = data.data;
        // console.log("single comptions  posts ",data );
    }, function (err) {
        console.log(err);
    });

    // $scope.newcompetition = function(vaild) {
    //     if (vaild) {
    //         $scope.competition.category_id=$routeParams['category_id'];
    //         $scope.competition.mentor_id=$rootScope.cur_user.id;
    //
    //         Competitions.createCompetition($scope.competition).then(function(data){
    //             console.log("the post request from server is ",data);
    //         } , function(err){
    //             console.log(err);
    //         });
    //     }
    // };
    //

    $scope.newCompetitionPost = function(vaild) {

      console.log("test befor vaild in  newCompetitionPost ");

        if (vaild) {
          console.log("data of compition post form  ",$scope.post);

          $scope.post.category_id=$stateParams['category_id'];
          $scope.post.competition_id=$stateParams['competition_id'];
  console.log("data of compition post form  ",$scope.post);
  $scope.post.media_type =  $rootScope.currentFile.type
  $scope.post.media_url =  $rootScope.currentFile.name
  console.log("media type is ",$scope.post.media_type, "media url is " , $scope.post.media_url);
            Competitions.createCompetitionPost($scope.post).then(function(data){
                console.log("the post request from server is ",data);
            } , function(err){
                console.log(err);
                // $location.url('/500');
            });

              $window.location.href='#/app/category/'+$scope.post.category_id+'/competitions/'+$scope.post.competition_id;

        }
    };

    // $scope.deleteCompetitionPost = function(post_id) {
    //         $scope.competition_id= $routeParams['competition_id'];
    //
    //         Competitions.deleteCompetitionPost($scope.competition_id,post_id).then(function(data){
    //             console.log("the post request from server is ",data);
    //             if (data.status == 'ok') {
    //                 $route.reload();
    //             }else {
    //                 alert("sorry it's not your post")
    //             }
    //         } , function(err){
    //             console.log(err);
    //         });
    // };
    //
    $scope.joinCompetition = function(competition_id){
      console.log("competition_id",competition_id);
        Competitions.joinCompetition(competition_id).then(function (data) {
        // $state.go('app.categorycompetitions')
        // $window.location.href='#/app/category/'+$scope.post.category_id+'/competitions/'+$scope.post.competition_id;

            console.log(data);
        }, function (err) {
            console.log(err);
        });
    }

    $scope.vote = function(post_id,index) {
        console.log('POST ID',post_id);
            Competitions.vote(post_id).then(function(data){
              $rootScope.cur_user = localStorage.getItem('id');
                console.log("current user id in votes",$rootScope.cur_user);
              console.log(data.new_votes_count);
              if (data.new_votes_count) {
                $scope.competitionPosts[index].votes_count =data.new_votes_count[0].count_vote
              }
                console.log("VOTE CONTROLLERRR",);
            } , function(err){
                console.log(err);
            });
    };

    $scope.uploadedFile = function(element) {
        console.log("element is ",element)
        $rootScope.currentFile = element.files[0];
        filesuploaded.push(element.files[0]);}



});
