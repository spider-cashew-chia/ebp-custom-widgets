<?php
use Elementor\Widget_Base;
use Elementor\Controls_Manager;

if (!defined('ABSPATH'))
    exit;



class Ebp_Custom_Process_1 extends Widget_Base
{

    public function get_name()
    {
        return 'ebp_custom_process_1';
    }

    public function get_title()
    {
        return __('EBP Custom Process 1', 'ebp-custom-widgets');
    }

    public function get_icon()
    {


        // Fallback to default icon if file doesn't exist
        return 'eicon-post-list';
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
        return ['ebp-custom-process-1-style'];
    }


    protected function register_controls()
    {
        // Content Section - for rich text content
        $this->start_controls_section(
            'content_section',
            [
                'label' => __('Content', 'ebp-custom-widgets'),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

        // Rich text control for section content (title and description)
        $this->add_control(
            'section_content',
            [
                'label' => __('Section Content', 'ebp-custom-widgets'),
                'type' => Controls_Manager::WYSIWYG,
                'default' => __('<h2><span class="aximo-title-animation">Our high-quality<span class="aximo-title-icon"><img src="assets/images/v1/star2.png" alt=""></span></span>working processes</h2><p>We focus at every stage on effective communication and collaboration between the client and ensuring that the final design meets the client\'s objectives and expectations.</p><p>It is important to note that these are simplified steps, and the actual work process may vary depending on the complexity of the project.</p>', 'ebp-custom-widgets'),
                'placeholder' => __('Enter your section content here...', 'ebp-custom-widgets'),
            ]
        );

        $this->end_controls_section();

        // Accordion Items Repeater Section
        $this->start_controls_section(
            'accordion_section',
            [
                'label' => __('Accordion Items', 'ebp-custom-widgets'),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

        // Repeater control for accordion items
        $repeater = new \Elementor\Repeater();

        // Accordion item title control
        $repeater->add_control(
            'accordion_title',
            [
                'label' => __('Title', 'ebp-custom-widgets'),
                'type' => Controls_Manager::TEXT,
                'default' => __('01/ Project idea', 'ebp-custom-widgets'),
                'placeholder' => __('Enter accordion title...', 'ebp-custom-widgets'),
            ]
        );

        // Accordion item content control
        $repeater->add_control(
            'accordion_content',
            [
                'label' => __('Content', 'ebp-custom-widgets'),
                'type' => Controls_Manager::TEXTAREA,
                'default' => __('The process starts with a detailed discussion with the client to understand their idea & goals.', 'ebp-custom-widgets'),
                'placeholder' => __('Enter accordion content...', 'ebp-custom-widgets'),
                'rows' => 3,
            ]
        );

        // Accordion item open state control (to determine which item is open by default)
        $repeater->add_control(
            'accordion_open',
            [
                'label' => __('Open by Default', 'ebp-custom-widgets'),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => __('Yes', 'ebp-custom-widgets'),
                'label_off' => __('No', 'ebp-custom-widgets'),
                'return_value' => 'yes',
                'default' => 'no',
                'description' => __('Set this item to be open by default', 'ebp-custom-widgets'),
            ]
        );

        // Add the repeater to the widget
        $this->add_control(
            'accordion_list',
            [
                'label' => __('Accordion Items', 'ebp-custom-widgets'),
                'type' => Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        'accordion_title' => __('01/ Project idea', 'ebp-custom-widgets'),
                        'accordion_content' => __('The process starts with a detailed discussion with the client to understand their idea & goals.', 'ebp-custom-widgets'),
                        'accordion_open' => 'yes',
                    ],
                    [
                        'accordion_title' => __('02/ Brainstorming', 'ebp-custom-widgets'),
                        'accordion_content' => __('Brainstorming is a group creativity technique in which members attempt to find a conclusion.', 'ebp-custom-widgets'),
                        'accordion_open' => 'no',
                    ],
                    [
                        'accordion_title' => __('03/ Launch', 'ebp-custom-widgets'),
                        'accordion_content' => __('The completed design assets or final product are delivered with necessary documentation.', 'ebp-custom-widgets'),
                        'accordion_open' => 'no',
                    ],
                ],
                'title_field' => '{{{ accordion_title }}}',
            ]
        );

        $this->end_controls_section();
    }


    protected function render()
    {
        // Get all the settings for this widget
        $settings = $this->get_settings_for_display();

        ?>
<!-- Process  -->
<div class="section">
    <div class="container">
        <div class="aximo-faq-wrap">
            <div class="row">
                <div class="col-lg-7 d-flex align-items-center">
                    <div class="aximo-default-content">
                        <?php
                                // Output the rich text content
                                if (!empty($settings['section_content'])) {
                                    echo wp_kses_post($settings['section_content']);
                                }
                                ?>
                    </div>
                </div>
                <div class="col-lg-5">
                    <div class="aximo-accordion-wrap wow fadeInUpX" data-wow-delay="0s" id="aximo-accordion">
                        <?php
                                // Check if accordion list exists and has items
                                if (!empty($settings['accordion_list'])) {
                                    foreach ($settings['accordion_list'] as $index => $item) {
                                        // Determine if this item should be open by default
                                        $is_open = !empty($item['accordion_open']) && $item['accordion_open'] === 'yes';
                                        $open_class = $is_open ? ' open' : '';
                                        ?>
                        <div class="aximo-accordion-item<?php echo esc_attr($open_class); ?>">
                            <div class="aximo-accordion-header">
                                <?php if (!empty($item['accordion_title'])): ?>
                                <h3><?php echo esc_html($item['accordion_title']); ?></h3>
                                <?php endif; ?>
                            </div>
                            <div class="aximo-accordion-body">
                                <?php if (!empty($item['accordion_content'])): ?>
                                <p><?php echo esc_html($item['accordion_content']); ?></p>
                                <?php endif; ?>
                            </div>
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
</div>
<!-- End section -->

<!-- Calendly inline widget begin -->
<div class="calendly-inline-widget" data-url="https://calendly.com/neil-fourninemarketing/new-meeting"
    style="min-width:320px;height:700px;"></div>
<script type="text/javascript" src="https://assets.calendly.com/assets/external/widget.js" async></script>
<!-- Calendly inline widget end -->
<?php
    }
}