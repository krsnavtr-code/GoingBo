<?php

use App\Http\Controllers\AdminControllers\AdminPagesController;
use App\Http\Controllers\AdminControllers\BlogController;
use App\Http\Controllers\AdminControllers\BusController;
use App\Http\Controllers\AdminControllers\ClubController;
use App\Http\Controllers\AdminControllers\EmployeeController;
use App\Http\Controllers\AdminControllers\FlightController;
use App\Http\Controllers\AdminControllers\HotelController;
use App\Http\Controllers\AdminControllers\PackageController;
use App\Http\Controllers\AdminControllers\SEOController;
use App\Http\Controllers\AdminControllers\SpecialHotelController;
use App\Http\Controllers\AdminControllers\SpecialTaxiController;
use App\Http\Controllers\AdminControllers\TaxiController;
use App\Http\Controllers\AdminControllers\UserController;
use App\Http\Controllers\AdminControllers\WebpageController;
use App\Http\Controllers\AdminControllers\CabController;
use App\Http\Controllers\AdminControllers\CityController;
use App\Http\Controllers\AdminControllers\BusinessLoginController;
use Illuminate\Support\Facades\Route;
use App\Models\Cab;

Route::get('', fn () => view('admin.index'))->name('admin_home');
Route::get('index', fn () => redirect()->route('admin_home'));

Route::controller(AdminPagesController::class)->prefix("blog")->group(function () {
    Route::get('', '');
});
Route::controller(BusinessLoginController::class)->prefix("business-login")->group(function () {
    
    Route::get('', 'ui_login');
    Route::post('', 'web_login');
    Route::post('register',  'web_store') ;

    Route::get('/dashboard', 'index');

    // Cab business routes
    Route::prefix('cab')->group(function () {
        Route::get('/add-route', 'CabController@addRoute')->name('cab.add_route');
        Route::get('/add', 'CabController@add')->name('cab.add');
        Route::get('/edit', 'CabController@edit')->name('cab.edit');
        Route::get('/view-routes', 'CabController@viewRoutes')->name('cab.view_routes');
        Route::get('/view', 'CabController@view')->name('cab.view');
    });

    // Hotel business routes
    Route::controller(HotelController::class)->prefix('hotel')->group(function () {
        Route::get('/add',  'create');
        Route::post('/store',  'store');
        Route::get('/edit', 'HotelController@edit')->name('hotel.edit');
        Route::get('/view-rooms', 'HotelController@viewRooms')->name('hotel.view_rooms');
    });

    // Common routes
    Route::get('/account-info', 'AccountController@info')->name('account.info');
    Route::get('/logout', 'logout');
    
});

Route::controller(BlogController::class)->prefix("blog")->group(function () {
    Route::get('', 'ui_view_blogs');
    Route::get('toggle/{blogId}', 'web_toggle_blog_status');
    Route::prefix("editor")->group(function () {
        Route::get('', 'ui_editor');
        Route::post('', 'web_editor');
    });
    Route::prefix("category")->group(function () {
        Route::get('', 'ui_view_categories');
        Route::prefix("create")->group(function () {
            Route::get('', 'ui_create_category');
            Route::post('', 'web_create_category');
        });
        Route::prefix("edit")->group(function () {
            Route::get('{catId}', 'ui_edit_category');
            Route::post('', 'web_edit_category');
        });
    });
});
Route::controller(BusController::class)->prefix("bus")->group(function () {
    Route::get('', '');
});
Route::controller(CabController::class)->prefix("cab")->group(function () {
    Route::get('', 'ui_view_cabs');
    Route::post('approve/{cabId}', 'web_approve_cab');
    Route::get('toggle/{cabId}', 'api_toggle_cab');
    Route::prefix("add")->group(function () {
        Route::get('', 'ui_add_cab');
        Route::post('', 'web_add_cab');
    });
    Route::prefix("edit")->group(function () {
        Route::get('{cabId}', 'ui_edit_cab');
        Route::post('{cabId}', 'web_edit_cab');
    });


    Route::get('/delete/{cabId}', 'ui_delete_cab');


    Route::prefix("route")->group(function () {
        Route::get('', 'ui_view_cab_routes');
        Route::post('toggle/{cabId}', 'web_toggle_cab');
        Route::prefix("add")->group(function () {
            Route::get('{cabId}', 'ui_add_cab_route');
            Route::post('', 'web_add_cab_route');
        });
        Route::prefix("edit")->group(function () {
            Route::get('{cabId}', 'ui_edit_cab_route');
            Route::post('', 'web_edit_cab_route');
        });
    });
});
Route::controller(ClubController::class)->prefix("membership")->group(function () {
    Route::get('', '');
});
Route::controller(CityController::class)->prefix("city")->group(function () {
    Route::get('', 'ui_view_cities');
    Route::prefix("add")->group(function () {
        Route::get('', 'ui_add_city');
        Route::post('', 'web_add_city');
    });
    Route::prefix("edit")->group(function () {
        Route::get('{cityId}', 'ui_edit_city');
        Route::post('', 'web_edit_city');
    });
});
Route::controller(EmployeeController::class)->group(function () {
    Route::withoutMiddleware('AdminAuth')->group(function () {
        Route::prefix('login')->group(function () {
            Route::get('', 'ui_login')->name('admin_login');
            Route::post('', 'web_login');
        });
        Route::any('logout', 'web_logout')->name('admin_logout');
    });

    Route::prefix('employee')->group(function () {
        Route::get('', 'ui_view_emps');
        Route::get('togglestatus', 'web_toggle_status');
        Route::prefix('create')->group(function () {
            Route::get('', 'ui_create_emp');
            Route::post('', 'web_create_emp');
        });
        Route::prefix('edit')->group(function () {
            Route::get('{empId}', 'ui_edit_emp');
            Route::post('', 'web_edit_emp');
        });
    });

    Route::prefix('jobrole')->group(function () {
        Route::get('', 'ui_view_roles');
        Route::prefix('create')->group(function () {
            Route::get('', 'ui_create_role');
            Route::post('', 'web_create_role');
        });
        Route::prefix('edit')->group(function () {
            Route::get('{roleId}', 'ui_edit_role');
            Route::post('', 'web_edit_role');
        });
    });
});
Route::controller(FlightController::class)->prefix("flight")->group(function () {
    Route::get('', '');
});
Route::controller(HotelController::class)->prefix("hotel")->group(function () {
    Route::get('', '');
});
Route::controller(PackageController::class)->prefix("holidaypackages")->group(function () {
    Route::get('', 'ui_view_package');
    Route::prefix("add")->group(function () {
        Route::get('', 'ui_add_package');
        Route::post('', 'web_add_package');
    }); 
    Route::prefix("edit")->group(function () {
        Route::get('{packageId}', 'ui_edit_package');
        Route::post('{packageId}', 'web_edit_package');
    });

    Route::prefix("activities")->group(function(){
        Route::post('{packageId}', 'web_add_activity');
        Route::get('{packageId}', 'ui_view_activity');
        
    });
});
Route::controller(SEOController::class)->prefix("special-hotel")->group(function () {
    Route::get('', '');
});
Route::controller(SpecialHotelController::class)->prefix("special-hotel")->group(function () {
    Route::get('', '');
});
Route::controller(SpecialTaxiController::class)->prefix("special-taxi")->group(function () {
    Route::get('', '');
});
Route::controller(TaxiController::class)->prefix("taxi")->group(function () {
    Route::get('', '');
});
Route::controller(UserController::class)->prefix("user")->group(function () {
    Route::get('', '');
});
Route::controller(WebpageController::class)->prefix("webpage")->group(function () {
    Route::get('', 'ui_view_webpages');
    Route::get('toggle/{webpageId}', 'web_toggle_webpage_status');
    Route::prefix('add')->group(function () {
        Route::get('', 'ui_add_webpage');
        Route::post('', 'web_add_webpage');
    });
    Route::prefix('edit')->group(function () {
        Route::get('{webpageId}', 'ui_edit_webpage');
        Route::post('', 'web_edit_webpage');
    });
});


