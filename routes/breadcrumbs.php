<?php

// Home
Breadcrumbs::for('home', function ($trail) {
    $trail->push('Home', route('home'));
});

//Home > userInfo
Breadcrumbs::for('userInfo.index', function ($trail) {
    $trail->parent('home');
    $trail->push('User', route('userInfo.index'));
});

//Home > appList

Breadcrumbs::for('appList.index', function ($trail) {
    $trail->parent('home');
    $trail->push('appList', route('appList.index'));
});

// Home > userInfo > userInfoTrash

Breadcrumbs::for('userInfoTrash', function ($trail) {
    $trail->parent('userInfo.index');
    $trail->push('User List Trash', route('userInfoTrash'));
});

// Breadcrumbs::for('blog', function ($trail) {
//     $trail->parent('home');
//     $trail->push('Blog', route('blog'));
// });

// // Home > Blog > [Category]
// Breadcrumbs::for('category', function ($trail, $category) {
//     $trail->parent('blog');
//     $trail->push($category->title, route('category', $category->id));
// });

// // Home > Blog > [Category] > [Post]
// Breadcrumbs::for('post', function ($trail, $post) {
//     $trail->parent('category', $post->category);
//     $trail->push($post->title, route('post', $post->id));
// });

/*
|--------------------------------------------------------------------------
| SALES Breadcrumbs -Start
|--------------------------------------------------------------------------
*/
Breadcrumbs::for('Dashboard', function ($trail) {
    $trail->push('Home', route('Dashboard'));
});


Breadcrumbs::for('InvoiceListing', function ($trail) {
    $trail->parent('Dashboard');
    $trail->push('Invoice', route('InvoiceListing'));
});


Breadcrumbs::for('NewInvoice', function ($trail) {
    $trail->parent('Dashboard');
    $trail->push('New Invoice', route('NewInvoice'));
});

Breadcrumbs::for('Sales-Settings', function ($trail) {
    $trail->parent('Dashboard');
    $trail->push('Sales Settings', route('Sales-Settings'));
});

/*
|--------------------------------------------------------------------------
| SALES Breadcrumbs -End
|--------------------------------------------------------------------------
*/


/*
|--------------------------------------------------------------------------
| INVENTORY Breadcrumbs -Start
|--------------------------------------------------------------------------
*/





Breadcrumbs::for('WarehouseListing', function ($trail) {
    $trail->parent('Dashboard');
    $trail->push('Warehouse', route('WarehouseListing'));
});


Breadcrumbs::for('NewWarehouse', function ($trail) {
    $trail->parent('Dashboard');
    $trail->push('New Warehouse', route('NewWarehouse'));
});



Breadcrumbs::for('WarehouseManagerListing', function ($trail) {
    $trail->parent('Dashboard');
    $trail->push('Warehouse Manager', route('WarehouseInchargeListing'));
});


Breadcrumbs::for('NewWarehouseManager', function ($trail) {
    $trail->parent('Dashboard');
    $trail->push('New Warehouse Manager', route('NewWarehouseManager'));
});

Breadcrumbs::for('WarehouseInchargeListing', function ($trail) {
    $trail->parent('Dashboard');
    $trail->push('Warehouse Incharge', route('WarehouseInchargeListing'));
});


Breadcrumbs::for('NewWarehouseIncharge', function ($trail) {
    $trail->parent('Dashboard');
    $trail->push('New Warehouse Incharge', route('NewWarehouseIncharge'));
});

Breadcrumbs::for('ProductListing', function ($trail) {
    $trail->parent('Dashboard');
    $trail->push('Products', route('ProductListing'));
});


Breadcrumbs::for('NewProduct', function ($trail) {
    $trail->parent('Dashboard');
    $trail->push('New Product', route('NewProduct'));
});



Breadcrumbs::for('AdjustmentListing', function ($trail) {
    $trail->parent('Dashboard');
    $trail->push('Inventory Adjustments', route('AdjustmentListing'));
});


Breadcrumbs::for('NewAdjustment', function ($trail) {
    $trail->parent('Dashboard');
    $trail->push('New Inventory Adjustment', route('NewAdjustment'));
});


Breadcrumbs::for('UnitListing', function ($trail) {
    $trail->parent('Dashboard');
    $trail->push('Units', route('UnitListing'));
});


Breadcrumbs::for('NewUnit', function ($trail) {
    $trail->parent('Dashboard');
    $trail->push('New Unit', route('NewUnit'));
});


Breadcrumbs::for('BrandListing', function ($trail) {
    $trail->parent('Dashboard');
    $trail->push('Brands', route('BrandListing'));
});


Breadcrumbs::for('NewBrand', function ($trail) {
    $trail->parent('Dashboard');
    $trail->push('New Brand', route('NewBrand'));
});


Breadcrumbs::for('ManufacturerListing', function ($trail) {
    $trail->parent('Dashboard');
    $trail->push('Manufacturers', route('ManufacturerListing'));
});


Breadcrumbs::for('NewManufacturer', function ($trail) {
    $trail->parent('Dashboard');
    $trail->push('New Manufacturer', route('NewManufacturer'));
});


Breadcrumbs::for('AttributeListing', function ($trail) {
    $trail->parent('Dashboard');
    $trail->push('Attributes', route('AttributeListing'));
});


Breadcrumbs::for('NewAttribute', function ($trail) {
    $trail->parent('Dashboard');
    $trail->push('New Attribute', route('NewAttribute'));
});


Breadcrumbs::for('AccountsListing', function ($trail) {
    $trail->parent('Dashboard');
    $trail->push('Accounts', route('AccountsListing'));
});


Breadcrumbs::for('NewAccount', function ($trail) {
    $trail->parent('Dashboard');    
    $trail->push('New Account', route('NewAccount'));
});

Breadcrumbs::for('StoreManagement', function ($trail) {
    $trail->parent('Dashboard');
    $trail->push('Store Management', route('StoreManagement'));
});

Breadcrumbs::for('Newstoremanagement', function ($trail) {
    $trail->parent('Dashboard');
    $trail->push('New Store Management', route('Add-StoreManagement'));
});

Breadcrumbs::for('RackManagement', function ($trail) {
    $trail->parent('Dashboard');
    $trail->push('Rack Management', route('RackManagement'));
});

Breadcrumbs::for('Newrackmanagement', function ($trail) {
    $trail->parent('Dashboard');
    $trail->push('New Rack Management', route('Add-RackManagement'));
});

Breadcrumbs::for('categorylist', function ($trail) {
    $trail->parent('Dashboard');
    $trail->push('Category List', route('CategoryList'));
});

Breadcrumbs::for('newcategory', function ($trail) {
    $trail->parent('Dashboard');
    $trail->push('New Category', route('Add-category'));
});

Breadcrumbs::for('settingslist', function ($trail) {
    $trail->parent('Dashboard');
    $trail->push('Settings List', route('Settings'));
});

Breadcrumbs::for('New Settings', function ($trail) {
    $trail->parent('Dashboard');
    $trail->push('New Settings', route('Add-settings'));
});



/*
|--------------------------------------------------------------------------
| INVENTORY Breadcrumbs -END
|--------------------------------------------------------------------------
*/




