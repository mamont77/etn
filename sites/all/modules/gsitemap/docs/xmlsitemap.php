<?php
// $Id: xmlsitemap.php,v 1.2 2007/05/06 22:06:54 darrenoh Exp $

/**
 * @addtogroup hooks
 * @{
 */

/**
 * Define additional links to add to the site map.
 *
 * This hook allows modules to add additional links to the site map. Links
 * may be associated with nodes, terms, or users, as shown in the example.
 *
 * @param $type:
 *   If set, a string specifying the type of additional links to return.
 *   - nid:
 *     Links associated with nodes
 *   - tid:
 *     Links associated with terms
 *   - uid:
 *     Links associated with users
 *   - xml:
 *     An XML site map (for including site maps from other modules)
 * @param $excludes:
 *   If set, an array of criteria for excluding links.
 * @return
 *   If $type is xml, return an XML site map. Otherwise, return an array of
 *   links or an empty array. Each link should be an array with the
 *   following keys:
 *   - nid, tid, or uid:
 *     ID to associate with this link (if $type is set)
 *   - #loc:
 *     The URL of the page
 *   - #lastmod:
 *     Timestamp of last modification
 *   - #changefreq:
 *     Number of seconds between changes
 *   - #priority:
 *     A number between 1.0 and 0.0 indicating the link's priority
 */
function hook_xmlsitemap($type = NULL, $excludes = array()) {
  $additional = array();
  switch ($type) {
    case 'node':
      // Add pages created by the node paging module.
      foreach (node_get_types() as $type => $name) {
        $node_types[$type] = db_escape_string($type);
      }
      $excludes = array_merge($excludes, array_diff($node_types, variable_get('paging_node_types_enabled', array())));
      if (module_exists('comment')) {
        $result = db_query("
          SELECT p.pages, n.nid, n.type, n.promote, s.comment_count, n.changed, x.previously_changed, s.last_comment_timestamp, x.previous_comment, x.priority_override, u.dst AS alias
          FROM {node} n
          INNER JOIN {paging} p
          ON n.nid = p.nid
          LEFT JOIN {node_comment_statistics} s
          ON n.nid = s.nid
          LEFT JOIN {xmlsitemap} x
          ON n.nid = x.nid
          LEFT JOIN {url_alias} u
          ON x.pid = u.pid
          WHERE n.status > 0
          AND (x.priority_override >= 0 OR x.priority_override IS NULL)
          AND n.type NOT IN ('". implode("', '", $excludes) ."')
        ");
        $maxcomments = db_result(db_query('SELECT MAX(comment_count) FROM {node_comment_statistics}'));
      }
      else {
        $result = db_query("
          SELECT p.pages, n.nid, n.type, n.promote, n.changed, x.previously_changed, x.priority_override, u.dst AS alias
          FROM {node} n
          INNER JOIN {paging} p
          ON n.nid = p.nid
          LEFT JOIN {xmlsitemap} x
          ON n.nid = x.nid
          LEFT JOIN {url_alias} u
          ON x.pid = u.pid
          WHERE n.status > 0
          AND (x.priority_override >= 0 OR x.priority_override IS NULL)
          AND n.type NOT IN ('". implode("', '", $excludes) ."')
        ");
        $maxcomments = 0;
      }
      while ($node = db_fetch_object($result)) {
        $pri = xmlsitemap_node_priority($node, $maxcomments);
        if ($pri < 0) {
          continue;
        }
        $age = time() - $node->changed;
        if (!empty($node->previously_changed)) {
          $interval = $node->changed - $node->previously_changed;
        }
        else {
          $interval = 0;
        }
        for ($count = 1; $count < $node->pages; ++ $count) {
          $entry = array(
            'nid' => $node->nid,
            '#loc' => xmlsitemap_url('node/'. $node->nid, $node->alias, "page=0,$count", NULL, TRUE),
            '#lastmod' => $node->changed,
            '#changefreq' => max($age, $interval),
            '#priority' => $pri,
          );
          $additional[] = $entry;
        }
      }
      break;
    case 'term':
    case 'user':
      break;
    case 'xml':
      $additional = example_sitemap();
      break;
    default:
      // Add arbitrary additional links.
      $result = db_query('SELECT x.*, u.dst AS alias FROM {xmlsitemap_additional} x LEFT JOIN {url_alias} u ON x.pid = u.pid');
      while ($link = db_fetch_object($result)) {
        $age = time() - $link->last_changed;
        if (!empty($link->previously_changed)) {
          $interval = $link->last_changed - $link->previously_changed;
        }
        else {
          $interval = 0;
        }
        $entry = array(
          '#loc' => xmlsitemap_url($link->path, $link->alias, NULL, NULL, TRUE),
          '#lastmod' => $link->last_changed,
          '#changefreq' => max($age, $interval),
          '#priority' => $link->priority,
        );
        $additional[] = $entry;
      }
  }
  return $additional;
}

/**
 * @} End of "addtogroup hooks".
 */

