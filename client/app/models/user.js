import DS from 'ember-data';
import Model from 'ember-data/model';
import { hasMany } from 'ember-data/relationships';

export default DS.Model.extend({
    name : DS.attr('string'),
    tasks: DS.hasMany('task', {async: true})
     //children: DS.hasMany('child')
});
