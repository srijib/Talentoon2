angular.module('myApp').controller("userprofile", function ($scope, $http, user, $rootScope, $routeParams,$location) {

    $rootScope.userupdate=JSON.parse(localStorage.getItem("cur_user"));;
    $rootScope.fname= $rootScope.userupdate.first_name;
    $rootScope.lname=$rootScope.userupdate.last_name;

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
     console.log("shares",data.data.shares);
     $scope.allPosts = data.data.shares.concat($scope.userposts);
     console.log('all postssssssssssssssssssssssssssssssss',$scope.allPosts);

        $scope.allPosts.sort(function(a,b){
            return new Date(b.created_at) - new Date(a.created_at);
        });
        console.log('all postssssssssssssssssssssssssssssssss after sort',$scope.allPosts);


     $scope.usershare=data.data.shares;
    // $scope.userinfo=data.data;
    //     console.log("user profile posts",$scope.userposts);
    //     console.log("user profile info",$scope.userinfo);

  } , function(err){
    console.log(err);
  });

    //edit user profile function
    $scope.editprofile=function () {
        console.log($rootScope.cur_user.id);
        user.editprofile($rootScope.cur_user.id).then(function(data){
            console.log(data);
        $rootScope.userupdate=data;
        $location.url('/editprofile');
        $rootScope.fname= $rootScope.userupdate.first_name;
        $rootScope.lname=$rootScope.userupdate.last_name;
        } , function(err){
            console.log(err);

        });

    }


    $scope.updateuserprofile=function(valid){
        console.log('kkkkkkkkkkk',$scope.userupdate)

        if($scope.userupdate.userpassword ){
            $scope.password=true;
            console.log('i entered here')
        }
        if($scope.userupdate.newpassword===$scope.userupdate.repassword && $scope.userupdate.newpassword && $scope.userupdate.repassword){
            $scope.repassword=true;
            console.log('iam here')
        }
        if (valid) {
            console.log('feh user password',$scope.password)
            console.log('da5lt al etnen passwords',$scope.repassword)
            console.log($scope.userupdate.newpassword)
            //for checking on password in backend
            var userdata = $scope.userupdate
            if ($scope.repassword && $scope.password){
                console.log('da5lt koll 7aga ')
                // var userdata = $scope.userupdate
                console.log('y simnaaaaaaa');
                user.checkpassword(userdata).then(function (data) {
                    console.log('y simnaaaaaaa');
                    if (data == 'ok') {
                        $location.url('/');
                        $route.reload();
                    }else{
                        console.log(data)
                        // alert('enter your password right')
                    }
                }, function (err) {
                    console.log(err);
                });

            }else{
                //for updating data directly

                console.log('dddddddddddggggggggggg')

                user.updateuser(userdata).then(function (data) {
                    console.log(data)
                }, function (err) {
                    console.log(err);
                });

            }


        }
    }



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
