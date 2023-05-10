<?php

use Illuminate\Support\Facades\Route;


Route::prefix('benutzer')->group(function () {
    Route::controller('UserController')->group(function () {
        Route::get('/einstellungen/{id}', 'show')->name('user.settings');

        Route::patch('action/savesettings/{id}', 'update')->name('usersettings');
    });
});

Route::prefix('admin')->group(function () {
    Route::controller('AdminController')->group(function () {
        Route::get('/', 'index')->name('admin.dashboard');
    });

    Route::prefix('logs')->group(function () {
        Route::controller('LogsController')->group(function () {
            Route::get('/', 'index')->name('admin.logs');
        });
    });

    Route::prefix('ansprechpartner')->group(function () {
        Route::controller('ContactPartnersController')->group(function () {
            Route::get('/', 'index')->name('admin.contactmanagement');
            Route::get('bearbeiten/{contactpartner}', 'edit')->name('admin.contactedit');
            Route::get('erstellen', 'create')->name('admin.contactcreate');

            Route::post('action/edit/{id}', 'update')->name('contacteditPost');
            Route::post('action/create', 'store')->name('contactcreatePost');

            Route::delete('action/delete/{contactpartner}', "destroy")->name("contactpartners.destroy");
        });
    });

    Route::prefix('benutzerverwaltung')->group(function () {
        Route::controller('UserAdminController')->group(function () {
            Route::get('/', 'index')->name('admin.usermanagement');
            Route::get('bearbeiten/{id}', 'edit')->name('admin.useredit');
            Route::get('erstellen', 'create')->name('admin.usercreate');
            Route::get('import', 'importView')->name('admin.importuser');

            Route::post('action/edit/{id}', 'update')->name('usereditPost');
            Route::post('action/create', 'store')->name('usercreatePost');
            Route::post('action/importUser', 'importStore')->name('importusers');

            Route::delete('action/delete/{userid}', "destroy")->name("users.destroy");
        });
    });

    Route::prefix('gruppenverwaltung')->group(function () {
        Route::controller('GroupController')->group(function () {
            Route::get('/', 'index')->name('admin.groupmanagement');
            Route::get('bearbeiten/{id}', 'edit')->name('admin.groupedit');
            Route::get('erstellen', 'create')->name('admin.groupcreate');

            Route::post('action/create', 'store')->name('groupcreate');
            Route::post('action/edit/{id}', 'update')->name('groupedit');

            Route::delete('action/delete/{id}', 'delete')->name('groups.destroy');
        });
    });

    Route::prefix('faq')->group(function () {
        Route::controller('FaqAdminController')->group(function () {
            Route::get('/', 'index')->name('admin.faqmanagement');
            Route::get('bearbeiten/{id}', 'edit')->name('admin.faqedit');
            Route::get('erstellen', 'create')->name('admin.faqnew');

            Route::post('action/edit/{id}', 'update')->name('faqedit');
            Route::post('action/new', 'store')->name('faqnew');

            Route::delete('action/delete/{id}', 'destroy')->name('faq.destroy');
        });
    });

    Route::prefix('faqkategorie')->group(function () {
        Route::controller('FaqCategoriesController')->group(function () {
            Route::get('/', 'index')->name('admin.faqcategories');
            Route::get('bearbeiten/{id}', 'edit')->name('admin.faqcategories.edit');
            Route::get('erstellen', 'create')->name('admin.faqcategories.create');

            Route::post('action/edit/{id}', 'update')->name('faqcategoriesedit');
            Route::post('action/new', 'store')->name('faqcategoriesnew');

            Route::delete('action/delete/{id}', 'destroy')->name('faqcategories.destroy');
        });
    });

});

Route::prefix('inventarisierung')->group(function () {
    Route::controller('InventoryController')->group(function () {
        Route::get('/', 'index')->name('inventory.dashboard');
    });

    Route::prefix('assets')->group(function () {
        Route::controller('AssetController')->group(function () {
            Route::get('/', 'index')->name('inventory.assets.dashboard');
            Route::get('erstellen', 'create')->name('inventory.assets.create');
            Route::get('bearbeiten/{asset}', 'edit')->name('inventory.assets.edit');
            Route::get('info/{asset}', 'show')->name('inventory.assets.info');

            Route::post('action/create', 'store')->name('assetsCreatePost');
            Route::post('action/create/misc', 'storeMisc')->name('assetsCreateMiscPost');
            Route::post('action/update/{id}', 'update')->name('assetsPost');
            Route::post('action/update/misc/{id}', 'updateMisc')->name('assetsMiscPost');

            Route::delete('action/delete/{asset}', 'destroy')->name('assets.destroy');
        });

        Route::controller('AssetAdminController')->group(function () {
            Route::get('zuweisen/{asset}', 'edit')->name('inventory.assets.assign');

            Route::post('action/assign/{id}', 'update')->name('assetAssign');

            Route::delete('action/rentalDelete/{id}', 'destroy')->name('assetassign.destroy');
        });
    });

    Route::prefix('lizenzen')->group(function () {
        Route::controller('LicenseController')->group(function () {
            Route::get('/', 'index')->name('inventory.license.dashboard');
            Route::get('erstellen', 'create')->name('inventory.license.create');
            Route::get('bearbeiten/{license}', 'edit')->name('inventory.license.edit');
            Route::get('info/{license}', 'show')->name('inventory.license.show');

            Route::post('action/create', 'store')->name('licenseCreatePost');
            Route::post('action/update/{id}', 'update')->name('licensePost');

            Route::delete('action/delete/{license}', 'destroy')->name('license.destroy');

        });

        Route::controller('LicenseAdminController')->group(function () {
            Route::get('zuweisen/{license}', 'edit')->name('inventory.license.assign');

            Route::post('action/assign/{id}', 'update')->name('licenseAssign');

            Route::delete('action/rentalDelete/{id}', 'destroy')->name('licenseassign.destroy');
        });
    });

    Route::prefix('kategorien')->group(function () {
        Route::controller('AssetCategoriesController')->group(function () {
            Route::get('/', 'index')->name('inventory.categories.dashboard');
            Route::get('erstellen', 'create')->name('inventory.categories.create');
            Route::get('bearbeiten/{assetcategory}', 'edit')->name('inventory.categories.edit');

            Route::post('action/create', 'store')->name('inventorycategoriesCreatePost');
            Route::post('action/update/{id}', 'update')->name('inventorycategoriesPost');

            Route::delete('action/delete/{assetcategory}', 'destroy')->name('inventorycategories.destroy');
        });
    });

    Route::prefix('orte')->group(function () {
        Route::controller('AssetLocationController')->group(function () {
            Route::get('/', 'index')->name('inventory.location.dashboard');
            Route::get('erstellen', 'create')->name('inventory.location.create');
            Route::get('bearbeiten/{assetlocation}', 'edit')->name('inventory.location.edit');

            Route::post('action/create', 'store')->name('inventorylocationCreatePost');
            Route::post('action/update/{id}', 'update')->name('inventorylocationPost');

            Route::delete('action/delete/{assetlocation}', 'destroy')->name('inventorylocation.destroy');
        });
    });

    Route::prefix('hersteller')->group(function () {
        Route::controller('AssetManufacturerController')->group(function () {
            Route::get('/', 'index')->name('inventory.manufacturer.dashboard');
            Route::get('erstellen', 'create')->name('inventory.manufacturer.create');
            Route::get('bearbeiten/{assetmanufacturer}', 'edit')->name('inventory.manufacturer.edit');

            Route::post('action/create', 'store')->name('inventorymanufacturerCreatePost');
            Route::post('action/update/{id}', 'update')->name('inventorymanufacturerPost');

            Route::delete('action/delete/{assetmanufacturer}', 'destroy')->name('inventorymanufacturer.destroy');
        });
    });

    Route::prefix('modelle')->group(function () {
        Route::controller('AssetModelController')->group(function () {
            Route::get('/', 'index')->name('inventory.model.dashboard');
            Route::get('erstellen', 'create')->name('inventory.model.create');
            Route::get('bearbeiten/{assetmodel}', 'edit')->name('inventory.model.edit');

            Route::post('action/create', 'store')->name('inventorymodelCreatePost');
            Route::post('action/update/{id}', 'update')->name('inventorymodelPost');

            Route::delete('action/delete/{assetmodel}', 'destroy')->name('inventorymodel.destroy');
        });
    });

    Route::prefix('status')->group(function () {
        Route::controller('AssetStatusController')->group(function () {
            Route::get('/', 'index')->name('inventory.status.dashboard');
            Route::get('erstellen', 'create')->name('inventory.status.create');
            Route::get('bearbeiten/{assetstatus}', 'edit')->name('inventory.status.edit');

            Route::post('action/create', 'store')->name('inventorystatusCreatePost');
            Route::post('action/update/{id}', 'update')->name('inventorystatusPost');

            Route::delete('action/delete/{assetstatus}', 'destroy')->name('inventorystatus.destroy');

        });
    });

    Route::prefix('abteilungen')->group(function () {
        Route::controller('AssetDepartmentController')->group(function () {
            Route::get('/', 'index')->name('inventory.department.dashboard');
            Route::get('erstellen', 'create')->name('inventory.department.create');
            Route::get('bearbeiten/{assetdepartment}', 'edit')->name('inventory.department.edit');

            Route::post('action/create', 'store')->name('inventorydepartmentCreatePost');
            Route::post('action/update/{id}', 'update')->name('inventorydepartmentPost');

            Route::delete('action/delete/{assetdepartment}', 'destroy')->name('inventorydepartment.destroy');
        });
    });

    Route::prefix('personen')->group(function () {
        Route::controller('AssetPeopleController')->group(function () {
            Route::get('/', 'index')->name('inventory.people.dashboard');
            Route::get('info/{user}', 'show')->name('inventory.people.show');
        });

        Route::controller('AssetAdminController')->group(function () {
            Route::delete('action/rentalDelete/{id}', 'destroy')->name('assetpeople.destroy');
        });
    });
});

Route::prefix('ticket')->group(function () {
    Route::controller('TicketController')->group(function () {
        Route::get('/', 'index')->name('dashboard');
        Route::get('post/{ticket}', 'show')->name('ticket.post');
        Route::get('erstellen', 'create')->name('ticket.create');

        Route::post('action/create', 'store')->name('ticketcreate');
    });

    Route::controller('TicketMessageController')->group(function () {
        Route::post('message/{id}', 'store')->name('ticketmessagepost');
    });

    Route::controller('TicketAdminController')->group(function () {
        Route::get('admin', 'index')->name('ticket.dashboard');
        Route::get('bearbeiten/{ticket}', 'edit')->name('ticket.post.edit');

        Route::post('action/edit/{id}', 'update')->name('ticketpostedit');

        Route::patch('action/close/{id}', 'closeTicket')->name('ticketclose');
        Route::patch('action/open/{id}', 'openTicket')->name('ticketopen');
    });

    Route::prefix('admin')->group(function () {
        Route::prefix('kategorien')->group(function () {
            Route::controller('TicketCategoryController')->group(function () {
                Route::get('/', 'index')->name('ticket.categories.dashboard');
                Route::get('erstellen', 'create')->name('ticket.categories.create');
                Route::get('bearbeiten/{ticketcategory}', 'edit')->name('ticket.categories.edit');

                Route::post('action/edit/{id}', 'update')->name('ticketcategoriesedit');
                Route::post('action/create', 'store')->name('ticketcategoriescreate');

                Route::delete('action/delete/{ticketcategory}', 'destroy')->name('ticketcategories.destroy');
            });
        });

        Route::prefix('status')->group(function () {
            Route::controller('TicketStatusController')->group(function () {
                Route::get('/', 'index')->name('ticket.status.dashboard');
                Route::get('erstellen', 'create')->name('ticket.status.create');
                Route::get('bearbeiten/{ticketstatus}', 'edit')->name('ticket.status.edit');

                Route::post('action/edit/{id}', 'update')->name('ticketstatusedit');
                Route::post('action/create', 'store')->name('ticketstatuscreate');

                Route::delete('action/delete/{ticketstatus}', 'destroy')->name('ticketstatus.destroy');
            });
        });

        Route::prefix('archiv')->group(function () {
            Route::controller('ArchiveController')->group(function () {
                Route::get('/', 'index')->name('ticket.archive.dashboard');
                Route::get('post/{ticket}', 'show')->name('ticket.archive.post');

                Route::delete('action/delete/{ticket}', 'destroy')->name('ticketarchive.destroy');
            });
        });

    });

});


