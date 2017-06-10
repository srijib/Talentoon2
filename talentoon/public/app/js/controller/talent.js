angular.module('myApp').controller("talents",function($scope,$http,categories,$routeParams,$rootScope,$timeout){
	// $rootScope.cur_user = JSON.parse(localStorage.getItem("cur_user"));

  var reviewfilesuploaded = []
	var reviewfilesuploaded_names = []
  var talent = {}


	$scope.completeTalentProfile = function(valid){

	if (reviewfilesuploaded.length > 0)
	{
		talent.talent_id = $rootScope.cur_user.id;
		talent.category_id = $routeParams['category_id'];
		talent.from_when = $scope.talent.from_when;
		talent.description = $scope.talent.description;
		talent.files_of_initial_review = reviewfilesuploaded;

		console.log("Talent Object is ", talent);

		categories.complete_talent_profile(talent).then(function (data) {
			console.log("inside category talent profile",data.id)
			category_talent_id = data.id;
			console.log("get the id from here", category_talent_id)


			categories.insert_media_reviews_uploads(reviewfilesuploaded, category_talent_id).then(function () {

				console.log("in then ")
			}, function (error) {
				console.log(error)
			});


		}, function (err) {
			console.log(err)
		});


	} else {
		alert("sorry files is required")
	}
}
	$scope.uploadedFile = function (element) {
        console.log("element is ", element)
        $scope.currentFile = element.files[0];

        filesuploaded.push(element.files[0])

        var reader = new FileReader();

        reader.onload = function (event) {
            $scope.image_source = event.target.result
            $scope.$apply(function ($scope) {
                $scope.files = element.files;
            });
        }
        reader.readAsDataURL(element.files[0]);
    }



    $scope.uploadedReviewFile = function (element) {
        reviewfilesuploaded.push(element.files[0])
        reviewfilesuploaded_names.push(element.files[0].name)
		console.log(reviewfilesuploaded)
        console.log(reviewfilesuploaded_names)
		$rootScope.files_in_form = reviewfilesuploaded_names;


    }

})
