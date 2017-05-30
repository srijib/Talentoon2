angular.module('myApp').factory("event",function($q,$http,$rootScope){

    return {

        addevent: function (eventdata) {
            console.log("ana hnaaaaaaa",eventdata);
            var def = $q.defer();
            //al moshklaaaaa hnaaaaaaaaaaaaaaa
            // console.log('the url ya esraa', 'http://172.16.2.239:8000/api/categories/'+eventdata.category_id+'/events');
            $http({

                url: 'http://localhost:8000/api/categories/' + eventdata.category_id + '/events',
                method: 'POST',
                data: eventdata

            }).then(function (res) {
              console.log("____________in res add post ", res)

                console.log("____________in res  data add post ", res.data)
                console.log("____________media type ", $rootScope.currentFile.type)
                console.log('_________', $rootScope.currentFile.name)
                console.log("____________in res add post ", res.data.id)

                /////////////////////////

                $http({
                    method: 'POST',
                    url: 'http://localhost:8000/api/event_upload/' + res.data.id,
                    processData: false,
                    data: {
                        "media_url": "uploads/files" + $rootScope.currentFile.name,
                        "media_type": $rootScope.currentFile.type
                    },
                    transformRequest: function (data) {
                        var formData = new FormData();

                        //for(var i =0;i< filesuploaded.length;i++){
                        formData.append("file", $rootScope.currentFile);
                        //  console.log("file in loop",filesuploaded[i])
                        //}
                        return formData;
                    },
                    headers: {
                        'Content-Type': undefined,
                        'Process-Data': false
                    }
                }).then(function (data) {

                    console.log("your event is", data)
                });




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

        }
    }

});
