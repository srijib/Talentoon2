angular.module('myApp').controller("oneCategory", function ($location, $scope, $http,Competitions, categories, $routeParams, $rootScope, $timeout, $q, videoconference,$route,workshops) {

console.log('CURRRRRRRRRRRRRRRRRRRRRRRRR',$rootScope.cur_user);
    $rootScope.in_home = false;
    $rootScope.token = JSON.parse(localStorage.getItem("token"));

    $rootScope.wiziq_class_id = JSON.parse(localStorage.getItem("wiziq_class_id"));



    console.log("category controller current user",$rootScope.cur_user);
    console.log("category controller token",$rootScope.token);



    // $rootScope.editable_workshop=JSON.parse(localStorage.getItem("workshop"));;
    // $rootScope.editable_event=JSON.parse(localStorage.getItem("event"));;
    // $rootScope.editable_post=JSON.parse(localStorage.getItem("post"));;


	var filesuploaded = []
	var files_editpost_uploaded = []

    var filesmentoruploaded = []
    var reviewfilesuploaded = []
    var talent = {}
    var mentor = {}

    $scope.cat_id = $routeParams['category_id'];
    $rootScope.workshop_id = $routeParams['workshop_id'];
    $rootScope.event_id = $routeParams['event_id'];


    console.log('category id',$scope.cat_id);
    console.log('workshop id',$rootScope.workshop_id);
    console.log('event id',$rootScope.event_id );


    $scope.post_id = $routeParams['post_id'];


	categories.getUserRoles($scope.cat_id).then(function (data) {
		console.log("ROLESSSSS FROM CONTROLLER", data)
		if(data.is_sub.length){
            $scope.is_subscribed = data.is_sub[0].subscribed;
        }

        if(data.is_talent.length != 0){
            $scope.is_talent = data.is_talent[0].status;
        }

        if(data.is_mentor.length != 0 ){
            $scope.is_mentor = data.is_mentor[0].status;
            console.log('is_mentorrrrr',$scope.is_mentor);
        }
	}, function (err) {
		console.log(err);
	});

	categories.getCategoryAllData($scope.cat_id).then(function (data) {
		console.log('getCategoryAllDataaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa',data);
        $scope.categoryPosts = data.posts;

				console.log("type",$rootScope.type);
		$scope.comments=data.comments
		console.log("commm",$scope.comments);

        $scope.categoryEvents = data.events;
        console.log( data.events,"<<<<events")
        $scope.categoryWorkshops = data.workshops;
        $rootScope.cur_user = data.cur_user;
        $scope.category_details = data.category_details;

		if($scope.categoryPosts.length){
            $scope.category_posts_exists = 1;
        }else{
            $scope.category_posts_exists = 0;
        }
        if($scope.categoryEvents.length){
            $scope.category_events_exists = 1;
        }else{
            $scope.category_events_exists = 0;
        }

        if($scope.categoryWorkshops.length){
            $scope.category_workshops_exists = 1;
        }else{
            $scope.category_workshops_exists = 0;
        }

        if($scope.cur_user){
            $scope.cur_user_exists = 1;
        }else{
            $scope.cur_user_exists = 0;
        }

        if($scope.category_details){
            $scope.category_details_exists = 1;
        }else{
            $scope.category_details_exists = 0;
        }
    }, function (err) {
        console.log(err);
        // $location.url('/500');

    });


    Competitions.getCategoryCompetitions($scope.cat_id).then(function (data) {
		console.log('getCategoryCompetitions',data.data);
        $scope.categoryCompetitions = data.data;
    }, function (err) {
        console.log(err);
        // $location.url('/500');
    });


    // categories.getCategoryWorkshops($scope.cat_id).then(function (data) {
    //     $rootScope.categoryWorkshops = data;
    // }, function (err) {
    //     console.log(err);
    // });
	if ($rootScope.workshop_id) {
		categories.getCategoryWorkshop($rootScope.workshop_id).then(function (data) {
	        console.log("inside controller", data)
	        $rootScope.category_workshop = data.workshop;
	        $rootScope.userId = data.user.id;
	        $rootScope.enroll = data.enroll;
            $rootScope.is_enroll = data.is_enroll;
            console.log("ya 3m",data.is_enroll);

	        $rootScope.media = data.session;
            $rootScope.countcapacity=data.countcapacity.workshop_count;
            console.log("el count capacity",data.countcapacity.workshop_count);

	        // $rootScope.category_post = localStorage.getItem("data");
	        console.log("single workshop from controller", $rootScope.category_workshop);

	    }, function (err) {
	        console.log(err);
            // $location.url('/500');
	    });
	}

    //---------------------- FOR REFRESHING BUG---------------------------------
    if($rootScope.workshop_id){
        categories.getCategoryWorkshopEdit($rootScope.cat_id,$rootScope.workshop_id).then(function (data) {

            console.log('ID,ID',$rootScope.cat_id,$rootScope.workshop_id)

            $rootScope.editable_workshop=data;
            // $rootScope.editable_workshop.time_from =new Date(data.time_from)
            // $rootScope.editable_workshop.time_to =new Date(data.time_to)
            // $rootScope.editable_workshop.date_from = new Date(data.date_from)
            // $rootScope.editable_workshop.date_to = new Date(data.date_to)
            // $rootScope.editable_event.time_from =new Date(data.time_from)
            // $rootScope.editable_event.time_to =new Date(data.time_to)
            var data = localStorage.setItem("workshop", JSON.stringify(data));
            console.log('7asl al edit ya3ni haygeb al data',$rootScope.editable_workshop)

            // $rootScope.category_post = localStorage.getItem("data");
            console.log("single workshop from controller", $rootScope.category_workshop);

        }, function (err) {
            console.log(err);
            // $location.url('/500');
        });
    }


	if($rootScope.event_id){
        categories.getCategoryEventEdit($rootScope.cat_id,$rootScope.event_id).then(function (data) {
            console.log('hna al data',data)
            $rootScope.editable_event=data;
            var store= localStorage.setItem("event", JSON.stringify(data))

            $rootScope.editable_event.time_from = new Time(data.time_from)
            $rootScope.editable_event.time_to = new Time(data.time_to)
            $rootScope.editable_event.date_from = new Date(data.date_from)
            $rootScope.editable_event.date_to = new Date(data.date_to)
            // console.log("single event from controller", $rootScope.category_workshop);

        }, function (err) {
            console.log(err);
            // $location.url('/500');
        });
    }
    if($scope.post_id){
        categories.getCategoryPostEdit($rootScope.cat_id, $scope.post_id).then(function (data) {
            $rootScope.editable_post=data;
            console.log('ID,ID',$rootScope.cat_id,$rootScope.post_id,$rootScope.editable_post)

            console.log('7asl al edit ya3ni haygeb al data',$rootScope.editable_post);
            var store= localStorage.setItem("post", JSON.stringify(data));


        }, function (err) {
            console.log(err);
            // $location.url('/500');
        });
    }

    //------------------------------------------------------------
    // categories.getCategoryPost($scope.workshop_id).then(function (data) {
    //     $rootScope.editable_post=data;
    //     console.log("single post from controller", $rootScope.category_workshop);
    //
    // }, function (err) {
    //     console.log(err);
    // });

    // categories.getCategoryEvents($scope.cat_id).then(function (data) {
    //     $rootScope.events = data;
    //     console.log("EVENTSSSSSS",$rootScope.events);
    // }, function (err) {
    //     console.log(err);
    //
    // });

    $scope.isWorkshopCreator = function (workshop_id) {
    	console.log('hnaaa al id bta3 al workshop',workshop_id);
    	var user_id=$rootScope.cur_user.id;
        //$rootScope.cur_user['id']
        console.log('hnaaa al id bta3 al user workshop',$rootScope.cur_user.id);
        var data_ws={user_id,workshop_id};
        console.log('hnaaa al data workshop',data_ws);
        categories.isWorkshopCreator(data_ws).then(function(data){
			console.log('yess al data waslt',data)
            $rootScope.isCreator=data.creator;
			console.log($rootScope.isCreator)
        } , function(err){
            console.log(err);

        });
    }

    // $scope.editWorkshop=function (workshop_id,cat_id){
    //     console.log('gwa edit al workshop',workshop_id);
    //     var editable={workshop_id,cat_id}
    //     categories.editWorkshop(editable).then(function(data){
    //         $rootScope.editable_workshop=data
    //         var data = localStorage.setItem("workshop", JSON.stringify(data));
    //         console.log('7asl al edit ya3ni haygeb al data',$rootScope.editable_workshop)
    //
    //         $location.url('/category/'+cat_id+'/workshops/'+workshop_id+'/editworkshop')
    //     } , function(err){
    //         console.log(err);
    //         // $location.url('/500');
    //
    //     });
    // }
    $scope.deleteWorkshop=function (workshop_id,cat_id) {
        var editable={workshop_id,cat_id}
        categories.deleteWorkshop(editable).then(function(data){
            $rootScope.workshop_id=data
            console.log('7asl al deleteeeeeee',$rootScope.workshop_id)
            // $location.url('/category/'+cat_id+'/workshops/'+workshop_id+'/editworkshop')
            $location.url('/category/'+$scope.cat_id+'/workshops')
        } , function(err){
            console.log(err);
            // $location.url('/500');

        });
    }
    $scope.saveupdated=function (vaild){

        if (vaild) {
            var category= $scope.cat_id;
            var mentor_id= $rootScope.cur_user.id;
            $rootScope.editable_workshop.category_id=category


            var workshopdata = $rootScope.editable_workshop;
            console.log('in update dataaaaa',workshopdata);
            categories.updatedworkshop(workshopdata).then(function(data){
                console.log('in update al workshop lma da5lt anadi 3la method al factory w geet')
                console.log("the workshop request from server is ",data);
                $location.url('/category/'+category+'/workshops')

            } , function(err){
                console.log(err);
                // $location.url('/500');
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
            // $location.url('/500');

        });


    }

    // $scope.editPost=function (post_id,cat_id){
    //     console.log('gwa edit al post',post_id);
    //     var editable={post_id,cat_id}
    //     categories.editPost(editable).then(function(data){
    //         $rootScope.editable_post=data
    //         console.log('7asl al edit ya3ni haygeb al data',$rootScope.editable_post)
    //         var store= localStorage.setItem("post", JSON.stringify(data));
    //         $location.url('/category/'+cat_id+'/posts/'+post_id+'/editpost')
    //     } , function(err){
    //         console.log(err);
    //         // $location.url('/500');
    //
    //     });
    // }
    $scope.deletePost=function (post_id,cat_id) {
        var editable={post_id,cat_id}
        categories.deletePost(editable).then(function(data){
            $scope.post_id=data
            console.log('7asl al deleteeeeeee',$scope.post_id)
            $location.url('/category/'+$scope.cat_id+'/posts')
            // $location.url('/category/'+cat_id+'/workshops/'+workshop_id+'/editworkshop')
        } , function(err){
            console.log(err);
            // $location.url('/500');

        });
    }
    $scope.saveupdatedpost=function (vaild){

        if (vaild) {
            var category= $scope.cat_id;
            var mentor_id= $rootScope.cur_user.id;
            $rootScope.editable_post.category_id=category


            var postdata = $rootScope.editable_post;
            console.log('in update dataaaaa',postdata);
            categories.updatedpost(postdata).then(function(data){
                console.log('in update al post lma da5lt anadi 3la method al factory w geet')
                console.log("the workshop request from server is ",data);
                $location.url('/category/'+category+'/posts')

            } , function(err){
                console.log(err);
                // $location.url('/500');
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
            // $location.url('/500');

        });


    }

    // $scope.editEvent=function (event_id,cat_id){
    //     console.log('gwa edit al event',event_id);
    //     var editable={event_id,cat_id}
    //     categories.editEvent(editable).then(function(data){
    //
    //         $rootScope.editable_event=data
    //         var store= localStorage.setItem("event", JSON.stringify(data))
    //         $rootScope.editable_event.time_from =new Date(data.time_from)
    //         $rootScope.editable_event.time_to =new Date(data.time_to)
    //         // $scope.editable_event.time_from = new Time(data.time_from)
    //         // $scope.editable_event.time_to = new Time(data.time_to)
    //         $rootScope.editable_event.date_from = new Date(data.date_from)
    //         $rootScope.editable_event.date_to = new Date(data.date_to)
    //
    //         console.log('7asl al edit ya3ni haygeb al data',$rootScope.editable_event)
    //         $location.url('/category/'+cat_id+'/events/'+event_id+'/editevent')
    //
    //     } , function(err){
    //         console.log(err);
    //         // $location.url('/500');
    //
    //     });
    // }
    $scope.deleteEvent=function (event_id,cat_id) {
        var editable={event_id,cat_id}
        categories.deleteEvent(editable).then(function(data){
            $rootScope.event_id=data
            console.log('7asl al deleteeeeeee',$rootScope.event_id)
            $location.url('/category/'+cat_id+'/events')
            // $location.url('/category/'+cat_id+'/workshops/'+workshop_id+'/editworkshop')
        } , function(err){
            console.log(err);
            // $location.url('/500');

        });
    }
    $scope.saveupdatedevent=function (vaild){
        console.log('hhhhhhhhhhhhhhhh')
        if (vaild) {
            var category= $scope.cat_id;
            var mentor_id= $rootScope.cur_user.id;
            console.log('hhhhhhhhhhhhhhhh')
            $rootScope.editable_event.category_id=category


            var eventdata = $rootScope.editable_event;
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
                // $location.url('/500');
            });

        }


    }

    /////////////////////END Event edit delete update///////////////////////////////////

    categories.getMentorsReviews().then(function(data){
        console.log("inside all category posts controller Nadaaaaaaaaaaaaa" , data)
        $scope.allposts_mentorsreviews = data;
    } , function(err){
        console.log(err);
        // $location.url('/500');
    });

    $scope.rev={}

    $scope.add_review = function(i) {

        console.log("ana hena ",$scope.categoryPosts[i]);

        categories.submitMentorReview($scope.categoryPosts[i]).then(function(data){
            console.log("saved success review",data)
            // $location.url('/category/'+$scope.cat_id+'/posts');
            $route.reload();
        } , function(err){
            console.log(err);
            // $location.url('/500');
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

    // categories.getCategoryPosts($scope.cat_id).then(function (data) {
    //     $rootScope.category3Posts = data;
	// 	console.log("user from esraaa to minaaaaaa" , data)
	//
    // }, function (err) {
    //     console.log(err);
	//
    // });

//----------------------------single----post---------------------------------------

	if ($scope.post_id) {
		categories.getCategoryPost($scope.post_id).then(function (data) {
	        // console.log("inside controller ESRAAAAAAAAAAAA" , data.is_liked[0].liked)
            $scope.category_post = data.post;

            if(data.is_liked.length){
                $scope.category_post.is_liked = data.is_liked[0].liked
            }
					  $scope.type=data.post.media_type;
						console.log("type", $rootScope.type)
					// 	if( $rootScope.type =="video/mp4" ||$rootScope.type =="video/Avi"){
					// 		$rootScope.mediaType ="video"
					// 	}
					// 	else if ($rootScope.type="image/jpg"||rootScope.type="image/jpeg"||rootScope.type="image/png") {
	        //  $rootScope.mediaType ="image"
					// 	}
						// video/mp4
	        $scope.category_post_like_count = data.countlike;

	        $scope.comments = data.comments;


	    }, function (err) {
	        console.log(err);
            // $location.url('/500');
	    });
	}




// subscribe in category
    $scope.subscribe = function () {
        var subscriber_id = $rootScope.cur_user.id
        var subscribed = 1;

        var category_id = $scope.cat_id ;
        var obj = {subscriber_id, category_id, subscribed}
        console.log(obj);
        categories.subscribe(obj).then(function (data) {
            // localStorage.setItem('status', data);
            // $rootScope.status = localStorage.getItem("status");
            // $location.url('/category/' + category_id);
			$route.reload();
        }, function (err) {
            console.log(err);
            // $location.url('/500');
        });

    }
//----------------------------------------------------

// unsubscribe in category
    $scope.unsubscribe = function () {
        var subscriber_id = $rootScope.cur_user.id
        var subscribed = 0;

        var category_id = $scope.cat_id;
        var obj = {subscriber_id, category_id, subscribed}
        console.log(obj);
        categories.unsubscribe(obj).then(function (data) {
            // $rootScope.status=data;
            // $location.url('/category/' + category_id);
            // console.log("hiii")
			 $route.reload();
        }, function (err) {
            console.log(err);
            // $location.url('/500');
        });
    }
// untalent in category
    $scope.untalent = function () {
        var talent_id = $rootScope.cur_user.id
        var category_id = $scope.cat_id;
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
            // $location.url('/500');
        });
    }
// unsmentor in category
    $scope.unmentor = function () {
        var mentor_id = $rootScope.cur_user.id
        var category_id = $scope.cat_id;
		// mentor.action = "unmentor";
        var obj = {mentor_id, category_id}
        console.log(obj);
        categories.unmentor(obj).then(function (data) {
			 $route.reload();
        }, function (err) {
            console.log(err);
            // $location.url('/500');
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
            // console.log(err);
            // $location.url('/500');

        });
    }

//--------------------------------------------------------------------

    // $scope.allworkshops = function () {
	//
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
   var post_id= $rootScope.post_id;
   		$scope.comment.post_id=post_id
		 var commentdata=$scope.comment
		 console.log("comment data",commentdata);
		 categories.addcomment(commentdata).then(function(data){
             console.log("hhhhhh",data);
             $scope.comments=data.comments;

		 } , function(err){
		  console.log(err);
		  // $location.url('/500');
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
               // $location.url('/500');
           });
       }



    $scope.uploadedFile = function(element) {
        console.log("element is ",element)
        $rootScope.current_edit_post_file = element.files[0];

        $scope.files_editpost_uploaded.push(element.files[0]);
        $(element).parent().parent().parent().find('.form-control').val($(element).val().replace(/C:\\fakepath\\/i, ''));
    }









    // if(localStorage.getItem("wiziq_presenter_url")){
    //     $scope.current_presenter_class_url =  localStorage.getItem("wiziq_presenter_url");
    // }
    //
    // if(localStorage.getItem("attendee_"+$rootScope.cur_user.id)){
    //     $scope.current_student_join_class_url =  localStorage.getItem("attendee_"+$rootScope.cur_user.id);
    // }


});
