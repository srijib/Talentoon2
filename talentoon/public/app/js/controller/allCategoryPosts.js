angular.module('myApp').controller("allCategoryPosts",function($scope,$http,categories,$routeParams,$location,$rootScope){

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

});
