<?php
/**
 * This is a routes file.
 *
 * The route and controller@method can be set in the format
 * route => controller@method
 * '/home' => 'home@index',
 *
 * route
 * '/article/show/{id}'
 *
 * {id} params
 *
 * or route
 * '/articles/page/{page}/sort/{sort}'
 *
 * {page} .. {sort} params
 *
 *
 * params will be added
 * and available in the controller
 * automatically in the variable $this->data[page]|$this->data[sort]...
 *
 */


return [
    '/' => 'park@showAll',
    '/home' => 'park@showAll',
    '/catalog/park/all' => 'park@showAll',
    '/catalog/cars/all' => 'cars@showAll',
    '/avtopark/create' => 'park@create',
    '/avtopark/edit/{id}' => 'park@edit',
    '/avtopark/save' => 'park@save',
    '/login' => 'authorization@login',
    '/avtopark/delete/{id}' => 'park@delPark',
    '/car/delete/{id}' => 'cars@delete',
    '/car/remove-from-park/{id}' => 'cars@removeFromPark',
    //'/logout' => 'authorization@logout',
]











?>



