// App.Store = DS.Store.extend({
    // revision: 12
    // , adapter: 'DS.FixtureAdapter'
    // , adapter: 'DS.RESTAdapter'
// });
//ember data 0.13:
// App.Store = DS.Store.extend({
//   adapter: DS.MyRESTAdapter.create()
// });

//Fetching the real data:
// App.ApplicationAdapter = DS.MyFixtureAdapter;

App.ApplicationAdapter = DS.RESTAdapter.extend({
  // host: 'http://localhost:8000', 
  namespace: 'api'
});

App.FaqRoute = Ember.Route.extend({
    model: function() {
        return this.store.find('orders');
    } 
    , setupControllers: function(controller, model){
        controller.set('faq', model);
    }
});

// App.FaqRoute = Ember.Route.extend({
//   model: function(params) {
//     return this.store.find('order', params.post_id);
//   }
// });


// App.Message = DS.Model.extend({
//     user: DS.belongsTo("App.User"),
//     text: DS.attr('string')
// });

// App.User = DS.Model.extend({
//     messages: DS.hasMany("App.Message"),
//     screen_name: DS.attr("string")
// });

//modeling the data that we want to recieve:
//Ember data supports 4 diff datatypes: string, number, boolean and date
App.Order = DS.Model.extend({
    topic: DS.attr('string')
    , instructions: DS.attr('string')
    , subject: DS.attr('string')
    , doctype: DS.attr('string')
    , pages: DS.attr('string')
    , single_paced: DS.attr('string')
    , style: DS.attr('string')
    , academic_level: DS.attr('string')
    , page_cost: DS.attr('string')
    , total: DS.attr('string')
    , currency: DS.attr('string')
    , language: DS.attr('string')
    , urgency: DS.attr('string')
    , recieve_calls: DS.attr('string')
    , status: DS.attr('string')
    , notes: DS.attr('string')
    , created_at: DS.attr('string')
    , updated_at: DS.attr('string')
});

// //fixtures to act as a fallback:
// App.Order.FIXTURES = [
// {
// "id": "2",
// "topic": "yusdvhdsh",
// "instructions": "",
// "subject": "",
// "doctype": "",
// "pages": "",
// "single_paced": "0",
// "style": "",
// "academic_level": "",
// "page_cost": "",
// "total": "",
// "currency": "",
// "language": "",
// "urgency": "",
// "recieve_calls": "0",
// "status": "",
// "notes": "",
// "created_at": "2013-10-14 14:50:42",
// "updated_at": "2013-10-14 14:50:42"
// }
// , {
// "id": "3",
// "topic": "praise",
// "instructions": "",
// "subject": "",
// "doctype": "",
// "pages": "",
// "single_paced": "1",
// "style": "forever",
// "academic_level": "9999",
// "page_cost": "",
// "total": "",
// "currency": "",
// "language": "",
// "urgency": "",
// "recieve_calls": "1",
// "status": "",
// "notes": "",
// "created_at": "2013-10-15 00:48:43",
// "updated_at": "2013-10-15 00:48:43"
// }
// // // , {}
// // // , {}
// ]
