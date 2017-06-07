angular.module('myApp').controller("homec",function(categories,$route,Home,$scope,$http,$routeParams,$rootScope,categories){

	Home.getTopPosts().then(function(data){
        console.log("el top posts ba2a",data);
		$scope.topposts=data.posts;
        $scope.comments=data.comments;
        console.log("comments",$scope.comments);
        $scope.post_exist = true;
	} , function(err){
		console.log("No posts existing, error: ",err);
        $scope.post_exist = false;

	});

    Home.getEvents().then(function(data){

        $scope.events=data;
		console.log("Eventsssssssssssss here",data);
        $scope.event_exist = true;
    } , function(err){
        console.log(err);
        $scope.event_exist = false;

    });
    Home.getWorkshops().then(function(data){

        $scope.workshops=data;
		console.log("workshopsssssssssssss is here",data);
        $scope.workshop_exist = true;
    } , function(err){
        console.log(err);
        $scope.workshop_exist = false;

    });


	var post_id= $routeParams['post_id'];
	Home.postDetails(post_id).then(function(data){
		$scope.post=data;
	} , function(err){
		console.log(err);

	});
    $scope.comment={}

    $scope.add_comment = function(i) {
        categories.submitComment($scope.topposts[i].comment,$scope.topposts[i].id).then(function(data){
            console.log("saved success comment",data)
        } , function(err){
            console.log(err);

        });
    }



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
