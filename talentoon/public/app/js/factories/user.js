angular.module('myApp').factory("user", function ($http, $q,$rootScope) {

    return {
        register: function (userdata) {

            //console.log("naaaaahla");
            var def = $q.defer();
            $http({
                url: $rootScope.CONSTANSTS.baseURL+':'+$rootScope.CONSTANSTS.port+'/api/signup',
                method: 'POST',
                data: userdata
            }).then(function (res) {
                console.log("_________ inside register __ ", res.data.user.id);
                if (res.data) {

                    /////////////////////////
                    $http({
                        method: 'POST',
                        url: $rootScope.CONSTANSTS.baseURL+':'+$rootScope.CONSTANSTS.port+'/api/profile_picture_upload/' + res.data.user.id,
                        processData: false,
                        data: {"media_url": "uploads/profile_pic" + $rootScope.profilePictureFile.name, "media_type": $rootScope.profilePictureFile.type},
                        transformRequest: function (data) {
                            var formData = new FormData();
                            formData.append("file", $rootScope.profilePictureFile);
                            return formData;
                        },
                        headers: {
                            'Content-Type': undefined,
                            'Process-Data': false
                        }
                    }).then(function (data) {
                        // alert(data);
                        console.log("thennnnn in add post", data)
                    });

                    //////////////////////////////////////////////


                    def.resolve(res.data)
                } else {
                    def.reject('Couldnot create User')
                }

            }, function (err) {
                // console.log(err);
            });
            return def.promise;
        },

        login: function (userdata) {
            var def = $q.defer();
            $http({
                url: $rootScope.CONSTANSTS.baseURL+':'+$rootScope.CONSTANSTS.port+'/api/login',
                method: 'POST',
                data: userdata

            }).then(function (res) {
                //console.log("userfactory:",res);
                if (res.data) {
                    console.log("from factory",res.data);
                    def.resolve(res.data)
                } else {
                    def.reject('User Couldnot Login');
                }
            }, function (err) {
                console.log(err);

                alert("server connection  error ");
            });
            return def.promise;
        },

        getAllCountry: function () {
            var def = $q.defer();
            $http({
                url:$rootScope.CONSTANSTS.baseURL+':'+$rootScope.CONSTANSTS.port+'/api/countries',
                method: 'GET'

            }).then(function (res) {
                console.log('in factory', res)
                if (res.data.data.length) {
                    console.log("datalength",res.data.data.length);

                    def.resolve(res.data.data)
                } else {
                    def.reject('there is no data ')
                }

                console.log(res);
            }, function (err) {
                // console.log(err);
            });
            return def.promise;
        },
        userprofile: function () {

            var def = $q.defer();
            $http({
                url: $rootScope.CONSTANSTS.baseURL+':'+$rootScope.CONSTANSTS.port+'/api/userprofile',
                method: 'GET'

            }).then(function (res) {
                console.log(res);
                if (res) {
                    // if(res.data.length){
                    def.resolve(res)
                    // def.resolve(res.data)


                } else {
                    def.reject('there is no data ')
                }

            }, function (err) {
                // console.log(err);
                def.reject(err);
            })
            return def.promise;

        },
        userposts: function () {

            var def = $q.defer();
            $http({
                url: $rootScope.CONSTANSTS.baseURL+':'+$rootScope.CONSTANSTS.port+'/api/userprofile/userposts',
                method: 'GET'

            }).then(function (res) {
                console.log("userpost",res);
                if (res) {
                    // if(res.data.length){
                    def.resolve(res)
                    // def.resolve(res.data)


                } else {
                    def.reject('there is no data ')
                }

            }, function (err) {
                // console.log(err);
                def.reject(err);
            })
            return def.promise;

        },
        user: function (user_id) {

            var def = $q.defer();
            $http({
                url: $rootScope.CONSTANSTS.baseURL+':'+$rootScope.CONSTANSTS.port+'/api/userprofile/'+user_id,
                method: 'GET'

            }).then(function (res) {
                console.log("posts",res);
                if (res) {
                    // if(res.data.length){
                    def.resolve(res)
                    // def.resolve(res.data)


                } else {
                    def.reject('there is no data ')
                }

            }, function (err) {
                // console.log(err);
                def.reject(err);
            })
            return def.promise;

        },

        Main_Role: function () {
            var def = $q.defer();
            $http({
                url: $rootScope.CONSTANSTS.baseURL+':'+$rootScope.CONSTANSTS.port+'/api/main_role/',
                method: 'GET'

            }).then(function (res) {
                console.log("posts",res);
                if (res) {
                    // if(res.data.length){
                    def.resolve(res.data)
                    // def.resolve(res.data)


                } else {
                    def.reject('there is no data ')
                }

            }, function (err) {
                // console.log(err);
                def.reject(err);
            })
            return def.promise;

        },

        editprofile: function (id) {
        console.log("in factory to edit profile",id);
        var def = $q.defer();

        $http({
            url: $rootScope.CONSTANSTS.baseURL+':'+$rootScope.CONSTANSTS.port+'/api/editprofile/',
            // url:'http://172.16.2.239:8000/api/posts',
            method: 'GET'
            // data: id
        }).then(function (res) {

            /////////////////////////
            $http({
                method: 'POST',
                url: $rootScope.CONSTANSTS.baseURL+':'+$rootScope.CONSTANSTS.port+'/api/profile_picture_upload/' + res.data.user.id,
                processData: false,
                data: {"media_url": "uploads/profile_pic" + $rootScope.profilePictureFile.name, "media_type": $rootScope.profilePictureFile.type},
                transformRequest: function (data) {
                    var formData = new FormData();
                    formData.append("file", $rootScope.profilePictureFile);
                    return formData;
                },
                headers: {
                    'Content-Type': undefined,
                    'Process-Data': false
                }
            }).then(function (data) {
                // alert(data);
                console.log("thennnnn in add post", data)
            });
            //////////////////////////////////////////////


            console.log('i tested in profile',res.data);

            if (res.data) {
                def.resolve(res.data)
            } else {
                def.reject('there is no data ')
            }

        }, function (err) {
            // console.log(err);
            def.reject(err);
        })
        return def.promise;


    },

        checkpassword:function (userdata) {
        console.log('in factory updated',userdata)
        var def = $q.defer();

        $http({
            url: $rootScope.CONSTANSTS.baseURL+':'+$rootScope.CONSTANSTS.port+'/api/checkpassword',
            method: 'post',
            data: userdata

        }).then(function (res) {
            console.log("b3tna al update ensha2 allah ", res.data)

            if (res) {

                console.log("d5lna gwa al res if", res.data);
                def.resolve(res.data)
            } else {
                def.reject('there is no data ')
            }

        }, function (err) {
            // console.log(err);
            def.reject(err);
        })
        return def.promise;
    },
        updateuser:function (userdata) {
        console.log('in factory updated',userdata)
        var def = $q.defer();

        $http({
            url: $rootScope.CONSTANSTS.baseURL+':'+$rootScope.CONSTANSTS.port+'/api/updateprofile',
            method:'put',
            data: userdata

        }).then(function (res) {
            console.log("b3tna al update ensha2 allah ", res.data)

            if (res) {

                console.log("d5lna gwa al res if", res.data);
                def.resolve(res.data)
            } else {
                def.reject('there is no data ')
            }

        }, function (err) {
            // console.log(err);
            def.reject(err);
        })
        return def.promise;
    },
     follow:function(data){
          console.log("from factory",data);
          var def =$q.defer();
          $http({
            url:$rootScope.CONSTANSTS.baseURL+':'+$rootScope.CONSTANSTS.port+'/api/userprofile/follow',
            method:'POST',
            data:data

          }).then(function(res){
            console.log("res from follow",res);
            if(res.data){
              console.log(res.data);
             def.resolve(res.data);

            }else{
              def.reject('there is no data ')
            }

          },function(err){
            def.reject(err);
          })
          return def.promise ;

      },
      unfollow:function(data){
        console.log("from factory",data);
        var def =$q.defer();
        $http({
          url:$rootScope.CONSTANSTS.baseURL+':'+$rootScope.CONSTANSTS.port+'/api/userprofile/unfollow',
          method:'POST',
          data:data

        }).then(function(res){
          console.log("res from unfollow",res);
          if(res.data){
            console.log(res.data);
           def.resolve(res.data);

          }else{
            def.reject('there is no data ')
          }

        },function(err){
          def.reject(err);
        })
        return def.promise ;

    },
      get_cur_user:function(){
        var def =$q.defer();
        $http({
          url:$rootScope.CONSTANSTS.baseURL+':'+$rootScope.CONSTANSTS.port+'/api/userprofile/cur_user',
          method:'GET',
        }).then(function(res){
          console.log("res from unfollow",res);
          if(res.data){
            console.log(res.data);
           def.resolve(res.data);

          }else{
            def.reject('there is no data ')
          }

        },function(err){
          def.reject(err);
        })
        return def.promise ;

    },

    };
});
