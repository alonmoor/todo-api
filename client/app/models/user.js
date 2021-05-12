import DS from 'ember-data';
import Model from 'ember-data/model';
import { hasMany } from 'ember-data/relationships';

export default DS.Model.extend({
    name : DS.attr('string'),
    share  : DS.attr('boolean',{defaultValue: false}),
    tasks: DS.hasMany('task', {async: true})
});
