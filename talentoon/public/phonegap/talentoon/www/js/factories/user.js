angular.module('talentoon').factory("user", function ($http, $q,$rootScope) {

    return {
        register: function (userdata) {

            //console.log("naaaaahla");
            var def = $q.defer();
            $http({
                url: $rootScope.CONSTANSTS.baseURL+':'+$rootScope.CONSTANSTS.port+'/api/signup',
                headers:{
              'Authorization':'Bearer: '+ $rootScope.token
                 },
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
            console.log(userdata);
            var def = $q.defer();
            $http({
                url: $rootScope.CONSTANSTS.baseURL+':'+$rootScope.CONSTANSTS.port+'/api/login',
                headers:{
              'Authorization':'Bearer: '+ $rootScope.token
                 },
                method: 'POST',
                data: userdata

            }).then(function (res) {
                //console.log("userfactory:",res);
                if (res.data) {
                    console.log("from factory",res.data);
                    if(res.data.status=='wrong'){
                        alert('invalid user name or password')
                    }else {
                        def.resolve(res.data)
                    }

                } else {
                    def.reject('User Couldnot Login');
                }
            }, function (err) {
                console.log(err);
                // alert("server error")
            });
            return def.promise;
        },

        getAllCountry: function () {
            console.log('nahla  ')
            var def = $q.defer();
            $http({
                url:$rootScope.CONSTANSTS.baseURL+':'+$rootScope.CONSTANSTS.port+'/api/countries',
                headers:{
              'Authorization':'Bearer: '+ $rootScope.token
                 },
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

                headers:{
              'Authorization':'Bearer: ' + $rootScope.token
                 },
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
                headers:{
              'Authorization':'Bearer: ' + $rootScope.token
                 },
                method: 'GET'

            }).then(function (res) {
                console.log("userpost in factory",res.data);
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


    };
});
