
// App.ApplicationController = Ember.ObjectController.extend({
//     , signin: function() {
//             this.render({ outlet: 'auth' });
//     }
//     , signup: function() {
//         this.render({ outlet: 'auth' });
//     }
// });

App.MyOrderController = Ember.Controller.extend({
 	names: ["Yehuda", "Tom", "Amazing", "Grace"],
	subject_area_sel : subject_area_sel,
	document_type_sel : document_type_sel,
	academic_level_sel : academic_level_sel,
	urgency_sel : urgency_sel,
	writing_style_sel : writing_style_sel,
	langstyle_sel : langstyle_sel,
	numpages_sel : numpages_sel,
	curr_sel : curr_sel,
});

// App.ApplicationController = Ember.Controller.extend({
//     curr_sel: [
//         {v:"1", n:"USD"},
//         {v:"2", n:"GBP"},
//         {v:"3", n:"CAD"},
//         {v:"4", n:"AUD"},
//         {v:"5", n:"EUR"}
//     ],
//     selectedCurrency: null,
//     selectedCurrencyChanged: function() {
//         console.log(this.get('selectedCurrency.n'));
//     }.observes('selectedCurrency')
// });
