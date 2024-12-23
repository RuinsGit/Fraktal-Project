<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AboutController;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\BlogController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ContactController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\ProfileController;

use App\Http\Controllers\Admin\ServiceController;
use App\Http\Controllers\Admin\SubCategoryController;
use App\Http\Controllers\Admin\ContactMessageController;
use App\Http\Controllers\Admin\LeaderController;
use App\Http\Controllers\Admin\GalleryController;
use App\Http\Controllers\Admin\ProductVideoController;
use App\Http\Controllers\Admin\HeaderController;
use App\Http\Controllers\Admin\CompanyController;
use App\Http\Controllers\Admin\PartnerController;
use App\Http\Controllers\Admin\StudyProgramController;
use App\Http\Controllers\Admin\CommentController;
use App\Http\Controllers\Admin\CompanyNameController;
use App\Http\Controllers\Admin\AdvantageController;
use App\Http\Controllers\Admin\AboutCompanyController;
use App\Http\Controllers\Admin\AboutVisionController;
use App\Http\Controllers\Admin\HistoryController;
use App\Http\Controllers\Admin\CourseController;
use App\Http\Controllers\Admin\ServicesTitleController;
use App\Http\Controllers\Admin\EducationTitleController;
use App\Http\Controllers\Admin\DigitalPsychologyTitleController;
use App\Http\Controllers\Admin\PsychologyTextController;
use App\Http\Controllers\Admin\HumanDesignController;
use App\Http\Controllers\Admin\HumanContentController;
use App\Http\Controllers\Admin\GalleryVideoController;
use App\Http\Controllers\Admin\BlogTitleController;
use App\Http\Controllers\Admin\ContactTitleController;
use App\Http\Controllers\Admin\HomeTitleController;
use App\Http\Controllers\Admin\BlogTypeController;
use App\Http\Controllers\Admin\StudyContentController;
use App\Http\Controllers\Admin\TranslationController;
use App\Http\Controllers\Admin\CourseTypeController;
use App\Http\Controllers\Admin\CourseRouteController;





/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});


Route::prefix('admin')->name('admin.')->group(function () {
    // Main admin route - redirects to the login page
    Route::get('/', function () {
        return redirect()->route('admin.login');
    });

    // ------------------------- Login Routes Started -------------------------
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login-handle', [AuthController::class, 'login'])->name('handle-login');
    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
    // ------------------------- Login Routes Ended -------------------------

   
    Route::middleware(['auth:admin'])->group(function () {
       // ------------------------- Dashboard Routes Started -------------------------
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
        
        Route::get('/profile', [ProfileController::class, 'index'])->name('profile');
        Route::post('/profile/update', [ProfileController::class, 'update'])->name('profile.update');
        // ------------------------- Dashboard Routes Ended -------------------------



        
        // ------------------------- Category Routes Started -------------------------
        Route::controller(CategoryController::class)->prefix('category')->name('category.')->group(function () {
            Route::get('/', 'index')->name('index');
            Route::get('/create', 'create')->name('create');
            Route::post('/store', 'store')->name('store');
            Route::get('/edit/{id}', 'edit')->name('edit');
            Route::post('/update/{id}', 'update')->name('update');
            Route::get('/delete/{id}', 'destroy')->name('destroy');
        });
        // ------------------------- Category Routes Ended -------------------------




       // ------------------------- SubCategory Routes Started -------------------------
        Route::prefix('sub-category')->name('sub-category.')->group(function () {
            Route::get('/', [SubCategoryController::class, 'index'])->name('index');
            Route::get('/create', [SubCategoryController::class, 'create'])->name('create');
            Route::post('/store', [SubCategoryController::class, 'store'])->name('store');
            Route::get('/{id}/edit', [SubCategoryController::class, 'edit'])->name('edit');
            Route::post('/{id}/update', [SubCategoryController::class, 'update'])->name('update');
            Route::get('/{id}/delete', [SubCategoryController::class, 'destroy'])->name('destroy');
        });
        // ------------------------- SubCategory Routes Ended -------------------------




       // ------------------------- Products Routes Started -------------------------
        Route::prefix('product')->name('product.')->group(function () {
            Route::get('/', [ProductController::class, 'index'])->name('index');
            Route::get('/create', [ProductController::class, 'create'])->name('create');
            Route::post('/store', [ProductController::class, 'store'])->name('store');
            Route::get('/edit/{id}', [ProductController::class, 'edit'])->name('edit');
            Route::post('/update/{id}', [ProductController::class, 'update'])->name('update');
            Route::get('/delete/{id}', [ProductController::class, 'destroy'])->name('destroy');
            Route::get('/{id}/show', [ProductController::class, 'show'])->name('show');
            Route::get('/get-sub-category/{category_id}', [ProductController::class, 'getSubCategory'])
                ->name('get-sub-category');
            
            Route::delete('/video/{id}', [ProductController::class, 'deleteVideo'])->name('video.delete');
        });
        // ------------------------- Products Routes Ended -------------------------
        


        // ------------------------- Order Routes Started -------------------------
        Route::prefix('order')->name('order.')->group(function () {
            Route::get('/', [OrderController::class, 'index'])->name('index');
            Route::get('/detail/{id}', [OrderController::class, 'detail'])->name('detail');
            Route::post('/{id}/change-status', [OrderController::class, 'changeStatus'])->name('change-status');
            Route::get('/{id}/destroy', [OrderController::class, 'destroy'])->name('destroy');
        });
        // ------------------------- Order Routes Ended -------------------------



        // ------------------------- Review Routes Started -------------------------
        Route::prefix('review')->name('review.')->group(function () {
            Route::get('/', [ReviewController::class, 'index'])->name('index');
            Route::get('/{id}/detail', [ReviewController::class, 'detail'])->name('detail');
            Route::post('/{id}/change-status', [ReviewController::class, 'changeStatus'])->name('change.status');
        });
        // ------------------------- Review Routes Ended -------------------------




        // ------------------------- About Routes Started -------------------------
        Route::get('/about', [AboutController::class, 'index'])->name('about');
        Route::post('/about/update', [AboutController::class, 'update'])->name('about.update');

        
        Route::get('/about', [AboutController::class, 'index'])->name('about');
        Route::post('/about', [AboutController::class, 'update'])->name('about.update');
        
        // ------------------------- About Routes Ended -------------------------



        // ------------------------- Contact Routes Started -------------------------
    
        Route::get('/contact', [ContactController::class, 'index'])->name('contact');
        Route::post('/contact', [ContactController::class, 'update'])->name('contact.update');

        // ------------------------- Contact Routes Ended -------------------------

        // ------------------------- Services Routes Started -------------------------
        Route::prefix('service')->name('service.')->group(function () {
            Route::get('/', [ServiceController::class, 'index'])->name('index');
            Route::get('/create', [ServiceController::class, 'create'])->name('create');
            Route::post('/store', [ServiceController::class, 'store'])->name('store');
            Route::get('/{id}/edit', [ServiceController::class, 'edit'])->name('edit');
            Route::post('/{id}/update', [ServiceController::class, 'update'])->name('update');
            Route::get('/{id}/delete', [ServiceController::class, 'destroy'])->name('destroy');
        });
        // ------------------------- Services Routes Ended -------------------------



        // ------------------------- Blog Routes Started -------------------------
        Route::prefix('blog')->name('blog.')->group(function () {
            Route::get('/', [BlogController::class, 'index'])->name('index');
            Route::get('/create', [BlogController::class, 'create'])->name('create');
            Route::post('/store', [BlogController::class, 'store'])->name('store');
            Route::get('/{id}/edit', [BlogController::class, 'edit'])->name('edit');
            Route::post('/{id}/update', [BlogController::class, 'update'])->name('update');
            Route::get('/{id}/delete', [BlogController::class, 'destroy'])->name('destroy');
        });
        // ------------------------- Blog Routes Ended -------------------------

        Route::get('contact-messages', [ContactMessageController::class, 'index'])->name('contact-message.index');
        Route::get('contact-messages/{id}', [ContactMessageController::class, 'show'])->name('contact-message.show');
        Route::delete('contact-messages/{id}', [ContactMessageController::class, 'destroy'])->name('contact-message.destroy');
        Route::post('contact-messages/{id}/mark-as-read', [ContactMessageController::class, 'markAsRead'])->name('contact-message.mark-as-read');

        // Leader Routes
        Route::prefix('leader')->name('leader.')->controller(App\Http\Controllers\Admin\LeaderController::class)->group(function () {
            Route::get('/', 'index')->name('index');
            Route::get('/create', 'create')->name('create');
            Route::post('/store', 'store')->name('store');
            Route::get('/edit/{id}', 'edit')->name('edit');
            Route::post('/update/{id}', 'update')->name('update');
            Route::get('/destroy/{id}', 'destroy')->name('destroy');
        });

        // Gallery Routes
        Route::prefix('gallery')->name('gallery.')->controller(App\Http\Controllers\Admin\GalleryController::class)->group(function () {
            Route::get('/', 'index')->name('index');
            Route::get('/create', 'create')->name('create');
            Route::post('/store', 'store')->name('store');
            Route::get('/edit/{id}', 'edit')->name('edit');
            Route::post('/update/{id}', 'update')->name('update');
            Route::get('/destroy/{id}', 'destroy')->name('destroy');
        });

        Route::group(['prefix' => 'product/video', 'as' => 'product.video.'], function () {
            Route::get('/{video}/download', [ProductVideoController::class, 'download'])->name('download');
            Route::post('/update-duration', [ProductVideoController::class, 'updateDuration'])->name('update-duration');
            Route::post('/increment-view', [ProductVideoController::class, 'incrementView'])->name('increment-view');
            Route::post('/rate', [ProductVideoController::class, 'rate'])->name('rate');
            Route::delete('/{video}', [ProductVideoController::class, 'destroy'])->name('destroy');
        });

        // Home Routes
        Route::prefix('home')->name('home.')->group(function () {
            // Header Routes
            Route::prefix('header')->name('header.')->group(function () {
                Route::get('/', [HeaderController::class, 'index'])->name('index');
                Route::get('/create', [HeaderController::class, 'create'])->name('create');
                Route::post('/store', [HeaderController::class, 'store'])->name('store');
                Route::get('/edit/{id}', [HeaderController::class, 'edit'])->name('edit');
                Route::post('/update/{id}', [HeaderController::class, 'update'])->name('update');
                Route::get('/destroy/{id}', [HeaderController::class, 'destroy'])->name('destroy');
                Route::get('/status/{id}', [HeaderController::class, 'status'])->name('status');
            });

            // Company Routes
            Route::prefix('company')->name('company.')->group(function () {
                Route::get('/', [CompanyController::class, 'index'])->name('index');
                Route::get('/create', [CompanyController::class, 'create'])->name('create');
                Route::post('/store', [CompanyController::class, 'store'])->name('store');
                Route::get('/edit/{id}', [CompanyController::class, 'edit'])->name('edit');
                Route::post('/update/{id}', [CompanyController::class, 'update'])->name('update');
                Route::get('/destroy/{id}', [CompanyController::class, 'destroy'])->name('destroy');
                Route::get('/status/{id}', [CompanyController::class, 'status'])->name('status');
            });

            // Partner Routes
            Route::prefix('partners')->name('partners.')->group(function () {
                Route::get('/', [PartnerController::class, 'index'])->name('index');
                Route::get('/create', [PartnerController::class, 'create'])->name('create');
                Route::post('/store', [PartnerController::class, 'store'])->name('store');
                Route::get('/edit/{id}', [PartnerController::class, 'edit'])->name('edit');
                Route::post('/update/{id}', [PartnerController::class, 'update'])->name('update');
                Route::get('/destroy/{id}', [PartnerController::class, 'destroy'])->name('destroy');
                Route::get('/status/{id}', [PartnerController::class, 'status'])->name('status');
            });

            // Study Program Routes
            Route::prefix('study-programs')->name('study-programs.')->group(function () {
                Route::get('/', [StudyProgramController::class, 'index'])->name('index');
                Route::get('/create', [StudyProgramController::class, 'create'])->name('create');
                Route::post('/store', [StudyProgramController::class, 'store'])->name('store');
                Route::get('/edit/{id}', [StudyProgramController::class, 'edit'])->name('edit');
                Route::put('/update/{id}', [StudyProgramController::class, 'update'])->name('update');
                Route::delete('/destroy/{id}', [StudyProgramController::class, 'destroy'])->name('destroy');
                Route::post('/status/{id}', [StudyProgramController::class, 'status'])->name('status');
            });

            // Study Program Content Routes
            Route::prefix('home')->name('home.')->group(function () {
                Route::prefix('study-program-contents')->name('study-program-contents.')->controller(StudyProgramContentController::class)->group(function () {
                    Route::get('/', 'index')->name('index');
                    Route::get('/create', 'create')->name('create');
                    Route::post('/store', 'store')->name('store');
                    Route::get('/edit/{id}', 'edit')->name('edit');
                    Route::post('/update/{id}', 'update')->name('update');
                    Route::get('/destroy/{id}', 'destroy')->name('destroy');
                    Route::get('/status/{id}', 'status')->name('status');
                });
            });

            // Company Names Routes
            Route::prefix('company-names')->name('company-names.')->group(function () {
                Route::get('/', [CompanyNameController::class, 'index'])->name('index');
                Route::get('/create', [CompanyNameController::class, 'create'])->name('create');
                Route::post('/store', [CompanyNameController::class, 'store'])->name('store');
                Route::get('/edit/{id}', [CompanyNameController::class, 'edit'])->name('edit');
                Route::post('/update/{id}', [CompanyNameController::class, 'update'])->name('update');
                Route::get('/destroy/{id}', [CompanyNameController::class, 'destroy'])->name('destroy');
                Route::get('/status/{id}', [CompanyNameController::class, 'status'])->name('status');
            });

            // Advantages Routes
            Route::prefix('advantages')->name('advantages.')->group(function () {
                Route::get('/', [AdvantageController::class, 'index'])->name('index');
                Route::get('/create', [AdvantageController::class, 'create'])->name('create');
                Route::post('/store', [AdvantageController::class, 'store'])->name('store');
                Route::get('/edit/{id}', [AdvantageController::class, 'edit'])->name('edit');
                Route::post('/update/{id}', [AdvantageController::class, 'update'])->name('update');
                Route::get('/destroy/{id}', [AdvantageController::class, 'destroy'])->name('destroy');
                Route::get('/status/{id}', [AdvantageController::class, 'status'])->name('status');
            });
        });

        // Comment Routes
        Route::prefix('comment')->name('comment.')->controller(CommentController::class)->group(function () {
            Route::get('/', 'index')->name('index');
            Route::get('/create', 'create')->name('create');
            Route::post('/store', 'store')->name('store');
            Route::get('/edit/{id}', 'edit')->name('edit');
            Route::post('/update/{id}', 'update')->name('update');
            Route::get('/destroy/{id}', 'destroy')->name('destroy');
            Route::get('/status/{id}', 'status')->name('status');
        });

        // Company Name Routes
        Route::prefix('company-names')->name('company-names.')->group(function () {
            Route::get('/', [CompanyNameController::class, 'index'])->name('index');
            Route::get('/create', [CompanyNameController::class, 'create'])->name('create');
            Route::post('/store', [CompanyNameController::class, 'store'])->name('store');
            Route::get('/edit/{id}', [CompanyNameController::class, 'edit'])->name('edit');
            Route::post('/update/{id}', [CompanyNameController::class, 'update'])->name('update');
            Route::get('/destroy/{id}', [CompanyNameController::class, 'destroy'])->name('destroy');
            Route::get('/status/{id}', [CompanyNameController::class, 'status'])->name('status');
        });

        // About Company Routes
        Route::prefix('about')->name('about.')->group(function () {
            Route::prefix('company')->name('company.')->group(function () {
                Route::get('/', [AboutCompanyController::class, 'index'])->name('index');
                Route::get('/create', [AboutCompanyController::class, 'create'])->name('create');
                Route::post('/store', [AboutCompanyController::class, 'store'])->name('store');
                Route::get('/edit/{id}', [AboutCompanyController::class, 'edit'])->name('edit');
                Route::post('/update/{id}', [AboutCompanyController::class, 'update'])->name('update');
                Route::get('/destroy/{id}', [AboutCompanyController::class, 'destroy'])->name('destroy');
                Route::get('/status/{id}', [AboutCompanyController::class, 'status'])->name('status');
            });
        });

        // About Vision Routes
        Route::prefix('about')->name('about.')->group(function () {
            Route::prefix('vision')->name('vision.')->group(function () {
                Route::get('/', [AboutVisionController::class, 'index'])->name('index');
                Route::get('/create', [AboutVisionController::class, 'create'])->name('create');
                Route::post('/store', [AboutVisionController::class, 'store'])->name('store');
                Route::get('/edit/{id}', [AboutVisionController::class, 'edit'])->name('edit');
                Route::post('/update/{id}', [AboutVisionController::class, 'update'])->name('update');
                Route::get('/destroy/{id}', [AboutVisionController::class, 'destroy'])->name('destroy');
                Route::get('/status/{id}', [AboutVisionController::class, 'status'])->name('status');
            });
        });

        // History Routes
        Route::prefix('history')->name('history.')->group(function () {
            Route::get('/', [HistoryController::class, 'index'])->name('index');
            Route::get('/create', [HistoryController::class, 'create'])->name('create');
            Route::post('/store', [HistoryController::class, 'store'])->name('store');
            Route::get('/edit/{id}', [HistoryController::class, 'edit'])->name('edit');
            Route::post('/update/{id}', [HistoryController::class, 'update'])->name('update');
            Route::get('/destroy/{id}', [HistoryController::class, 'destroy'])->name('destroy');
            Route::get('/status/{id}', [HistoryController::class, 'status'])->name('status');
        });

        // Course Routes
        Route::prefix('course')->name('course.')->group(function () {
            Route::get('/', [CourseController::class, 'index'])->name('index');
            Route::get('/create', [CourseController::class, 'create'])->name('create');
            Route::post('/store', [CourseController::class, 'store'])->name('store');
            Route::get('/edit/{id}', [CourseController::class, 'edit'])->name('edit');
            Route::post('/update/{id}', [CourseController::class, 'update'])->name('update');
            Route::get('/destroy/{id}', [CourseController::class, 'destroy'])->name('destroy');
            Route::get('/status/{id}', [CourseController::class, 'status'])->name('status');
        });

        // Services Title Routes
        Route::prefix('services-title')->name('services-title.')->group(function () {
            Route::get('/', [ServicesTitleController::class, 'index'])->name('index');
            Route::post('/update', [ServicesTitleController::class, 'update'])->name('update');
        });

        // Education Title Routes
        Route::prefix('education-title')->name('education-title.')->group(function () {
            Route::get('/', [EducationTitleController::class, 'index'])->name('index');
            Route::post('/update', [EducationTitleController::class, 'update'])->name('update');
            Route::get('/status/{id}', [EducationTitleController::class, 'status'])->name('status');
        });

        // Digital Psychology Title Routes
        Route::prefix('digital-psychology-title')->name('digital-psychology-title.')->group(function () {
            Route::get('/', [DigitalPsychologyTitleController::class, 'index'])->name('index');
            Route::post('/update', [DigitalPsychologyTitleController::class, 'update'])->name('update');
            Route::get('/status/{id}', [DigitalPsychologyTitleController::class, 'status'])->name('status');
        });

        // Psychology Text Routes
        Route::prefix('psychology-text')->name('psychology-text.')->group(function () {
            Route::get('/', [PsychologyTextController::class, 'index'])->name('index');
            Route::get('/create', [PsychologyTextController::class, 'create'])->name('create');
            Route::post('/store', [PsychologyTextController::class, 'store'])->name('store');
            Route::get('/edit/{id}', [PsychologyTextController::class, 'edit'])->name('edit');
            Route::put('/update/{id}', [PsychologyTextController::class, 'update'])->name('update');
            Route::get('/destroy/{id}', [PsychologyTextController::class, 'destroy'])->name('destroy');
            Route::get('/status/{id}', [PsychologyTextController::class, 'status'])->name('status');
        });

        // Human Design Routes
        Route::prefix('human-design')->name('human-design.')->group(function () {
            Route::get('/', [HumanDesignController::class, 'index'])->name('index');
            Route::get('/create', [HumanDesignController::class, 'create'])->name('create');
            Route::post('/store', [HumanDesignController::class, 'store'])->name('store');
            Route::get('/edit/{id}', [HumanDesignController::class, 'edit'])->name('edit');
            Route::put('/update/{id}', [HumanDesignController::class, 'update'])->name('update');
            Route::delete('/destroy/{id}', [HumanDesignController::class, 'destroy'])->name('destroy');
            Route::get('/status/{id}', [HumanDesignController::class, 'status'])->name('status');
        });

        // Human Content Routes
        Route::prefix('human-content')->name('human-content.')->group(function () {
            Route::get('/', [HumanContentController::class, 'index'])->name('index');
            Route::get('/create', [HumanContentController::class, 'create'])->name('create');
            Route::post('/store', [HumanContentController::class, 'store'])->name('store');
            Route::get('/edit/{id}', [HumanContentController::class, 'edit'])->name('edit');
            Route::put('/update/{id}', [HumanContentController::class, 'update'])->name('update');
            Route::delete('/destroy/{id}', [HumanContentController::class, 'destroy'])->name('destroy');
            Route::get('/status/{id}', [HumanContentController::class, 'status'])->name('status');
        });

        // Gallery Title Routes
        Route::prefix('gallery-title')->name('gallery-title.')->controller(App\Http\Controllers\Admin\GalleryTitleController::class)->group(function () {
            Route::get('/', 'index')->name('index');
            Route::get('/create', 'create')->name('create');
            Route::post('/store', 'store')->name('store');
            Route::get('/edit/{id}', 'edit')->name('edit');
            Route::post('/update/{id}', 'update')->name('update');
            Route::get('/destroy/{id}', 'destroy')->name('destroy');
            Route::get('/status/{id}', 'status')->name('status');
        });

        // Gallery Video Routes
        Route::prefix('gallery-video')->name('gallery-video.')->controller(App\Http\Controllers\Admin\GalleryVideoController::class)->group(function () {
            Route::get('/', 'index')->name('index');
            Route::get('/create', 'create')->name('create');
            Route::post('/store', 'store')->name('store');
            Route::get('/edit/{id}', 'edit')->name('edit');
            Route::post('/update/{id}', 'update')->name('update');
            Route::get('/destroy/{id}', 'destroy')->name('destroy');
            Route::get('/status/{id}', 'status')->name('status');
        });

        // Blog Title Routes
        Route::prefix('blog-title')->name('blog-title.')->controller(App\Http\Controllers\Admin\BlogTitleController::class)->group(function () {
            Route::get('/', 'index')->name('index');
            Route::get('/create', 'create')->name('create');
            Route::post('/store', 'store')->name('store');
            Route::get('/edit/{id}', 'edit')->name('edit');
            Route::put('/update/{id}', 'update')->name('update');
            Route::get('/destroy/{id}', 'destroy')->name('destroy');
            Route::get('/status/{id}', 'status')->name('status');
        });

        // Contact Title Routes
        Route::prefix('contact-title')->name('contact-title.')->controller(App\Http\Controllers\Admin\ContactTitleController::class)->group(function () {
            Route::get('/', 'index')->name('index');
            Route::get('/create', 'create')->name('create');
            Route::post('/store', 'store')->name('store');
            Route::get('/edit/{id}', 'edit')->name('edit');
            Route::put('/update/{id}', 'update')->name('update');
            Route::get('/destroy/{id}', 'destroy')->name('destroy');
            Route::get('/status/{id}', 'status')->name('status');
        });

        // HomeTitle Routes
        Route::prefix('home/title')->name('home.title.')->controller(App\Http\Controllers\Admin\HomeTitleController::class)->group(function () {
            Route::get('/', 'index')->name('index');
            Route::get('/create', 'create')->name('create');
            Route::post('/store', 'store')->name('store');
            Route::get('/edit/{id}', 'edit')->name('edit');
            Route::post('/update/{id}', 'update')->name('update');
            Route::get('/destroy/{id}', 'destroy')->name('destroy');
            Route::get('/status/{id}', 'status')->name('status');
        });

        Route::resource('course-types', CourseTypeController::class);
        Route::resource('blog-types', BlogTypeController::class);

        // Study Content Routes
        Route::prefix('study-content')->name('study-content.')->group(function () {
            Route::get('/', [StudyContentController::class, 'index'])->name('index');
            Route::get('/create', [StudyContentController::class, 'create'])->name('create');
            Route::post('/store', [StudyContentController::class, 'store'])->name('store');
            Route::get('/edit/{id}', [StudyContentController::class, 'edit'])->name('edit');
            Route::put('/update/{id}', [StudyContentController::class, 'update'])->name('update');
            Route::delete('/destroy/{id}', [StudyContentController::class, 'destroy'])->name('destroy');
            Route::get('/status/{id}', [StudyContentController::class, 'status'])->name('status');
        });

        Route::resource('translations', TranslationController::class);

        Route::resource('course-route', CourseRouteController::class);
    });
});