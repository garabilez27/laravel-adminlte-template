<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use App\Models\Roles;

class RolesController extends Controller
{
    private $prefix = 'sttng';
    private $default_route = 'rl.index';

    public function index(Request $request)
    {
        // validattion for search engine
        $inputs = $request->validate([
            'search' => 'nullable|string',
        ]);

        if(empty($inputs['search']) && isset($request['search']))
        {
            return redirect()->route($this->default_route);
        }

        // get list
        $search = isset($inputs['search']) ? $inputs['search'] : '';
        $menus = Roles::where('rl_deleted', 0)->where('rl_active', 1)->get();
        if(!empty($inputs['search']))
        {
            $menus = Roles::where('rl_deleted', 0)->where('rl_active', 1)->whereRaw('rl_detail like ?', '%'.$search.'%')->get();
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
            'detail' => 'required|unique:tbl_roles,rl_detail'
        ]);

        try
        {
            $id = $this->generateID(1);
            if(is_null($id))
            {
                return redirect()->route($this->default_route)->with('message', $this->dangerMessage('Error encountered in generating ID.'));
            }

            $role = new Roles();
            $role->rl_id = $id;
            $role->rl_detail = $inputs['detail'];
            $role->save();

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
            $role = Roles::whereRaw('md5(rl_id) = ?', $id)->where('rl_deleted', 0)->first();
            if(is_null($role))
            {
                return redirect()->route($this->default_route)->with('message', $this->warningMessage());
            }

            return $this->render('edit', $role);
        }
        catch(Exception $e)
        {
            return redirect()->route($this->default_route)->with('message', $this->dangerMessage());
        }
    }

    public function update(Request $request)
    {
        $inputs = $request->validate([
            'detail' => 'required',
            'id' => 'required',
        ]);

        // Check detail if existing
        $count = Roles::whereRaw('md5(rl_id) <> ?', $inputs['id'])->where('rl_detail', $inputs['detail'])->count();
        if($count > 0)
        {
            return redirect()->back()->withErrors(['detail' => 'The reference has already been taken.']);
        }

        try
        {
            $role = Roles::whereRaw('md5(rl_id) = ?', $inputs['id'])->where('rl_deleted', 0)->first();
            if(is_null($role))
            {
                return redirect()->route($this->default_route)->with('message', $this->warningMessage());
            }

            $role->rl_detail = $inputs['detail'];
            $role->save();

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
            $role = Roles::whereRaw('md5(rl_id) = ?', $id)->where('rl_deleted', 0)->first();
            if(is_null($role))
            {
                return redirect()->route($this->default_route)->with('message', $this->warningMessage());
            }

            $role->rl_deleted = 1;
            $role->save();

            return redirect()->route($this->default_route)->with('message', $this->infoMessage('Record has been updated successfully.'));
        }
        catch(Exception $e)
        {
            return redirect()->route($this->default_route)->with('message', $this->dangerMessage());
        }
    }

    private function render($page, $records = [], string $search = '')
    {
        // Check role if it has the menu
        $user = session()->get('user');
        if(!isset($user->menus[$this->prefix]))
        {
            return redirect('dashboard')->with('message', $this->dangerMessage('Unauthorize.'));
        }

        $data = [
            's_menu' => $this->prefix,
            's_submenu' => $this->getSubMenu($this->prefix, $page, 'rl'),
            'records' => $records,
            'search' => $search,
        ];

        return view('pages.roles.'.$page, $data);
    }
}
