angular.module('myApp').controller("workshop", function ($scope, $http, workshops, $routeParams,$location,$rootScope) {

$scope.workshop_enroll = function(workshop_id,userId) {
var workshop_id=workshop_id;
var user_id=userId;
console.log(user_id);

console.log(user_id);
var obj={user_id,workshop_id}
console.log("objjjjjjjjjjjjjjjjjjjjjjj",obj);
		workshops.workshop_enroll(obj).then(function(data){
			console.log("dataaaaaaaaaaaa",data);

		} , function(err){
			console.log(err);

		});

}







});
