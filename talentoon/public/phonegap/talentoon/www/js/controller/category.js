angular.module('talentoon').controller("oneCategory",function($state,$window,$scope,$http,categories,$stateParams,$rootScope,$timeout,$q){

	// $rootScope.token = JSON.parse(localStorage.getItem("token"));
		$rootScope.token = localStorage.getItem('token');
		$rootScope.cur_user = localStorage.getItem('id');


	console.log("category controller current user",$rootScope.cur_user);
	var filesuploaded = []
    var filesmentoruploaded = []
    var reviewfilesuploaded=[]
	var talent = {}
    var mentor = {}
	var user_id=1;

	$rootScope.cat_id= $stateParams['category_id'];
	$scope.event_id=$stateParams['event_id'];



	categories.getCategoryEvents($rootScope.cat_id).then(function(data){
			var user_id=1;
			$rootScope.events=data;
	} , function(err){
			console.log(err);

	});




    $scope.uploadedFile = function(element) {
            console.log("element is ",element)
            $scope.currentFile = element.files[0];

            filesuploaded.push(element.files[0])

            var reader = new FileReader();

            reader.onload = function(event) {
              $scope.image_source = event.target.result
              $scope.$apply(function($scope) {
                $scope.files = element.files;
              });
            }
        reader.readAsDataURL(element.files[0]);
    }



    $scope.uploadedReviewFile = function(element) {
        reviewfilesuploaded.push(element.files[0])
    }


//------------------------------------------------------------------
	//get all category
        //esraaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa
	categories.getAllCategory().then(function(data){
		 console.log("esraaaaa all data",data);
		$scope.categories=data.data;
                console.log("categories array",$scope.categories);
	} , function(err){
		console.log(err);
	});

//---------------------------------------------------------------


	categories.getCategoryPosts($rootScope.cat_id).then(function(data){
// 		if(data.talent.talent_id != null){
// $rootScope.talent_id=data.talent.talent_id;
// }
// $rootScope.talent_id=0;
  // $rootScope.talent_id=data.talent.talent_id;
console.log("talent id in category",$rootScope.talent_id);
console.log("curent user id  in category",$rootScope.cur_user);
			$rootScope.category3Posts=data.posts;
			console.log("posts in category",$rootScope.category3Posts);
	} , function(err){
			console.log(err);

	});

//----------------------------single----post---------------------------------------
$scope.post_id= $stateParams['post_id'];

	categories.getCategoryPost($scope.post_id).then(function(data){

			console.log("inside controller" , data)
			$rootScope.category_post=data.post;
			console.log("post in getCategoryPost",data.post);
			// $rootScope.category_post_like_count=data.countlike;
	} , function(err){
			console.log(err);
	});

    });
