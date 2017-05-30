angular.module('myApp').controller("categories",function($location,$scope,$http,categories,$routeParams,$rootScope,$timeout,FileUploader,$q){

	$rootScope.token = JSON.parse(localStorage.getItem("token"));
	$rootScope.cur_user = JSON.parse(localStorage.getItem("cur_user"));
	console.log("category controller current user",$rootScope.cur_user);
	var filesuploaded = []
    var filesmecategoriesntoruploaded = []
    var reviewfilesuploaded=[]
	var talent = {}
    var mentor = {}
	var user_id=1;

	$scope.cat_id= $routeParams['category_id'];


	categories.getAllCategory().then(function(data){
		$scope.categories=data.data;
				console.log("categories array",$scope.categories);
	} , function(err){
		console.log(err);
	});
});
