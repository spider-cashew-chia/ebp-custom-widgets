<?php
use Elementor\Widget_Base;
use Elementor\Controls_Manager;

if (!defined('ABSPATH'))
    exit;



class Ebp_Custom_Stats_1 extends Widget_Base
{

    public function get_name()
    {
        return 'ebp_custom_stats_1';
    }

    public function get_title()
    {
        return __('EBP Custom Stats 1', 'ebp-custom-widgets');
    }

    public function get_icon()
    {


        // Fallback to default icon if file doesn't exist
        return 'eicon-archive';
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
        return ['ebp-custom-stats-1-style'];
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

        // Rich text control for col-lg-7 (title section)
        $this->add_control(
            'title_content',
            [
                'label' => __('Title Content', 'ebp-custom-widgets'),
                'type' => Controls_Manager::WYSIWYG,
                'default' => __('<h2><span class="aximo-title-animation">We make your<span class="aximo-title-icon"><img src="assets/images/v1/star2.png" alt=""></span></span>business stand out</h2>', 'ebp-custom-widgets'),
                'placeholder' => __('Enter your title content here...', 'ebp-custom-widgets'),
            ]
        );

        // Rich text control for col-lg-4 (description section)
        $this->add_control(
            'description_content',
            [
                'label' => __('Description Content', 'ebp-custom-widgets'),
                'type' => Controls_Manager::WYSIWYG,
                'default' => __('<p>We work closely with our clients to know their objectives, target audience, unique needs, and practical design solutions.</p>', 'ebp-custom-widgets'),
                'placeholder' => __('Enter your description content here...', 'ebp-custom-widgets'),
            ]
        );

        // Video link control for col-lg-8
        $this->add_control(
            'video_url',
            [
                'label' => __('Video Link', 'ebp-custom-widgets'),
                'type' => Controls_Manager::URL,
                'placeholder' => __('https://www.youtube.com/watch?v=VIDEO_ID', 'ebp-custom-widgets'),
                'show_external' => true,
                'default' => [
                    'url' => 'https://www.youtube.com/watch?v=Vx2aLNgGoAE',
                    'is_external' => true,
                    'nofollow' => false,
                ],
            ]
        );

        // Image control for video background
        $this->add_control(
            'video_background_image',
            [
                'label' => __('Video Background Image', 'ebp-custom-widgets'),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => '',
                ],
            ]
        );

        $this->end_controls_section();

        // Counter Repeater Section
        $this->start_controls_section(
            'counter_section',
            [
                'label' => __('Counter Items', 'ebp-custom-widgets'),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

        // Repeater control for counter items
        $repeater = new \Elementor\Repeater();

        // Percentage/number control
        $repeater->add_control(
            'counter_percentage',
            [
                'label' => __('Number', 'ebp-custom-widgets'),
                'type' => Controls_Manager::NUMBER,
                'default' => 15,
                'min' => 0,
                'step' => 1,
                'description' => __('Enter the number value for the counter', 'ebp-custom-widgets'),
            ]
        );

        // Suffix control (+, k, %, etc.)
        $repeater->add_control(
            'counter_suffix',
            [
                'label' => __('Suffix', 'ebp-custom-widgets'),
                'type' => Controls_Manager::TEXT,
                'default' => __('+', 'ebp-custom-widgets'),
                'placeholder' => __('e.g., +, k, %', 'ebp-custom-widgets'),
                'description' => __('Enter the suffix to display after the number (e.g., +, k, %)', 'ebp-custom-widgets'),
            ]
        );

        // Description control
        $repeater->add_control(
            'counter_description',
            [
                'label' => __('Description', 'ebp-custom-widgets'),
                'type' => Controls_Manager::TEXT,
                'default' => __('Years of experience', 'ebp-custom-widgets'),
                'placeholder' => __('Enter counter description...', 'ebp-custom-widgets'),
            ]
        );

        // Add the repeater to the widget
        $this->add_control(
            'counter_list',
            [
                'label' => __('Counter Items', 'ebp-custom-widgets'),
                'type' => Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        'counter_percentage' => 15,
                        'counter_suffix' => __('+', 'ebp-custom-widgets'),
                        'counter_description' => __('Years of experience', 'ebp-custom-widgets'),
                    ],
                    [
                        'counter_percentage' => 120,
                        'counter_suffix' => __('k', 'ebp-custom-widgets'),
                        'counter_description' => __('Successful projects', 'ebp-custom-widgets'),
                    ],
                    [
                        'counter_percentage' => 100,
                        'counter_suffix' => __('%', 'ebp-custom-widgets'),
                        'counter_description' => __('Client satisfaction rate', 'ebp-custom-widgets'),
                    ],
                ],
                'title_field' => '{{{ counter_description }}}',
            ]
        );

        $this->end_controls_section();
    }


    protected function render()
    {
        // Get all the settings for this widget
        $settings = $this->get_settings_for_display();

        // Get video URL settings and build the link attributes
        $video_url = $settings['video_url'];
        $video_link = '#';
        $video_target = '';
        $video_rel = '';

        if (!empty($video_url['url'])) {
            $video_link = esc_url($video_url['url']);

            // Add target attribute if link opens in new tab
            if (!empty($video_url['is_external'])) {
                $video_target = ' target="_blank"';
            }

            // Add rel attribute for nofollow links
            if (!empty($video_url['nofollow'])) {
                $video_rel = ' rel="nofollow"';
            }
        }

        // Get video background image URL and alt text
        $video_bg_image_url = '';
        $video_bg_image_alt = '';
        if (!empty($settings['video_background_image']['url'])) {
            $video_bg_image_url = esc_url($settings['video_background_image']['url']);
            $video_bg_image_alt = !empty($settings['video_background_image']['alt']) ? esc_attr($settings['video_background_image']['alt']) : '';
        }

        ?>
<!-- Stats  -->
<div class="section aximo-section-padding">
    <div id="aximo-counter"></div>
    <div class="container">
        <div class="aximo-section-title">
            <div class="row">
                <div class="col-lg-7">
                    <?php
                            // Output the rich text content for title
                            if (!empty($settings['title_content'])) {
                                echo wp_kses_post($settings['title_content']);
                            }
                            ?>
                </div>
                <div class="col-lg-4 offset-lg-1 d-flex align-items-center">
                    <?php
                            // Output the rich text content for description
                            if (!empty($settings['description_content'])) {
                                echo wp_kses_post($settings['description_content']);
                            }
                            ?>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-8">
                <div class="aximo-video-wrap wow fadeInUpX" data-wow-delay="0s">
                    <?php if (!empty($video_bg_image_url)): ?>
                    <img src="<?php echo $video_bg_image_url; ?>" alt="<?php echo $video_bg_image_alt; ?>">
                    <?php endif; ?>
                    <a class="aximo-video-popup play-btn1 video-init" href="<?php echo $video_link; ?>"
                        <?php echo $video_target . $video_rel; ?>>
                        <img src="/wp-content/uploads/2025/11/play-btn.svg" alt="">
                    </a>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="aximo-counter-wrap">
                    <?php
                            // Check if counter list exists and has items
                            if (!empty($settings['counter_list'])) {
                                foreach ($settings['counter_list'] as $index => $counter) {
                                    // Get counter values with defaults
                                    $counter_percentage = !empty($counter['counter_percentage']) ? intval($counter['counter_percentage']) : 0;
                                    $counter_suffix = !empty($counter['counter_suffix']) ? esc_html($counter['counter_suffix']) : '';
                                    $counter_description = !empty($counter['counter_description']) ? esc_html($counter['counter_description']) : '';
                                    ?>
                    <div class="aximo-counter-data">
                        <h2 class="aximo-counter-number">
                            <span data-percentage="<?php echo $counter_percentage; ?>"
                                class="aximo-counter"></span><?php echo $counter_suffix; ?>
                        </h2>
                        <?php if (!empty($counter_description)): ?>
                        <p><?php echo $counter_description; ?></p>
                        <?php endif; ?>
                    </div>
                    <?php
                                }
                            }
                            ?>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End section -->

<?php
    }
}