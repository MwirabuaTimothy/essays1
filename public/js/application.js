//initialise App
App = Ember.Application.create({
    LOG_TRANSITIONS: true
});

App.Router.reopen({
    // location: 'history' //routes on direct urls, not hashes 
    // , rootURL: '/app/' // serve the app on domain.com/app
});

App.Router.map(function() {
    // rootURL: '/app';
    this.resource('introduction');
    this.resource('about-us');
    this.resource('services');
    this.resource('contact-us');
    this.resource('my-order');
    this.resource('faq');
    this.resource('sign-in');
    this.resource('sign-up');
    this.resource('popup');
});

App.initializer({
    name: 'Inject Store',
    initialize: function(container, application) {
        container.injection('application:main', 'store', 'store:main');
    }
});
var categorydata = {};
App.ApplicationRoute = Ember.Route.extend({
    actions: {
        /** BASIC PAGE TRANSITIONS ***/
          introduction: function() {
            this.transitionToAnimated('introduction', {main: 'fade'})
        }
        , aboutus: function() {
            this.transitionToAnimated('about-us', {main: 'fade'})
        }
        , contactus: function() {
            this.transitionToAnimated('contact-us', {main: 'flip'})
        }
        , myorder: function() {
            this.transitionToAnimated('my-order', {main: 'fade'});
        }
        , ourservices: function() {
            this.transitionToAnimated('services', {main: 'fade'})
        }
        /*** EMBER APP USES ***/
        , checklogin: function(path) {
            if(essays.storeThisSmartly("essaysUser")) {
                this.transitionToAnimated(path, {main: "fade"})
            }else{
                this.transitionToAnimated('sign_up', {main: 'flip'})
            }
        }
        , faq: function() {
            this.transitionToAnimated('faq', {main: 'fade'})
        }
        
        , signin: function() {
             // this.render({ outlet: 'auth' });
            this.transitionToAnimated('sign-in', { main: 'slide' });
        }
        , signup: function() {
            this.transitionToAnimated('sign-up', { main: 'slide' });
        }
        // , renderTemplate: function() {
        //     this.render('sign-in', {   // the template to render
        //         into: 'index',          // the template to render into
        //         outlet: 'auth',       // the name of the outlet in that template
        //         controller: 'SignInController'  // the controller to use for the template
        //     });
        // }

        , popst: function(param) {
            categorydata = param;
            var modalView = this.container.lookup('view:popup')
            modalView.append();
            // this.transitionToAnimated('popup', { main: 'flip' });
            console.log(categorydata);
        }
        // ,  openModal: function() {
        //   var modalView = this.container.lookup('view:modal')
        //   modalView.append();
        // }
    }
});
 
// App.ModalView = Ember.View.extend({
//     layoutName: 'modal',
//     closeModal: function(){
//         this.remove();
//     }
// });

App.PopupView = Ember.View.extend({
    layoutName: "modal",
    closeModal: function(){
        this.remove();
    },
    // title: "My Mama",
    // desc: "Description of soemthing" 
});
App.PopupRoute = Ember.Route.extend({
    model: function(param) {
        categorydata = param;
        return categorydata;
    } 
});

App.ServicesRoute = Ember.Route.extend({
    model: function() {
        return servicesJSON;
    } 
    // , setupControllers: function(controller, model){
    //     controller.set('faq', model);
    // }
});


// Animated Transitions need explicit view declarations
App.ApplicationView = Ember.View.extend({classNames: ['application']});
App.IntroductionView = Ember.View.extend();
App.AboutUsView = Ember.View.extend();
App.ServicesView = Ember.View.extend();
App.ContactUsView = Ember.View.extend();
App.MyOrderView = Ember.View.extend();
App.SignInView = Ember.View.extend();
App.SignUpView = Ember.View.extend();
App.OrdersView = Ember.View.extend();

App.IndexRoute = Ember.Route.extend({
    redirect: function() {
        this.transitionToAnimated('introduction', {main: 'slideRight'})
    }
});

programmers =  [
    {firstName: "Yehuda", id: 1},
    {firstName: "Tom",    id: 2}
  ];

App.SignUpController = Ember.Controller.extend({
    programmers: function(){
        return programmers;
    }
    ,  currentProgrammer: {
    id: 2
  }
});

App.SignUpRoute = Ember.Route.extend({
    // afterModel: function() {
    //     setTimeout(function() {
    //         ko.applyBindings(signUpModel, document.querySelector('#signup-form'))
    //     }, 10)
    // }
});



App.MyOrderRoute = Ember.Route.extend({
    afterModel: function() {
        //instantiating the google select plugin
        setTimeout(function() {
            $('div.options select').select2({ placeholder: "Select a subject"});
            //correct all options to have the assigned text values
            $('option').each(function() {
                $(this).attr('value', function() { return $(this).text() });
            });
            // ko.applyBindings(orderModel, document.querySelector('.myorder form'));

            //Setting up Multiple file upload JS
            var dz = new Dropzone('#my-dropzone', {
                // url: "./xfiles",
                paramName: "files",
                uploadMultiple: true,
                maxFilesize: 10,
                // dictFileTooBig: "go to hell!",
                thumbnailWidth: "80",
                thumbnailHeight: "80",
                clickable: true,
                addRemoveLinks: true,
                maxFiles:5,
                parallelUploads:5,
                autoProcessQueue: false,
                dictCancelUpload: "Cancel",
                init: function() {
                    var submit  = $('#submitOrder');
                    var dz = this;

                    submit.on('click', function(e) {
                        e.preventDefault();
                        if(dz.files.length > 0) {
                            dz.processQueue();
                        }else{
                            //Just submit his details only

                        }
                        console.log("Submitted it");
                    }); //Tell dropzone to process all queued files.

                    dz.on("sending", function(file, xhr, formData) {
                        // Will send the "orderdetails" along with the file as POST data.
                        var order = JSON.parse(localStorage.getItem('userorder'));
                        formData.append("order_id", order['userorderID']);
                        formData.append("category", "assisting");
                        //console.log(order);
                    });

                    dz.on('processingmultiple', function() {
                        submit.html(submit.data('processing'));
                    });

                    dz.on('successmultiple', function() {
                        submit.html(submit.data('complete')).removeClass('block-negative').addClass('block-positive');
                        //Now post the user's order data
                        var order = JSON.parse(localStorage.getItem('userorder'));
                        $.post('route', order, function() {
                            //do something, redirect to login page.
                        }, "json");
                    });

                    dz.on('addedfile', function() {
                        console.log("Total no of files --> " + this.files.length)
                    })

                    console.log("Initialised dropzone upload plugin. --> " + dz.getQueuedFiles().length);
                }
            });
      // $("#btnDropzone").click(function () {

      //       var fileCount = myDropzone.files.length;
      //       alert(fileCount);
      //       alert(fileCount % myDropzone.options.parallelUploads);
      //       var loopsCount = fileCount / myDropzone.options.parallelUploads;

      //       if (fileCount % myDropzone.options.parallelUploads != 0) {
      //           loopsCount = loopsCount + 1;
      //       }

      //       alert(loopsCount);
      //       for (var i = 0; i < loopsCount ; i++) {
      //           alert(i);
      //           myDropzone.processQueue();
      //       }

      //   });

            //1st submission, for attachment uploads
            $('#submitAttach').on('click', function() {
                var data = {}, orderdata, good = orderModel.allisvalid(), empty = [];
                // var data = {}, orderdata, good = [];
                if(good) {
                    orderdata = $('[data-part="order"]').map(function() {
                        data[$(this).attr('id')] = $(this).val();
                        //return {tag: $(this).attr('id'), value: $(this).val()}
                    })
                    //If all is good, show the upload parameter
                    data["userorderID"] = window.btoa(data['ordertitle']);
                    $('.overlay, .uploadAttachment').fadeIn(300).data('userorder', JSON.stringify(data));
                    localStorage.setItem('userorder', JSON.stringify(data));
                    $('.notificationbar').slideUp(300);
                    console.log(orderdata);
                }else{
                    $('.notificationbar').slideDown(300);
                }
            });

            $('.overlay').on('click', function() {
                $(this).hide().siblings('.uploadAttachment').hide();
            })
        }, 10); //run on 100 milliseconds
    }
});

var essays = {
    /**
     * @param options - local(bool), content(object), backup(bool)
     * @param key
     * STORE CONTENT locally or in cookie or BOTH
     */
    storeThisSmartly: function(key, options) {
        if (options) {
            if (options.local) {
                localStorage.setItem(key, JSON.stringify(options.content));
            } else {
                $.cookie(key, options.content);
                if (options.backup) localStorage.setItem(key, JSON.stringify(options.content));
            }
        }else if (options == false) { //if options == false
            localStorage.removeItem(key); //delete the key
            if ($.cookie) $.cookie(key, false);
        }

        //if only one argument is given retrieve that data from localstorage
        return arguments.length == 1 ? JSON.parse(localStorage.getItem(key)) : false;
    },
    clear: function(key) {
        this.storeThisSmartly(key, false);
    }
}
