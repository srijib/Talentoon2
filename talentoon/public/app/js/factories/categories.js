angular.module('myApp').factory("categories", function ($q, $http, $rootScope) {
    return {
        getAllCategory: function () {

            var def = $q.defer();
            $http({
                url: 'http://localhost:8000/api/category',
                // url:'json/categories.json',
                method: 'GET'

            }).then(function (res) {
                console.log(res.data);
                if (res.data) {
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
        getCategoryAllData:function(cat_id){
            var def =$q.defer();
            $http({
                url:'http://localhost:8000/api/category/'+cat_id,
                method:'GET'
            }).then(function(res){
                // 		console.log("response is" , res);
                if(res.data){
                    def.resolve(res.data);
                }else{
                    def.reject('there is no data ')
                }

            },function(err){
                def.reject(err);
            })
            return def.promise ;

        },
        getUserRoles:function(cat_id){
            var def =$q.defer();
            $http({
                url:'http://localhost:8000/api/category/'+cat_id+'/roles',
                method:'GET'
            }).then(function(res){
                		// console.log("ROLESSSSS FROM FACTORY" , res);
                if(res.data){
                    def.resolve(res.data);
                }else{
                    def.reject('there is no data ')
                }

            },function(err){
                def.reject(err);
            })
            return def.promise ;

        },
        // getCategoryPosts:function(cat_id){
        //     // console.log('factory cat cat_id',cat_id);
        // 			var def =$q.defer();
        // 			$http({
        // 				url:'http://localhost:8000/api/category/'+cat_id ,
        // 				method:'GET'
        // 			}).then(function(res){
        // 				console.log("response is 3abet" , res);
        // 				if(res.data.posts.length){
        // 		     			def.resolve(res.data.posts);
        // 				}else{
        // 					def.reject('there is no data ')
        // 				}
        //
        // 			},function(err){
        // 				def.reject(err);
        // 			})
        // 			return def.promise ;
        //
        // 		},

        // *************************
        getCategoryEventEdit:function(cat_id,event_id){
        			var def =$q.defer();
        			$http({
        				url:'http://localhost:8000/api/categories/'+cat_id+'/events/'+event_id ,
        				method:'GET'
        			}).then(function(res){
        				console.log("<<<<<<<<<event in factory>>>>>>>>>" , res.data.event[0]);
        				if(res.data){
                            var data = localStorage.setItem("event", JSON.stringify(res.data.event[0]));
        		     			def.resolve(res.data.event[0]);

        				}else{
        					def.reject('there is no data ')
        				}

        			},function(err){
        				def.reject(err);
        			})
        			return def.promise ;

        		},
        // /*********************************

        // getCategoryEvents:function(cat_id){
        // 			var def =$q.defer();
        // 			$http({
        // 				url:'http://localhost:8000/api/categories/'+cat_id+'/events' ,
        // 				method:'GET'
        // 			}).then(function(res){
        // 				console.log("all events in factory " , res.data);
        // 				if(res.data.data.length){
        // 		     			def.resolve(res.data.data);
        //
        // 				}else{
        // 					def.reject('there is no data ')
        // 				}
        //
        // 			},function(err){
        // 				def.reject(err);
        // 			})
        // 			return def.promise ;
        //
        // 		},
        //
        getCategoryPostEdit: function (cat_id,id) {
            console.log("post id", id)
            var def = $q.defer();
            $http({
                url: 'http://localhost:8000/api/categories/'+cat_id+'/posts/'+id,
                method: 'GET',

            }).then(function (res) {
                // console.log("single post from factory",res.data.post)
                console.log("<<<<<<<<<<<<single post from factory>>>>>>>>>>", res.data.post[0])

                if (res) {
                    var data = localStorage.setItem("post", JSON.stringify(res.data.post[0]));
                    // def.resolve(res.data.post);
                    def.resolve(res.data.post[0]);


                } else {
                    def.reject('there is no data ')
                }

            }, function (err) {
                def.reject(err);
            })
            return def.promise;

        },
        getCategoryPost: function (id) {
            console.log("post id", id)
            var def = $q.defer();
            $http({
                url: 'http://localhost:8000/api/post/' + id,
                method: 'GET',
                data: id
            }).then(function (res) {
                // console.log("single post from factory",res.data.post)
                console.log("single post from factory", res.data)

                if (res) {
                    var data = localStorage.setItem("data", JSON.stringify(res.data.post));
                    // def.resolve(res.data.post);
                    def.resolve(res.data);


                } else {
                    def.reject('there is no data ')
                }

            }, function (err) {
                def.reject(err);
            })
            return def.promise;

        },

        subscribe: function (data) {
            // console.log("from factories CAT ID",category_id);
            // console.log("from factories subscriber_id",subscriber_id);
            // console.log("from factories STATUS =",subscribed);

            var def = $q.defer();

            $http({

                url: 'http://localhost:8000/api/categorysubscribe',
                method: 'POST',
                data: data

            }).then(function (res) {
                console.log("res from subscribe", res);
                if (res.data.status) {
                    console.log(res.data.status);
                    def.resolve(res.data.status);

                } else {
                    def.reject('there is no data ')
                }

            }, function (err) {
                def.reject(err);
            })
            return def.promise;

        },
        unsubscribe: function (data) {
            // console.log("from factories",index,user_id,status);
            console.log(data);
            var def = $q.defer();

            $http({
                url: 'http://localhost:8000/api/categoryunsubscribe',
                method: 'POST',
                data: data

            }).then(function (res) {
                console.log(res);
                console.log(res.data.status);

                console.log(res.data.status);
                def.resolve(res.data.status);


            }, function (err) {
                def.reject(err);
            })
            return def.promise;

        },
        untalent: function (data) {
            // console.log("from factories",index,user_id,status);
            console.log(data);
            var def = $q.defer();

            $http({
                url: 'http://localhost:8000/api/categoryuntalent',
                method: 'POST',
                data: data

            }).then(function (res) {
                console.log(res);
                console.log(res.data.status);

                console.log(res.data.status);
                def.resolve(res.data.status);

            }, function (err) {
                def.reject(err);
            })
            return def.promise;

        },

        addpost: function (postdata) {
            console.log("Post Dataaaa",postdata);
            var def = $q.defer();
            // console.log('the url ya esraa', 'http://172.16.2.239:8000/api/categories/'+postdata.category_id+'/posts');
            $http({
                url: 'http://localhost:8000/api/categories/' + postdata.category_id + '/posts',
                // url:'http://172.16.2.239:8000/api/posts',
                method: 'POST',
                data: postdata
            }).then(function (res) {

                console.log("____________in res add post ", res.data.post_id) 
                console.log("____________media type ", $rootScope.currentFile.type)
                console.log('_________', $rootScope.currentFile.name)


                /////////////////////////
                $http({
                    method: 'POST',
                    url: 'http://localhost:8000/api/single_upload/' + res.data.post_id,
                    processData: false,
                    data: {"media_url": "uploads/files" + $rootScope.currentFile.name, "media_type": $rootScope.currentFile.type},
                    transformRequest: function (data) {
                        var formData = new FormData();
                        formData.append("file", $rootScope.currentFile);
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

        insert_media_reviews_uploads: function (reviewfilesuploaded, category_talent_id) {
            var def = $q.defer();
            $http({
                method: 'POST',
                url: 'http://localhost:8000/api/review_files_upload/' + category_talent_id,
                processData: false,
                data: reviewfilesuploaded,
                transformRequest: function (data) {
                    var formData = new FormData();
                    for (var i = 0; i < reviewfilesuploaded.length; i++) {
                        formData.append("file[]", reviewfilesuploaded[i]);
                        //console.log("file in loop",reviewfilesuploaded[i])
                    }
                    console.log("form data", formData);
                    return formData;
                },
                headers: {
                    'Content-Type': undefined,
                    'Process-Data': false
                }
            }).then(function (res) {
              console.log("upload filessss",res);
                def.resolve(res.data)
                // if(res.data){
                //     def.resolve(res.data)
                // }else{
                //     def.reject('there is no data ')
                // }

            }, function (err) {
                // console.log(err);
                def.reject(err);
            })
            return def.promise;




            // /////////////////////////
            // $http({
            // 	method  : 'POST',
            // 	url     : 'http://localhost:8000/api/review_files_upload/'+category_talent_id,
            // 	processData: false,
            // 	data:reviewfilesuploaded,
            // 	transformRequest: function (data) {
            // 		var formData = new FormData();
            // 		for(var i =0;i< reviewfilesuploaded.length;i++){
            // 			formData.append("file[]", reviewfilesuploaded[i]);
            // 			//console.log("file in loop",reviewfilesuploaded[i])
            // 		}
            // 		// console.log("form data",formData)
            // 		return formData;
            // 	},
            // 	headers: {
            // 		'Content-Type': undefined,
            // 		'Process-Data':false
            // 	}
            // }).then(function(data){
            // 	alert(data);
            // 	console.log("then NNN in add review",data)
            // });

            //////////////////////////////////////////////
        },


        addworkshop:function(workshopdata){
            console.log('in factory addworkshop')
            console.log(workshopdata);
            console.log(workshopdata.category_id);
            var def =$q.defer();
            $http({

                url:'http://localhost:8000/api/categories/'+workshopdata.category_id+'/workshops' ,
                method:'POST',
                data:workshopdata

            }).then(function(res){
                console.log('in add workshop w 7salaha success')
                console.log("workshop",res);
                $http({
                    method: 'POST',
                    url: 'http://localhost:8000/api/workshop_upload/' + res.data.workshop_id,
                    processData: false,
                    data: {"media_url": "uploads/files" + $rootScope.workshopFile.name, "media_type": $rootScope.workshopFile.type},
                    transformRequest: function (data) {
                        var formData = new FormData();
                        formData.append("file", $rootScope.workshopFile);
                        return formData;
                    },
                    headers: {
                        'Content-Type': undefined,
                        'Process-Data': false
                    }
                }).then(function (data) {
                    // alert(data);
                    console.log('in factory w ba3t al media')
                    console.log("thennnnn in add post", data)
                });

                //////////////////////////////////////////////
                console.log(res);
                console.log("length: ",res.data.length);
                if(res.data){

                    def.resolve(res.data)
                }else{
                    console.log('w 7sal al error')
                    def.reject('there is no data ')
                }

            },function(err){
                // console.log(err);
                def.reject(err);
            })
            return def.promise ;

        },

        // addevent: function (eventdata) {
        //     var def = $q.defer();
        //     $http({
        //         url: 'addevent url',
        //         method: 'GET',
        //         data: eventdata
        //
        //     }).then(function (res) {
        //
        //         if (res.data.length) {
        //             def.resolve(res.data)
        //         } else {
        //             def.reject('there is no data ')
        //         }
        //
        //     }, function (err) {
        //         // console.log(err);
        //         def.reject(err);
        //     })
        //     return def.promise;
        //
        // },
        complete_talent_profile: function (talent_data) {

            var def = $q.defer();
            $http({
                url: 'http://127.0.0.1:8000/api/categorytalent/store',
                method: 'POST',
                data: talent_data

            }).then(function (res) {
                // console.log("res is find the id now please hhhhhhhh ", res)

                console.log("res is find the id now please ", res.data.id)

                if (res) {
                    $rootScope.category_talent_id = res.data.id;
                    console.log("7777777777777", $rootScope.category_talent_id);
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
        ,
        complete_mentor_profile: function (mentor_data) {

            var def = $q.defer();
            $http({
                url: 'http://127.0.0.1:8000/api/categorymentor/store',
                method: 'POST',
                data: mentor_data

            }).then(function (res) {

                if (res.data) {
                    console.log(res.data);
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
        ,
        unmentor: function (mentor_data) {
            var def = $q.defer();

            $http({
                url: 'http://127.0.0.1:8000/api/categorymentor/update',
                method: 'POST',
                data: mentor_data

            }).then(function (res) {
                console.log("i am in unmentor", res.data);
                if (res.data) {
                    console.log(res.data);
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
        // getCategoryWorkshops:function(index){
        //
        // 	var def =$q.defer();
        // 	$http({
        // 		url:'http://localhost:8000/api/category/'+index ,
        // 		method:'GET'
        // 	}).then(function(res){
        //         console.log("workshops_bassant",res);
        // 		console.log("response is " , res.data.workshops);
        // 		if(res.data.workshops){
        //      			def.resolve(res.data.workshops);
        // 		}else{
        // 			def.reject('there is no data ')
        // 		}
        //
        // 	},function(err){
        // 		def.reject(err);
        // 	})
        // 	return def.promise ;
        //
        // },
        getCategoryWorkshopEdit: function (cat_id,id) {
            //  var category_id= index;
            // // console.log("category_id",category_id)
            // console.log("workshop id", id)
            var def = $q.defer();
            $http({
                url: 'http://localhost:8000/api/categories/'+cat_id+'/workshops/'+id,
                method: 'GET',

            }).then(function (res) {
                console.log("<<<<<<<<single workshop from factory>>>>>>>>",res.data.workshop)
                // console.log("user",res.data.user);
                // console.log("enroll",res.data.enroll);
                // console.log("single category from factory", res.data.workshop)

                if (res.data) {
                    var data = localStorage.setItem("workshop", JSON.stringify(res.data.workshop));
                    def.resolve(res.data.workshop);

                } else {
                    def.reject('there is no data ')
                }

            }, function (err) {
                def.reject(err);
            })
            return def.promise;

        },
        getCategoryWorkshop: function (id) {
            //  var category_id= index;
            // // console.log("category_id",category_id)
            // console.log("workshop id", id)
            var def = $q.defer();
            $http({
                url: 'http://localhost:8000/api/workshop/'+id,
                method: 'GET',
                data: id
            }).then(function (res) {
                console.log("single workshop from factory",res.data)
                // console.log("user",res.data.user);
                // console.log("enroll",res.data.enroll);
                // console.log("single category from factory", res.data.workshop)

                if (res) {
                    var data = localStorage.setItem("workshop_data", JSON.stringify(res.data.workshop));
                    def.resolve(res.data);

                } else {
                    def.reject('there is no data ')
                }

            }, function (err) {
                def.reject(err);
            })
            return def.promise;

        },

        isWorkshopCreator: function (data) {
            //  var category_id= index;
            // // console.log("category_id",category_id)
            // console.log("workshop id", id)
            var def = $q.defer();
            console.log("data",data)
            $http({
                url: 'http://localhost:8000/api/isWorkshopCreator',
                method: 'POST',
                data: data
            }).then(function (res) {

                console.log("hnshof hal hwa y3rf ya3ml edit",res.data)
                // console.log("user",res.data.user);
                // console.log("enroll",res.data.enroll);
                // console.log("single category from factory", res.data.workshop)
                if (res) {

                    def.resolve(res.data);

                } else {
                    def.reject('there is no data ')
                    console.log("hnshof hal hwa y3rf ya3ml edit fl error",res.data)
                }

            }, function (err) {
                def.reject(err);
            })
            return def.promise;

        },
        editWorkshop: function (editable) {
            console.log("in factory to edit workshop",editable.cat_id);
            var def = $q.defer();
            var id=editable.workshop_id;
            // console.log('the url ya esraa', 'http://172.16.2.239:8000/api/categories/'+postdata.category_id+'/posts');
            $http({
                url: 'http://localhost:8000/api/categories/' + editable.cat_id + '/workshops/'+editable.workshop_id+'/edit',
                // url:'http://172.16.2.239:8000/api/posts',
                method: 'get',
                data: id
            }).then(function (res) {

                console.log('i tested',res.data.myrequest);

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
        addcomment: function (commentdata) {
            var def = $q.defer();
            $http({
                url: 'http://localhost:8000/api/comment',
                method: 'POST',
                data: commentdata

            }).then(function (res) {
                console.log("comment result",res);
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
        //////////////////post ajax////////////
        isPostCreator: function (data) {
            //  var category_id= index;
            // // console.log("category_id",category_id)
            // console.log("workshop id", id)
            var def = $q.defer();
            console.log("data",data)
            $http({
                url: 'http://localhost:8000/api/isPostCreator',
                method: 'POST',
                data: data
            }).then(function (res) {

                console.log("hnshof hal hwa y3rf ya3ml edit (post)",res.data)
                // console.log("user",res.data.user);
                // console.log("enroll",res.data.enroll);
                // console.log("single category from factory", res.data.workshop)

                if (res) {

                    def.resolve(res.data);

                } else {
                    def.reject('there is no data ')
                    console.log("hnshof hal hwa y3rf ya3ml edit fl error",res.data)
                }

            }, function (err) {
                def.reject(err);
            })
            return def.promise;

        },
        editPost: function (editable) {
            console.log("in factory to edit post",editable.cat_id);
            var def = $q.defer();
            var id=editable.post_id;
            // console.log('the url ya esraa', 'http://172.16.2.239:8000/api/categories/'+postdata.category_id+'/posts');
            $http({
                url: 'http://localhost:8000/api/categories/' + editable.cat_id + '/posts/'+id+'/edit',
                // url:'http://172.16.2.239:8000/api/posts',
                method: 'GET'
                // data: id
            }).then(function (res) {

                console.log('i tested',res.data);

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

        updatedpost:function (postdata) {
            var def = $q.defer();
            console.log('bnshooof kkkkk',postdata)
            $http({
                url: 'http://127.0.0.1:8000/api/categories/'+ postdata.category_id + '/posts/'+postdata.id,
                method: 'PUT',
                data: postdata

            }).then(function (res) {
                console.log('bnshooof kkkkk',postdata)
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
        deletePost:function (postdata) {
            var def = $q.defer();
            var id=postdata.post_id
            $http({
                url: 'http://127.0.0.1:8000/api/categories/'+ postdata.cat_id + '/posts/'+postdata.post_id,
                method: 'DELETE',
                data:id


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
        //////////////////end post ajax////////////
        //////////////////event ajax////////////
        isEventCreator: function (data) {
            //  var category_id= index;
            // // console.log("category_id",category_id)
            // console.log("workshop id", id)
            var def = $q.defer();
            console.log("data",data)
            $http({
                url: 'http://localhost:8000/api/isEventCreator',
                method: 'POST',
                data: data
            }).then(function (res) {

                console.log("hnshof hal hwa y3rf ya3ml edit",res.data)
                // console.log("user",res.data.user);
                // console.log("enroll",res.data.enroll);
                // console.log("single category from factory", res.data.workshop)

                if (res) {

                    def.resolve(res.data);

                } else {
                    def.reject('there is no data ')
                    console.log("hnshof hal hwa y3rf ya3ml edit fl error",res.data)
                }

            }, function (err) {
                def.reject(err);
            })
            return def.promise;

        },
        editEvent: function (editable) {
            console.log("in factory to edit event",editable.cat_id);
            var def = $q.defer();
            var id=editable.event_id;
            // console.log('the url ya esraa', 'http://172.16.2.239:8000/api/categories/'+postdata.category_id+'/posts');
            $http({
                url: 'http://localhost:8000/api/categories/' + editable.cat_id + '/events/'+id+'/edit',
                // url:'http://172.16.2.239:8000/api/posts',
                method: 'GET'
                // data: id
            }).then(function (res) {

                console.log('i tested',res.data);

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

        updatedevent:function (eventdata) {
            console.log('jjjjjjj',eventdata)
            var def = $q.defer();
            console.log(eventdata.category_id)
            console.log(eventdata.id)
            $http({
                url: 'http://127.0.0.1:8000/api/categories/'+ eventdata.category_id + '/events/'+eventdata.id,
                method: 'PUT',
                data: eventdata

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
        deleteEvent:function (eventdata) {
            var def = $q.defer();
            var id=eventdata.event_id
            $http({
                url: 'http://127.0.0.1:8000/api/categories/'+ eventdata.cat_id + '/events/'+eventdata.event_id,
                method: 'DELETE',
                data:id


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
        //////////////////end event ajax////////////

        getMentorsReviews:function(){
            var def = $q.defer();
            console.log("in mentors reviews");
            $http({
                method: 'GET',
                url: 'http://localhost:8000/api/get_post_reviews',
            }).then(function (data_of_reviews) {
                console.log("then in reviews of post", data_of_reviews.data.reviews)
                if (data_of_reviews) {
                    def.resolve(data_of_reviews.data.reviews);
                } else {
                    def.reject('there is no data ')
                    // console.log("error",res.data)
                }

            },function(err){
                def.reject(err);
            })
            return def.promise;

        },
        submitMentorReview:function(review){
            var def = $q.defer();
            console.log("in mentors add reviews",review);
            $http({
                method: 'POST',
                url: 'http://localhost:8000/api/add_mentor_post_review',
                data: review,
            }).then(function (data) {
                console.log("then in added reviews of post", data)
                if (data) {
                    def.resolve(data);
                } else {
                    def.reject('there is no data ')
                    // console.log("error",res.data)
                }

            },function(err){
                def.reject(err);
            })
            return def.promise;

        },    submitComment:function(comment,post_id){

            var def = $q.defer();
            var data={};
            data={post_id,comment};

            console.log("in posts comment",data);
            $http({
                method: 'POST',
                url: 'http://localhost:8000/api/comment',
                data: data,
            }).then(function (data) {
                console.log("then in added comment of post", data)
                if (data) {
                    def.resolve(data);
                } else {
                    def.reject('there is no data ')
                    // console.log("error",res.data)
                }

            },function(err){
                def.reject(err);
            })
            return def.promise;

        }

    }


})
