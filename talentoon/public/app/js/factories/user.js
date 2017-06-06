angular.module('myApp').factory("user", function ($http, $q) {

    return {
        register: function (userdata) {

            //console.log("naaaaahla");
            var def = $q.defer();
            $http({
                url: 'http://localhost:8000/api/signup',
                method: 'POST',
                data: userdata
            }).then(function (res) {
                console.log(res);
                if (res.data) {
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
                url: 'http://localhost:8000/api/login',
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
            });
            return def.promise;
        },

        getAllCountry: function () {
            console.log('nahla  ')
            var def = $q.defer();
            $http({
                url:'http://localhost:8000/api/countries',
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
                url: 'http://localhost:8000/api/userprofile',
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
                url: 'http://localhost:8000/api/userprofile/userposts',
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
        displayShared: function () {

            var def = $q.defer();
            $http({
                url: 'http://localhost:8000/api/userprofile/displayShared',
                method: 'GET'

            }).then(function (res) {
                console.log("shareposts",res);
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
        editprofile: function (id) {
        console.log("in factory to edit profile",id);
        var def = $q.defer();

        $http({
            url: 'http://localhost:8000/api/editprofile/',
            // url:'http://172.16.2.239:8000/api/posts',
            method: 'GET'
            // data: id
        }).then(function (res) {

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
            url: 'http://127.0.0.1:8000/api/checkpassword',
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
            url: 'http://127.0.0.1:8000/api/updateprofile',
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
    }
    };
});
