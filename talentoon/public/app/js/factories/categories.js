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
        getCategoryPosts:function(index){

  			var def =$q.defer();
  			$http({
  				url:'http://localhost:8000/api/category/'+index ,
  				method:'GET'
  			}).then(function(res){
  				// console.log("response is " , res.data.posts);
  				if(res.data.posts.length){
  		     			def.resolve(res.data.posts);
  							// 			console.log("res.data.posts is " , res.data.posts )
  						// def.resolve(res.data[index])
  				}else{
  					def.reject('there is no data ')
  				}

  			},function(err){
  				def.reject(err);
  			})
  			return def.promise ;

  		},
        getCategoryEvent:function(cat_id,event_id){
            console.log('beforee ajaaaaaaaaaaaxxx',event_id);
  			var def =$q.defer();
  			$http({
  				url:'http://localhost:8000/api/categories/'+cat_id+'/events/'+event_id ,
  				method:'GET'
  			}).then(function(res){
  				console.log("all events in factory " , res.data);
  				if(res.data.posts.length){
  		     			def.resolve(res.data.posts);

  				}else{
  					def.reject('there is no data ')
  				}

  			},function(err){
  				def.reject(err);
  			})
  			return def.promise ;

  		},
        getCategoryEvents:function(cat_id){
  			var def =$q.defer();
  			$http({
  				url:'http://localhost:8000/api/categories/'+cat_id+'/events' ,
  				method:'GET'
  			}).then(function(res){
  				console.log("all events in factory " , res.data.data);
  				if(res.data.data.length){
  		     			def.resolve(res.data.data);

  				}else{
  					def.reject('there is no data ')
  				}

  			},function(err){
  				def.reject(err);
  			})
  			return def.promise ;

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

        }
        ,
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
			console.log(workshopdata);
			console.log(workshopdata.category_id);
			var def =$q.defer();
			$http({

				url:'http://localhost:8000/api/categories/'+workshopdata.category_id+'/workshops' ,
				method:'POST',
				data:workshopdata

			}).then(function(res){
                console.log("workshop",res.data);
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
                    console.log("thennnnn in add post", data)
                });

                //////////////////////////////////////////////
				console.log(res);
				if(res.data.length){
					def.resolve(res.data)
				}else{
					def.reject('there is no data ')
				}

			},function(err){
				// console.log(err);
				def.reject(err);
			})
			return def.promise ;

		},

        addevent: function (eventdata) {
            var def = $q.defer();
            $http({
                url: 'addevent url',
                method: 'GET',
                data: eventdata

            }).then(function (res) {

                if (res.data.length) {
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
        complete_talent_profile: function (talent_data) {

            var def = $q.defer();
            $http({
                url: 'http://127.0.0.1:8000/api/categorytalent/store',
                method: 'POST',
                data: talent_data

            }).then(function (res) {
                console.log("res is find the id now please ", res.data.category_talent_id)

                if (res) {
                    $rootScope.category_talent_id = res.data.category_talent_id;
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
                method: 'PUT',
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
        },getCategoryWorkshops:function(index){

			var def =$q.defer();
			$http({
				url:'http://localhost:8000/api/category/'+index ,
				method:'GET'
			}).then(function(res){
                console.log("workshops_bassant",res);
				console.log("response is " , res.data.workshops);
				if(res.data.workshops){
		     			def.resolve(res.data.workshops);
				}else{
					def.reject('there is no data ')
				}

			},function(err){
				def.reject(err);
			})
			return def.promise ;

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

    }


})
