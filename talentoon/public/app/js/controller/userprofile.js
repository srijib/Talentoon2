angular.module('myApp').controller("userprofile", function ($scope, $http, user, $routeParams,$location) {

  user.userprofile().then(function(data){
      $scope.userprofile=data.data;
      $scope.user_points_from_mentors_reviews = $scope.userprofile.points[0].points;
      $scope.user_level = getuserlevel($scope.userprofile.points[0].points);
      console.log("categories array",$scope.userprofile.points[0]);
      console.log("user profile",$scope.userprofile);
	} , function(err){
		console.log(err);

	});


  user.userposts().then(function(data){
     console.log(data.data);
    $scope.userposts=data.data.post;
    $scope.userinfo=data.data;
        console.log("user profile posts",$scope.userposts);
        console.log("user profile info",$scope.userinfo);

  } , function(err){
    console.log(err);

  });
  user.displayShared().then(function(data){
     console.log("shareeeeeeeeees",data.data.shares);
     $scope.usershare=data.data.shares;
    // $scope.userinfo=data.data;
    //     console.log("user profile posts",$scope.userposts);
    //     console.log("user profile info",$scope.userinfo);

  } , function(err){
    console.log(err);

  });


})



function getuserlevel(points){

    var level = 0;
    if(points<100){
        level = 1;
    }
    if(points>=100 && points<200)
    {
        level = 2;
    }
    if(points>=200 && points<300)
    {
        level = 3;
    }
    if(points>=300 && points<400)
    {
        level = 4;
    }
    if(points>=400 && points<500)
    {
        level = 5;
    }
    if(points>=500 && points<600)
    {
        level = 6;
    }
    if(points>=600 && points<700)
    {
        level = 7;
    }
    if(points>=700 && points<800)
    {
        level = 8;
    }
    if(points>=800 && points<900)
    {
        level = 9;
    }
    if(points>=900 && points<1000)
    {
        level = 10;
    }

    return level;

}

