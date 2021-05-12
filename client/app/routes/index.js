import Ember from 'ember';
import Route from '@ember/routing/route';
import EmberObject, { computed } from '@ember/object';
import { all } from 'rsvp';


const TaskData = EmberObject.extend({
  tasks: null,

  total : computed('tasks.[]', 'tasks.@each.{isDeleted,done}', function() {
    let tasks = this.get('tasks')
    let cc = 0;
    tasks.forEach(function(vv) {
      if ( !vv.isDeleted ) {
        cc++;
      }
    })
    return cc;
  }),
  done : computed('tasks.[]','tasks.@each.{isDeleted,done}', function() {
    let tasks = this.get('tasks')

    let cc = 0;
    tasks.forEach(function(vv) {
      if ( vv.done && !vv.isDeleted ) {
        cc++;
      }
    })
    return cc;
  }),
  todo : computed('tasks.[]','tasks.@each.{isDeleted,done}', function() {
    let tasks = this.get('tasks')
    let cc = 0;
    tasks.forEach(function(vv) {
      if ( !vv.done && !vv.isDeleted) {
        cc++;
      }
    })
    return cc;
  }),
});

//=====================================================================================


const UserData = EmberObject.extend({
    users: null,

    total : computed('users.[]', 'users.@each.{isDeleted,name}', function() {
        let users = this.get('users')
        let cc = 0;
        users.forEach(function(vv) {
            if ( !vv.isDeleted ) {
                cc++;
            }
        })
        return cc;
    }),
    name : computed('users.[]','users.@each.{isDeleted,name}', function() {

      let users = this.get('users')

        let cc = 0;
        users.forEach(function(vv) {
            if ( vv.name && !vv.isDeleted ) {
                cc++;
            }
        })
        return cc;
    }),

});

//=======================================================================


// export default Ember.Route.extend({
//   model() {
//     return Ember.RSVP.hash({
//       tasks: this.get('store').findAll('task', 1),
//       users: this.get('store').findAll('user'),
//     });
//   },
//
// });


export default Route.extend({
  model() {
    return TaskData.create({
      tasks : this.store.findAll('task')
    });
  },
})

//=======================================================================
