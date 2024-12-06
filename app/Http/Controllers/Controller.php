<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Values;

abstract class Controller
{
    protected function getSubMenu($prefix, $page, string $root = '')
    {
        $user = session()->get('user');

        // Existing in sidebar
        if(isset($user->menus[$prefix]['sub'][$root.'.'.$page]))
        {
            return $root.'.'.$page;
        }

        //
        if($this->inPageAction($page))
        {
            return $root.'.index';
        }

        // Menu have no branch
        if(!$user->menus[$prefix]['branched'])
        {
            return '';
        }

        return $root.'.index';
    }

    protected function inPageAction(string $page)
    {
        $actions = [
            'add',
            'edit'
        ];

        return in_array($page, $actions);
    }

    protected function successMessage($message = 'Record has been added successfully.')
    {
        return [
            'class' => 'alert-success',
            'icon' => 'fa-check',
            'content' => $message,
            'status' => 'Success'
        ];
    }

    protected function warningMessage($message = 'Something went wrong. Please try again.')
    {
        return [
            'class' => 'alert-warning',
            'icon' => 'fa-exclamation-triangle',
            'content' => $message,
            'status' => 'Invalid'
        ];
    }

    protected function infoMessage($message = 'Record has been added successfully.')
    {
        return [
            'class' => 'alert-info',
            'icon' => 'fa-circle-info',
            'content' => $message,
            'status' => 'Information'
        ];
    }

    protected function dangerMessage($message = 'An error occured. Please contact the Developer regarding this matter.')
    {
        return [
            'class' => 'alert-danger',
            'icon' => 'fa-ban',
            'content' => $message,
            'status' => 'Unauthorize'
        ];
    }

    protected function generateID(int $id)
    {
        try
        {
            $value = Values::find($id);
            if(is_null($value))
            {
                return null;
            }

            $prefix = $value->val_prefix;
            $num = $value->val_value + 1;
            $month = date('m');
            $year = date('y');

            // save new count
            $value->val_value = $num;
            $value->save();

            // return the ID
            return $prefix.$month.$num.$year;
        }
        catch(Exception $e)
        {
            // no ID generated
            return null;
        }
    }
}
