<?php

use App\Entity\Region;
use \App\Entity\User;
use \App\Entity\Adverts\Category;
use DaveJamesMiller\Breadcrumbs\BreadcrumbsGenerator as Crumbs;

Breadcrumbs::for('home', function (Crumbs $trail) {
    $trail->push('Home', route('home'));
});

Breadcrumbs::for('login', function (Crumbs $trail) {
    $trail->parent('home');
    $trail->push('Login', route('login'));
});


Breadcrumbs::for('register', function (Crumbs $trail) {
    $trail->parent('home');
    $trail->push('Register', route('register'));
});


Breadcrumbs::for('password.request', function (Crumbs $trail) {
    $trail->parent('login');
    $trail->push('Password request', route('password.request'));
});

Breadcrumbs::for('password.reset', function (Crumbs $trail) {
    $trail->parent('password.request');
    $trail->push('Password reset', route('password.reset'));
});

Breadcrumbs::for('cabinet', function (Crumbs $trail) {
    $trail->parent('home');
    $trail->push('Cabinet', route('cabinet'));
});

// Admin
Breadcrumbs::for('admin.home', function (Crumbs $trail) {
    $trail->parent('home');
    $trail->push('Admin', route('admin.home'));
});

Breadcrumbs::for('admin.users.index', function (Crumbs $trail) {
    $trail->parent('admin.home');
    $trail->push('Users', route('admin.users.index'));
});

Breadcrumbs::for('admin.users.create', function (Crumbs $trail) {
    $trail->parent('admin.users.index');
    $trail->push('Users create', route('admin.users.create'));
});

Breadcrumbs::for('admin.users.show', function (Crumbs $trail, User $user) {
    $trail->parent('admin.users.index');
    $trail->push($user->name, route('admin.users.show', $user));
});

Breadcrumbs::for('admin.users.edit', function (Crumbs $trail, User $user) {
    $trail->parent('admin.users.show', $user);
    $trail->push('Edit', route('admin.users.edit', $user));
});

//End Admin

// Regions

Breadcrumbs::for('admin.regions.index', function (Crumbs $crumbs) {
    $crumbs->parent('admin.home');
    $crumbs->push('Regions', route('admin.regions.index'));
});

Breadcrumbs::for('admin.regions.create', function (Crumbs $crumbs) {
    $crumbs->parent('admin.regions.index');
    $crumbs->push('Create', route('admin.regions.create'));
});

Breadcrumbs::for('admin.regions.show', function (Crumbs $crumbs, Region $region) {
    if ($parent = $region->parent) {
        $crumbs->parent('admin.regions.show', $parent);
    } else {
        $crumbs->parent('admin.regions.index');
    }
    $crumbs->push($region->name, route('admin.regions.show', $region));
});

Breadcrumbs::for('admin.regions.edit', function (Crumbs $crumbs, Region $region) {
    $crumbs->parent('admin.regions.show', $region);
    $crumbs->push('Edit', route('admin.regions.edit', $region));
});

// Advert Categories

Breadcrumbs::for('admin.adverts.categories.index', function (Crumbs $crumbs) {
    $crumbs->parent('admin.home');
    $crumbs->push('Categories', route('admin.adverts.categories.index'));
});

Breadcrumbs::for('admin.adverts.categories.create', function (Crumbs $crumbs) {
    $crumbs->parent('admin.adverts.categories.index');
    $crumbs->push('Create', route('admin.adverts.categories.create'));
});

Breadcrumbs::for('admin.adverts.categories.show', function (Crumbs $crumbs, Category $category) {
    if ($parent = $category->parent) {
        $crumbs->parent('admin.adverts.categories.show', $parent);
    } else {
        $crumbs->parent('admin.adverts.categories.index');
    }
    $crumbs->push($category->name, route('admin.adverts.categories.show', $category));
});

Breadcrumbs::for('admin.adverts.categories.edit', function (Crumbs $crumbs, Category $category) {
    $crumbs->parent('admin.adverts.categories.show', $category);
    $crumbs->push('Edit', route('admin.adverts.categories.edit', $category));
});
