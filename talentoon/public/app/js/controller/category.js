angular.module('myApp').controller("oneCategory", function ($location, $scope, $http, categories, $routeParams, $rootScope, $timeout, $q, videoconference,$route) {

	$rootScope.token = JSON.parse(localStorage.getItem("token"));
	$rootScope.cur_user = JSON.parse(localStorage.getItem("cur_user"));
	console.log("category controller current user",$rootScope.cur_user);
	console.log("category controller token",$rootScope.token);
	var filesuploaded = []

    var filesmentoruploaded = []
    var reviewfilesuploaded = []
    var talent = {}
    var mentor = {}
    var user_id = $rootScope.cur_user.id;


    $scope.cat_id = $routeParams['category_id'];
    $scope.workshop_id = $routeParams['workshop_id'];
    $scope.event_id = $routeParams['event_id'];



	categories.getCategoryAllData($scope.cat_id).then(function (data) {
		console.log('getCategoryAllDataaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa',data);
        $scope.categoryPosts = data.posts;
        $scope.is_subscribed = data.is_sub[0].subscribed;
        $scope.is_talent = data.is_talent[0].status;
        $scope.is_mentor = data.is_mentor[0].status;
		console.log('$scope.is_subscribed',data.is_mentor[0].status);
        $scope.categoryEvents = data.events;
        $scope.categoryWorkshops = data.workshops;
        $rootScope.cur_user = data.cur_user;
        $scope.category_details = data.category_details;
		if($scope.categoryPosts.length){
            $scope.category_posts_exists = 1;
        }
        if($scope.categoryEvents.length){
            $scope.category_events_exists = 1;
        }

        if($scope.categoryWorkshops.length){
            $scope.category_workshops_exists = 1;
        }

        if($scope.cur_user){
            $scope.cur_user_exists = 1;
        }

        if($scope.category_details){
            $scope.category_details_exists = 1;
        }
    }, function (err) {
        console.log(err);
    });

	// Competitions.getCategoryCompetitions($scope.cat_id).then(function (data) {
	// 	console.log('getCategoryCompetitions',data.competitions);
    //     $scope.categoryCompetitions = data.competitions;
    // }, function (err) {
    //     console.log(err);
    // });


    // categories.getCategoryWorkshops($scope.cat_id).then(function (data) {
    //     $rootScope.categoryWorkshops = data;
    // }, function (err) {
    //     console.log(err);
    // });

    categories.getCategoryWorkshop($scope.workshop_id).then(function (data) {
        console.log("inside controller", data)
        $rootScope.category_workshop = data.workshop;
        $rootScope.userId = data.user.id;
        $rootScope.enroll = data.enroll;
        $rootScope.media = data.session;

        // $rootScope.category_post = localStorage.getItem("data");
        console.log("single workshop from controller", $rootScope.category_workshop);

    }, function (err) {
        console.log(err);
    });
    // categories.getCategoryEvent($scope.cat_id,$scope.workshop_id).then(function (data) {
    //     $rootScope.editable_event=data;
    //     console.log("single event from controller", $rootScope.category_workshop);
    //
    // }, function (err) {
    //     console.log(err);
    // });
    // categories.getCategoryPost($scope.workshop_id).then(function (data) {
    //     $rootScope.editable_post=data;
    //     console.log("single post from controller", $rootScope.category_workshop);
    //
    // }, function (err) {
    //     console.log(err);
    // });

    // categories.getCategoryEvents($scope.cat_id).then(function (data) {
    //     var user_id = 1;
    //     $rootScope.events = data;
    //     console.log("EVENTSSSSSS",$rootScope.events);
    // }, function (err) {
    //     console.log(err);
	//
    // });

    $scope.isWorkshopCraetor = function (workshop_id) {
    	console.log('hnaaa al id bta3 al workshop',workshop_id);
    	var user_id=$rootScope.cur_user.id;
        //$rootScope.cur_user['id']
        console.log('hnaaa al id bta3 al user workshop',$rootScope.cur_user.id);
        var data_ws={user_id,workshop_id};
        console.log('hnaaa al data workshop',data_ws);
        categories.isWorkshopCraetor(data_ws).then(function(data){
			console.log('yess al data waslt',data)
            $rootScope.isCreator=data.creator;
			console.log($rootScope.isCreator)
        } , function(err){
            console.log(err);


        });


    }

    $scope.editWorkshop=function (workshop_id,cat_id){
        console.log('gwa edit al workshop',workshop_id);
        var editable={workshop_id,cat_id}
        categories.editWorkshop(editable).then(function(data){
            $rootScope.editable_workshop=data
            console.log('7asl al edit ya3ni haygeb al data',$rootScope.editable_workshop)
            $location.url('/category/'+cat_id+'/workshops/'+workshop_id+'/editworkshop')
        } , function(err){
            console.log(err);


        });
    }
    $scope.deleteWorkshop=function (workshop_id,cat_id) {
        var editable={workshop_id,cat_id}
        categories.deleteWorkshop(editable).then(function(data){
            $rootScope.workshop_id=data
            console.log('7asl al deleteeeeeee',$rootScope.workshop_id)
            // $location.url('/category/'+cat_id+'/workshops/'+workshop_id+'/editworkshop')
        } , function(err){
            console.log(err);


        });
    }
    $scope.saveupdated=function (vaild){

        if (vaild) {
            var category= $routeParams['category_id'];
            var mentor_id= $rootScope.cur_user.id;
            $scope.editable_workshop.category_id=category


            var workshopdata = $scope.editable_workshop;
            console.log('in update dataaaaa',workshopdata);
            categories.updatedworkshop(workshopdata).then(function(data){
                console.log('in update al workshop lma da5lt anadi 3la method al factory w geet')
                console.log("the workshop request from server is ",data);

            } , function(err){
                console.log(err);

            });

        }


    }
    ////////////////////////////Strat POST edit delete update/////////////////
    $scope.isPostCraetor = function (post_id) {
        console.log('hnaaa al id bta3 al post',post_id);
        var user_id=$rootScope.cur_user.id;
        //$rootScope.cur_user['id']
        console.log('hnaaa al id bta3 al user workshop',$rootScope.cur_user.id);
        var data_ws={user_id,post_id};
        console.log('hnaaa al data workshop',data_ws);
        categories.isWorkshopCraetor(data_ws).then(function(data){
            console.log('yess al data waslt',data)
            $rootScope.isPostCreator=data.creator;
            console.log($rootScope.isPostCreator)
        } , function(err){
            console.log(err);


        });


    }

    $scope.editPost=function (post_id,cat_id){
        console.log('gwa edit al post',post_id);
        var editable={post_id,cat_id}
        categories.editPost(editable).then(function(data){
            $rootScope.editable_post=data
            console.log('7asl al edit ya3ni haygeb al data',$rootScope.editable_post)
            $location.url('/category/'+cat_id+'/posts/'+post_id+'/editpost')
        } , function(err){
            console.log(err);


        });
    }
    $scope.deletePost=function (post_id,cat_id) {
        var editable={post_id,cat_id}
        categories.deletePost(editable).then(function(data){
            $rootScope.post_id=data
            console.log('7asl al deleteeeeeee',$rootScope.post_id)
            $location.url('/category/'+cat_id+'/posts')
            // $location.url('/category/'+cat_id+'/workshops/'+workshop_id+'/editworkshop')
        } , function(err){
            console.log(err);


        });
    }
    $scope.saveupdatedpost=function (vaild){

        if (vaild) {
            var category= $routeParams['category_id'];
            var mentor_id= $rootScope.cur_user.id;
            $scope.editable_post.category_id=category


            var postdata = $scope.editable_post;
            console.log('in update dataaaaa',postdata);
            categories.updatedpost(postdata).then(function(data){
                console.log('in update al post lma da5lt anadi 3la method al factory w geet')
                console.log("the workshop request from server is ",data);
                $location.url('/category/'+cat_id+'/posts')

            } , function(err){
                console.log(err);

            });

        }


    }
    //////////////////END Post edit,delete,update//////////////////////
    ////////////////////Start Event edit delete update///////////////////
    $scope.isEventCraetor = function (event_id) {
        console.log('hnaaa al id bta3 al event',event_id);
        var user_id=$rootScope.cur_user.id;
        //$rootScope.cur_user['id']
        console.log('hnaaa al id bta3 al user event',$rootScope.cur_user.id);
        var data_ws={user_id,event_id};
        console.log('hnaaa al data event',data_ws);
        categories.isEventCreator(data_ws).then(function(data){
            console.log('yess al data waslt',data)
            $rootScope.isEventCreator=data.creator;
            console.log($rootScope.isEventCreator)
        } , function(err){
            console.log(err);


        });


    }

    $scope.editEvent=function (event_id,cat_id){
        console.log('gwa edit al event',event_id);
        var editable={event_id,cat_id}
        categories.editEvent(editable).then(function(data){

            $rootScope.editable_event=data
            $scope.editable_event.time_from =new Date(data.time_from)
            $scope.editable_event.time_to =new Date(data.time_to)
            // $scope.editable_event.time_from = new Time(data.time_from)
            // $scope.editable_event.time_to = new Time(data.time_to)
            $scope.editable_event.date_from = new Date(data.date_from)
            $scope.editable_event.date_to = new Date(data.date_to)

            console.log('7asl al edit ya3ni haygeb al data',$rootScope.editable_event)
            $location.url('/category/'+cat_id+'/events/'+event_id+'/editevent')

        } , function(err){
            console.log(err);


        });
    }
    $scope.deleteEvent=function (event_id,cat_id) {
        var editable={event_id,cat_id}
        categories.deleteEvent(editable).then(function(data){
            $rootScope.event_id=data
            console.log('7asl al deleteeeeeee',$rootScope.event_id)
            // $location.url('/category/'+cat_id+'/workshops/'+workshop_id+'/editworkshop')
        } , function(err){
            console.log(err);


        });
    }
    $scope.saveupdatedevent=function (vaild){
        console.log('hhhhhhhhhhhhhhhh')
        if (vaild) {
            var category= $routeParams['category_id'];
            var mentor_id= $rootScope.cur_user.id;
            console.log('hhhhhhhhhhhhhhhh')
            $scope.editable_event.category_id=category


            var eventdata = $scope.editable_event;
            console.log('in update dataaaaa cat',eventdata.category_id);
            console.log('in update dataaaaa eve ',eventdata.id);
            categories.updatedevent(eventdata).then(function(data){
                console.log('in update al event lma da5lt anadi 3la method al factory w geet')
                console.log("the event request from server is ",data);
                $location.url('/category/'+category+'/events')
                if(data){

                }

            } , function(err){
                console.log(err);

            });

        }


    }
    /////////////////////END Event edit delete update///////////////////////////////////

    categories.getMentorsReviews().then(function(data){
        console.log("inside all category posts controller Nadaaaaaaaaaaaaa" , data)
        $scope.allposts_mentorsreviews = data;
    } , function(err){
        console.log(err);

    });

    $scope.rev={}

    $scope.add_review = function(i) {


        console.log("jjjj mina")
        // console.log("JJJJ Y Bassant",$scope.categoryPosts[i].post_id)
        // $scope.categoryPosts[i].post_id = $scope.post_id;
        // $scope.categoryPosts[i].mentor_id = 2;

        console.log("ana hena ",$scope.categoryPosts[i].id);

        categories.submitMentorReview($scope.categoryPosts[i]).then(function(data){
            console.log("saved success review",data)
            // $location.url('/category/'+$scope.cat_id+'/posts');
            $route.reload();
        } , function(err){
            console.log(err);

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
    // categories.getAllCategory().then(function (data) {
    //     console.log("esraaaaa all data", data);
    //     $scope.categories = data.data;
    //     console.log("categories array", $scope.categories);
    // }, function (err) {
    //     console.log(err);
    // });
//----------------------------------------------------------------------
    // $scope.comment = {};
    // $scope.addcomment = function (valid) {
    //     if (valid) {
    //         var comment = $scope.comment
    //         // console.log(comment);
    //         // console.log("vaild in add comment");
	//
    //     } else {
    //         console.log("error in add comment");
    //     }
    // }
//---------------------------------------------------------------
    //get 3  posts under category
    // $scope.allposts = function() {
    // var user_id = 1;
    // categories.getCategoryPost($scope.cat_id).then(function (data) {
    //     // console.log("inside controller" , data)
    //     $scope.category_posts = data;
    //     // console.log("la2aa",$scope.category_posts);
	//
    //     console.log("post detalis", $scope.category_posts);
    // }, function (err) {
    //     console.log(err);
	//
    // });

//when click on show all posts
    // $scope.allposts = function () {
	//
    //     var user_id = 1;
    //     categories.getCategoryPosts($scope.cat_id).then(function (data) {
    //         $rootScope.categoryPosts = data;
	// 		console.log('allllllllll ya mina');
    //         $location.url('/category/' + $scope.cat_id + '/posts');
	//
    //     }, function (err) {
    //         console.log(err);
	//
    //     });
    // }
//--------------------------------------------------------------

    // var user_id = 1;
    // categories.getCategoryPosts($scope.cat_id).then(function (data) {
    //     $rootScope.category3Posts = data;
	// 	console.log("user from esraaa to minaaaaaa" , data)
	//
    // }, function (err) {
    //     console.log(err);
	//
    // });

//----------------------------single----post---------------------------------------
    $scope.post_id = $routeParams['post_id'];
    var user_id = 1;
    categories.getCategoryPost($scope.post_id).then(function (data) {
        // console.log("inside controller" , data)
        $rootScope.category_post = data.post;
        $rootScope.category_post_like_count = data.countlike;
		$rootScope.comments = data.comments;


    }, function (err) {
        console.log(err);
    });


// subscribe in category
    $scope.subscribe = function () {
        var subscriber_id = $rootScope.cur_user.id
        var subscribed = 1;

        var category_id = $routeParams['category_id'];
        var obj = {subscriber_id, category_id, subscribed}
        console.log(obj);
        categories.subscribe(obj).then(function (data) {
            // localStorage.setItem('status', data);
            // $rootScope.status = localStorage.getItem("status");
            // $location.url('/category/' + category_id);
			$route.reload();
        }, function (err) {
            console.log(err);
        });

    }
//----------------------------------------------------

// unsubscribe in category
    $scope.unsubscribe = function () {
        var subscriber_id = $rootScope.cur_user.id
        var subscribed = 0;

        var category_id = $routeParams['category_id'];
        var obj = {subscriber_id, category_id, subscribed}
        console.log(obj);
        categories.unsubscribe(obj).then(function (data) {
            // $rootScope.status=data;
            // $location.url('/category/' + category_id);
            // console.log("hiii")
			 $route.reload();
        }, function (err) {
            console.log(err);
        });
    }
// untalent in category
    $scope.untalent = function () {
        var talent_id = $rootScope.cur_user.id
        var category_id = $routeParams['category_id'];
        var obj = {talent_id, category_id}
        console.log(obj);
        categories.untalent(obj).then(function (data) {
            // localStorage.setItem('status', data);
            // $rootScope.status = localStorage.getItem("status");
            // $rootScope.status=data;
            // $location.url('/category/' + category_id);
            // console.log("hiii")
			 $route.reload();
        }, function (err) {
            console.log(err);
        });
    }
// unsmentor in category
    $scope.unmentor = function () {
        var mentor_id = $rootScope.cur_user.id
        var category_id = $routeParams['category_id'];
		// mentor.action = "unmentor";
        var obj = {mentor_id, category_id}
        console.log(obj);
        categories.unmentor(obj).then(function (data) {
			 $route.reload();
        }, function (err) {
            console.log(err);
        });
    }


//be teacher in wizIQ
    $scope.add_wiziq_teacher = function () {
        var mentor_id = $rootScope.cur_user.id;
        var teacher_name = $rootScope.cur_user.first_name + $rootScope.cur_user.last_name;
        var teacher_email = $rootScope.cur_user.email;
        console.log("Add Wiziq Teacher");
        videoconference.add_teacher(mentor_id,teacher_email,teacher_name).then(function (data) {

        }, function (err) {
            console.log("Add Wiziq Teacher ERROR section");
            console.log(err);
        });
    }

//--------------------------------------------------------------------

    // $scope.allworkshops = function () {
	//
    //     var user_id = 1;
    //     categories.getCategoryWorkshops($scope.cat_id).then(function (data) {
    //         $rootScope.categoryWorkshops = data;
	//
    //         console.log("all workshops under category", data);
	//
	//
    //     }, function (err) {
    //         console.log(err);
	//
    //     });
    // }

	$scope.newcomment = function(vaild) {
	   if (vaild) {
   var post_id=$routeParams['post_id'];
   		$scope.comment.post_id=post_id
		 var commentdata=$scope.comment
		 console.log("comment data",commentdata);
		 categories.addcomment(commentdata).then(function(data){

		 } , function(err){
		  console.log(err);

		 });

	   }}

	   $scope.comment={}

       $scope.add_comment = function(i) {
		   console.log("hhh",i);
           categories.submitComment($scope.categoryPosts[i].comment,$scope.categoryPosts[i].id).then(function(data){
               console.log("saved success comment",data)
               $route.reload();
           } , function(err){
               console.log(err);

           });
       }

    if(localStorage.getItem("wiziq_presenter_url")){
        $scope.current_presenter_class_url =  localStorage.getItem("wiziq_presenter_url");
    }


});
