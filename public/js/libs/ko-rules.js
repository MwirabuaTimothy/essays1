
//Order form validation
var orderModel = {
    title: ko.observable('').extend({
        required: true,
        minLength: 1,
        pattern: {
            params: /[\w.-]{1,}/,
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
    emailaddress: ko.observable().extend({
        required: true,
        pattern: {
            params: /^[\w.-]+@[\w.-]+\.[A-Za-z]{2,6}$/,
            message: "Invalid email address."
        }
    }),
    password: ko.observable().extend({
        required: true,
        minLength: 6
    }),
    allisvalid: ko.computed(function() {
        var validation = ko.validatedObservable(this);
        var bool = validation.isValid();
        return bool;
    }, this)
};

//Validation of the sign up folder
var signUpModel = {
    emailaddress: ko.observable().extend({
        required: true,
        pattern: {
            params: /^[\w.-]+@[\w.-]+\.[A-Za-z]{2,6}$/,
            message: "Invalid email address."
        }
    }),
    password: ko.observable().extend({
        required: true,
        minLength: 6
    })
};

signUpModel.passwordconfirm = ko.observable().extend({
    required: true,
    equal: signUpModel.passwords,
    pattern: {
        message: "Passwords does not match!"
    }
});

//to check if everything in the signup form is okay
signUpModel.allisvalid = ko.computed(function() {
    var validation = ko.validatedObservable(signUpModel);
    var bool = validation.isValid();
    return bool;
}, signUpModel);

//Instantiate KO order input bindings
$(document).ready(function() {
    ko.applyBindings(sideBarModel, document.querySelector('.auth'));
});






////new signup validation
// http://kojs.dan.doezema.com/examples/2
// https://github.com/Knockout-Contrib/Knockout-Validation/wiki/User-Contributed-Rules