<?php

function convert_dbdate($dateTimeObj)
{
    $current = $dateTimeObj;
    $curtz = $current->getTimezone();
    $curtztrans = $curtz->getTransitions();
    return $current->format('l, F j, Y H:i:s') . '&nbsp;' . $curtztrans[0]['abbr'];
}

function convert_dbdate_tz($dateTimeObj, $tzObj)
{
    $curtztrans = $tzObj->getTransitions();
    return $dateTimeObj->format('m/d/Y H:i:s') . '&nbsp;' . $curtztrans[0]['abbr'];
}