import Ember from 'ember';
import Component from '@ember/component';

export default Component.extend({
  store: Ember.inject.service(),

  actions : {
    toggle(_event) {
      this.task.set('done', !this.task.get('done'))
      this.task.save();
    },
    editTitle(_event) {
      this.set('editTitle',true);
      this.$('input.title').focus();
    },
    editTitleDone(event) {
      if ( event.code == "Enter") {
        let title = this.$('.title').val();
        this.task.set('title',title);
        this.task.save();
        this.set('editTitle',false);
        return;
      }
      if ( event.keyCode==27) {
        this.set('editTitle',false);
        return;
      }
    },
    deleteTask(_event) {
      this.task.deleteRecord();
      this.task.save();
    }
  }
});
