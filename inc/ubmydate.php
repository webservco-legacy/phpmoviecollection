<?php
/*
Project     : Ub My Date - PHP MySQL date conversion script
Purpose     : Get the date in MySQL format and convert it in other formats
File name   : ubmydate.php
Version     : 1.0.061205
Author(s)   : Radu Maier
Copyright   : Copyright (C) 2006 Radu Maier oimoroiATgmailDOTcom
License     : GNU/GPL
Website     : http://underbeat.evonet.ro

This program is free software; you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation; version 2 of the License.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
GNU General Public  License for more details.

You should have received a copy of the GNU General Public License
along with this program from the site that you downloaded it
from; if not. write to the Free Software Foundation, Inc., 59 Temple
Place, Suite 330, Boston, MA 02111-1307 USA
*/

function MyDate($dataSQL, $dateformat) {
    $mydateDD  = substr($dataSQL, 8, 2);
    $mydateMM  = substr($dataSQL, 5, 2);
    $mydateYY  = substr($dataSQL, 0, 4);

    switch($dateformat) {
        case "dd/mm": {
            $mydate = $mydateDD . '&#47;' . $mydateMM;
            echo $mydate;
            break;
        }
        case "mm/yyyy": {
            $mydate = $mydateMM . '&#47;' . $mydateYY;
            echo $mydate;
            break;
        }
        case "dd/mm/yyyy": {
            $mydate = $mydateDD . '&#47;' . $mydateMM . '&#47;' . $mydateYY;
            echo $mydate;
            break;
        }
        case "dd-mm-yyyy": {
            $mydate = $mydateDD . '&#45;' . $mydateMM . '&#45;' . $mydateYY;
            echo $mydate;
            break;
        }
        case "yyyy": {
            $mydate = $mydateYY;
            echo $mydate;
            break;
        }
        default: { // dd/mm/yyyy
            $mydate = $mydateDD . '&#47;' . $mydateMM . '&#47;' . $mydateYY;
            echo $mydate;
            break;
        }
    }
    return $mydate;
}

/*
// DEBUG
MyDate("2006-30-15", "dd/mm/yyyy");
*/
?>