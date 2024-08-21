<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Menu\CreateFormRequest;
use App\Models\Menu;
use Illuminate\Http\Request;
use App\Http\Services\Menu\MenuService;
class MenuController
{
    protected $menuService;
    public function __construct(MenuService $menuService){
        $this->menuService = $menuService;
    }
    public function create(){
        return view('admin.menu.add',[
            'title' => 'Them danh muc moi',
            'menus' => $this->menuService->getParent()
        ]);
    }

    public function store(CreateFormRequest $request){
        $result = $this->menuService->create($request);
        return redirect()->back();
    }

    public function index(){
        $list = Menu::paginate(10);
        return view('admin.menu.list',[
            'title' => 'Danh sach muc moi nhat',
            'list'=>Menu::paginate(10)
        ]);
    }



    public function show(Menu $menu){
        return view('admin.menu.edit',[
            'title' => 'Chinh sua danh muc' . $menu->name,
            'menu' => $menu,
            'menus' => $this->menuService->getParent()
        ]);
    }

//    public function update(CreateFormRequest $request, Menu $menu){
//        $request -> validate([
//            'name' => 'required',
//            'parent_id' => 'required',
//            'description' => 'required',
//            'content' => 'required',
//            'active' => 'required',
//        ]);
//        $menu->update($request->all());
//        return view('admin.menu.list',[
//            'title' => 'Sửa danh muc moi',
//            'menu' => $menu,
//            'menus' => $this->menuService->getParent()
//        ]);
//    }
    public function update (Menu $menu, CreateFormRequest $request){
         $this->menuService->update($menu, $request);
         return redirect('admin/menus/list')->with('success','Update successfully');
    }


    public function destroy($id){
        try {
            Menu::where('id', $id)->delete();
            return redirect('/admin/menus/list')->with('success','Delete successfully');
        } catch (\Exception $exception) {
            return redirect('/admin/menus/list')->with('error', $exception->getMessage());
        }
    }


//    public function search(Request $request)
//    {
//        $query = Menu::query();
//
//        if ($request->has('id')) {
//            $query = $query->filterById($request->input('id'));
//        }
//
//        if ($request->has('start_date') && $request->has('end_date')) {
//            $query = $query->filterByCreatedAt($request->input('start_date'), $request->input('end_date'));
//        }
//
//        if ($request->has('status')) {
//            $query = $query->filterByStatus($request->input('status'));
//        }
//
//        $records = $query->get();
//
//        return view('your-view', compact('records'));
//    }

    public function search(Request $request)
    {
        $filters = [
            'id' => $request->input('id'),
            'start_date' => $request->input('start_date'),
            'end_date' => $request->input('end_date'),
            'active' => $request->input('active'),
        ];

        $hasFilters = $this->hasFilters($filters);

        if ($hasFilters) {
            $menus = $this->menuService->getFilteredMenus($filters);
        } else {
            $menus = [];
        }
        
        return view('admin.menu.search', compact('menus', 'hasFilters'));
    }
    protected function hasFilters($filters)
    {
        return !empty($filters['id'])
            || (!empty($filters['start_date']) && !empty($filters['end_date']))
            || !empty($filters['status']);
    }
}
