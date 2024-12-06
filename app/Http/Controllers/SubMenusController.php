<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use App\Models\Menus;
use App\Models\SubMenus;

class SubMenusController extends Controller
{
    private $prefix = 'sttng';
    private $default_route = 'sbmn.index';

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
        $sub_menus = SubMenus::with(['menu'])->where('sbmn_deleted', 0)->where('sbmn_active', 1)->get();
        if(!empty($inputs['search']))
        {
            $sub_menus = SubMenus::where('sbmn_deleted', 0)->where('sbmn_active', 1)->whereRaw('sbmn_detail like ?', '%'.$search.'%')->get();
        }

        return $this->render('index', $sub_menus, $search);
    }

    public function add()
    {
        $menus = Menus::where('mn_deleted', 0)->get();
        return $this->render('add', $menus);
    }

    public function create(Request $request)
    {
        $inputs = $request->validate([
            'group' => 'required',
            'detail' => 'required',
            'reference' => 'required|unique:tbl_sub_menus,sbmn_reference',
            'icon' => 'required',
            'class' => 'nullable',
            'sequence' => 'numeric|nullable',
            'menu' => 'required|numeric',
        ]);

        try
        {
            $smenu = Menus::whereRaw('md5(mn_id) = ?', $inputs['group'])->where('mn_deleted', 0)->first();
            if(is_null($smenu))
            {
                return redirect()->route($this->default_route)->with('message', $this->warningMessage());
            }

            $id = $this->generateID(4);
            if(is_null($id))
            {
                return redirect()->route($this->default_route)->with('message', $this->dangerMessage('Error encountered in generating ID.'));
            }

            $sub = new SubMenus();
            $sub->sbmn_id = $id;
            $sub->sbmn_detail = $inputs['detail'];
            $sub->sbmn_reference = $inputs['reference'];
            $sub->sbmn_icon = $inputs['icon'];
            $sub->sbmn_class = $inputs['class'];
            $sub->sbmn_sequence = $inputs['sequence'];
            $sub->sbmn_menu = $inputs['menu'];
            $sub->mn_id = $smenu->mn_id;
            $sub->save();

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
            $smenu = SubMenus::whereRaw('md5(sbmn_id) = ?', $id)->where('sbmn_deleted', 0)->first();
            if(is_null($smenu))
            {
                return redirect()->route($this->default_route)->with('message', $this->warningMessage());
            }

            $menus = Menus::where('mn_deleted', 0)->get();
            $data = [
                'menus' => $menus,
                'smenu' => $smenu,
            ];

            return $this->render('edit', $data);
        }
        catch(Exception $e)
        {
            return redirect()->route($this->default_route)->with('message', $this->dangerMessage());
        }
    }

    public function update(Request $request)
    {
        $inputs = $request->validate([
            'group' => 'required',
            'detail' => 'required',
            'reference' => 'required',
            'icon' => 'required',
            'class' => 'nullable',
            'sequence' => 'numeric|nullable',
            'menu' => 'required|numeric',
            'id' => 'required',
        ]);

        // Check reference if existing
        $count = SubMenus::whereRaw('md5(sbmn_id) <> ?', $inputs['id'])->where('sbmn_reference', $inputs['reference'])->count();
        if($count > 0)
        {
            return redirect()->back()->withErrors(['reference' => 'The reference has already been taken.']);
        }

        try
        {
            $smenu = Menus::whereRaw('md5(mn_id) = ?', $inputs['group'])->where('mn_deleted', 0)->first();
            if(is_null($smenu))
            {
                return redirect()->route($this->default_route)->with('message', $this->warningMessage());
            }

            $sub = SubMenus::whereRaw('md5(sbmn_id) = ?', $inputs['id'])->where('sbmn_deleted', 0)->first();
            if(is_null($sub))
            {
                return redirect()->route($this->default_route)->with('message', $this->warningMessage());
            }

            $sub->sbmn_detail = $inputs['detail'];
            $sub->sbmn_reference = $inputs['reference'];
            $sub->sbmn_icon = $inputs['icon'];
            $sub->sbmn_class = $inputs['class'];
            $sub->sbmn_sequence = $inputs['sequence'];
            $sub->sbmn_menu = $inputs['menu'];
            $sub->mn_id = $smenu->mn_id;
            $sub->save();

            return redirect()->route($this->default_route)->with('message', $this->infoMessage());
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
            $menu = SubMenus::whereRaw('md5(sbmn_id) = ?', $id)->where('sbmn_deleted', 0)->first();
            if(is_null($menu))
            {
                return redirect()->route($this->default_route)->with('message', $this->warningMessage());
            }

            $menu->sbmn_deleted = 1;
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
            's_submenu' => $this->getSubMenu($this->prefix, $page, 'sbmn'),
            'records' => $records,
            'search' => $search,
        ];

        return view('pages.sub-menus.'.$page, $data);
    }
}
