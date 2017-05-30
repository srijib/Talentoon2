angular.module('myApp').controller("post", function ($scope, $http, posts, $routeParams,$location,$rootScope) {



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
$scope.sharepost = function(post_id,user_id) {
var post_id=post_id;
var user_id=user_id;

console.log(user_id);
var obj={post_id,user_id}
console.log(obj);
		posts.sharepost(obj).then(function(data){
			console.log(data);

		} , function(err){
			console.log(err);

		});

}







});
