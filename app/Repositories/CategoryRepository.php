<?php
namespace App\Repositories;

use App\Models\Categories;
use Illuminate\Support\Facades\Auth;

class CategoryRepository
{
    public function getAllCategories()
    {
            return Categories::all();
    }

    public function getAllCategoriesWithPaginate()
    {
            return Categories::paginate(5);
    }

    public function createCategory(array $data)
    {
        $category = Categories::create($data);
        return $category;
    }

    public function search( $query)
    {

        $category = Categories::where('name', 'like', "%$query%")->get();
        return $category;
    }

    public function lastPage()  {
        // Get the total number of categories to determine the last page
        $totalCategories = Categories::count();
        $categoriesPerPage = 5; // Assuming you're paginating 10 categories per page
        $lastPage = ceil($totalCategories / $categoriesPerPage);
        return $lastPage;
    }

    public function updateCategory($id, array $data)
    {
        $category = Categories::findOrFail($id);
        $category->update($data);
        return $category;
    }

    public function findCategoryById($id)
    {
        return Categories::findOrFail($id);
    }

    public function deleteCategory($id)
    {
        $category = Categories::findOrFail($id);
        $category->delete();
    }

    public function restoreCategory($id)
    {
        $category = Categories::withTrashed()->findOrFail($id);
        $category->restore();
    }


}
