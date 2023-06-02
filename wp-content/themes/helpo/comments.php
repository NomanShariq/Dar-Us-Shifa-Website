<?php
/*
 * Created by Artureanec
*/

if (post_password_required()) {
    return;
}

function helpo_comment_code($comment, $args, $depth)
{
    $GLOBALS['comment'] = $comment;
    ?>

<div <?php comment_class('helpo_comments__item'); ?> id="comment-<?php comment_ID() ?>">
    <div class="helpo_comments__item-img">
        <?php echo get_avatar($comment->comment_author_email, $args['avatar_size']); ?>
    </div>

    <div class="helpo_comments__item-description">
        <?php
        if ($comment->comment_approved == '0') {
            echo '<p>' . esc_html__('Your comment is awaiting moderation.', 'helpo') . '</p>';
        }

        echo '
            <div class="helpo_comment_meta">
                <div class="helpo_comment_author_cont">
                    <span class="helpo_comments__item-name">' . esc_html(get_comment_author()) . '</span>
                    <span class="helpo_comments__item-date">' . esc_html(get_comment_date()) . '</span>
                </div>
                ';
                ?>
                <div class="helpo_comment_reply_cont">
                    <?php
                    $reply_button = '
                        <svg class="icon">
                            <svg viewBox="0 0 16 16" id="previous-' . mt_rand(0, 99999) . '" xmlns="http://www.w3.org/2000/svg">
                                <path d="M0 7.9L6 3v3h2c8 0 8 8 8 8s-1-4-7.8-4H6v2.9l-6-5z"></path>
                            </svg>
                        </svg>
                    ';

                    comment_reply_link(
                        array_merge(
                            $args, array(
                                'before' => ' <span class="helpo_comments__item-action">',
                                'after' => '</span>',
                                'depth' => $depth,
                                'reply_text' => $reply_button,
                                'max_depth' => $args['max_depth']
                            )
                        )
                    );
                    edit_comment_link('<i class="fa fa-pencil"></i>');
                    ?>
                </div>
                <?php
                echo '
				<div class="clear"></div>
            </div>
        ';
        ?>

        <div class="helpo_comments__item-text">
            <?php comment_text(); ?>
        </div>
    </div>
    <?php
}
if (have_comments() || comments_open()) {
    ?>

    <div class="helpo_comments_cont">
        <div class="helpo_comments_wrapper">
            <?php
            if (have_comments()) {
                the_comments_navigation();
                ?>

                <h6 class="helpo_blog-post__title"><?php echo esc_html__('Comments', 'helpo'); ?></h6>

                <div class="helpo_comments">
                    <?php
                    wp_list_comments(array(
                        'style' => 'div',
                        'max_depth' => '5',
                        'avatar_size' => 70,
                        'type' => 'all',
                        'callback' => 'helpo_comment_code'
                    ));
                    ?>
                </div>

                <?php the_comments_navigation();
            }

            $helpo_comments_field_req = get_option('require_name_email');

            comment_form(array(
                'title_reply_before' => '<h6 class="helpo_blog-post__title">',
                'title_reply' => esc_html__('Leave a Comment', 'helpo'),
                'title_reply_after' => '</h6>',
                'fields' => array(
                    'author' => '<div class="row"><div class="col-6"><input class="form__field" placeholder="'.esc_attr__('Name', 'helpo') . ($helpo_comments_field_req ? ' *' : '').'" name="author" type="text" value="' . esc_attr($commenter['comment_author']) . '" size="30" /></div>',
                    'email' => '<div class="col-6"><input class="form__field" placeholder="'.esc_attr__('Email', 'helpo') . ($helpo_comments_field_req ? ' *' : '').'" name="email" type="text" value="' . esc_attr($commenter['comment_author_email']) . '" size="30" /></div></div>',
                ),
                'comment_field' => '<div class="row"><div class="col-12"><textarea name="comment" cols="45" rows="5" placeholder="' . esc_attr__('Comment', 'helpo') . '" id="comment-message" class="form__field form__message"></textarea></div></div>',
                'label_submit' => esc_html__('Post Comment', 'helpo'),
            ));
            ?>
        </div>
    </div>

    <?php
}



