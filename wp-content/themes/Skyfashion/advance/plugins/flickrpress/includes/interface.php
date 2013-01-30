<?php
/*  Copyright 2008 Michael Tyson <mike@tyson.id.au>
    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation; either version 2 of the License, or
    (at your option) any later version.
    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.
    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/
function FPERR($s)
{
    $bt = debug_backtrace();
    error_log(($bt[0]["file"] ? (substr($bt[0]["file"], strlen($_SERVER["DOCUMENT_ROOT"]) + 1) . ":" . $bt[0]["line"] . " (") : "") .
        $bt[1]["function"] . "()" .
        ($bt[0]["file"] ? ")" : "") .
        ": " . $s);
}

function FPDBG($s)
{
    /*
    $bt = debug_backtrace();
    error_log(($bt[0]["file"] ? (substr($bt[0]["file"], strlen($_SERVER["DOCUMENT_ROOT"])+1).":".$bt[0]["line"]." (") : "").
        $bt[1]["function"]."()".
        ($bt[0]["file"]?")":"").
        ": ".$s);
    */
}

/**
 * Load items from Flickr according to options
 *
 * @param options Options
 * @param cache Cache, on input and output
 * @param start Starting index, for paging
 * @param total On output, total number of items
 * @return Array of objects representing items
 * @since 0.1
 * @author Michael Tyson
 **/
function flickrpress_load_items(&$options, &$cache, $start, &$total)
{
    // Load items depending on type
    if ($options['type'] == "rss") {
        // RSS: Special case, no need of API
        return flickrpress_load_items_rss($options, $start, $total);
    }
    if (!$options['api_key']) {
        // No API key - nothing we can do
        FPERR("No API key");
        return array();
    }
    require_once('phpFlickr/phpFlickr.php');
    $flickr = new fkbxphpFlickr($options['api_key']);
    // Get ID for account
    $accountId = $options['account_id'];
    if (!$account_id) {
        if (preg_match('/^[0-9]+@[^\.]+$/', $options['account'])) {
            $accountId = $options['account'];
        } else if (strpos('@', $options['account']) !== false) {
            $results = $flickr->people_findByEmail($options['account']);
            $accountId = $results['nsid'];
        } else {
            $results = $flickr->people_findByUsername($options['account']);
            $accountId = $results['nsid'];
        }
        if ($results === false) {
            FPERR("Couldn't get account: " . $flickr->getErrorMsg());
            return array();
        }
        if (!$accountId) {
            FPERR("Couldn't find account '" . $options['account'] . "'");
            return array();
        }
        $options['account_id'] = $accountId;
    }
    if (isset($cache['data']) && (time() - $cache['timestamp']) < FLICKRPRESS_CACHE_MAX_AGE) {
        // Cache still fresh - use it
        $items = $cache['data'];
    } else {
        $items = array();
        if ($options['type'] == 'photostream') {
            $items = flickrpress_load_items_photostream($flickr, $options);
        } else if ($options['type'] == 'sets') {
            $items = flickrpress_load_items_sets($flickr, $options);
        } else if ($options['type'] == 'favorites') {
            $items = flickrpress_load_items_favorites($flickr, $options);
        } else {
            FPERR("Invalid display type");
        }
        // Save to cache
        $cache['data'] = $items;
        $cache['timestamp'] = time();
    }
    if ($total !== null && ($options['random'] || $options['paging'])) {
        $total = count($items);
    }
    if ($options['random'] && count($items) > 1) {
        // $items is all items - we have to pick random items from it
        $keys = array_rand($items, min($options['count'], count($items)));
        if (!is_array($keys)) $keys = array($keys);
        $output = array();
        foreach ($keys as $key) {
            $output[] = $items[$key];
        }
        $items = $output;
    }
    if ($options['paging']) {
        // We are using paging to offset into the items array
        $items = (array)@array_slice($items, $start, $options['count']);
    }
    $photosUrl = $options['photos_url'];
    if (!$photosUrl) {
        $result = $flickr->urls_getUserPhotos($accountId);
        if ($result === false) {
            FPERR("Couldn't get photo URL for user: " . $flickr->getErrorMsg());
        }
        $options['photos_url'] = $photosUrl = $result;
    }
    // Format items appropriately
    $output = array();
    foreach ($items as $photo) {
        $item = new stdClass();
        if ($photosUrl) {
            $item->page = $photosUrl . $photo['id'];
        }
        $item->thumbnail = $flickr->buildPhotoURL($photo, ($options['view'] == 'large' ? 'small' : ($options['view'] == 'proportional' ? 'thumbnail' : 'square')));
        $item->image = $flickr->buildPhotoURL($photo, 'medium');
        $item->title = $photo['title'];
        $output[] = $item;
    }
    return $output;
}

/**
 * Load items from RSS
 *
 * @param options Options
 * @param start Starting index, for paging
 * @param total On output, total number of items
 * @return Array of items
 * @author Michael Tyson
 * @since 0.1
 **/
function flickrpress_load_items_rss($options, $start, &$total)
{
    // Load RSS feed contents
//    if( file_exists( ABSPATH . WPINC . '/rss.php') ) {
//		require_once(ABSPATH . WPINC . '/rss.php');
//	} else {
//		require_once(ABSPATH . WPINC . '/rss-functions.php');
//	}
    $feed = fetch_feed($options['url']);
    $flickr_items = $feed->get_items();
    if (!$feed || !is_array($flickr_items)) {
        FPERR("RSS load of " . $options['url'] . " failed");
        return array();
    }
    if (count($flickr_items) == 0) {
        FPERR("No items in RSS feed " . $options['url']);
        return array();
    }
    if ($options['random']) {
        shuffle($flickr_items);
    }
    if ($total !== null) {
        $total = count($flickr_items);
    }
    $count = 0;
    $items = array();
    foreach ($flickr_items as $feedItem) {
        if ($count < $start) {
            $count++;
            continue;
        }
        if ($count++ >= $options['count'] + $start) break;
        if (!preg_match('/<img src="([^"]+)/si', $feedItem->get_description(), $matches)) continue;
        $thumbnailSuffix = '_s';
        switch ($options['view']) {
            case 'large':
                $thumbnailSuffix = '_m';
                break;
            case 'proportional':
                $thumbnailSuffix = '_t';
                break;
            default:
                $thumbnailSuffix = '_s';
                break;
        }
        $item = new stdClass();
        $item->page = $feedItem->get_link();
        $item->thumbnail = str_replace('_m.jpg', $thumbnailSuffix . '.jpg', $matches[1]);
        $item->image = str_replace('_m.jpg', '.jpg', $matches[1]);
        $item->title = $feedItem->get_title();
        $item->description = '';
        $items[] = $item;
    }
    return $items;
}

/**
 * Load photostream items
 *
 * @param flickr Flickr interface
 * @param options Options
 * @return Array of items
 * @author Michael Tyson
 * @since 0.1
 **/
function flickrpress_load_items_photostream($flickr, $options)
{
    $accountId = $options['account_id'];
    if ($options['random'] || $options['paging']) {
        // Load all items
        $page = 1;
        $items = array();
        do {
            set_time_limit(30);
            if ($options['tags']) {
                $results = $flickr->photos_search(array('user_id' => $accountId, 'tags' => $options['tags'], 'per_page' => 500, 'page' => $page++));
                if ($results) $results = $results['photo'];
            } else {
                $results = $flickr->people_getPublicPhotos($accountId, NULL, NULL, 500, $page++);
                if ($results) $results = $results['photos']['photo'];
            }
            if ($results === false) {
                FPERR("Couldn't load photos: " . $flickr->getErrorMsg());
                return array();
            }
            $items = array_merge($items, $results);
        } while (count($results) == 500);
    } else {
        // Load recent items
        if ($options['tags']) {
            $items = $flickr->photos_search(array('user_id' => $accountId, 'tags' => $options['tags'], 'per_page' => $options['count']));
            if ($items) $items = $items['photo'];
        } else {
            $items = $flickr->people_getPublicPhotos($accountId, NULL, NULL, $options['count']);
            if ($items) $items = $items['photos']['photo'];
        }
        if ($items === false) {
            FPERR("Couldn't load photos: " . $flickr->getErrorMsg());
            return array();
        }
    }
    return $items;
}

/**
 * Load all items in given sets
 *
 * @param flickr Flickr interface
 * @param options Options
 * @return Array of items
 * @author Michael Tyson
 * @since 0.1
 **/
function flickrpress_load_items_sets($flickr, &$options)
{
    $accountId = $options['account_id'];
    $sets = $options['set_data'];
    if (!$sets || (time() - $options['set_data_cache_time']) > FLICKRPRESS_CACHE_MAX_AGE) {
        // Need to compile a list of set ids from the list of set titles
        $sets = array();
        $setTitles = array_map(create_function('$a', 'return strtolower(trim($a));'), explode(',', $options['sets']));
        $flickrSetList = $flickr->photosets_getList($accountId);
        if ($flickrSetList === false) {
            FPERR("Couldn't load set list: " . $flickr->getErrorMsg());
            return array();
        }
        foreach ($flickrSetList['photoset'] as $set) {
            if (in_array(strtolower($set['title']), $setTitles)) {
                $sets[] = $set;
            }
        }
        $options['set_data'] = $sets;
        $options['set_data_cache_time'] = time();
    }
    if ($options['random'] || $options['paging']) {
        // Load all items
        $items = array();
        foreach ($sets as $set) {
            set_time_limit(30);
            $page = 1;
            do {
                $results = $flickr->photosets_getPhotos($set['id'], 'date_upload', NULL, 500, $page++);
                if ($results === false) {
                    FPERR("Couldn't load photos: " . $flickr->getErrorMsg());
                    return array();
                }
                $items = array_merge($items, $results['photoset']['photo']);
            } while (count($results) == 500);
        }
    } else {
        // Load recent items - $count from each, then sort, then select $count most reent
        $items = array();
        foreach ($sets as $set) {
            $results = $flickr->photosets_getPhotos($set['id'], 'date_upload', NULL, $options['count']);
            if ($results === false) {
                FPERR("Couldn't load photos: " . $flickr->getErrorMsg());
                return array();
            }
            $items = array_merge($items, $results['photoset']['photo']);
        }
        usort($items, create_function('$a, $b', 'return $b["dateupload"] - $a["dateupload"];'));
        $items = array_slice($items, 0, $options['count']);
    }
    return $items;
}

/**
 * Load all items in favorites
 *
 * @param flickr Flickr interface
 * @param options Options
 * @return Array of items
 * @author Michael Tyson
 * @since 0.1
 **/
function flickrpress_load_items_favorites($flickr, &$options)
{
    $accountId = $options['account_id'];
    if ($options['random'] || $options['paging']) {
        // Load all items
        $page = 1;
        $items = array();
        do {
            set_time_limit(30);
            $results = $flickr->favorites_getPublicList($accountId, NULL, NULL, NULL, 500, $page++);
            if ($results) $results = $results["photos"]["photo"];
            if ($results === false) {
                FPERR("Couldn't load photos: " . $flickr->getErrorMsg());
                return array();
            }
            $items = array_merge($items, $results);
        } while (count($results) == 500);
    } else {
        // Load recent items
        $items = $flickr->favorites_getPublicList($accountId, NULL, NULL, NULL, $options['count']);
        if ($items) $items = $items["photos"]["photo"];
        if ($items === false) {
            FPERR("Couldn't load photos: " . $flickr->getErrorMsg());
            return array();
        }
    }
    return $items;
}

?>