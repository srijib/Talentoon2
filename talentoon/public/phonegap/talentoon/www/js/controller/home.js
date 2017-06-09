angular.module('talentoon').controller("homec",function(Home,$scope,$http,$rootScope,categories,$stateParams,$sce){

	// $rootScope.token = JSON.parse(localStorage.getItem("token"));
	// $rootScope.cur_user = JSON.parse(localStorage.getItem("cur_user"));
	console.log($rootScope.token);
	Home.getTopPosts().then(function(data){

		// console.log(data);
		$scope.topposts=data;
		for (var i = 0; i < data.length; i++) {
if(data[i].media_type == 'video'){
			$scope.video_path = {src:'http://192.168.6.5:8000/'+data[i].media_type};

			 $scope.trustSrc = function(src) {
					 return $sce.trustAsResourceUrl(src);
			 }}
		}
		// console.log("type",data[0].media_type);

// console.log("top posts",data[0].post);
	} , function(err){
		console.log(err);

	});

    // Home.getEvents().then(function(data){
		//
    //     $scope.events=data;
		// console.log("Eventsssssssssssss here",data);
		//
    // } , function(err){
    //     console.log(err);
		//
    // });
    // Home.getWorkshops().then(function(data){
		//
    //     $scope.workshops=data;
		// console.log("workshopsssssssssssss is here",data);
		//
    // } , function(err){
    //     console.log(err);
		//
    // });








	var post_id= $stateParams.post_id;
	Home.postDetails(post_id).then(function(data){
		$scope.post=data;
	} , function(err){
		console.log(err);

	});



	// categories.getCategoryPost(id).then(function(data){
	// 		// console.log("inside controller" , data)
	// 		$rootScope.category_post=data;
	// 		// $rootScope.category_post = localStorage.getItem("data");
	// 		console.log("single post from controller",$rootScope.category_post);
	//
	// } , function(err){
	// 		console.log(err);
	// });
	//-------------------push notification---------------------
$rootScope.pushtoken=localStorage.getItem('pushtoken');
$rootScope.token = localStorage.getItem('token');
console.log('nshss',$rootScope.token)
console.log('hhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhh');
var id =$rootScope.pushtoken
var apikey="AIzaSyBNxzS-Xp5R1RRH43iYYbmnTlqA25BlSgE";


console.log("data push notification key ",apikey)
console.log("data push notification id ",id)

Home.push(apikey,id).then(function(data){
	$scope.pushdata=data;
} , function(err){
	console.log(err);

});
//--------------------end push -------------------

})
