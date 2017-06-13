angular.module('myApp').controller("main", function ($scope,$rootScope, Email,user,categories,$location,$route) {

    var filesuploaded = []

    if (localStorage.getItem("token")) {
        user.get_cur_user().then(function(data){
    		console.log('currrr usssserrrrr',data);
    		$rootScope.cur_user=data.cur_user;
            $rootScope.fname= $rootScope.cur_user.first_name;
            $rootScope.lname=$rootScope.cur_user.last_name;
            var dob=$rootScope.cur_user.date_of_birth;
            $rootScope.cur_user.date_of_birth=new Date(dob);
            $rootScope.country=data.country.country_name;
    	}, function (err) {
            console.log(err);
        });

        user.getAllCountry().then(function (data) {
            //console.log("countries:", data);
            $scope.countries = data;
            console.log("countries", $scope.countries);
        }, function (err) {
            console.log(err);
        });

        user.Main_Role().then(function (data) {
            //console.log("countries:", data);
            $scope.is_mentor = data.role_id;
            console.log("is_mentor", data.role_id);
        }, function (err) {
            console.log(err);
        });
    }

    $rootScope.token = JSON.parse(localStorage.getItem("token"));
	// $rootScope.cur_user = JSON.parse(localStorage.getItem("cur_user"));

    $scope.language=function(lang){
        console.log(lang);
        if (lang == "ar") {
            localStorage.setItem('language', 'ar');
        }else{
            localStorage.setItem('language', 'en');
        }
        window.location.reload();
    }

    $scope.send_complaint=function(valid){
        if (valid) {
            console.log($scope.complaint.text);
            var obj = {text:$scope.complaint.text}
            Email.contact_us(obj).then(function(data){
        		console.log('EMAIL',data);

        	}, function (err) {
                console.log(err);
            });
        }
    }

    categories.getAllCategory().then(function (data) {
        $scope.categories = data.data;
        console.log("categoriesNames array", $scope.categories);
    }, function (err) {
        console.log(err);
        // $location.url('/500');
    });

    $scope.loginFn = function (valid) {
        if (valid) {
            var userdata = $scope.user
            console.log("inside login:", userdata);
            user.login(userdata).then(function (data) {
                console.log("dataaaaa minA",data.user);
                if (data.status == 'ok') {
                    // var myModal = angular.element( document.querySelector( '#login' ) ).modal('toggle');;
                    // myModal.hide();
                    // console.log("MYMODAAAAL",myModal);
                    $rootScope.token=data.token;
                    $rootScope.cur_user=data.user;
                    localStorage.setItem('token', JSON.stringify(data.token));
                    $location.url('/');
                    window.location.reload();
                }


                else{
                    alert('invaled user name or password')
                }
            }, function (err) {
                console.log(err);

                console.log(err.status)


                // alert("server connection error");
            });
        }
    }



    $scope.logoutFn = function () {
            // console.log("inside logout");
            // var auth2 = gapi.auth2.getAuthInstance();
            // auth2.signOut().then(function () {
            //     console.log('User signed out.');
            // });

            localStorage.removeItem('token');
            $rootScope.cur_user={}
            $rootScope.token=''
            $location.url('/');
    }

    $scope.registerFn = function (valid) {
        console.log('inside register fn');
        console.log($scope.user);


        $scope.user.image = $rootScope.profilePictureFile.name;

        console.log("user image is",$scope.user.image);

        if($scope.user.password && $scope.user.password.length>5){
            $scope.pass=true;
        }
        if($scope.user.password==$scope.user.repassword){
            $scope.repass=true;
        }
        if (valid && $scope.repass && $scope.pass) {
            console.log('inside valid');
            var userdata = $scope.user
            console.log("userdata",userdata);
            user.register(userdata).then(function(data){
                console.log("inside controller:",data);
                $location.url('/');
                window.location.reload();
            },function(err){
               console.log(err);
                // $location.url('/500');
            });
        }
    }


    $scope.uploadedFile = function(element) {
        console.log("element is ",element)
        $rootScope.profilePictureFile = element.files[0];
        filesuploaded.push(element.files[0]);
    }

})
