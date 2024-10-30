<?php

function bpmvtpc_update_names() {
   global $wpdb;

    $defaults = array(
            'type' => 'active', // active, newest, alphabetical, random, popular, most-forum-topics or most-forum-posts
            'user_id' => false, // Pass a user_id to limit to only groups that this user is a member of
            'search_terms' => false, // Limit to groups that match these search terms

            'per_page' => 200, // The number of results to return per page
            'page' => 1, // The page to return if limiting per page
            'populate_extras' => true, // Fetch meta such as is_banned and is_member
    );
   echo "<h3>Updating names and descriptions of forums..</h3>";
   $groups=groups_get_groups($defaults);
   echo "<ul>";
    foreach ( (array) $groups['groups'] as $current_group ) {
        $forum_id=groups_get_groupmeta($current_group->id,"forum_id");
        if($forum_id){
            echo "<li><b>$current_group->name</b> ($current_group->description)</li>";
            $wpdb->update( $wpdb->base_prefix."bb_"."forums",
                    array(
                    "forum_name"=>$current_group->name
                    ),
                    array(
                    "forum_id"=>$forum_id
                    )
            );
            $wpdb->update( $wpdb->base_prefix."bb_"."forums",
                    array(
                    "forum_desc"=>$current_group->description
                    ),
                    array(
                    "forum_id"=>$forum_id
                    )
            );
        }

    }
   echo "</ul>";
    echo "<h3>Done!</h3>";
}

/**
 * moves topics
 */
function bpmvtpc_move_topics($fromid, $toid) {
    global $wpdb;
    if($fromid==$toid){
        echo "<h3>Orly??</h3>";
        return;
    }
    $from_topics=bp_forums_get_forum($fromid)->topics;
    $from_posts=bp_forums_get_forum($fromid)->posts;
    $to_topics=bp_forums_get_forum($toid)->topics;
    $to_posts=bp_forums_get_forum($toid)->posts;
    
    $new_topics=$from_topics+$to_topics;
    $new_posts=$from_posts+$to_posts;

    echo "<h3>Moving topics..</h3>";
    $wpdb->update( $wpdb->base_prefix."bb_"."topics",
            array(
            "forum_id"=>$toid
            ),
            array(
            "forum_id"=>$fromid
            )
    );
    //update counts
    $wpdb->update( $wpdb->base_prefix."bb_"."forums",
            array(
            "topics"=>0
            ),
            array(
            "forum_id"=>$fromid
            )
    );
    $wpdb->update( $wpdb->base_prefix."bb_"."forums",
            array(
            "posts"=>0
            ),
            array(
            "forum_id"=>$fromid
            )
    );
    $wpdb->update( $wpdb->base_prefix."bb_"."forums",
            array(
            "topics"=>$new_topics
            ),
            array(
            "forum_id"=>$toid
            )
    );
    $wpdb->update( $wpdb->base_prefix."bb_"."forums",
            array(
            "posts"=>$new_posts
            ),
            array(
            "forum_id"=>$toid
            )
    );
    echo "<h3>Done!</h3>";
}

?>
