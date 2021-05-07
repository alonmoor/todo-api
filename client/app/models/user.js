import DS from 'ember-data';

export default DS.Model.extend({
    name : DS.attr('string'),
    tasks: DS.hasMany()
     //children: DS.hasMany('child')
});
