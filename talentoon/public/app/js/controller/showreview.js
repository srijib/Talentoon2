angular.module('myApp').controller("showreview", function($rootScope,$scope, $http,showreview, $routeParams) {

    // $rootScope.cur_user = JSON.parse(localStorage.getItem("cur_user"));

    var mentor_id=$rootScope.cur_user.id;

    showreview.getAllInitialPosts(mentor_id).then(function(data){

        // console.log("data Mina",data);
        $rootScope.all_initial_posts=data;
    } , function(err){
        console.log(err);

    });

    $scope.rev={}

  $scope.review = function(i) {
      $scope.all_initial_posts[i].rev.review_media_id=$rootScope.all_initial_posts[i].id
      $scope.all_initial_posts[i].rev.category_talent_id=$rootScope.all_initial_posts[i].category_talent_id
      //now it is mentor id not category mentor id
      $scope.all_initial_posts[i].rev.category_mentor_id=mentor_id;
    console.log("review data sis",$scope.all_initial_posts[i].rev);
      showreview.storeSingleInitialReview($scope.all_initial_posts[i].rev).then(function(data){
        console.log("data Mina",data);
      } , function(err){
        console.log(err);
      });

  }

})
