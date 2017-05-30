angular.module('myApp').controller("homec",function(Home,$scope,$http,$routeParams,$rootScope,categories){

	$rootScope.token = JSON.parse(localStorage.getItem("token"));
	$rootScope.cur_user = JSON.parse(localStorage.getItem("cur_user"));
	console.log($rootScope.token);
	Home.getTopPosts().then(function(data){

		// console.log(data);
		$scope.topposts=data;
// console.log("top posts",data[0].post);
	} , function(err){
		console.log(err);

	});

    Home.getEvents().then(function(data){

        $scope.events=data;
		console.log("Eventsssssssssssss here",data);

    } , function(err){
        console.log(err);

    });
    Home.getWorkshops().then(function(data){

        $scope.workshops=data;
		console.log("workshopsssssssssssss is here",data);

    } , function(err){
        console.log(err);

    });








	var post_id= $routeParams['post_id'];
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


})
