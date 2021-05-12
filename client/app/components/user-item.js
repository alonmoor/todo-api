import Ember from 'ember';
import Component from '@ember/component';
// import Service from '@ember/service';
import { inject as service } from '@ember/service';

export default Component.extend({
  store: Ember.inject.service(),

  actions : {
    toggle(_event) {
      this.share.set('share', !this.user.get('share'))
      this.user.save();
    },
    editShareDone(event) {
      if ( event.code == "Click") {
        let title = this.$('.title').val();
        this.user.set('share',share);
        this.user.save();
        this.set('editTitle',false);
        return;
      }
      if ( event.keyCode==27) {
        this.set('editTitle',false);
        return;
      }
    },
  }
});
