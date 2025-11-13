<?php
use Elementor\Widget_Base;
use Elementor\Controls_Manager;

if (!defined('ABSPATH'))
    exit;



class Ebp_Custom_Team_1 extends Widget_Base
{

    public function get_name()
    {
        return 'ebp_custom_team_1';
    }

    public function get_title()
    {
        return __('EBP Custom Team 1', 'ebp-custom-widgets');
    }

    public function get_icon()
    {


        // Fallback to default icon if file doesn't exist
        return 'eicon-person';
    }

    public function get_categories()
    {
        return ['ebp-custom-widgets'];
    }

    // Enqueue widget assets
    public function get_script_depends()
    {
        return ['jquery'];
    }

    public function get_style_depends()
    {
        return ['ebp-custom-team-1-style'];
    }


    protected function register_controls()
    {
        // Content Section - for all the content controls
        $this->start_controls_section(
            'content_section',
            [
                'label' => __('Content', 'ebp-custom-widgets'),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

        // Rich text control for section title
        $this->add_control(
            'section_title',
            [
                'label' => __('Section Title', 'ebp-custom-widgets'),
                'type' => Controls_Manager::WYSIWYG,
                'default' => __('<h2>We have a team of<span class="aximo-title-animation">creative people<span class="aximo-title-icon"><img src="assets/images/v1/star2.png" alt=""></span></span></h2>', 'ebp-custom-widgets'),
                'placeholder' => __('Enter your section title here...', 'ebp-custom-widgets'),
            ]
        );

        $this->end_controls_section();

        // Query Section - for CPT query settings
        $this->start_controls_section(
            'query_section',
            [
                'label' => __('Query', 'ebp-custom-widgets'),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

        // Post type control - default to 'team'
        $this->add_control(
            'post_type',
            [
                'label' => __('Post Type', 'ebp-custom-widgets'),
                'type' => Controls_Manager::SELECT,
                'default' => 'team',
                'options' => $this->get_post_types(),
                'description' => __('Select the custom post type to display', 'ebp-custom-widgets'),
            ]
        );

        // Posts per page control
        $this->add_control(
            'posts_per_page',
            [
                'label' => __('Posts Per Page', 'ebp-custom-widgets'),
                'type' => Controls_Manager::NUMBER,
                'default' => 4,
                'min' => 1,
                'max' => 50,
                'step' => 1,
                'description' => __('Number of team members to display', 'ebp-custom-widgets'),
            ]
        );

        // Order by control
        $this->add_control(
            'orderby',
            [
                'label' => __('Order By', 'ebp-custom-widgets'),
                'type' => Controls_Manager::SELECT,
                'default' => 'date',
                'options' => [
                    'date' => __('Date', 'ebp-custom-widgets'),
                    'title' => __('Title', 'ebp-custom-widgets'),
                    'menu_order' => __('Menu Order', 'ebp-custom-widgets'),
                    'rand' => __('Random', 'ebp-custom-widgets'),
                ],
            ]
        );

        // Order control
        $this->add_control(
            'order',
            [
                'label' => __('Order', 'ebp-custom-widgets'),
                'type' => Controls_Manager::SELECT,
                'default' => 'DESC',
                'options' => [
                    'ASC' => __('Ascending', 'ebp-custom-widgets'),
                    'DESC' => __('Descending', 'ebp-custom-widgets'),
                ],
            ]
        );

        $this->end_controls_section();
    }

    // Helper function to get available post types
    private function get_post_types()
    {
        // Get all public post types
        $post_types = get_post_types(['public' => true], 'objects');
        $options = [];

        foreach ($post_types as $post_type) {
            $options[$post_type->name] = $post_type->label;
        }

        return $options;
    }


    protected function render()
    {
        // Get all the settings for this widget
        $settings = $this->get_settings_for_display();

        // Get query settings
        $post_type = !empty($settings['post_type']) ? $settings['post_type'] : 'team';
        $posts_per_page = !empty($settings['posts_per_page']) ? intval($settings['posts_per_page']) : 4;
        $orderby = !empty($settings['orderby']) ? $settings['orderby'] : 'date';
        $order = !empty($settings['order']) ? $settings['order'] : 'DESC';

        // Build query arguments for the team CPT
        $query_args = [
            'post_type' => $post_type,
            'posts_per_page' => $posts_per_page,
            'orderby' => $orderby,
            'order' => $order,
            'post_status' => 'publish',
        ];

        // Execute the query
        $team_query = new \WP_Query($query_args);

        ?>
<!-- Team  -->
<div class="section aximo-section-padding3">
    <div class="container">
        <?php if (!empty($settings['section_title'])): ?>
        <div class="aximo-section-title center">
            <?php echo wp_kses_post($settings['section_title']); ?>
        </div>
        <?php endif; ?>
        <div class="row">
            <?php
                    // Check if we have posts from the query
                    if ($team_query->have_posts()) {
                        $delay = 0.1; // Start animation delay counter
                        while ($team_query->have_posts()) {
                            $team_query->the_post();

                            // Get the post ID
                            $post_id = get_the_ID();

                            // Get featured image
                            $featured_image_url = '';
                            $featured_image_alt = '';
                            if (has_post_thumbnail($post_id)) {
                                $featured_image_id = get_post_thumbnail_id($post_id);
                                $featured_image_url = wp_get_attachment_image_url($featured_image_id, 'full');
                                $featured_image_alt = get_post_meta($featured_image_id, '_wp_attachment_image_alt', true);
                                if (empty($featured_image_alt)) {
                                    $featured_image_alt = get_the_title($post_id);
                                }
                            }

                            // Get post title
                            $post_title = get_the_title();

                            // Get post content (excerpt or full content)
                            $post_content = get_the_content();
                            // Strip HTML tags and limit length for display
                            $post_content = wp_strip_all_tags($post_content);
                            $post_content = wp_trim_words($post_content, 20, '...');

                            // Get permalink for the team member
                            $post_permalink = get_permalink();

                            // Format delay for animation attribute
                            $delay_attr = ' data-wow-delay="' . esc_attr($delay) . 's"';
                            ?>
            <div class="col-xl-3 col-md-6">
                <div class="aximo-team-wrap wow fadeInUpX" <?php echo $delay_attr; ?>>
                    <div class="aximo-team-thumb">
                        <?php if (!empty($featured_image_url)): ?>
                        <img src="<?php echo esc_url($featured_image_url); ?>"
                            alt="<?php echo esc_attr($featured_image_alt); ?>">
                        <?php endif; ?>
                        <!-- Social icons can be added here if needed -->
                    </div>
                    <div class="aximo-team-data">
                        <?php if (!empty($post_title)): ?>
                        <a href="<?php echo esc_url($post_permalink); ?>">
                            <h3><?php echo esc_html($post_title); ?></h3>
                        </a>
                        <?php endif; ?>
                        <?php if (!empty($post_content)): ?>
                        <p><?php echo esc_html($post_content); ?></p>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
            <?php
                            // Increment delay for next item
                            $delay += 0.1;
                        }
                        // Reset post data after the loop
                        wp_reset_postdata();
                    } else {
                        // No posts found message (optional, can be removed)
                        echo '<div class="col-12"><p>' . __('No team members found.', 'ebp-custom-widgets') . '</p></div>';
                    }
                    ?>
        </div>
    </div>
</div>
<!-- End section -->

<?php
    }
}