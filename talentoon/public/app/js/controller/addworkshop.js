angular.module('myApp').controller("addworkshop",function($scope,$http,categories,$routeParams,$location,$rootScope,user){


    $scope.newworkshop = function(vaild) {
      var today = new Date();
      console.log("Today is ", today)

     if (vaild) {

         if (Date.parse($scope.workshop.date_to) < Date.parse($scope.workshop.date_from)){
             $scope.End_Start_Date_validation = false;
         }
         else if(today > Date.parse($scope.workshop.date_from)){
             $scope.Start_Today_Date_validation = false;
         }
         else {
             var category = $routeParams['category_id'];
             var mentor_id = $rootScope.cur_user.id;
             $scope.workshop.category_id = category
             $scope.workshop.mentor_id = mentor_id
             $scope.workshop.is_approved = 0
             //    $scope.workshop.media_url="image"
             //    $scope.workshop.media_type="image"

             var workshopdata = $scope.workshop;
             console.log('in neworkshop');
             categories.addworkshop(workshopdata).then(function (data) {
                 console.log('in neworkshop lma da5lt anadi 3la method al factory w geet')
                 console.log("the workshop request from server is ", data);
                 $scope.workshop_created = true;
//when data retrived from server
//            $location.url('/category/'+$scope.post.category_id);
             }, function (err) {
                 console.log(err);
                 $scope.workshop_created = false;
                 // $location.url('/500');

             });
         }
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


    if(localStorage.getItem("wiziq_presenter_url")){
        $scope.current_presenter_class_url =  localStorage.getItem("wiziq_presenter_url");
    }




});
