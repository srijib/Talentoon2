//angular.module('myApp').config(['$routeProvider', function ($routeProvider) {
angular.module('myApp').config(['$routeProvider', '$httpProvider', function ($routeProvider, $httpProvider) {

        $routeProvider.when('/', {
            templateUrl: 'views/home.html',
            controller: 'homec'
        })


                // .when('/category/createEvent', {
                //     templateUrl: 'views/post.html',
                //     controller: 'homec'
                // })
                    .when('/post/:post_id', {
                    templateUrl: 'views/post.html',
                    controller: 'homec'
                })

                .when('/category/:category_id/createEvent', {
                    templateUrl: 'views/createEvent.html',
                    controller: 'eventcontroller'
                })

                .when('/initial_review', {
                    templateUrl: 'views/initial_review.html',
                    controller: 'initial_review'
                })

//all category
                .when('/categories', {
                    templateUrl: 'views/categories.html',
                    controller: 'categories',
                    resolve: {

                        resolvedCategory: function (categories) {
                            return categories.getAllCategory().then(function (res) {
                                return res;
                            });
                        },

                    }
                })

//allposts in category
                .when('/category/:category_id', {
                    templateUrl: 'views/category.html',
                    controller: 'oneCategory'
                })

//user subscribe in category

                .when('/category/subscribe/:category_id/:user_id', {
                    // templateUrl:'views/category.html',
                    controller: 'oneCategory'
                })

                .when('/category/unsubscribe/:category_id/:user_id', {
                    // templateUrl:'views/category.html',
                    controller: 'oneCategory'
                })



//user choose to be a talent under a certain category
                .when('/category/betalent/:category_id/:user_id', {
                    controller: 'talents'
                })



//user choose to be a mentor under a certain category
                .when('/category/bementor/:category_id/:user_id', {
                    controller: 'mentors'
                })




//add post
                .when('/category/:category_id/addpost', {
                    templateUrl: 'views/addpost.html',
                    controller: 'addpost'
                })
// add workshop
                .when('/category/:category_id/addworkshop', {
                    templateUrl: 'views/addworkshop.html',
                    controller: 'addworkshop'
                })
//add event


//user routes

                .when('/register', {
                    templateUrl: 'views/register.html',
                    controller: 'register'

                })

                .when('/login', {
                    templateUrl: 'views/login.html',
                    controller: 'login'

                })

                .when('/showreview', {
                    templateUrl: 'views/showreview.html',
                    controller: 'showreview'
                })

                .when('/category/:category_id/posts', {
                    templateUrl: 'views/categoryposts.html',
                    controller: 'allCategoryPosts'
                })

                .when('/category/:category_id/posts/:post_id', {
                    templateUrl: 'views/categorypost.html',
                    controller: 'oneCategory'
                })

                .when('/category/:category_id/events/:event_id', {
                    templateUrl: 'views/categorypost.html',
                    controller: 'oneCategory'
                })

                .when('/myprofile', {
                  templateUrl: 'views/myprofile.html',
                  controller: 'userprofile'
                })
                .when('/category/:category_id/workshops', {
                    templateUrl: 'views/categoryworkshops.html',
                    controller: 'oneCategory'
                })

                .when('/category/:category_id/workshops/:workshop_id', {
                    templateUrl: 'views/categoryworkshop.html',
                    controller: 'oneCategory'
                })


                .when('/videoconference', {
                    templateUrl: 'views/create_video_conference_class.html',
                    controller: 'videoconference'
                })


    $httpProvider.interceptors.push(['$q', '$location', function ($q, $location) {
                return {
                    'request': function (config) {
                        config.headers = config.headers || {};
                        var token = JSON.parse(localStorage.getItem("token"));
                        if (token) {
                            config.headers.Authorization = 'Bearer ' + token;
                        }
                        return config;
                    },
                    'responseError': function (response) {
                        if (response.status === 401 || response.status === 403) {
                            $location.path('/signin');
                        }
                        return $q.reject(response);
                    }
                };
            }]);


    }]);
