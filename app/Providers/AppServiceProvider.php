<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\Category;
use App\Models\Coursemap;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot()
    {
        // Define a view composer for the sidebar
        View::composer('layouts.user', function ($view) {
            if (Auth::check()) { // Ensure the user is authenticated
                $user = Auth::user();

                $myCourses = Coursemap::where('user_id', $user->id)->with('course')->get(); 
                $course_completed_status=array();
                if($myCourses){
                    /// check course is completed or not and course category id for category active or deactive
                    foreach($myCourses as $myCourse){
                        if($myCourse->course){
                            if (array_key_exists($myCourse->course->category_id,$course_completed_status))
                            {
                                if($course_completed_status[$myCourse->course->category_id] != 0){
                                    if($myCourse->assignment_status > 0){
                                        $course_completed_status[$myCourse->course->category_id]=1;
                                    }else{
                                        $course_completed_status[$myCourse->course->category_id]=$myCourse->is_complete;
                                    }
                                }
                            }
                            else
                            {
                                if($myCourse->assignment_status > 0){
                                    $course_completed_status[$myCourse->course->category_id]=1;
                                }else{
                                    $course_completed_status[$myCourse->course->category_id]=$myCourse->is_complete;
                                }
                            }
                        }
                    }
                }
     
                
                // Fetch categories with enrolled course count
                $categories = Category::with(['courses.courseMaps' => function ($query) use ($user) {
                    $query->where('user_id', $user->id); // Filter enrollments by user ID
                }])->get();

                $userCategoryCourse['categoryData'] = $categories->map(function ($category) {
                    return [
                        'category_id' => $category->id,
                        'category_image' => $category->image,
                        'category_name' => $category->name,
                        'category_subset' => $category->subset,
                        'course_count' => $category->courses->filter(function ($course) {
                            return $course->courseMaps->isNotEmpty(); // Count only courses with enrollments
                        })->count(),
                        'enrolled_courses' => $category->courses->filter(function ($course) {
                            return $course->courseMaps->isNotEmpty(); // Get enrolled courses for this category
                        }),
                    ];
                });

              $userCategoryCourse['course_completed_status']=$course_completed_status;
                // Pass data to the view
                $view->with('categoryData', $userCategoryCourse);
            }
        });
    }

 
}
