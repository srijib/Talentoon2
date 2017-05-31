angular.module('myApp').controller("addevents",function($scope,$http,categories,$routeParams){
  $scope.newevent = function(vaild) {
     if (vaild) {
       var category= $routeParams['category_id'];
       var user_id= 1;
       var eventdata = $scope.event
       $scope.event.category_id=category
        $scope.event.user_id=user_id
       console.log(eventdata);
       categories.addevent(eventdata).then(function(data){
//when data retrive from server
       } , function(err){
       	console.log(err);

       });

     }

   }
	});
