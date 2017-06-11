angular.module('myApp').controller("workshop", function ($route,$scope, $http, workshops, $routeParams,$location,$rootScope,videoconference,categories,$window,$timeout) {

	// $rootScope.cur_user = JSON.parse(localStorage.getItem("cur_user"));
	$rootScope.wiziq_class_id = JSON.parse(localStorage.getItem("wiziq_class_id"));

    $scope.session={}

	var class_id = $rootScope.wiziq_class_id
	var user_id = $rootScope.cur_user.id;
	var name = $rootScope.cur_user.first_name;


    videoconference.get_wiziq_data().then(function(data){
    	console.log("respoon wiziq",data)
        $window.localStorage.setItem("wiziq_teacher_id" ,data.data[0].wiziq_teacher_id);
        $window.localStorage.setItem("wiziq_teacher_email", data.data[0].wiziq_teacher_email);

        $window.localStorage.setItem("wiziq_class_id", data.data[0].wiziq_class_id);
        $window.localStorage.setItem("wiziq_presenter_url", data.data[0].wiziq_presenter_url);


        $rootScope.current_presenter_class_url = data.data[0].wiziq_presenter_url;

        console.log("presenter url is >>>> ",data.data[0].wiziq_presenter_url)


        //need loop
        if(data.data.length>0){
            for(i=0;i<data.data.length;i++){
                if($rootScope.cur_user.id == data.data[i].wiziq_attendee_id){
                    $rootScope.current_student_join_class_url =  data.data[i].wiziq_attendee_url;
                }
                $window.localStorage.setItem("attendee_" + data.data[i].wiziq_attendee_id, data.data[i].wiziq_attendee_url);
            }
        }

        // if(localStorage.getItem("wiziq_presenter_url")){
        //     $scope.current_presenter_class_url =  localStorage.getItem("wiziq_presenter_url");
        // }
        //
        // if(localStorage.getItem("attendee_"+$rootScope.cur_user.id)){
        //     $scope.current_student_join_class_url =  localStorage.getItem("attendee_"+$rootScope.cur_user.id);
        // }


    }, function (err) {
        console.log(err);
    });



	$scope.cat_id = $routeParams['category_id'];

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
        }
	}, function (err) {
		console.log(err);
	});

	$scope.workshop_enroll = function(workshop_id,userId) {

		var obj={userId,workshop_id}
		console.log("objjjjjjjjjjjjjjjjjjjjjjj",obj);



        //i need to enroll the student to be attendee in class
        var attendee_obj = {class_id,user_id,name}
        videoconference.add_wiziq_attendee_class(attendee_obj).then(function(data){
            console.log(data)
        } , function(err){
            console.log(err)
        });
        //i need to enroll the student to be attendee in class



        workshops.workshop_enroll(obj).then(function(data){
			console.log("dataaaaaaaaaaaa",data);
			$route.reload();
		} , function(err){
			console.log(err);

		});
	}

});
