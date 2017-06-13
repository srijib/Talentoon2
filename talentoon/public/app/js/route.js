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
        POSTS:'posts',
        COMPETITION:'Competition',
        INITIALREVIEW:'Initial Review'

    },
      FOOTER: {
        LINKS: 'Links',
        STAY_TUNED: 'Stay tuned',
        CONTACT_US: 'Contact us',
          SOCIAL_TEXT:'Connect with us and stay in the loop',
          Email_US_TEXT:'If you have any inquiry, please send a email',
          Email_US_ENTER_QN_TEXT:'Enter Your Question Here',
          Email_US_BUTTON:'Email Us',
          COMPLAINT_TEXT:'If you have any problem, please do not hesitate to email us',
          COMPLAINT_ENTER_COMPLAINT_TEXT:'Complaint',

    },
      ONE_CATEGORY: {
          SUBSCRIBE: 'Subscribe',
          BE_MENTOR: 'Be Mentor',
          BE_TALENT: 'Be Talent',
          BE_UN_TALENT: 'Un Talent',
          BE_UN_MENTOR: 'Un Mentor',
          UN_SUBSCRIBE: 'Un Subscribe',
          TOP_COMPETITIONS: 'Top Competitions',
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
        POSTS:'بوستات',
        COMPETITION:'المسابقات',
        INITIALREVIEW:'تقييم المستوى'
    },
        FOOTER: {
          LINKS: 'روابط',
          STAY_TUNED: 'خليك معانا ',
          CONTACT_US: 'كلمنا',
            SOCIAL_TEXT:'اتصل بنا عبر الفيسبوك ',
            Email_US_TEXT:'لو قابلتك مشكله ماتتردش تبعتلنا',
            Email_US_ENTER_QN_TEXT:'ادخل سؤالك هنا',
            Email_US_BUTTON:'ارسل',
            COMPLAINT_TEXT:'لو عندك شكوى, ابعتلنا هنرد عليك',
            COMPLAINT_ENTER_COMPLAINT_TEXT:'أرسل الشكوى',
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

    if (! localStorage.getItem('language')) {
        localStorage.setItem('language', 'en');
    }
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
    .when('/password/forget', {
        templateUrl: 'views/forget_password.html',
        controller: 'forget_password'
    })
    .when('/competitions', {
        templateUrl: 'views/allcompetitions.html',
        controller: 'competitions'
    })
    .when('/category/:category_id/competitions', {
        templateUrl: 'views/categoryCompetitions.html',
        controller: 'categoryCompetitions'
    })
    .when('/category/:category_id/createcompetition', {
        templateUrl: 'views/formcompetition.html',
        controller: 'categoryCompetitions'
    })
    .when('/category/:category_id/competitions/:competition_id', {
        templateUrl: 'views/singleCompetition.html',
        controller: 'singleCompetition'
    })
    .when('/category/:category_id/competitions/:competition_id/edit', {
        templateUrl: 'views/editcompetition.html',
        controller: 'singleCompetition'
    })
    .when('/category/:category_id/competitions/:competition_id/addpost', {
        templateUrl: 'views/addcompetitionpost.html',
        controller: 'singleCompetition'
    })
    .when('/category/:category_id/competitions/:competition_id/delete', {
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

    .when('/posts', {
        templateUrl: 'views/posts.html',
        controller: 'posts'
    })
    //all category
    .when('/categories', {
        templateUrl: 'views/categories.html',
        controller: 'categories',
        // resolve: {
        //     resolvedCategory: function (categories) {
        //         return categories.getAllCategory().then(function (res) {
        //             return res;
        //         });
        //     },
        // }
    })

        //allposts in category
        .when('/category/:category_id', {
            templateUrl: 'views/category.html',
            controller: 'oneCategory'
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

//edit competition

        // .when('/category/:category_id/competitions/:competition.id/editcompetition',{
        //     templateUrl: 'views/editcompetition.html',
        //     controller: 'competitions'
        // })
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

        //add event
        .when('/showreview', {
            templateUrl: 'views/showreview.html',
            controller: 'showreview'
        })
        .when('/404', {
            templateUrl: 'views/404.html'

        })
        .when('/401', {
            templateUrl: 'views/401.html'

        })
        .when('/500', {
            templateUrl: 'views/500.html'

        })

        .when('/category/:category_id/posts/:post_id', {
            templateUrl: 'views/categorypost.html',
            controller: 'oneCategory'
        })

        .when('/category/:category_id/events/:event_id', {
            templateUrl: 'views/categoryevent.html',
            controller: 'oneCategory'
        })

        .when('/profile', {
            templateUrl: 'views/profile.html',
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
            templateUrl: 'views/profile.html',
            controller: 'userprofile'
        })
        .when('/404',{
            templateUrl: 'views/404.html',
        })

        .otherwise({
         redirectTo: '/404'
     });


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
