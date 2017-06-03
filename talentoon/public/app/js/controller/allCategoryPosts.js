angular.module('myApp').controller("allCategoryPosts",function($scope,$http,$route,categories,$routeParams,$location,$rootScope){

  var index= $routeParams['category_id'];
  	$scope.cat_id=index;
  	var user_id=1;
  	categories.getCategoryPosts(index).then(function(data){
  			console.log("inside controller Minaaaaaaaaaaaaaaaaaaa" , data)
  			$rootScope.categoryAllPosts=data;
            $scope.category_id = data[0].category_id;
            console.log($scope.category_id);
  	} , function(err){
  			console.log(err);

  	});


    categories.getMentorsReviews().then(function(data){
        console.log("inside all category posts controller Nadaaaaaaaaaaaaa" , data)
        $scope.allposts_mentorsreviews = data;
    } , function(err){
        console.log(err);

    });

    $scope.rev={}

    $scope.add_review = function(i) {
        $scope.categoryAllPosts[i].post_id = $scope.post_id;
        $scope.categoryAllPosts[i].mentor_id = 2;

        console.log("ana hena ",$scope.categoryAllPosts[i]);

        categories.submitMentorReview($scope.categoryAllPosts[i]).then(function(data){
            console.log("saved success review",data)
            // $location.url('/category/'+$scope.cat_id+'/posts');
            $route.reload();
        } , function(err){
            console.log(err);

        });
    }


});
