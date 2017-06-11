angular.module('myApp').factory("videoconference",function($q,$http,$rootScope,$window){
    var headers = {
        'Access-Control-Allow-Origin' : '*',
        'Access-Control-Allow-Methods' : 'POST, GET, OPTIONS, PUT',
        'Content-Type': 'application/json',
        'Accept': 'application/json'
    };

    return {
        add_teacher:function(mentor_id,teacher_email,teacher_name){
            console.log("in add teacher d5l", mentor_id)
            var def =$q.defer();
            $http({
                // url:$rootScope.CONSTANSTS.baseURL+':'+$rootScope.CONSTANSTS.port+'/api/conference/'+ mentor_id ,
                url:$rootScope.CONSTANSTS.baseURL+':'+$rootScope.CONSTANSTS.port+'/api/categorymentor/get_mentor_details/'+ mentor_id ,
                method:'GET'

            }).then(function(res){
                console.log("get mentor details hereee",res)
                //after success of getting the user details. I need to send the email and name to the WizIQ API to add a new Teacher and get response of Teacher ID
                if(res.data){
                    console.log("after ret in video",res.data.mentor.email)
                    // def.resolve(res.data)
                    $http({
                        url:$rootScope.CONSTANSTS.baseURL+':'+$rootScope.CONSTANSTS.port+'/api/conference/add_teacher' ,
                        method:'POST',
                        data: {"mentor_id":mentor_id,"teacher_email":teacher_email,"teacher_name":teacher_name}
                    }).then(function(res){
                        console.log("Response of ADD Teacher",res)




                        if(res.data['@attributes'].status == "fail"){
                            console.log("Not able to insert with message ",res.data.error['@attributes'].msg)
                            // console.log(res)
                            def.resolve(res.data.error['@attributes'].msg)

                        }else{
                            console.log("Successfully added a new teacher with teacher_id : ",res.data.add_teacher.teacher_id)
                            // console.log(res);
                            //after success of adding a New Teacher and now I have teacher_id, I want to set it in the rootScope to add new class with it
                            //make sure before adding a new class that teacher id in root Scope is not null
                            $rootScope.wiziq_teacher_id = res.data.add_teacher.teacher_id;
                            // $window.localStorage.setItem("wiziq_teacher_id", res.data.add_teacher.teacher_id);
                            // $window.localStorage.setItem("wiziq_teacher_email", res.data.add_teacher.teacher_email);
                            // $window.localStorage.setItem(key,value)
                            def.resolve(res.data.add_teacher.teacher_id)

                        }
                    },function(err){
                        console.log("heloooooeee in video")
                        def.reject(err);
                    })
                }else{
                    def.reject('there is no data ')
                }
            },function(err){
                def.reject(err);
            })
            return def.promise ;
        },



        create_class:function(class_object){
            console.log("class object is ",class_object);
            var def =$q.defer();
            $http({
                url:$rootScope.CONSTANSTS.baseURL+':'+$rootScope.CONSTANSTS.port+'/api/conference/create_class' ,
                method:'POST',
                data:class_object
            }).then(function(res){
                console.log("res from create class",res)

                if(res.data.status == "fail"){
                    console.log("Not able to insert with message ",res.data.errormsg)
                    def.resolve(res.data.errormsg)
                }else{
                    console.log("Successfully added a new class with class_id : ",res.data.class_id)
                    $rootScope.wiziq_class_id = res.data.class_id;
                    console.log(res.data)
                    // $window.localStorage.setItem("wiziq_class_id", res.data.class_id);
                    // $window.localStorage.setItem("wiziq_presenter_url", res.data.presenter_url);
                    // $window.localStorage.setItem("wiziq_class_url", res.data.create.class_details.class_url);
                    def.resolve(res.data.class_id)
                }
            },function(err){
                def.reject(err);
            })
            return def.promise ;
        },



        add_wiziq_attendee_class:function(add_attendee_object){
            console.log("add attendee object is ",add_attendee_object);
            var def =$q.defer();
            $http({
                url:$rootScope.CONSTANSTS.baseURL+':'+$rootScope.CONSTANSTS.port+'/api/conference/add_attendee_to_class' ,
                method:'POST',
                data:add_attendee_object
            }).then(function(res){
                console.log("res from add attendee to class",res)

                if(res.data.status == "fail"){
                    console.log("Not able to add attendee with message ",res.data.errormsg)
                    def.resolve(res.data.errormsg)
                }else{

                    console.log("Successfully attendee attended the class with student_url : ",res.data.attendee_url)

                    var local_storage_key = "attendee_" + add_attendee_object.user_id;
                    var local_storage_value = res.data.attendee_url;

                    // $window.localStorage.setItem(local_storage_key, local_storage_value);

                    def.resolve(res)
                }
            },function(err){
                def.reject(err);
            })
            return def.promise ;
        },

        get_wiziq_data:function(data){
            console.log("from wiziq factory",data);
            var def =$q.defer();
            $http({
                url:$rootScope.CONSTANSTS.baseURL+':'+$rootScope.CONSTANSTS.port+'/api/conference/video_conference_details',
                method:'GET',
            }).then(function(res){
                console.log("res of wiz iq data",res);
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




    }
});
