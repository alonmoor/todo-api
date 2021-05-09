import DS from 'ember-data';
import Model from 'ember-data/model';
import { hasMany } from 'ember-data/relationships';

export default DS.Model.extend({
  title : DS.attr('string'),
  done  : DS.attr('boolean',{defaultValue: false}),
  users: DS.hasMany('user', {async: true})
});


 
