angular.module('myApp').controller("post", function ($scope, $http, posts,categories, $routeParams,$location,$rootScope) {

	// $scope.cat_id = $routeParams['category_id'];

	// categories.getUserRoles($scope.cat_id).then(function (data) {
	// 	console.log("ROLESSSSS FROM CONTROLLER", data)
	// 	if(data.is_sub.length){
    //         $scope.is_subscribed = data.is_sub[0].subscribed;
    //     }
	//
    //     if(data.is_talent.length != 0){
    //         $scope.is_talent = data.is_talent[0].status;
    //     }
	//
    //     if(data.is_mentor.length != 0 ){
    //         $scope.is_mentor = data.is_mentor[0].status;
    //     }
	// }, function (err) {
	// 	console.log(err);
	// });



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
                // $location.url('/500');
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
            // $location.url('/500');
		});

}
$scope.sharepost = function(post_id) {
var post_id=post_id;
// var user_id=user_id;

var obj={post_id}

console.log("hhhhhhhhhhhhhhhhhhhhhhhhhh",obj);
		posts.sharepost(obj).then(function(data){
			console.log(data);

		} , function(err){
			console.log(err);
            // $location.url('/500');
		});

}







});
