<?php

namespace App\Http\Controllers;

use App\Menu;
use App\Brand;
use App\Pattern;
use App\Category;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        return view('dashboard.index');
    }

    /**
     *
     */
    public function computers()
    {
        $categories = Category::orderBy('name')->get();

        return array_map(function ($category) {
            return [ucfirst($category->name) => $category->countDevices()];
        }, $categories->all());
    }

    /**
     *
     */
    public function patterns()
    {
        $patterns = new Pattern;
        $patterns = $patterns->computerPatterns();

        return $patterns->map(function ($pattern) {
            return [ucfirst($pattern->name) => $pattern->countDevices()];
        });
    }

    /**
     *
     */
    public function computersByBrand()
    {
        $brands = new Brand;
        $brands = $brands->computerBrands();

        return $brands->map(function ($brand) {
            return [ucfirst($brand->name) => $brand->countDevices()];
        });
    }
}
