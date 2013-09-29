/**
 *
 *@Author - Eugene Mutai
 *@Twitter - JheneKnights
 *
 * Date: 9/12/13
 * Time: 2:56 PM
 * Description:
 *
 * Dual licensed under the MIT or GPL Version 2 licenses.
 * http://www.opensource.org/licenses/mit-license.php
 * http://www.opensource.org/licenses/gpl-2.0.php
 *
 * Copyright (C) 2013
 * @Version -
 */

var orderModel = {
    title: ko.observable('').extend({
        required: true,
        minLength: 1,
        pattern: {
            params: /[\w.-]{1,}/, //jhene-knights
            message: "Title of your project cannot be blank."
        }
    }),
    pagesorwords: ko.observable('').extend({
        required: true,
        //digit: true,
        pattern: {
            params: /^(\+)?[0-9.-]{1,}/,
            message: "invalid input, enter only numerical values."
        }
    })
};

//Validation of all the valid fields
orderModel.allisvalid = ko.computed(function() {
    var validation = ko.validatedObservable(orderModel);
    return validation.isValid();
}, orderModel);

//Will take care of the Sidebar login validation
var sideBarModel = {
    sidebarEmailAddress: ko.observable('').extend({
        required: true,
        pattern: {
            params: /^[\w.-]+@[\w.-]+\.[A-Za-z]{2,6}$/, //jhene-knights
            message: "Invalid email address."
        }
    }),
    sidebarPassword: ko.observable('').extend({
        required: true,
        minLength: 6
    }),
    sidebarAllisvalid: ko.computed(function() {
        var validation = ko.validatedObservable(this);
        var bool = validation.isValid();
        return bool;
    }, this)
};

//initialise App
App = Ember.Application.create();

App.Router.map(function() {
    this.route('introduction');
    this.route('about-us');
    this.route('services');
    this.route('contact-us');
    this.route('my-order');
});

App.IndexRoute = Ember.Route.extend({
    redirect: function() {
        this.transitionToAnimated('introduction', {main: 'slideLeft'})
    }
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
            ko.applyBindings(orderModel, document.querySelector('.myorder form'));

            //Setting up Multiple file upload JS
            var dz = new Dropzone('#my-dropzone', {
                paramName: "files",
                uploadMultiple: true,
                autoProcessQueue: false,
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

            //1st submission, for attachment uploads
            $('#submitAttach').on('click', function() {
                var data = {}, orderdata, good = orderModel.allisvalid(), empty = [];
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

App.ApplicationRoute = Ember.Route.extend({
    actions: {
        /** BASIC PAGE TRANSITIONS ***/
        introduction: function() {
            this.transitionToAnimated('introduction', {main: 'fade'})
        },
        aboutus: function() {
            this.transitionToAnimated('about-us', {main: 'fade'})
        },
        contactus: function() {
            this.transitionToAnimated('contact-us', {main: 'flip'})
        },
        myorder: function() {
            this.transitionToAnimated('my-order', {main: 'fade'});
        },
        ourservices: function() {
            this.transitionToAnimated('services', {main: 'fade'})
        },
        /*** EMBER APP USES ***/
        checklogin: function(path) {
            if(essays.storeThisSmartly("essaysUser")) {
                this.transitionToAnimated(path, {main: "slideLeft"})
            }else{
                this.transitionToAnimated('sign-up', {main: 'slideRight'})
            }
        }
    }
});

App.ApplicationView = Ember.View.extend({
    classNames: ['application']
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


