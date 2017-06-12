angular.module('myApp').controller("categories",function($location,$scope,$http,user,categories,$routeParams,$rootScope,$timeout,$q){

    // $rootScope.token = JSON.parse(localStorage.getItem("token"));
    // $rootScope.cur_user = JSON.parse(localStorage.getItem("cur_user"));
    console.log("category controller current user", $rootScope.cur_user);

    var filesuploaded = []
    var filesmecategoriesntoruploaded = []
    var reviewfilesuploaded = []
    var talent = {}
    var mentor = {}

	$scope.cat_id= $routeParams['category_id'];


    categories.getAllCategory().then(function (data) {
        $scope.categories = data.data;
        console.log("categories array", $scope.categories);
        $scope.category_exist = 1
    }, function (err) {
        $scope.category_exist = 0
        console.log(err);
        // $location.url('/500');
    });
});
