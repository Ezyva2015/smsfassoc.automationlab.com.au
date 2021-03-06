<?php
/**
 * Displays a topic.
 *
 * Available Variables:
 * 
 * $course_id 		: (int) ID of the course
 * $course 		: (object) Post object of the course
 * $course_settings : (array) Settings specific to current course
 * $course_status 	: Course Status
 * $has_access 	: User has access to course or is enrolled.
 * 
 * $courses_options : Options/Settings as configured on Course Options page
 * $lessons_options : Options/Settings as configured on Lessons Options page
 * $quizzes_options : Options/Settings as configured on Quiz Options page
 * 
 * $user_id 		: (object) Current User ID
 * $logged_in 		: (true/false) User is logged in
 * $current_user 	: (object) Currently logged in user object
 * $quizzes 		: (array) Quizzes Array
 * $post 			: (object) The topic post object
 * $lesson_post 	: (object) Lesson post object in which the topic exists
 * $topics 		: (array) Array of Topics in the current lesson
 * $all_quizzes_completed : (true/false) User has completed all quizzes on the lesson Or, there are no quizzes.
 * $lesson_progression_enabled 	: (true/false)
 * $show_content	: (true/false) true if lesson progression is disabled or if previous lesson and topic is completed. 
 * $previous_lesson_completed 	: (true/false) true if previous lesson is completed
 * $previous_topic_completed	: (true/false) true if previous topic is completed
 * 
 * @since 2.1.0
 * 
 * @package LearnDash\Topic
 */
?>


<?php
/**
 * Topic Dots
 */
?>
<?php if ( ! empty( $topics ) ) : ?>
	<!--<div id='learndash_topic_dots-<?php echo esc_attr( $lesson_id ); ?>' class="learndash_topic_dots type-dots">

		<b><?php _e( 'Topic Progress:', 'learndash' ); ?></b>

		<?php foreach ( $topics as $key => $topic ) : ?>
			<?php $completed_class = empty( $topic->completed ) ? 'topic-notcompleted' : 'topic-completed'; ?>
			<a class='<?php echo esc_attr( $completed_class ); ?>' href='<?php echo get_permalink( esc_attr( $topic->ID ) ); ?>' title='<?php echo esc_attr( $topic->post_title ); ?>'>
				<span title='<?php echo esc_attr( $topic->post_title ); ?>'></span>
			</a>
		<?php endforeach; ?>

	</div>-->
<?php endif; ?>

<div id="learndash_back_to_lesson"><a href='<?php echo esc_attr( get_permalink( $lesson_id) ); ?>'>&larr; <?php _e( 'Back to Lesson', 'learndash' ); ?></a></div>

<?php if ( $lesson_progression_enabled && ! $previous_topic_completed ) : ?>

	<span id="learndash_complete_prev_topic"><?php  _e( 'Please go back and complete the previous topic.', 'learndash' ); ?></span>
    <br />

<?php elseif ( $lesson_progression_enabled && ! $previous_lesson_completed ) : ?>

	<span id="learndash_complete_prev_lesson"><?php _e( 'Please go back and complete the previous lesson.', 'learndash' ); ?></span>
    <br />

<?php endif; ?>

<?php if ( $show_content ) : ?>



<?php  if ( is_user_logged_in() || get_the_lessontopic($post->ID,854)==1 ) { ?>

<?php if ( ! empty( $topics ) ) : ?>
		<div id="learndash_lesson_topics_list" style="float:left">
            <div id='learndash_topic_dots-<?php echo esc_attr( $post->ID ); ?>' class="learndash_topic_dots type-list">
                <strong><?php _e( 'Knowledge Topics', 'learndash'); ?></strong>
                <ul>
                    <?php $odd_class = ''; ?>

                    <?php foreach ( $topics as $key => $topic ) : ?>

                        <?php $odd_class = empty( $odd_class ) ? 'nth-of-type-odd' : ''; ?>
                        <?php $completed_class = empty( $topic->completed ) ? 'topic-notcompleted' : 'topic-completed'; ?>

                        <li class='<?php echo esc_attr( $odd_class ); ?>'>
                            <span class="topic_item" <?php if($post->ID==$topic->ID){ echo "style='background:#ddd'"; } ?>>
                                <a class='<?php echo esc_attr( $completed_class ); ?>' href='<?php echo esc_attr( get_permalink( $topic->ID ) ); ?>' title='<?php echo esc_attr( $topic->post_title ); ?>'>
                                    <span><?php echo $topic->post_title; ?></span>
                                </a>
                            </span>
                        </li>

                    <?php endforeach; ?>

                </ul>
            </div>
		</div>	
	
	
	
		<?php endif; ?>

		<div class="fplearndash-content" style="float:right">
			<?php echo $content; ?>
		</div>





		<?php
		
		$quizids="";
		
		$swtopicinfo = get_post_meta($post->ID,'_sfwd-topic', true);
		
		$quizlist = get_posts('post_type=sfwd-quiz');
		
		foreach($quizlist as $quizindex=>$quizdata){
			
			$quizlesson = get_post_meta($quizdata->ID,'_sfwd-quiz', true);
			
			
			if($quizlesson['sfwd-quiz_lesson']==$swtopicinfo['sfwd-topic_lesson']){
				
				$quizids[]=$quizdata->ID;
				
			}
			
		}
		
	
	$quizzes="";
		
	
	foreach($quizids as $quizid){
		
		$quizzes = get_post( $quizid ); 
		
	?>
	
	<?php if ( ! empty( $quizzes ) ) : ?>
		<div class="clear"></div>
		<div id="learndash_quizzes" style="float: right; width: 29%;">
			<div id="quiz_heading"><span><?php _e( 'Test your knowledge', 'learndash' ); ?></span></div>
			<div id="quiz_list">
				<div id='post-<?php echo esc_attr( $quizzes->post_id ); ?>'>				
					<h4>
						<a class='<?php echo esc_attr( $quiz['status'] ); ?>' href='<?php echo esc_attr( $quizzes->guid ); ?>'><?php echo $quizzes->post_title; ?></a>
					</h4>
				</div>
			</div>
		</div>
	<?php endif; } ?>
	
	
	<?php if ( lesson_hasassignments( $post ) ) : ?>

		<?php $assignments = learndash_get_user_assignments( $post->ID, $user_id ); ?>

		<div id="learndash_uploaded_assignments">
			<h2><?php _e( 'Files you have uploaded', 'learndash' ); ?></h2>
			<table>
				<?php if ( ! empty( $assignments ) ) : ?>
					<?php foreach( $assignments as $assignment ) : ?>
							<tr>
								<td><a href='<?php echo esc_attr( get_post_meta( $assignment->ID, 'file_link', true ) ); ?>' target="_blank"><?php echo __( 'Download', 'learndash' ) . ' ' . get_post_meta( $assignment->ID, 'file_name', true ); ?></a></td>
								<td><a href='<?php echo esc_attr( get_permalink( $assignment->ID) ); ?>'><?php _e( 'Comments', 'learndash' ); ?></a></td>
							</tr>
					<?php endforeach; ?>
				<?php endif; ?>
			</table>
		</div>

	<?php endif; ?>
	
<?php } //user is logged in end ?>	
	

	<?php
    /**
     * Show Mark Complete Button
     */
    ?>
	<?php if ( $all_quizzes_completed ) : ?>
		<?php //echo '<br />' . learndash_mark_complete( $post ); ?>
	<?php endif; ?>

<?php endif; ?>
<div style="clear:both;"></div>
<!--<p id="learndash_next_prev_link"><?php echo learndash_previous_post_link(); ?>&nbsp;&nbsp;&nbsp;&nbsp;<?php echo learndash_next_post_link(); ?></p>-->