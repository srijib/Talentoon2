angular.module('myApp').controller("allCategoryPosts",function($scope,$http,categories,$routeParams,$location,$rootScope){

  var index= $routeParams['category_id'];
  	$scope.cat_id=index;
  	var user_id=1;
  	categories.getCategoryPosts(index).then(function(data){
  			// console.log("inside controller" , data)
  			$rootScope.categoryAllPosts=data;

  	} , function(err){
  			console.log(err);

  	});

});
