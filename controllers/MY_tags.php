<?php defined("SYSPATH") or die("No direct script access.");

/**
 * Gallery - a web based photo album viewer and editor
 * Copyright (C) 2000-2013 Bharat Mediratta
 *
 * This program is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation; either version 2 of the License, or (at
 * your option) any later version.
 *
 * This program is distributed in the hope that it will be useful, but
 * WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the GNU
 * General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program; if not, write to the Free Software
 * Foundation, Inc., 51 Franklin Street - Fifth Floor, Boston, MA  02110-1301, USA.
 */
class MY_Tags_Controller extends Tags_Controller
{

    /**
     * Overridden to allow guest users to create tags
     * @param $item_id
     * @throws Exception
     */
    public function create($item_id)
    {
        $item = ORM::factory("item", $item_id);
        access::required("view", $item);
        //access::required("edit", $item);

        $form = tag::get_add_form($item);
        if ($form->validate())
        {
            foreach (explode(",", $form->add_tag->inputs["name"]->value) as $tag_name)
            {
                $tag_name = trim($tag_name);
                if ($tag_name)
                {
                    $tag = tag::add($item, $tag_name);
                }
            }

            json::reply(array("result" => "success", "cloud" => (string)tag::cloud(30)));
        }
        else
        {
            json::reply(array("result" => "error", "html" => (string)$form));
        }
    }
}
