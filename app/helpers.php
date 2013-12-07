<?php

if ( !function_exists('allowed') )
{
    function allowed($privilege)
    {
        if (
            Auth::user()->id == 1 ||                                                    # default policy, first user has almighty powers!
            in_array($privilege, Auth::user()->getRolePermissionNames())
        )
            return true;

        return false;
    }
}
