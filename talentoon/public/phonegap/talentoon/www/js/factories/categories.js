angular.module('talentoon').factory("categories", function ($q, $http, $rootScope) {
    return {
        getAllCategory: function (token) {
console.log("token in factory",token)
            var def = $q.defer();
            $http({
                url: 'http://172.16.3.77:8000/api/category',
                headers:{
              'Authorization':'Bearer'+ token
                 },
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
  				url:'http://172.16.3.77:8000/api/category/'+index ,
          headers:{
        'Authorization':'Bearer'+ $rootScope.token
           },
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
  				url:'http://172.16.3.77:8000/api/categories/'+cat_id+'/events/'+event_id ,
          headers:{
        'Authorization':'Bearer'+ $rootScope.token
           },
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
  				url:'http://172.16.3.77:8000/api/categories/'+cat_id+'/events' ,
          headers:{
        'Authorization':'Bearer'+ $rootScope.token
           },
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
                url: 'http://172.16.3.77:8000/api/post/' + id,
                headers:{
              'Authorization':'Bearer'+ $rootScope.token
                 },
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

        }
        ,
        addpost: function (postdata) {
            // console.log("Post Dataaaa",postdata);
            var def = $q.defer();
            // console.log('the url ya esraa', 'http://172.16.2.239:8000/api/categories/'+postdata.category_id+'/posts');
            console.log('the url ya esraa', 'http://172.16.3.77:8000/api/categories/'+$rootScope.cat_id+'/posts');
            $http({
                url: 'http://172.16.3.77:8000/api/categories/' +$rootScope.cat_id+ '/posts',
                headers:{
              'Authorization':'Bearer'+ $rootScope.token
                 },
                // url:'http://172.16.2.239:8000/api/posts',
                method: 'POST',
                data: postdata
            }).then(function (res) {
              console.log("____________in res  ", res)

                console.log("____________in res add post ", res.data.post_id)
                console.log("____________media type ", $rootScope.currentFile.type)
                console.log('_________', $rootScope.currentFile.name)


                /////////////////////////
                $http({
                    method: 'POST',
                    url: 'http://172.16.3.77:8000/api/single_upload/' + res.data.post_id,
                    headers:{
                  'Authorization':'Bearer'+ $rootScope.token
                     },
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

                if (res) {
console.log("add post in factory",res)
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
                url: 'http://172.16.3.77:8000/api/review_files_upload/' + category_talent_id,
                headers:{
              'Authorization':'Bearer'+ $rootScope.token
                 },
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





        },

        addevent: function (eventdata) {
            var def = $q.defer();
            $http({
                url: 'addevent url',
                headers:{
              'Authorization':'Bearer'+ $rootScope.token
                 },
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

        }


}
})
