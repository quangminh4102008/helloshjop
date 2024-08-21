<?php

namespace App\Http\Services\Menu;

use App\Models\Menu;
use Illuminate\Support\Facades\Session;

class MenuService
{
    public function getParent()
    {
        return Menu::where('parent_id', 0)->get();
    }

    public function getAll(){
        return Menu::orderbyDesc('id')->paginate(10);
    }

    public function create($request)
    {
        try {
            Menu::create([
                'name' => (string)$request->input('name'),
                'parent_id' => (int)$request->input('parent_id'),
                'description' => (string)$request->input('description'),
                'content' => (string)$request->input('content'),
                'active' => (string)$request->input('active'),
            ]);

            Session::flash('success', 'Tạo Danh Mục Thành Công');
        } catch (\Exception $err) {
            Session::flash('error', $err->getMessage());
            return false;
        }

        return true;
    }
    public function update($menu, $request){
        $menu->name = (string)$request->input('name');

        if ($request->input('parent_id') != $menu->id) {
            $menu->parent_id = (int)$request->input('parent_id');
        }

        $menu->description = (string)$request->input('description');
        $menu->content = (string)$request->input('content');
        $menu->active = (string)$request->input('active');
        $menu->save();

        Session::flash('succes', 'Cap nhat thanh cong');
        return true;
    }
    public function destroy($request){
        $id = (int)$request->input('id');
        $menu = Menu::where('id',$id)->first();
        if ($menu){
            return Menu::where('id',$id)->orWhere('parent_id',$id)->delete();
        }
        return false;
    }

//    public function filterById($query, $id)
//    {
//        return $query->where('id', $id);
//    }
//
//    public function filterByCreatedAt($query, $startDate, $endDate)
//    {
//        return $query->whereBetween('created_at', [$startDate, $endDate]);
//    }
//
//    public function filterByStatus($query, $status)
//    {
//        return $query->where('status', $status);
//    }
public function getFilteredMenus($filters)
{
    $query = Menu::query();

    if ($filters['id']) {
        $query->where('id', $filters['id']);
    }

    if ($filters['start_date'] && $filters['end_date']) {
        $query->whereBetween('created_at', [$filters['start_date'], $filters['end_date']]);
    }

    if ($filters['active']) {
        $query->where('active', $filters['active']);
    }

    return $query->get();
}

}
