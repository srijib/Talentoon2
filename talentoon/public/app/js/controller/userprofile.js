angular.module('myApp').controller("userprofile", function (categories,$scope, $http, user, $rootScope, $route,$routeParams,$location) {
    var filesuploaded = []
    $scope.user_id = $routeParams['user_id'];
    if (! $scope.user_id) {
        $scope.user_id = $rootScope.cur_user.id
    }


  user.userprofile().then(function(data){
      console.log("...............user profile is................",$scope.userprofile);
      $scope.userprofile=data.data;
      $scope.user_points_from_mentors_reviews = $scope.userprofile.points_number;
      $scope.reward_image = $scope.userprofile.reward_image;
      $scope.level = $scope.userprofile.level;
      // $scope.user_level = getuserlevel($scope.userprofile.points[0].points);
      // console.log("user profile pointssss are ",$scope.userprofile.points[0]);

      console.log("...............user profile is................",$scope.userprofile);
	} , function(err){
		console.log(err);
	});
    console.log('el current user ahoooooooooo',$rootScope.cur_user);
    // if($rootScope.cur_user.date_of_birth){
    //     var dob=$rootScope.cur_user.date_of_birth;
    //     $rootScope.cur_user.date_of_birth=new Date(dob);
    // }
    // $rootScope.dob=$rootScope.cur_user.date_of_birth;
    // $rootScope.cur_user.date_of_birth=new Date($rootScope.cur_user.date_of_birth);
    // user.editprofile($rootScope.cur_user.id).then(function(data){
    //     console.log('<<<<<<<<< user update dataaaaaaaaaaaa >>>>>>>>',data);
    //     $rootScope.cur_user=data;
    //     var dob=$rootScope.cur_user.date_of_birth;
    //     $rootScope.cur_user.date_of_birth=new Date(dob);
    //     $rootScope.fname= $rootScope.cur_user.first_name;
    //     $rootScope.lname=$rootScope.cur_user.last_name;
    //     console.log('el current user ahoooooooooo',$rootScope.cur_user)
    // } , function(err){
    //     console.log(err);
    //     // $location.url('/500');
    //
    // });

<<<<<<< HEAD

    user.user($scope.user_id).then(function(data){
            console.log("data of users",data.data);
           $scope.allPosts=data.data.allPosts;
           $scope.users=data.data.user;
           $scope.user_country=data.data.country;
           if(data.data.follower==null){
               $scope.follower=0;
           }else{
           $scope.follower=data.data.follower.followers_count
           }
           if(data.data.following==null){
               $scope.following=0;
           }else{
               $scope.following=data.data.following.following_count
           }
          // $scope.following=data.data.following
      } , function(err){
        console.log(err);

      });


  $scope.likepost = function(post_id,user_id) {
  var likeable_id=post_id;
  var likeable_type="post"
  var user_id=user_id;
  console.log(likeable_id)
  console.log(likeable_type);
  console.log(user_id);
  var obj={likeable_id,likeable_type,user_id}
  console.log(obj);
          posts.likepost(obj).then(function(data){
              // $rootScope.status=data;
              // localStorage.setItem('status',data);
              // $rootScope.status = localStorage.getItem("status");
              $rootScope.data=data;
              localStorage.setItem('testObject', JSON.stringify(data));
              // console.log("status in controller",$rootScope.status);
              var likedata = localStorage.getItem('testObject');
              console.log("parse",JSON.parse(likedata))
       $rootScope.userstatus=JSON.parse(likedata).status;
       $rootScope.user_id=JSON.parse(likedata).user_id;


           //
           localStorage.setItem('userstatus', $rootScope.userstatus );
           $rootScope.userstatu = localStorage.getItem('userstatus');


              // console.log("data in controller",$rootScope.data);
              console.log("status in controller",$rootScope.userstatus);
              // console.log("user_id in controller",$rootScope.user_id);



          } , function(err){
              console.log(err);

          });

  }


$scope.dislikepost = function(post_id,user_id) {
var likeable_id=post_id;
var likeable_type="post"
var user_id=user_id;
console.log(likeable_id)
console.log(likeable_type);
console.log(user_id);
var obj={likeable_id,likeable_type,user_id}
console.log(obj);
      posts.dislikepost(obj).then(function(data){
          // $rootScope.status=data;
          // localStorage.setItem('status',data);
          // localStorage.setItem('testObject', JSON.stringify(data));
          // $rootScope.status = localStorage.getItem("status");
          // console.log("status in controller",$rootScope.status);

          $rootScope.data=data;
          localStorage.setItem('testObject', JSON.stringify(data));
          // console.log("status in controller",$rootScope.status);
          var likedata = localStorage.getItem('testObject');
          console.log("parse",JSON.parse(likedata))
          $rootScope.userstatus=JSON.parse(likedata).status;
          $rootScope.user_id=JSON.parse(likedata).user_id;



                   localStorage.setItem('userstatus', $rootScope.userstatus );
                   $rootScope.userstatu = localStorage.getItem('userstatus');
          console.log("status in controller",$rootScope.userstatus);


      } , function(err){
          console.log(err);

      });

}

    // user.editprofile($rootScope.cur_user.id).then(function(data){
    //     $rootScope.cur_user=data;
    //     var dob=$rootScope.cur_user.date_of_birth;
    //     $rootScope.cur_user.date_of_birth=new Date(dob);
    //     $rootScope.fname= $rootScope.cur_user.first_name;
    //     $rootScope.lname=$rootScope.cur_user.last_name;
    // } , function(err){
    //     console.log(err);
    //
    // });

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
    $scope.user_id = $routeParams['user_id'];

    user.user($scope.user_id).then(function (data) {
        console.log(data.data);
        $scope.userposts = data.data.allPosts;
        $scope.user = data.data.user;
        $scope.country = data.data.country;
        $scope.status = data.data.follow;
        if (data.data.follower == null) {
            $scope.follower = 0;
        } else {
            $scope.follower = data.data.follower.followers_count
        }
        if (data.data.following == null) {
            $scope.following = 0;
        } else {
            $scope.following = data.data.following.following_count
        }
        // $scope.following=data.data.following


        console.log("eldataaaaa", $scope.following);
        // $scope.userinfo=data.data;
        console.log("user profile posts MINAAA", data.data.follow);

  } , function(err){
    console.log(err);
      // $location.url('/500');

  });
  // $scope.editprofile=function () {
  //     console.log($rootScope.cur_user.id);
  //     user.editprofile($rootScope.cur_user.id).then(function(data){
  //         console.log(data);
  //     $rootScope.cur_user=data;
  //     // $location.url('/editprofile');
  //     $rootScope.fname= $rootScope.cur_user.first_name;
  //     $rootScope.lname=$rootScope.cur_user.last_name;
  //     } , function(err){
  //         console.log(err);
  //         // $location.url('/500');
  //
  //     });
  // }


  $scope.updateuserprofile=function(valid){
      console.log('kkkkkkkkkkk',$scope.userupdate)

      if($rootScope.cur_user.userpassword ){
          $scope.password=true;
          console.log('i entered here')
      }
      if($rootScope.cur_user.newpassword===$rootScope.cur_user.repassword && $rootScope.cur_user.newpassword && $rootScope.cur_user.repassword){
          $scope.repassword=true;
          console.log('iam here')
      }
      if (valid) {
          console.log('feh user password',$scope.password)
          console.log('da5lt al etnen passwords',$scope.repassword)
          console.log($rootScope.cur_user.newpassword)
          //for checking on password in backend
          var userdata = $rootScope.cur_user
          if ($scope.repassword && $scope.password){
              console.log('da5lt koll 7aga ')
              // var userdata = $scope.userupdate
              console.log('y simnaaaaaaa',userdata);
              user.checkpassword(userdata).then(function (data) {
                  console.log('y simnaaaaaaa');
                  if (data == 'ok') {
                      $location.url('#!/');
                      $route.reload();
                  }else{
                      console.log(data)
                      // alert('enter your password right')
                  }
              }, function (err) {
                  console.log(err);
                  // $location.url('/500');
              });

          }else{
              //for updating data directly

              console.log('dddddddddddggggggggggg')

              user.updateuser(userdata).then(function (data) {
                  console.log(data)
              }, function (err) {
                  console.log(err);
                  // $location.url('/500');
              });

          }


      }
  }


    //edit user profile function

    // $scope.editprofile=function () {
    //     console.log($rootScope.cur_user.id);
    //     user.editprofile($rootScope.cur_user.id).then(function(data){
    //         console.log('<<<<<<<<< user update dataaaaaaaaaaaa >>>>>>>>',data);
    //     $rootScope.cur_user=data;
    //     var dob=$rootScope.cur_user.date_of_birth;
    //     $rootScope.cur_user.date_of_birth=new Date(dob);
    //     // $rootScope.cur_user.date_of_birth=new Date(data.date_of_birth)
    //     $location.url('/editprofile');
    //     $rootScope.fname= $rootScope.cur_user.first_name;
    //     $rootScope.lname=$rootScope.cur_user.last_name;
    //     } , function(err){
    //         console.log(err);
    //
    //     });
    //
    // }

    user.getAllCountry().then(function (data) {
        //console.log("countries:", data);
        $rootScope.countries_edit_user = data;
        console.log("countries", $scope.countries);
    }, function (err) {
        console.log(err);
        // $location.url('/500');
    });


    $scope.follow = function (following_id) {

        var obj = {following_id}
        console.log(obj);
        user.follow(obj).then(function (data) {
            console.log(data);
            $route.reload();


        }, function (err) {
            console.log(err);

        });



    }
    $scope.unfollow = function (following_id) {


// var user_id=user_id;

        var obj = {following_id}
        user.unfollow(obj).then(function (data) {
            console.log(data);
            console.log("el un follow", data);


            $route.reload();

        }, function (err) {
            console.log(err);


        });


    }

    $scope.uploadedFile = function (element) {
        console.log("element is ", element)
        $rootScope.profilePictureFile = element.files[0];
        filesuploaded.push(element.files[0]);
    }

    $scope.add_comment = function (i) {
        console.log("hhh", i);
        categories.submitComment($scope.allPosts[i].comment, $scope.allPosts[i].id).then(function (data) {
            console.log("saved success comment", data)
            $route.reload();
        }, function (err) {
            console.log(err);


        });
    }
    $scope.new_comment = function (i) {
        console.log("hhh", i);
        categories.submitComment($scope.userposts[i].comment, $scope.userposts[i].id).then(function (data) {
            console.log("saved success comment", data)
            $route.reload();
        }, function (err) {
            console.log(err);

        });
    }
});
