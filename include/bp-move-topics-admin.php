<div class="wrap">
    <?php
    if ( isset( $_POST['move'] ) && check_admin_referer('bpmvtpc_admin_settings')) {
        bpmvtpc_move_topics($_POST['old_forum'], $_POST['new_forum']);
        echo "<p><a href='admin.php?page=bpmvtpc_admin_settings'>Go back</a></p>";
    }
    else if ( isset( $_POST['update_names'] ) && check_admin_referer('bpmvtpc_admin_settings')) {
        bpmvtpc_update_names();
        echo "<p><a href='admin.php?page=bpmvtpc_admin_settings'>Go back</a></p>";
    }
    else {
        ?>

    <h2>Move forum topics</h2>
    <p>This plugin can move all topics from one forum to another. The process cannot be reverted, use with care!</p>

    <form action="admin.php?page=bpmvtpc_admin_settings" method="post" id="bp-move-topics-admin-form">
        <div>
            From Forum:
            <select id="old_forum" name="old_forum">
                <?php for($count=0;$count<=100;$count+=1) {
                    $forum=bp_forums_get_forum($count);
                    if($forum) {
                        ?>
                    <option value="<?php echo($forum->forum_id);?>"><?php echo($forum->forum_name);?></option>
                    <?php
                    }
                }
                ?>
            </select>
            To Forum:
            <select id="new_forum" name="new_forum">
                <?php for($count=0;$count<=100;$count+=1) {
                    $forum=bp_forums_get_forum($count);
                    if($forum) {
                        ?>
                    <option value="<?php echo($forum->forum_id);?>"><?php echo($forum->forum_name);?></option>
                    <?php
                    }
                }
                ?>
            </select>
        </div>
        <p class="submit">
            <input class="button-primary" type="submit" name="move" value="Move"/>
        </p>
        <h4>Tools</h4>
        <p>By pressing this button you can apply the groups names and description to the forums. (e.g. when using "BuddyPress Forum Extras Forum Index")</p>
        <p class="submit">
            <input class="button-primary" type="submit" name="update_names" value="Update forum names and descriptions"/>
        </p>
        <?php
        wp_nonce_field( 'bpmvtpc_admin_settings' );
        ?>
    </form>
    <h3>About</h3>
    <p>This plugin was written by Normen Hansen for <a href="http://www.jmonkeyengine.com">jMonkeyEngine.com</a></p>
        <?php
    }
    ?>
</div>