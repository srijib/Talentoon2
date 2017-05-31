angular.module('myApp').controller("addworkshop",function($scope,$http,categories,$routeParams,$location,$rootScope){


  $scope.newworkshop = function(vaild) {
     if (vaild) {
       var category= $routeParams['category_id'];
       var mentor_id= 1;
       $scope.workshop.category_id=category
       $scope.workshop.mentor_id=mentor_id
       $scope.workshop.is_approved=0
    //    $scope.workshop.media_url="image"
    //    $scope.workshop.media_type="image"

        var workshopdata = $scope.workshop;

       categories.addworkshop(workshopdata).then(function(data){

           console.log("the workshop request from server is ",data);
//when data retrived from server
//            $location.url('/category/'+$scope.post.category_id);
       } , function(err){
       	console.log(err);

       });

     }

 },
 $scope.uploadedFile = function(element) {
     console.log("element is ",element)
     $rootScope.workshopFile = element.files[0];
     //filesuploaded.push(element.files[0]);






     console.log("current file is ",$rootScope.workshopFile)
     var reader = new FileReader();

     reader.onload = function(event) {
         $scope.image_source = event.target.result
         $scope.$apply(function($scope) {
             $scope.files = element.files;
         });
     }
     reader.readAsDataURL(element.files[0]);
 }


});
