<?php

use App\Models\UserIdentity;

function informationBy($citizen_id)
{
    $user = UserIdentity::where('citizen_id', $citizen_id)->select('nid_verify', 'brn_verify', 'tin_verify')->first();

    if ($user->nid_verify == 1) {
        return 'এনআইডি';
    }

    if ($user->brn_verify == 1) {
        return 'বিআরএন';
    }

    if ($user->tin_verify == 1) {
        return 'টিন';
    }

    return 'যাচাই করা হয়নি';
}



function informationByTin($citizen_id)
{
    $tin = UserIdentity::where('citizen_id', $citizen_id)->select('tin_verify')->first();

    if ($tin->tin_verify == 1) {
        return 'টিন';
    }

    return 'যাচাই করা হয়নি';
}


function informationByBrn($citizen_id)
{
    $brn = UserIdentity::where('citizen_id', $citizen_id)->select('brn_verify')->first();

    if ($brn->brn_verify == 1) {

        return 'বিআরএন';
    }

    return 'যাচাই করা হয়নি';
}


/**
 * Get NID Image 
 *
 * NOTE: profilePath == dateofbirht
 * @param [type] $profilePath == dateofbirht
 * @param [type] $userId
 * @return void
 */
function getProfilePhoto($profilePath, $userId)
{
    $profilePath = getProfilePath($profilePath, $userId);
    $fileName = $userId . '.png';
    if (file_exists($profilePath . $fileName)) {
        $fileSize =  filesize($profilePath . $fileName);
        if ($fileSize < 1048576)
            return 'data:image/png;base64,' . base64_encode(file_get_contents($profilePath . $fileName));
        else
            return '';
    } else
        return '';
}




/**
 * Get Profile Path
 *
 * @param [type] $profilePath
 * @param [type] $userId
 * @return void
 */
function getProfilePath($profilePath, $userId)
{
    if (!is_numeric($profilePath))
        $profilePath = strtotime($profilePath);

    $profilePath = 'nid_profile/' . date('Y/m/d', $profilePath) . '/' . $userId . '/';

    $temp = explode('/', $profilePath);
    $path = '';
    foreach ($temp as $val) {
        if ($path != '')
            $path = $path . '/';
        $path = $path . $val;
        if (!is_dir($path))
            mkdir($path);
    }

    return $profilePath;
}



/**
 * Get Invoice Number
 *
 * @return void
 */
function referUrl()
{
    $const = session()->get('referer');

    return $const;
}