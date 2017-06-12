angular.module('myApp').controller("addsession",function($scope,$http,workshops,$routeParams,$location,$rootScope,user){
    var filesuploaded = []


    $scope.newsession = function(vaild) {
     if (vaild) {
       var workshop= $routeParams['workshop_id'];
       var category= $routeParams['category_id'];
       var sessiondata={}
       sessiondata = $scope.session;
       console.log("session",sessiondata);
       $scope.session.workshop_id=workshop

       console.log("for mina post daa",sessiondata);
         //here upload
         //end here upload
       workshops.addsession(sessiondata).then(function(data){

           console.log("the workshop request from server is ",data);
//when data retrived from server
           $location.url('/category/'+category+'/workshops/'+workshop);
       } , function(err){
       	console.log(err);
       // $location.url('/500');
       });

     }}

     $scope.uploadedFile = function(element) {
         console.log("element is ",element)
         $rootScope.sessionFile = element.files[0];
         filesuploaded.push(element.files[0]);
         console.log("current file is ",$rootScope.sessionFile)
         var reader = new FileReader();

         reader.onload = function(event) {
             $scope.session_source = event.target.result
             $scope.$apply(function($scope) {
            $scope.files = element.files;
             });
         }
         reader.readAsDataURL(element.files[0]);
}

});//end of module
