import { module, test } from 'qunit';
import { visit } from '@ember/test-helpers';
import { setupApplicationTest } from 'ember-qunit';

module('Acceptance | task list', function(hooks) {
  setupApplicationTest(hooks);
  test('should display tasks in home page', async function (assert) {
    await visit('/');
    assert.equal(this.element.querySelectorAll('.task').length, 3, 'should display 3 tasks');
    assert.equal(this.element.querySelectorAll('.todo').length, 2, 'should display 2 tasks as todo');
    assert.equal(this.element.querySelectorAll('.done').length, 1, 'should display 1 tasks as done');
  });

  test('should add task', async function (assert) {
    await visit('/');
    assert.ok(false);
  });

  test('should mark task as done', async function (assert) {
    await visit('/');
    assert.ok(false);
  });

  test('should change task text', async function (assert) {
    await visit('/');
    assert.ok(false);
  });

  test('should delete task', async function (assert) {
    await visit('/');
    assert.ok(false);
  });


});
