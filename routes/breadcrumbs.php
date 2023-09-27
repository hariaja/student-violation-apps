<?php // routes/breadcrumbs.php

use Diglactic\Breadcrumbs\Breadcrumbs;
use Diglactic\Breadcrumbs\Generator as BreadcrumbTrail;

// Home
Breadcrumbs::for('home', function (BreadcrumbTrail $trail) {
  $trail->push(trans('page.overview.title'), route('home'));
});

// Roles Breadcrumbs
Breadcrumbs::for('roles.index', function (BreadcrumbTrail $trail) {
  $trail->parent('home');
  $trail->push(trans('page.roles.index'), route('roles.index'));
});

Breadcrumbs::for('roles.create', function (BreadcrumbTrail $trail) {
  $trail->parent('roles.index');
  $trail->push(trans('page.roles.create'), route('roles.create'));
});

Breadcrumbs::for('roles.edit', function (BreadcrumbTrail $trail, $role) {
  $trail->parent('roles.index');
  $trail->push(trans('page.roles.edit'), route('roles.edit', $role->uuid));
});

Breadcrumbs::for('roles.show', function (BreadcrumbTrail $trail, $role) {
  $trail->parent('roles.index');
  $trail->push(trans('page.roles.show'), route('roles.show', $role->uuid));
});
// Roles Breadcrumbs

// Users Breadcrumbs
Breadcrumbs::for('users.index', function (BreadcrumbTrail $trail) {
  $trail->parent('home');
  $trail->push(trans('page.users.index'), route('users.index'));
});

Breadcrumbs::for('users.create', function (BreadcrumbTrail $trail) {
  $trail->parent('users.index');
  $trail->push(trans('page.users.create'), route('users.create'));
});

Breadcrumbs::for('users.edit', function (BreadcrumbTrail $trail, $user) {
  $trail->parent('users.index');
  $trail->push(trans('page.users.edit'), route('users.edit', $user->uuid));
});

Breadcrumbs::for('users.show', function (BreadcrumbTrail $trail, $user) {
  $trail->parent('users.index');
  $trail->push(trans('page.users.show'), route('users.show', $user->uuid));
});
// Users Breadcrumbs

// achievements Breadcrumbs
Breadcrumbs::for('achievements.index', function (BreadcrumbTrail $trail) {
  $trail->parent('home');
  $trail->push(trans('page.achievements.index'), route('achievements.index'));
});

Breadcrumbs::for('achievements.create', function (BreadcrumbTrail $trail) {
  $trail->parent('achievements.index');
  $trail->push(trans('page.achievements.create'), route('achievements.create'));
});

Breadcrumbs::for('achievements.edit', function (BreadcrumbTrail $trail, $achievement) {
  $trail->parent('achievements.index');
  $trail->push(trans('page.achievements.edit'), route('achievements.edit', $achievement->uuid));
});

Breadcrumbs::for('achievements.show', function (BreadcrumbTrail $trail, $achievement) {
  $trail->parent('achievements.index');
  $trail->push(trans('page.achievements.show'), route('achievements.show', $achievement->uuid));
});
// achievements Breadcrumbs

// violations Breadcrumbs
Breadcrumbs::for('violations.index', function (BreadcrumbTrail $trail) {
  $trail->parent('home');
  $trail->push(trans('page.violations.index'), route('violations.index'));
});

Breadcrumbs::for('violations.create', function (BreadcrumbTrail $trail) {
  $trail->parent('violations.index');
  $trail->push(trans('page.violations.create'), route('violations.create'));
});

Breadcrumbs::for('violations.edit', function (BreadcrumbTrail $trail, $violation) {
  $trail->parent('violations.index');
  $trail->push(trans('page.violations.edit'), route('violations.edit', $violation->uuid));
});

Breadcrumbs::for('violations.show', function (BreadcrumbTrail $trail, $violation) {
  $trail->parent('violations.index');
  $trail->push(trans('page.violations.show'), route('violations.show', $violation->uuid));
});
// violations Breadcrumbs