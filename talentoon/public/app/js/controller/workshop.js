angular.module('myApp').controller("workshop", function ($route,$scope, $http, workshops, $routeParams,$location,$rootScope,videoconference) {

    	$rootScope.cur_user = JSON.parse(localStorage.getItem("cur_user"));
    	$rootScope.wiziq_class_id = JSON.parse(localStorage.getItem("wiziq_class_id"));


    	var class_id = $rootScope.wiziq_class_id
	    var user_id = $rootScope.cur_user.id;
    	var name = $rootScope.cur_user.first_name;




    $scope.workshop_enroll = function(workshop_id,userId) {

    	console.log("inside enroll into workshop")

			//I will get The user id and name from the local storage please tell Bassant and Mina

			var workshop_id=workshop_id;
			var user_id=userId;
			console.log(user_id);

			console.log(user_id);
			var obj={user_id,workshop_id}

			console.log("object of workshop enroll parameter",obj);
			workshops.workshop_enroll(obj).then(function(data){
				console.log("After Workshop enroll",data);


				//i need to enroll the student to be attendee in class
				var attendee_obj = {class_id,user_id,name}
				videoconference.add_wiziq_attendee_class(attendee_obj).then(function(data){

					console.log(data)

				} , function(err){

					console.log(err)

				});
				//i need to enroll the student to be attendee in class



				// $route.reload();

			} , function(err){
				console.log(err);

			});

			}







});
