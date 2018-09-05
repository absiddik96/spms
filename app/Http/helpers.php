<?php
function gender($value)
{
    $gender = '';
    switch ($value) {
        case 1:
        $gender = 'Male';
        break;

        case 2:
        $gender = 'Female';
        break;

        case 3:
        $gender = 'Others';
        break;

        default:
        $gender = '';
        break;
    }
    return $gender;
}

?>
