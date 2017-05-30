angular.module('myApp').controller("oneCategory",function($location,$scope,$http,categories,$routeParams,$rootScope,$timeout,FileUploader,$q,videoconference){

	$rootScope.token = JSON.parse(localStorage.getItem("token"));
	$rootScope.cur_user = JSON.parse(localStorage.getItem("cur_user"));
	console.log("category controller current user",$rootScope.cur_user);
	var filesuploaded = []
    var filesmentoruploaded = []
    var reviewfilesuploaded=[]
	var talent = {}
    var mentor = {}
	var user_id=1;

	$scope.cat_id= $routeParams['category_id'];
	$scope.workshop_id=$routeParams['workshop_id'];
	$scope.event_id=$routeParams['event_id'];

	categories.getCategoryWorkshops($scope.cat_id).then(function(data){
			$rootScope.categoryWorkshops=data;
	} , function(err){
			console.log(err);

	});


	categories.getCategoryWorkshop($scope.cat_id,$scope.workshop_id).then(function(data){
			console.log("inside controller" , data)
			$rootScope.category_workshop=data.workshop;
			$rootScope.userId=data.user.id;
			$rootScope.enroll=data.enroll;
			// $rootScope.category_post = localStorage.getItem("data");
			console.log("single workshop from controller",$rootScope.category_workshop);

	} , function(err){
			console.log(err);
	});

	categories.getCategoryEvents($scope.cat_id).then(function(data){
			var user_id=1;
			$rootScope.events=data;
	} , function(err){
			console.log(err);

	});


    $scope.completeTalentProfile = function(){

		if (reviewfilesuploaded.length > 0)
		{
			talent.talent_id = 1;
			talent.category_id = $routeParams['category_id'];
			talent.from_when =$scope.talent.from_when;
			talent.description = $scope.talent.description;
			talent.files_of_initial_review = reviewfilesuploaded;

			console.log("Talent Object is ",talent);

            categories.complete_talent_profile(talent).then(function(data){

                category_talent_id = data.category_talent_id.original.category_talent_id;
                console.log("get the id from here",category_talent_id)


                categories.insert_media_reviews_uploads(reviewfilesuploaded,category_talent_id).then(function(){

                    console.log("in then ")
                }, function (error) {
                    console.log(error)
                });


            }, function (err) {
                console.log(err)
            });


		}else{
			alert("sorry files is required")
		}

	}



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














    $scope.completeMentorProfile = function(){

        mentor.mentor_id = 1;
        mentor.category_id = $routeParams['category_id'];
        mentor.years_of_experience = $scope.mentor.years_of_experience;
        mentor.experience =$scope.mentor.experience;
        mentor.status=0;

        console.log("Mentor Object is ",mentor);

		categories.complete_mentor_profile(mentor).then(function(data){
			console.log(data)
			console.log("in complete mentor profile")

			}, function (err) {
					console.log(err)
					console.log("in complete mentor profile error")
		});
    }

    $scope.unmentor = function(){

        mentor.mentor_id = 1;
        //$routeParams['category_id']
        mentor.category_id = 1;
        mentor.action="unmentor";


        console.log("Mentor Object is ",mentor);

        categories.unmentor(mentor).then(function(data){
            console.log(data)

        }, function (err) {
            console.log(err)
        });




    }




    //assuming we have user id and the role that define him as mentor
    //here we will get the mentor status to make toggle button in views
    // categories.getUser(1).then(function(data){
    //
    //     console.log(data);
    //     $scope.currentUser=data;
    //
    // } , function(err){
    //     console.log(err);
    //
    // });

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
//----------------------------------------------------------------------
$scope.comment={};
	$scope.addcomment= function(valid) {
    if (valid) {
      var comment = $scope.comment
      // console.log(comment);
			// console.log("vaild in add comment");

    }
		else{
			console.log("error in add comment");
		}
  }
//---------------------------------------------------------------
	//get 3  posts under category
	// $scope.allposts = function() {
    var user_id=1;
    categories.getCategoryPost($scope.cat_id).then(function(data){
        // console.log("inside controller" , data)
        $scope.category_posts=data;
        // console.log("la2aa",$scope.category_posts);

    console.log("post detalis",$scope.category_posts);
    } , function(err){
        console.log(err);

    });

//when click on show all posts
$scope.allposts = function() {

	var user_id=1;
	categories.getCategoryPosts($scope.cat_id).then(function(data){
			// console.log("inside controller" , data)
			$rootScope.categoryPosts=data;
			$location.url('/category/'+$scope.cat_id+'/posts');

	} , function(err){
			console.log(err);

	});
}
//--------------------------------------------------------------

	var user_id=1;
	categories.getCategoryPosts($scope.cat_id).then(function(data){
			$rootScope.category3Posts=data;
	} , function(err){
			console.log(err);

	});

//----------------------------single----post---------------------------------------
$scope.post_id= $routeParams['post_id'];
	var user_id=1;
	categories.getCategoryPost($scope.post_id).then(function(data){
			// console.log("inside controller" , data)
			$rootScope.category_post=data.post;
			$rootScope.category_post_like_count=data.countlike;

	} , function(err){
			console.log(err);
	});


// subscribe in category
$scope.subscribe = function() {
	$routeParams['user_id']=1;
	 var subscriber_id= $routeParams['user_id'];
	 var subscribed=1;
	var category_id = $routeParams['category_id'];
var obj={subscriber_id, category_id,subscribed }
console.log(obj);
		categories.subscribe(obj).then(function(data){
			localStorage.setItem('status',data);
			$rootScope.status = localStorage.getItem("status");
			 $location.url('/category/'+category_id);
		} , function(err){
			console.log(err);

		});

}
//----------------------------------------------------

// unsubscribe in category
$scope.unsubscribe = function() {
	$routeParams['user_id']=1;
	 var subscriber_id= $routeParams['user_id'];
	 var subscribed=0;
	var category_id = $routeParams['category_id'];
var obj={subscriber_id, category_id,subscribed }
console.log(obj);
		categories.unsubscribe(obj).then(function(data){
			localStorage.setItem('status',data);
			$rootScope.status = localStorage.getItem("status");
			// $rootScope.status=data;
			  $location.url('/category/'+category_id);
			// console.log("hiii")
		} , function(err){
			console.log(err);

		});


}



//be teacher in wizIQ
$scope.add_wiziq_teacher = function() {
    var mentor_id=1;
    console.log("Add Wiziq Teacher");
	videoconference.add_teacher(mentor_id).then(function(data){
	} , function(err){
        console.log("Add Wiziq Teacher ERROR section");
		console.log(err);
	});
}

//--------------------------------------------------------------------



    // Talent Uploader

	//files with ng file upload
	var uploader = $scope.uploader = new FileUploader({
        // url: 'http://172.16.2.239:8000/api/test'
        // url: 'upload.php'
        url: 'http://localhost:8000/api/uploads/singleuploded'

			});




			$scope.allworkshops = function() {

				var user_id=1;
				categories.getCategoryWorkshops($scope.cat_id).then(function(data){
						$rootScope.categoryWorkshops=data;

						console.log("all workshops under category",data);


				} , function(err){
						console.log(err);

				});
			}












    });
