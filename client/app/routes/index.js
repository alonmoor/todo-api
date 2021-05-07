import Ember from 'ember';
import Route from '@ember/routing/route';
import EmberObject, { computed } from '@ember/object';
import { all } from 'rsvp';





// export default Ember.Route.extend({
//   model() {
//     return Ember.RSVP.hash({
//       users: this.get('store').findAll('user', 1),
//       tasks: this.get('store').findAll('tasks'),
//     });
//   },
// });


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







// export default Route.extend({
//   model() {
//     return TaskData.create({
//       tasks : this.store.findAll('task')
//     });
//   },
// })
//
//
//
//
// filteredOwners: Ember.computed('userName', 'model.@each.users.[]', function() {
//   let userName = this.get('userName');
//
//   return DS.PromiseArray.create({
//     promise: Ember.RSVP.filter(this.get('model').toArray(), owner => {
//       return owner.get('users').then( pets => {
//         return pets.isAny('name', userName);
//       });
//     })
//   });
// })

// export default Route.extend({
//   model() {
//       this.get('store').findAll('user');
//   },
// })







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


export default Ember.Route.extend({
  model() {
    return Ember.RSVP.hash({
      tasks: this.get('store').findAll('task', 1),
      users: this.get('store').findAll('user'),
    });
  },
});


// export default Route.extend({
//   model() {
//     return UserData.create({
//       users : this.store.findAll('user')
//     });
//   },
// });


// export default Route.extend({
//   model() {
//       this.get('store').findAll('user'),
//         this.get('store').findAll('task');
//   },
// });
