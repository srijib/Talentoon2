angular.module('myApp').config(['$routeProvider', '$httpProvider', '$translateProvider', function ($routeProvider, $httpProvider, $translateProvider) {
    var translations_en = {
      DESCOVER_MORE: 'Discover More',
      TOP_POSTS: 'Top Posts',
      TOP_EVENTS: 'Top Events',
      TOP_WORKSHOPS:'Top Workshops',
      NAVBAR: {
        HOME: 'Home',
        CATEGORIES: 'Categories',
        ALL_CATEGORIES: 'All Categories',
        PROFILE: 'Profile',
        SETTINGS: 'Settings',
        LOGOUT: 'Logout',
    },
      FOOTER: {
        LINKS: 'Links',
        STAY_TUNED: 'Stay tuned',
        CONTACT_US: 'Contact us',
    },
      ONE_CATEGORY: {
          SUBSCRIBE: 'Subscribe',
          BE_MENTOR: 'Be Mentor',
          BE_TALENT: 'Be Talent',
          BE_UN_TALENT: 'Un Talent',
          BE_UN_MENTOR: 'Un Mentor',
          UN_SUBSCRIBE: 'Un Subscribe',
          TOP_COMPETITIONS: 'Top Competitions'
    },
    };
    var translations_ar = {
      DESCOVER_MORE: 'اكتشف المزيد',
      TOP_POSTS: 'أجمد مواهب',
      TOP_EVENTS: 'أقرب ايفنتات',
      TOP_WORKSHOPS:'ورش عمل',
      NAVBAR: {
        HOME:'الرئيسيه',
        CATEGORIES:'المجالات',
        ALL_CATEGORIES:'كل المجالات',
        PROFILE:'بروفايل',
        SETTINGS:'الاعدادات',
        LOGOUT:'تسجيل الخروج',
    },
        FOOTER: {
          LINKS: 'روابط',
          STAY_TUNED: 'خليك معانا ',
          CONTACT_US: 'كلمنا',
      },
        ONE_CATEGORY: {
            SUBSCRIBE: 'تابع',
            BE_MENTOR: 'كن معلم ',
            BE_TALENT: 'كن موهوب',
            BE_UN_TALENT: 'الغاء الموهبه',
            BE_UN_MENTOR: 'الغاء التعليم',
            UN_SUBSCRIBE: 'لا تتابع',
            TOP_COMPETITIONS: 'المسابقات'

        },
      };

    // add translation table
    $translateProvider
      .translations('en', translations_en)
      .translations('ar', translations_ar)
    //   .preferredLanguage('en');
      .preferredLanguage(localStorage.getItem('language'));


    $routeProvider.when('/', {
        templateUrl: 'views/home.html',
        controller: 'homec'
    })
    .when('/competitions', {
        templateUrl: 'views/allcompetitions.html',
        controller: 'competitions'
    })
    .when('/category/:category_id/competitions', {
        templateUrl: 'views/categoryCompetitions.html',
        controller: 'categoryCompetitions'
    })
    .when('/category/:category_id/createcompetitions', {
        templateUrl: 'views/formcompetition.html',
        controller: 'categoryCompetitions'
    })
    .when('/category/:category_id/competitions/competition_id', {
        templateUrl: 'views/singleCompetition.html',
        controller: 'singleCompetition'
    })
    .when('/category/:category_id/competitions/competition_id/edit', {
        templateUrl: 'views/formcompetition.html',
        controller: 'singleCompetition'
    })
    .when('/competitions/competition_id/addpost', {
        templateUrl: 'views/addcompetitionpost.html',
        controller: 'singleCompetition'
    })
    .when('/competitions/:competition_id/posts/:post_id/delete', {
        templateUrl: 'views/singleCompetition.html',
        controller: 'singleCompetition'
    })

    .when('/post/:post_id', {
        templateUrl: 'views/post.html',
        controller: 'homec'
    })

    .when('/category/:category_id/createEvent', {
        templateUrl: 'views/createEvent.html',
        controller: 'eventcontroller'
    })

    // .when('/initial_review', {
    //     templateUrl: 'views/showreview.html',
    //     controller: 'showreview'
    // })
    .when('/competitions', {
        templateUrl: 'views/competitions.html',
        controller: 'competitions'
    })
    .when('/posts', {
        templateUrl: 'views/posts.html',
        controller: 'posts'
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

        // .when('/category/:category_id/subscribe/:user_id', {
        //     // templateUrl:'views/category.html',
        //     controller: 'oneCategory'
        // })
        //
        // .when('/category/unsubscribe/:category_id/:user_id', {
        //     // templateUrl:'views/category.html',
        //     controller: 'oneCategory'
        // })



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
//edit workshopp
            .when('/category/:category_id/workshops/:workshop_id/editworkshop', {
                templateUrl: 'views/editworkshop.html',
                controller: 'oneCategory'
            })
        //edit post
        .when('/category/:category_id/posts/:post_id/editpost', {
            templateUrl: 'views/editpost.html',
            controller: 'oneCategory'
        })
        //edit event

        .when('/category/:category_id/events/:event_id/editevent', {
            templateUrl: 'views/editevent.html',
            controller: 'oneCategory'
        })


        //user choose to be a talent under a certain category
        .when('/category/:category_id/betalent', {
            templateUrl: 'views/betalent.html',
            controller: 'talents'
        })




        //user choose to be a mentor under a certain category
        .when('/category/:category_id/bementor', {
            templateUrl: 'views/bementor.html',
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

        .when('/showreview', {
            templateUrl: 'views/showreview.html',
            controller: 'showreview'
        })

        .when('/category/:category_id/posts/:post_id', {
            templateUrl: 'views/categorypost.html',
            controller: 'oneCategory'
        })

        .when('/category/:category_id/events/:event_id', {
            templateUrl: 'views/categoryevent.html',
            controller: 'oneCategory'
        })

        .when('/myprofile', {
            templateUrl: 'views/myprofile.html',
            controller: 'userprofile'
        })
        .when('/editprofile', {
            templateUrl: 'views/editProfile.html',
            controller: 'userprofile'
        })
        .when('/category/:category_id/workshops', {
            templateUrl: 'views/categoryworkshops.html',
            controller: 'oneCategory'
        })
        .when('/category/:category_id/events', {
            templateUrl: 'views/categoryevents.html',
            controller: 'oneCategory'
        })
        .when('/category/:category_id/posts', {
            templateUrl: 'views/categoryposts.html',
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
        .when('/category/:category_id/workshops/:workshop_id/createSession', {
            templateUrl: 'views/createsession.html',
            controller: 'addsession'
        })
        .when('/profile/:user_id', {
            templateUrl: 'views/userprofile.html',
            controller: 'userprofile'
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
