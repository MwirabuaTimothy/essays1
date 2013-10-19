App.ServicesRoute = Ember.Route.extend({
    model: function() {
        return servicesJSON;
    } 
    // , setupControllers: function(controller, model){
    //     controller.set('faq', model);
    // }
});
//modeling the data that we want to recieve:
//Ember data supports 4 diff datatypes: string, number, boolean and date
// App.Services = DS.Model.extend({
//     topic: DS.attr('string')
//     , instructions: DS.attr('string')
//     , subject: DS.attr('string')
//     , doctype: DS.attr('string')
//     , pages: DS.attr('string')
//     , single_paced: DS.attr('string')
//     , style: DS.attr('string')
//     , academic_level: DS.attr('string')
//     , page_cost: DS.attr('string')
//     , total: DS.attr('string')
//     , currency: DS.attr('string')
//     , language: DS.attr('string')
//     , urgency: DS.attr('string')
//     , recieve_calls: DS.attr('string')
//     , status: DS.attr('string')
//     , notes: DS.attr('string')
//     , created_at: DS.attr('string')
//     , updated_at: DS.attr('string')
// });

// //fixtures to act as a fallback:
// App.Services.FIXTURES = 


var servicesJSON = [{
    title: 'Resume Services',
    sub: [
        {st: 'Resume Writing', desc: ''},
        {st: 'Resume Editing', desc: ''},
        {st: 'CV Writing', desc: ''},
        {st: 'CV Editing', desc: ''},
        {st: 'Cover Letter', desc: ''}
    ]},

    {   
        title: 'Essay Services',
        sub: [
            {st: 'Custom Essay', desc: ''},
            {st: 'Term Paper', desc: ''},
            {st: 'Research Summary', desc: ''},
            {st: 'Book Report/Review, Movie Review', desc: ''},
            {st: 'Coursework', desc: ''},
            {st: 'Case Study', desc: ''},
            {st: 'Lab Report', desc: ''},
            {st: 'Speech/Presentation', desc: ''},
            {st: 'Articles', desc: ''},
            {st: 'Article Critique', desc: ''},
            {st: 'Annotated Bibliography', desc: ''},
            {st: 'Reaction Paper', desc: ''}
        ]
    },
    {   
        title: 'Dissertation & Thesis Services',
        sub: [
            {st: 'Dissertation', desc:''},
            {st: 'Any dissertation chapter', desc:''},
            {st: 'Abstract', desc:''},
            {st: 'Introduction Chapter', desc:''},
            {st: 'Literature Review', desc:''},
            {st: 'Methodology', desc:''},
            {st: 'Results', desc:''},
            {st: 'Discussion', desc:''},
            {st: 'Thesis', desc: ''},
            {st: 'Thesis/Dissertation Proposal', desc: ''},
            {st: 'Research Proposal', desc: ''},
            {st: 'Editing', desc: ''},
            {st: 'Proofreading', desc: ''}
        ]
    },
    {   
        title: 'Admission Services',
        sub: [
            {st: 'Admission Essay', desc: ''},
            {st: 'Scholarship Essay', desc: ''},
            {st: 'Personal Statement', desc: ''},
            {st: 'Editing', desc: ''}
        ]
    },
    {   
        title: 'Editing Services',
        sub: [
            {st: 'Editing', desc: ''},
            {st: 'Proofreading', desc: ''},
            {st: 'Formatting', desc: ''}
        ]
    },
    {   
        title: 'Assignments',
        sub: [
            {st: 'Programming', desc: ''},
            {st: 'Power Point Presentation', desc: ''},
            {st: 'Math/Physics/Econ/Statistics Problems', desc: ''},
            {st: 'Multiple Choice Questions', desc: ''},
            {st: 'Statistics Project', desc: ''},
            {st: 'Research Summary', desc: ''}
        ]
    }];