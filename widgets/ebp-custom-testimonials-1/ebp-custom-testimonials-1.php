<?php
use Elementor\Widget_Base;
use Elementor\Controls_Manager;

if (!defined('ABSPATH'))
    exit;



class Ebp_Custom_Testimonials_1 extends Widget_Base
{

    public function get_name()
    {
        return 'ebp_custom_testimonials_1';
    }

    public function get_title()
    {
        return __('EBP Custom Testimonials 1', 'ebp-custom-widgets');
    }

    public function get_icon()
    {


        // Fallback to default icon if file doesn't exist
        return 'eicon-testimonial';
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
        return ['ebp-custom-testimonials-1-style'];
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
                'default' => __('<h2>Clients are always<span class="aximo-title-animation">satisfied with us<span class="aximo-title-icon"><img src="assets/images/v1/star2.png" alt=""></span></span></h2>', 'ebp-custom-widgets'),
                'placeholder' => __('Enter your section title here...', 'ebp-custom-widgets'),
            ]
        );

        $this->end_controls_section();

        // Testimonials Repeater Section
        $this->start_controls_section(
            'testimonials_section',
            [
                'label' => __('Testimonials', 'ebp-custom-widgets'),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

        // Repeater control for testimonials
        $repeater = new \Elementor\Repeater();

        // Rating control (number of stars, 1-5)
        $repeater->add_control(
            'testimonial_rating',
            [
                'label' => __('Rating (Stars)', 'ebp-custom-widgets'),
                'type' => Controls_Manager::NUMBER,
                'default' => 5,
                'min' => 1,
                'max' => 5,
                'step' => 1,
                'description' => __('Enter the number of stars (1-5)', 'ebp-custom-widgets'),
            ]
        );

        // Testimonial title/heading control
        $repeater->add_control(
            'testimonial_title',
            [
                'label' => __('Testimonial Title', 'ebp-custom-widgets'),
                'type' => Controls_Manager::TEXT,
                'default' => __('Super customer service!', 'ebp-custom-widgets'),
                'placeholder' => __('Enter testimonial title...', 'ebp-custom-widgets'),
            ]
        );

        // Testimonial content/description control
        $repeater->add_control(
            'testimonial_content',
            [
                'label' => __('Testimonial Content', 'ebp-custom-widgets'),
                'type' => Controls_Manager::TEXTAREA,
                'default' => __('Excellent customer service and I was really impressed and happy with my purchase especially as it was a last minute order which got to me in time, and when it arrived I was very happy with the design and size and so was the recipient.', 'ebp-custom-widgets'),
                'placeholder' => __('Enter testimonial content...', 'ebp-custom-widgets'),
                'rows' => 4,
            ]
        );

        // Author name control
        $repeater->add_control(
            'author_name',
            [
                'label' => __('Author Name', 'ebp-custom-widgets'),
                'type' => Controls_Manager::TEXT,
                'default' => __('William Jack', 'ebp-custom-widgets'),
                'placeholder' => __('Enter author name...', 'ebp-custom-widgets'),
            ]
        );

        // Author role/position control
        $repeater->add_control(
            'author_role',
            [
                'label' => __('Author Role/Position', 'ebp-custom-widgets'),
                'type' => Controls_Manager::TEXT,
                'default' => __('Founder@XYZ', 'ebp-custom-widgets'),
                'placeholder' => __('Enter author role...', 'ebp-custom-widgets'),
            ]
        );

        // Author image control
        $repeater->add_control(
            'author_image',
            [
                'label' => __('Author Image', 'ebp-custom-widgets'),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => '',
                ],
            ]
        );

        // Animation delay control
        $repeater->add_control(
            'animation_delay',
            [
                'label' => __('Animation Delay', 'ebp-custom-widgets'),
                'type' => Controls_Manager::TEXT,
                'default' => __('0.1s', 'ebp-custom-widgets'),
                'placeholder' => __('e.g., 0.1s', 'ebp-custom-widgets'),
                'description' => __('Enter animation delay value (e.g., 0.1s, 0.2s)', 'ebp-custom-widgets'),
            ]
        );

        // Add the repeater to the widget
        $this->add_control(
            'testimonials_list',
            [
                'label' => __('Testimonials List', 'ebp-custom-widgets'),
                'type' => Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        'testimonial_rating' => 5,
                        'testimonial_title' => __('Super customer service!', 'ebp-custom-widgets'),
                        'testimonial_content' => __('Excellent customer service and I was really impressed and happy with my purchase especially as it was a last minute order which got to me in time, and when it arrived I was very happy with the design and size and so was the recipient.', 'ebp-custom-widgets'),
                        'author_name' => __('William Jack', 'ebp-custom-widgets'),
                        'author_role' => __('Founder@XYZ', 'ebp-custom-widgets'),
                        'author_image' => ['url' => ''],
                        'animation_delay' => __('0.1s', 'ebp-custom-widgets'),
                    ],
                    [
                        'testimonial_rating' => 5,
                        'testimonial_title' => __('Exceptional creativity and vision', 'ebp-custom-widgets'),
                        'testimonial_content' => __('Working Mthemeus was a game-changer for our brand. Their exceptional creativity & vision breathed new life into our visual. The logo they perfectly captures our essence & has become instantly recognizable. We couldn\'t be happier the results!', 'ebp-custom-widgets'),
                        'author_name' => __('Smith Align', 'ebp-custom-widgets'),
                        'author_role' => __('Businessman', 'ebp-custom-widgets'),
                        'author_image' => ['url' => ''],
                        'animation_delay' => __('0.2s', 'ebp-custom-widgets'),
                    ],
                    [
                        'testimonial_rating' => 5,
                        'testimonial_title' => __('Innovative and professional', 'ebp-custom-widgets'),
                        'testimonial_content' => __('I can\'t say enough good things about them. Their team is not only incredibly talented but also highly professional. They listened to our ideas and brought to life in ways we couldn\'t have imagined. Their innovative approach and dedication to our project.', 'ebp-custom-widgets'),
                        'author_name' => __('Milano Joe', 'ebp-custom-widgets'),
                        'author_role' => __('Creative Director', 'ebp-custom-widgets'),
                        'author_image' => ['url' => ''],
                        'animation_delay' => __('0.3s', 'ebp-custom-widgets'),
                    ],
                    [
                        'testimonial_rating' => 5,
                        'testimonial_title' => __('Transformed our brand', 'ebp-custom-widgets'),
                        'testimonial_content' => __('Our partnership with Mthemeus transformed our brand from ordinary to extraordinary. Their branding expertise and design work elevated our marketing materials to a whole new level. Our customers have taken notice, and boost in brand recognition.', 'ebp-custom-widgets'),
                        'author_name' => __('Danial Mark', 'ebp-custom-widgets'),
                        'author_role' => __('Marketing Director', 'ebp-custom-widgets'),
                        'author_image' => ['url' => ''],
                        'animation_delay' => __('0.4s', 'ebp-custom-widgets'),
                    ],
                ],
                'title_field' => '{{{ testimonial_title }}}',
            ]
        );

        $this->end_controls_section();
    }


    protected function render()
    {
        // Get all the settings for this widget
        $settings = $this->get_settings_for_display();

        ?>
<!-- Testimonials  -->

<div class="section aximo-section-padding3">
    <div class="container">
        <?php if (!empty($settings['section_title'])): ?>
        <div class="aximo-section-title center">
            <?php echo wp_kses_post($settings['section_title']); ?>
        </div>
        <?php endif; ?>
        <div class="row">
            <?php
                    // Check if testimonials list exists and has items
                    if (!empty($settings['testimonials_list'])) {
                        foreach ($settings['testimonials_list'] as $index => $testimonial) {
                            // Get rating value, default to 5 if not set
                            $rating = !empty($testimonial['testimonial_rating']) ? intval($testimonial['testimonial_rating']) : 5;
                            // Ensure rating is between 1 and 5
                            $rating = max(1, min(5, $rating));

                            // Get animation delay, default to empty if not set
                            $animation_delay = !empty($testimonial['animation_delay']) ? esc_attr($testimonial['animation_delay']) : '';
                            $delay_attr = !empty($animation_delay) ? ' data-wow-delay="' . $animation_delay . '"' : '';

                            // Get author image URL and alt text
                            $author_image_url = '';
                            $author_image_alt = '';
                            if (!empty($testimonial['author_image']['url'])) {
                                $author_image_url = esc_url($testimonial['author_image']['url']);
                                $author_image_alt = !empty($testimonial['author_image']['alt']) ? esc_attr($testimonial['author_image']['alt']) : '';
                            }
                            ?>
            <div class="col-lg-6">
                <div class="aximo-testimonial-wrap wow fadeInUpX" <?php echo $delay_attr; ?>>
                    <div class="aximo-testimonial-rating">
                        <ul>
                            <?php
                                            // Output stars based on rating value
                                            for ($i = 1; $i <= 5; $i++) {
                                                if ($i <= $rating) {
                                                    echo '<li><i class="icon-star"></i></li>';
                                                }
                                            }
                                            ?>
                        </ul>
                    </div>
                    <div class="aximo-testimonial-data">
                        <?php if (!empty($testimonial['testimonial_title'])): ?>
                        <h3><?php echo esc_html($testimonial['testimonial_title']); ?></h3>
                        <?php endif; ?>
                        <?php if (!empty($testimonial['testimonial_content'])): ?>
                        <p><?php echo esc_html($testimonial['testimonial_content']); ?></p>
                        <?php endif; ?>
                    </div>
                    <div class="aximo-testimonial-author">
                        <?php if (!empty($author_image_url)): ?>
                        <div class="aximo-testimonial-author-thumb">
                            <img src="<?php echo $author_image_url; ?>" alt="<?php echo $author_image_alt; ?>">
                        </div>
                        <?php endif; ?>
                        <div class="aximo-testimonial-author-data">
                            <p>
                                <?php if (!empty($testimonial['author_name'])): ?>
                                <?php echo esc_html($testimonial['author_name']); ?>
                                <?php endif; ?>
                                <?php if (!empty($testimonial['author_role'])): ?>
                                <span><?php echo esc_html($testimonial['author_role']); ?></span>
                                <?php endif; ?>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <?php
                        }
                    }
                    ?>
        </div>
    </div>
</div>
<!-- End section -->
<?php
    }
}