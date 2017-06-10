angular.module('myApp').factory("event",function($q,$http,$rootScope){

    return {

        addevent: function (eventdata) {
            console.log("ana hnaaaaaaa",eventdata);
            var def = $q.defer();
            $http({
                url: 'http://localhost:8000/api/categories/' + eventdata.category_id + '/events',
                method: 'POST',
                data: eventdata

            }).then(function (res) {
                console.log("final from event service is", res)

                if( res.data.data.original.status == "0")
                {
                    def.reject('something bad happened at service')
                }
                event_id_returned =  res.data.data.original.id;
                $http({
                    method: 'POST',
                    url: 'http://localhost:8000/api/event_upload/' + event_id_returned,
                    processData: false,
                    data: {
                        "media_url": "uploads/files" + $rootScope.EventcurrentFile.name,
                        "media_type": $rootScope.EventcurrentFile.type
                    },
                    transformRequest: function (data) {
                        var formData = new FormData();
                        formData.append("file", $rootScope.EventcurrentFile);
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
                def.reject(err);
            })
            return def.promise;

        }

        
    }

});
