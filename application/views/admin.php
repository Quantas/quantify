<?php
/*
 * Copyright 2012 Andrew Landsverk
 *
 * This file is part of Quantify.
 *
 * Quantify is free software: you can redistribute it and/or modify it under the
 * terms of the GNU General Public License as published by the Free Software 
 * Foundation, either version 3 of the License, or (at your option) any later 
 * version.
 *
 * Quantify is distributed in the hope that it will be useful, but 
 * WITHOUT ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or
 * FITNESS FOR A PARTICULAR PURPOSE. See the GNU General Public License for more 
 * details.
 *
 * You should have received a copy of the GNU General Public License along with 
 * Quantify. If not, see http://www.gnu.org/licenses/.
 */
?>
<div id="admin_main">
    <?php if(hasPermission(models\Quantify\Current_User::user(), 'Administrator')) { echo anchor('admin/config', 'Config'); } ?>
    <?php if(hasPermission(models\Quantify\Current_User::user(), 'Editor')) { echo anchor('admin/entries', 'Entries'); } ?>
    <?php if(hasPermission(models\Quantify\Current_User::user(), 'Editor')) { echo anchor('admin/categories', 'Categories'); } ?>
    <?php if(hasPermission(models\Quantify\Current_User::user(), 'Administrator')) { echo anchor('admin/users', 'Users'); } ?>
    <?php if(hasPermission(models\Quantify\Current_User::user(), 'Administrator')) { echo anchor('admin/permissions', 'Permissions'); } ?>
    <?php if(hasPermission(models\Quantify\Current_User::user(), 'User')) { echo anchor('admin/profile', 'Profile'); } ?>
</div>