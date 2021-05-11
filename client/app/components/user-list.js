import Ember from 'ember';
import Component from '@ember/component';
import { inject as service } from '@ember/service';
import Service from '@ember/service';

export default Component.extend({
  store: Ember.inject.service(),
  displayNewUser: false,

  actions : {
    newUserDisplay(_event) {
      this.set('displayNewUser',true)
    },
    newUserDisplay(_event) {
      this.set('displayNewUser',false)
    },
    newUserDisplay(_event) {
      let name = this.$('input.name').val()
      let user = this.get('store').createRecord('user',{name: name});
      task.save();
      this.set('displayNewUser',false);
    }
  }
});
