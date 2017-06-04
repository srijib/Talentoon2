angular.module('talentoon').controller("addpost",function($state,$scope,$http,categories,$stateParams,$location,$rootScope){
    var filesuploaded = []
$scope.post={}
  $scope.newpost = function(vaild) {
     if (vaild) {
       var category= $stateParams['category_id'];
      //  var user_id= 1;
      console.log("category ",category)

       var postdata = $scope.post;

         console.log("post data ",postdata)
      //  $scope.post.category_id=category
        // $scope.post.user_id=user_id
       console.log("cat_id",$rootScope.cat_id);
var title= $scope.post.title
var description=$scope.post.description
var category_id=$rootScope.cat_id
         //here upload

         //end here upload
var data={title,description,category_id}
    console.log(data)
       categories.addpost(data).then(function(data){

           console.log("the post request from server is ",data);
//when data retrived from server
          //  $location.url('/category/'+$scope.post.category_id);
          $state.go('app.categories')
       } , function(err){
       	console.log(err);

       });

     }

   }

   $scope.uploadedFile = function(element) {
       console.log("element is ",element)
       $rootScope.currentFile = element.files[0];
       filesuploaded.push(element.files[0]);}});

  //  ,
  //     $scope.submit_post_file= function() {
  //         // $scope.form.image = filesuploaded;
  //         console.log("inside submit scope " ,filesuploaded)
   //
  //         $http({
  //             method  : 'POST',
  //             url     : 'http://localhost:8000/api/test',
  //             processData: false,
  //             transformRequest: function (data) {
  //                 var formData = new FormData();
   //
  //                 for(var i =0;i< filesuploaded.length;i++){
  //                     formData.append("file[]", filesuploaded[i]);
  //                     console.log("file in loop",filesuploaded[i])
  //                 }
  //                 return formData;
  //             },
  //             data : filesuploaded,
  //             headers: {
  //                 'Content-Type': undefined,
  //                 'Process-Data':false
  //             }
  //         }).then(function(data){
  //             // alert(data);
  //             console.log("thennnnn in add post",data)
  //         });
   //
  //     }
  //     ,







          // console.log("current file is ",$rootScope.currentFile)
          // var reader = new FileReader();
          //
          // reader.onload = function(event) {
          //     $scope.image_source = event.target.result
          //     $scope.$apply(function($scope) {
          //         $scope.files = element.files;
          //     });
          // }
          // reader.readAsDataURL(element.files[0]);
