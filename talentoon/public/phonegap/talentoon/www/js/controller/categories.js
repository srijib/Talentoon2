angular.module('talentoon').controller("categories",function($scope,$http,categories,$stateParams,$rootScope){
	$rootScope.token = localStorage.getItem('token');
console.log("token",$rootScope.token)
	// $rootScope.cur_user = JSON.parse(localStorage.getItem("cur_user"));
	// console.log("category controller current user",$rootScope.cur_user);
	$rootScope.cat_id= $stateParams['category_id'];
	categories.getAllCategory().then(function(data){
		$scope.categories=data.data;
				console.log("categories array",$scope.categories);
	} , function(err){
		console.log(err);
	});
});
