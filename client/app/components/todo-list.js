import Component from '@ember/component';

export default Component.extend({
  store: Ember.inject.service(),
  displayNewTask: false,

  actions : {
    newTaskDisplay(_event) {
      this.set('displayNewTask',true)
    },
    newTaskCancel(_event) {
      this.set('displayNewTask',false)
    },
    newTaskAdd(_event) {
      let title = this.$('input.title').val()
      let task = this.get('store').createRecord('task',{title: title,done:false});
      task.save();
      this.set('displayNewTask',false);
    }
  }
});
