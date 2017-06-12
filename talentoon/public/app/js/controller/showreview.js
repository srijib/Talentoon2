angular.module('myApp').controller("showreview", function($location,$timeout,$rootScope,$scope, $http,showreview, $routeParams,$route,user) {


    // $rootScope.cur_user = JSON.parse(localStorage.getItem("cur_user"));

    $timeout(function () {
        var mentor_id =$rootScope.cur_user.id;
        showreview.getAllInitialPosts(mentor_id).then(function(data){
            $rootScope.all_initial_posts=data;
        } , function(err){
            console.log(err);
            // $location.url('/500');
        });
    }, 10);

    $scope.rev={}

  $scope.review = function(i) {
      // $scope.all_initial_posts[i].rev.review_media_id=$rootScope.all_initial_posts[i].id
      $scope.all_initial_posts[i].rev.review_media_id=$rootScope.all_initial_posts[i].review_media_id
      $scope.all_initial_posts[i].rev.talent_id =$rootScope.all_initial_posts[i].talent_id
      $scope.all_initial_posts[i].rev.category_talent_id=$rootScope.all_initial_posts[i].category_talent_id
      //now it is mentor id not category mentor id
      $scope.all_initial_posts[i].rev.mentor_id=$rootScope.cur_user.id;
      console.log("review data sis",$scope.all_initial_posts[i].rev);
      showreview.storeSingleInitialReview($scope.all_initial_posts[i].rev).then(function(data){
        console.log("data Mina",data);
          //$route.reload();
      } , function(err){
        console.log(err);
          // $location.url('/500');
      });

  }

})
