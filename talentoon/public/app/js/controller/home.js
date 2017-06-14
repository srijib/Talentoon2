angular.module('myApp').controller("homec",function($location,$route,Home,$scope,$http,$routeParams,$rootScope,categories,user){
    Home.getTopPosts().then(function(data){

        console.log("el top posts ba2a",data);
		$scope.topposts=data.posts;
        $scope.comments=data.comments;
        console.log("comments",$scope.comments);

        if($scope.topposts.length){
            $scope.post_exist = true;
        }
        else{
            $scope.post_exist = false;
        }

	} , function(err){
        $rootScope.server_down = 1;
		console.log("No posts existing, error: ",err);
        $scope.post_exist = false;
        // $location.url('/500');

	});

    Home.getEvents().then(function(data){

        $scope.events=data;

        if($scope.events.length){
            console.log("Eventsssssssssssss here",data);
            $scope.event_exist = true;
        }
        else{
            $scope.event_exist = false;
        }


    } , function(err){
        console.log(err);
        $rootScope.server_down = 1;
        $scope.event_exist = false;
        // $location.url('/500');

    });
    Home.getWorkshops().then(function(data){

        $scope.workshops=data;
		// $scope.places=data.max_capacity-data.enroll_count;

        if($scope.workshops.length){
            $scope.workshop_exist = true;
        }
        else{
            $scope.workshop_exist = false;
        }

		console.log("workshopsssssssssssss is here",data);

    } , function(err){
        console.log(err);
        $rootScope.server_down = 1;
        $scope.workshop_exist = false;
        // $location.url('/500');

    });


	var post_id= $routeParams['post_id'];
	Home.postDetails(post_id).then(function(data){
		$scope.post=data;
	} , function(err){
		console.log(err);
        // $location.url('/500');

	});
    $scope.comment={}

    $scope.add_comment = function(i) {
        categories.submitComment($scope.topposts[i].comment,$scope.topposts[i].id).then(function(data){
            console.log("saved success comment",data)
            // $scope.comments[i].comment=data.comments
        } , function(err){
            console.log(err);
            // $location.url('/500');

        });
    }

	$scope.going= function(event_id,index) {
		Home.goingevent(event_id).then(function(data){
			console.log("GOING EVENT",data);
            if (data.new_going_count) {
                $scope.events[index].going_count= data.new_going_count.going_count
            }
            if (data.going ==1) {
                alert ('you are already going')
            }

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



// if($scope.categoryPosts.length){
//     $scope.category_posts_exists = 1;
// }else{
//     $scope.category_posts_exists = 0;
// }
// if($scope.categoryEvents.length){
//     $scope.category_events_exists = 1;
// }else{
//     $scope.category_events_exists = 0;
// }
//
// if($scope.categoryWorkshops.length){
//     $scope.category_workshops_exists = 1;
// }else{
//     $scope.category_workshops_exists = 0;
// }
//
// if($scope.cur_user){
//     $scope.cur_user_exists = 1;
// }else{
//     $scope.cur_user_exists = 0;
// }
//
// if($scope.category_details){
//     $scope.category_details_exists = 1;
// }else{
//     $scope.category_details_exists = 0;
// }
