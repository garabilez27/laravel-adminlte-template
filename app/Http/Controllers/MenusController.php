<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use App\Models\Menus;

class MenusController extends Controller
{
    private $prefix = 'sttng';
    private $default_route = 'mn.index';

    public function index(Request $request)
    {
        // validattion for search engine
        $inputs = $request->validate([
            'search' => 'nullable|string',
        ]);

        if(empty($inputs['search']) && isset($request['search']))
        {
            return redirect()->route('mn.index');
        }

        // get list
        $search = isset($inputs['search']) ? $inputs['search'] : '';
        $menus = Menus::where('mn_deleted', 0)->where('mn_active', 1)->get();
        if(!empty($inputs['search']))
        {
            $menus = Menus::where('mn_deleted', 0)->where('mn_active', 1)->whereRaw('mn_detail like ?', '%'.$search.'%')->get();
        }

        return $this->render('index', $menus, $search);
    }

    public function add()
    {
        return $this->render('add');
    }

    public function create(Request $request)
    {
        $inputs = $request->validate([
            'prefix' => 'required|max:10',
            'detail' => 'required',
            'reference' => 'required|unique:tbl_menus,mn_reference',
            'icon' => 'required',
            'sequence' => 'numeric|nullable',
            'branched' => 'required|numeric',
        ]);

        try
        {
            $id = $this->generateID(3);

            $menu = new Menus();
            $menu->mn_id = $id;
            $menu->mn_prefix = $inputs['prefix'];
            $menu->mn_detail = $inputs['detail'];
            $menu->mn_reference = $inputs['reference'];
            $menu->mn_icon = $inputs['icon'];
            $menu->mn_sequence = $inputs['sequence'];
            $menu->mn_branched = $inputs['branched'];
            $menu->save();

            return redirect()->route($this->default_route)->with('message', $this->infoMessage());
        }
        catch(Exception $e)
        {
            return redirect()->route($this->default_route)->with('message', $this->dangerMessage());
        }
    }

    public function edit(string $id)
    {
        try
        {
            $menu = Menus::whereRaw('md5(mn_id) = ?', $id)->where('mn_deleted', 0)->first();
            if(is_null($menu))
            {
                return redirect()->route($this->default_route)->with('message', $this->warningMessage());
            }

            return $this->render('edit', $menu);
        }
        catch(Exception $e)
        {
            return redirect()->route($this->default_route)->with('message', $this->dangerMessage());
        }
    }

    public function update(Request $request)
    {
        $inputs = $request->validate([
            'prefix' => 'required|max:10',
            'detail' => 'required',
            'reference' => 'required',
            'icon' => 'required',
            'sequence' => 'numeric|nullable',
            'branched' => 'required|numeric',
            'id' => 'required',
        ]);

        // Check reference if existing
        $count = Menus::whereRaw('md5(mn_id) <> ?', $inputs['id'])->where('mn_reference', $inputs['reference'])->count();
        if($count > 0)
        {
            return redirect()->back()->withErrors(['reference' => 'The reference has already been taken.']);
        }

        try
        {
            $menu = Menus::whereRaw('md5(mn_id) = ?', $inputs['id'])->where('mn_deleted', 0)->first();
            if(is_null($menu))
            {
                return redirect()->route($this->default_route)->with('message', $this->warningMessage());
            }

            $menu->mn_prefix = $inputs['prefix'];
            $menu->mn_detail = $inputs['detail'];
            $menu->mn_reference = $inputs['reference'];
            $menu->mn_icon = $inputs['icon'];
            $menu->mn_sequence = $inputs['sequence'];
            $menu->mn_branched = $inputs['branched'];
            $menu->save();

            return redirect()->route($this->default_route)->with('message', $this->infoMessage('Record has been updated successfully.'));
        }
        catch(Exception $e)
        {
            return redirect()->route($this->default_route)->with('message', $this->dangerMessage());
        }
    }

    public function destroy(string $id)
    {
        try
        {
            $menu = Menus::whereRaw('md5(mn_id) = ?', $id)->where('mn_deleted', 0)->first();
            if(is_null($menu))
            {
                return redirect()->route($this->default_route)->with('message', $this->warningMessage());
            }

            $menu->mn_deleted = 1;
            $menu->save();

            return redirect()->route($this->default_route)->with('message', $this->infoMessage('Record has been updated successfully.'));
        }
        catch(Exception $e)
        {
            return redirect()->route($this->default_route)->with('message', $this->dangerMessage());
        }
    }

    private function render($page, $records = [], string $search = '')
    {
        $data = [
            's_menu' => $this->prefix,
            's_submenu' => $this->getSubMenu($this->prefix, $page, 'mn'),
            'records' => $records,
            'search' => $search,
        ];

        return view('pages.menus.'.$page, $data);
    }
}
