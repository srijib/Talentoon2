angular.module('myApp').controller("userprofile", function ($scope, $http, user, $routeParams,$location) {

  user.userprofile().then(function(data){
      $scope.userprofile=data.data;
      $scope.user_points_from_mentors_reviews = $scope.userprofile.points_number;
      $scope.reward_image = $scope.userprofile.reward_image;
      $scope.level = $scope.userprofile.level;
      // $scope.user_level = getuserlevel($scope.userprofile.points[0].points);
      // console.log("user profile pointssss are ",$scope.userprofile.points[0]);
      console.log("user profile is",$scope.userprofile);
	} , function(err){
		console.log(err);
	});

  user.userposts().then(function(data){
     console.log(data.data);
    $scope.allPosts=data.data.allPosts;
    // $scope.userinfo=data.data;
        console.log("user profile posts MINAAA",data.data.allPosts);
        // console.log("user profile info",$scope.userinfo);
        var d = new Date(data.data.allPosts[0].created_at);
        console.log('ddddddddddddddddddddddddddddddd',d);

  } , function(err){
    console.log(err);

  });
  // user.displayShared().then(function(data){
  //    console.log("shares",data.data.shares);
  //   //  $scope.allPosts = data.data.shares.concat($scope.userposts);
  //   //  console.log('all postssssssssssssssssssssssssssssssss',$scope.allPosts);
  //    //
  //   //     $scope.allPosts.sort(function(a,b){
  //   //         return new Date(b.created_at) - new Date(a.created_at);
  //   //     });
  //   //     console.log('all postssssssssssssssssssssssssssssssss after sort',$scope.allPosts);
  //    //
  //
  //    $scope.usershare=data.data.shares;
  //   // $scope.userinfo=data.data;
  //   //     console.log("user profile posts",$scope.userposts);
  //   //     console.log("user profile info",$scope.userinfo);
  //
  // } , function(err){
  //   console.log(err);
  // });


})
