<?php if ( ! defined( 'ABSPATH' ) ) {
	exit( 'No direct script access allowed' );
}
/**
 * Template "Theme builders" for 8theme dashboard.
 *
 * @since   9.2
 * @version 1.0.0
 */

$has_pro = defined( 'ELEMENTOR_PRO_VERSION' );
$is_woocommerce = class_exists('WooCommerce');
$global_admin_class = EthemeAdmin::get_instance();
$is_elementor = class_exists('\Elementor\Plugin');
$elementor_pro_theme_builder_link = $is_elementor ? \Elementor\Plugin::$instance->app->get_settings('menu_url') : '';

$is_pro_elements = function_exists('pro_elements_plugin_load_plugin');

$builder_icons = array(
    'woocommerce' => '<svg width="1em" height="1em" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
<path d="M6.54381 15.0644L6.55026 15.0644C6.72321 15.0644 6.88577 14.981 6.98667 14.8403C7.33385 14.3551 7.95227 13.1688 8.42271 12.2325C8.43842 12.2813 8.45454 12.3307 8.47112 12.3806C8.85483 13.534 9.29313 14.3626 9.77396 14.8434C9.92542 14.9949 10.1524 15.0417 10.3514 14.9627C10.5505 14.8838 10.6835 14.694 10.6899 14.4799C10.6909 14.4466 10.7969 11.1415 11.5046 9.69055C11.6346 9.42417 11.524 9.10288 11.2576 8.97292C10.9912 8.84295 10.6699 8.95358 10.54 9.21996C10.0948 10.1324 9.86136 11.5821 9.7407 12.7245C9.41358 11.921 9.18333 11.0358 9.09445 10.6107C9.04747 10.3855 8.8623 10.2153 8.63388 10.1875C8.40536 10.1597 8.18483 10.2806 8.08525 10.4879C7.81335 11.0543 7.19564 12.3084 6.68959 13.241C6.60649 12.8931 6.50646 12.4254 6.38949 11.7986C6.18702 10.7134 6.03484 9.69321 6.03336 9.68303C5.98976 9.38978 5.71663 9.18741 5.42364 9.23106C5.13044 9.27466 4.92807 9.54759 4.97167 9.84078C4.9732 9.85117 5.12886 10.8952 5.33593 12.0038C5.72225 14.0722 5.95067 14.6005 6.10648 14.8296C6.20513 14.9746 6.36841 15.0623 6.54381 15.0644Z" fill="currentColor"></path>
<path fill-rule="evenodd" clip-rule="evenodd" d="M14.8814 10.5358C14.6579 10.0819 14.274 9.76799 13.7725 9.62846C13.2004 9.46968 12.5807 9.68085 12.1145 10.1941C11.5612 10.802 11.1575 11.9414 11.6836 13.3144C12.044 14.2553 12.6107 14.428 12.9769 14.428C13.0165 14.428 13.0534 14.4259 13.0876 14.4227C14.0623 14.3302 14.8809 13.0406 15.0386 12.1563C15.1519 11.5228 15.099 10.9774 14.8814 10.5358ZM13.9821 11.9676C13.9324 12.244 13.7597 12.6097 13.541 12.8989C13.3164 13.1967 13.0962 13.3438 12.9866 13.3539C12.9197 13.3603 12.7957 13.217 12.6861 12.9304C12.4658 12.3562 12.392 11.4837 12.9085 10.9159C13.0625 10.7464 13.2416 10.6506 13.3956 10.6506C13.4266 10.6506 13.4565 10.6544 13.4849 10.6624C14.0596 10.8223 14.0724 11.4602 13.9821 11.9676Z" fill="currentColor"></path>
<path fill-rule="evenodd" clip-rule="evenodd" d="M18.4181 9.96422C18.6042 10.1166 18.7561 10.3091 18.8683 10.5358C19.0854 10.9774 19.1383 11.5228 19.0249 12.1563C18.8672 13.0406 18.0487 14.3302 17.0745 14.4227C17.0403 14.4259 17.0029 14.428 16.9633 14.428C16.5971 14.428 16.0304 14.2553 15.67 13.3144C15.1444 11.9414 15.5481 10.802 16.1009 10.1941C16.5677 9.68085 17.1873 9.46968 17.7589 9.62846C18.0097 9.69851 18.231 9.81185 18.4181 9.96422ZM17.5279 12.8989C17.746 12.6097 17.9193 12.244 17.9685 11.9676C18.0588 11.4602 18.0466 10.8223 17.4718 10.6624C17.4429 10.6544 17.413 10.6506 17.382 10.6506C17.2285 10.6506 17.0494 10.7464 16.8949 10.9159C16.379 11.4837 16.4527 12.3562 16.6725 12.9304C16.7821 13.217 16.9066 13.3603 16.9729 13.3539C17.0825 13.3438 17.3028 13.1967 17.5279 12.8989Z" fill="currentColor"></path>
<path fill-rule="evenodd" clip-rule="evenodd" d="M24 12C24 18.6274 18.6274 24 12 24C5.37258 24 0 18.6274 0 12C0 5.37258 5.37258 0 12 0C18.6274 0 24 5.37258 24 12ZM18.4557 8.08447H5.73491C4.92896 8.08447 4.2757 8.73779 4.2757 9.54369V14.3334C4.2757 15.1393 4.92906 15.7926 5.73491 15.7926H11.7888L14.4719 17.3515L13.9361 15.7926H18.4557C19.2616 15.7926 19.9149 15.1393 19.9149 14.3334V9.54369C19.915 8.73774 19.2616 8.08447 18.4557 8.08447Z" fill="currentColor"></path>
</svg>',
    'customizer' => '<svg width="1em" height="1em" style="min-width: 1em" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
<path d="M12 0C5.37277 0 0 5.37277 0 12C0 18.6272 5.37277 24 12 24C18.6272 24 24 18.6272 24 12C24 5.37277 18.6272 0 12 0ZM12 1.38462C17.8629 1.38462 22.6154 6.13708 22.6154 12C22.6154 17.8629 17.8629 22.6154 12 22.6154C6.13708 22.6154 1.38462 17.8629 1.38462 12C1.38462 6.13708 6.13708 1.38462 12 1.38462ZM12 2.76923C8.85923 2.76923 6.08326 4.34901 4.41526 6.7527C4.54911 6.7527 4.67758 6.7509 4.79297 6.7509C5.77189 6.7509 7.28996 6.63462 7.28996 6.63462C7.7935 6.60554 7.85029 7.35612 7.34675 7.41797C7.34675 7.41797 6.83263 7.50474 6.26863 7.53335L9.67338 17.8594L11.716 11.5944L10.2692 7.53335C9.76569 7.50428 9.27584 7.41797 9.27584 7.41797C8.7723 7.38889 8.82909 6.60554 9.33263 6.63462C9.33263 6.63462 10.8823 6.7509 11.8008 6.7509C12.7797 6.7509 14.2978 6.63462 14.2978 6.63462C14.8013 6.60554 14.8581 7.35612 14.3546 7.41797C14.3546 7.41797 13.8368 7.50474 13.2764 7.53335L16.6532 17.8008L17.5898 14.6106C18.0615 13.3704 18.2993 12.3261 18.2993 11.5069C18.2993 10.3249 17.8912 9.53095 17.5331 8.89633C17.0614 8.10941 16.6253 7.42064 16.6253 6.63371C16.6253 5.82648 17.1717 5.08906 17.9739 4.97506C16.3622 3.60244 14.2777 2.76923 12 2.76923ZM20.2419 7.86689C20.252 8.03996 20.2563 8.21771 20.2563 8.40325C20.2563 9.37109 20.079 10.4631 19.5469 11.826L16.8543 19.8362C19.4763 18.2061 21.2308 15.3078 21.2308 12C21.2308 10.5129 20.8691 9.11212 20.2419 7.86689ZM3.53546 8.32752C3.04484 9.45414 2.76923 10.6948 2.76923 12C2.76923 15.5672 4.80676 18.6622 7.77584 20.1986L3.53546 8.32752ZM12.1704 12.841L9.46154 20.8675C10.2692 21.0992 11.1189 21.2308 12 21.2308C13.0449 21.2308 14.0455 21.0481 14.9829 20.7269L12.1704 12.841Z" fill="currentColor"/>
</svg>',
    'elementor' => '<svg width="1em" height="1em" style="min-width: 1em" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
<path d="M12 0C5.37194 0 0 5.37191 0 12C0 18.6259 5.37194 24 12 24C18.6281 24 24 18.628 24 12C23.9979 5.37191 18.626 0 12 0ZM9.00058 16.9982H7.00165V6.99942H9.00058V16.9982ZM16.9984 16.9982H10.9995V14.9994H16.9984V16.9982ZM16.9984 12.9983H10.9995V10.9994H16.9984V12.9983ZM16.9984 8.99833H10.9995V6.99942H16.9984V8.99833Z" fill="currentColor"/>
</svg>'
);


$theme_builders_plugins = array(
    'pro-elements' =>
        array(
            'logo' => '<svg width="52" height="52" viewBox="0 0 52 52" fill="none" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
<circle cx="26" cy="26" r="26" fill="url(#pattern0)"/>
<defs>
<pattern id="pattern0" patternContentUnits="objectBoundingBox" width="1" height="1">
<use xlink:href="#image0_1981_2436" transform="translate(0 -0.0172414) scale(0.00431034)"/>
</pattern>
<image id="image0_1981_2436" width="232" height="240" xlink:href="data:image/png;base64,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"/>
</defs>
</svg>',
            'title' => esc_html__('Free PRO Elements', 'xstore'),
            'price' => esc_html__('Free', 'xstore'),
            'is_free' => true,
            'is_installed' => false,
            'description' => esc_html__('Alternatively, if you prefer the free option, you can download and install the PRO Elements plugin from the official plugin website or GitHub repository.', 'xstore'),
            'url' => 'https://proelements.org/'
        ),
    'elementor-pro' =>
        array(
            'logo' => '<svg width="52" height="52" viewBox="0 0 52 52" fill="none" xmlns="http://www.w3.org/2000/svg">
<circle cx="26" cy="26" r="26" fill="black"/>
<path d="M17.0532 35.1873L17.0532 15.6873H20.9532L20.9532 35.1873H17.0532Z" fill="#F6F6F6"/>
<path d="M24.8533 15.6877H36.5533V19.5877H24.8533V15.6877Z" fill="#F6F6F6"/>
<path d="M24.8533 23.4872H36.5533V27.3872H24.8533V23.4872Z" fill="#F6F6F6"/>
<path d="M24.8533 31.2868H36.5533V35.1868H24.8533V31.2868Z" fill="#F6F6F6"/>
</svg>',
            'title' => esc_html__('Elementor Pro', 'xstore'),
            'price' => esc_html__('From $59', 'xstore'),
            'is_installed' => false,
            'description' => esc_html__('If you have already purchased Elementor Pro, go ahead and install it on your website. If not, you can acquire Elementor Pro from the official Elementor website.', 'xstore'),
            'url' => 'https://elementor.com/pro/'
        )
);
if ( !$has_pro ) {
    $all_plugins = get_plugins();
    $theme_builders_plugins['elementor-pro']['is_installed'] = array_key_exists('elementor-pro/elementor-pro.php', $all_plugins);
    if ( $theme_builders_plugins['elementor-pro']['is_installed'] )
        $theme_builders_plugins['elementor-pro']['url'] = admin_url('plugins.php');
    $theme_builders_plugins['pro-elements']['is_installed'] = array_key_exists('pro-elements/pro-elements.php', $all_plugins);
    if ( $theme_builders_plugins['pro-elements']['is_installed'] )
        $theme_builders_plugins['pro-elements']['url'] = admin_url('plugins.php');
}

?>

<div class="et-col-12 etheme-theme-builders">

    <h3><?php echo sprintf(esc_html__('Website Builders & %s Widgets', 'xstore'), apply_filters('etheme_theme_label', 'XStore')); ?></h3>
    <p>
        <?php echo sprintf(esc_html__('Take your website customization to the next level with our powerful %s Builders feature!', 'xstore'), apply_filters('etheme_theme_label', 'XStore')); ?>
    </p>
    <?php

        $header_customizer_count = get_customizer_templates();
        $single_product_customizer_count = get_customizer_templates('single_product');

        $theme_builders_list = array(
                'header' => array(
                    'title' => esc_html__('Header Builder', 'xstore'),
                    'logo' => '<svg width="1.3em" height="1.3em" viewBox="0 0 15 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M0 0V1.45455H0.727273V14.5455H0V16H5.81818V14.5455H5.09091V10.1818H9.45455V14.5455H8.72727V16H14.5455V14.5455H13.8182V1.45455H14.5455V0H8.72727V1.45455H9.45455V5.81818H5.09091V1.45455H5.81818V0H0ZM2.18182 1.45455H3.63636V7.27273H10.9091V1.45455H12.3636V14.5455H10.9091V8.72727H3.63636V14.5455H2.18182V1.45455Z" fill="currentColor"/>
                    </svg>',
                    'multiple_builders' => [
                        'elementor' => [
                            'active' => true,
                            'widgets_count' => 10,
                            'templates_count' => 11 // templates in XStudio
                        ],
                        'customizer' => [
                            'active' => true,
                            'url' => admin_url('/customize.php?autofocus[' . (!get_option('etheme_disable_customizer_header_builder', false) ? 'panel' : 'section') . ']=header-builder'),
                            'widgets_count' => 23,
                            'templates_count' => $header_customizer_count['prebuilt'],
                            'customer_templates_count' => $header_customizer_count['templates']
                        ],
                    ],
                ),
                'footer' => array(
                    'title' => esc_html__('Footer Builder', 'xstore'),
                    'logo' => '<svg width="1.3em" height="1.3em" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M0 0V16H16V0H14.5455V14.5455H1.45455V0H0ZM2.90909 0V1.45455H4.36364V0H2.90909ZM5.81818 0V1.45455H7.27273V0H5.81818ZM8.72727 0V1.45455H10.1818V0H8.72727ZM11.6364 0V1.45455H13.0909V0H11.6364ZM2.90909 2.90909V4.36364H13.0909V2.90909H2.90909ZM2.90909 6.54545V7.27273V13.0909H13.0909V6.54545H2.90909ZM4.36364 8H11.6364V11.6364H4.36364V8Z" fill="currentColor"/>
                    </svg>',
                    'multiple_builders' => [
                        'elementor' => [
                            'active' => true,
                            'widgets_count' => 60,
                            'templates_count' => 69 // templates in XStudio
                        ],
                    ],
                ),
                'product' => array(
                    'title' => esc_html__('Single Product Builder', 'xstore'),
                    'logo' => '<svg width="1.3em" height="1.3em" viewBox="0 0 14 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M6.80769 0C5.11779 0 3.73077 1.38702 3.73077 3.07692V3.69231H0.692308L0.653846 4.26923L0.0384615 15.3462L0 16H13.6154L13.5769 15.3462L12.9615 4.26923L12.9231 3.69231H9.88462V3.07692C9.88462 1.38702 8.4976 0 6.80769 0ZM6.80769 1.23077C7.82692 1.23077 8.65385 2.05769 8.65385 3.07692V3.69231H4.96154V3.07692C4.96154 2.05769 5.78846 1.23077 6.80769 1.23077ZM1.84615 4.92308H3.73077V6.76923H4.96154V4.92308H8.65385V6.76923H9.88462V4.92308H11.7692L12.3077 14.7692H1.30769L1.84615 4.92308Z" fill="currentColor"/>
                    </svg>',
                    'multiple_builders' => [
                        'elementor' => [
                            'active' => true,
                            'widgets_count' => 22,
                            'templates_count' => 9 // templates in XStudio
                        ],
                        'customizer' => [
                            'active' => true,
                            'url' => admin_url('/customize.php?autofocus['.(get_option( 'etheme_single_product_builder', false ) ? 'panel' : 'section').']=single_product_builder'),
                            'widgets_count' => 23,
                            'templates_count' => $single_product_customizer_count['prebuilt'],
                            'customer_templates_count' => $single_product_customizer_count['templates']
                        ],
                    ],
                    'required_woocommerce' => true,
                ),
                'product-archive' => array(
                    'title' => esc_html__('Products archive builder', 'xstore'),
                    'logo' => '<svg width="1.3em" height="1.3em" viewBox="0 0 16 13" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M1.6 0V1.95L0 4.08333V4.26667C0 5.14375 0.722917 5.86667 1.6 5.86667V12.8H10.1333V8H11.2V12.8H14.4V5.86667C15.2771 5.86667 16 5.14375 16 4.26667V4.08333L14.4 1.95V0H1.6ZM2.66667 1.06667H13.3333V1.6H2.66667V1.06667ZM2.4 2.66667H13.6L14.8833 4.38333C14.825 4.61458 14.65 4.8 14.4 4.8C14.1042 4.8 13.8667 4.5625 13.8667 4.26667H12.8C12.8 4.5625 12.5625 4.8 12.2667 4.8C11.9708 4.8 11.7333 4.5625 11.7333 4.26667H10.6667C10.6667 4.5625 10.4292 4.8 10.1333 4.8C9.8375 4.8 9.6 4.5625 9.6 4.26667H8.53333C8.53333 4.5625 8.29583 4.8 8 4.8C7.70417 4.8 7.46667 4.5625 7.46667 4.26667H6.4C6.4 4.5625 6.1625 4.8 5.86667 4.8C5.57083 4.8 5.33333 4.5625 5.33333 4.26667H4.26667C4.26667 4.5625 4.02917 4.8 3.73333 4.8C3.4375 4.8 3.2 4.5625 3.2 4.26667H2.13333C2.13333 4.5625 1.89583 4.8 1.6 4.8C1.35 4.8 1.175 4.61458 1.11667 4.38333L2.4 2.66667ZM2.66667 5.45C2.95 5.70625 3.325 5.86667 3.73333 5.86667C4.14167 5.86667 4.51667 5.70625 4.8 5.45C5.08333 5.70625 5.45833 5.86667 5.86667 5.86667C6.275 5.86667 6.65 5.70625 6.93333 5.45C7.21667 5.70625 7.59167 5.86667 8 5.86667C8.40833 5.86667 8.78333 5.70625 9.06667 5.45C9.35 5.70625 9.725 5.86667 10.1333 5.86667C10.5417 5.86667 10.9167 5.70625 11.2 5.45C11.4833 5.70625 11.8583 5.86667 12.2667 5.86667C12.675 5.86667 13.05 5.70625 13.3333 5.45V11.7333H12.2667V6.93333H9.06667V11.7333H2.66667V5.45ZM3.73333 6.93333V10.6667H8V6.93333H3.73333ZM4.8 8H6.93333V9.6H4.8V8Z" fill="currentColor"/>
                    </svg>',
                    'multiple_builders' => [
                        'elementor' => [
                            'active' => true,
                            'widgets_count' => 12,
                            'templates_count' => 7 // templates in XStudio
                        ],
                    ],
                    'required_woocommerce' => true,
                ),
                'cart' => array(
                    'title' => esc_html__('Cart page builder', 'xstore'),
                    'logo' => '<svg width="1.3em" height="1.3em" viewBox="0 0 16 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M8.08421 0L4.73684 3.34737L4.75789 3.36842H4.71579L5.05263 4.71579H14.2526L12.9684 9.43158H5.24211L3.47368 2.35789C3.32368 1.75789 2.78684 1.34737 2.16842 1.34737H0.673684C0.302632 1.34737 0 1.65 0 2.02105C0 2.39211 0.302632 2.69474 0.673684 2.69474H2.16842L3.93684 9.76842C4.08684 10.3684 4.62368 10.7789 5.24211 10.7789H12.9684C13.5763 10.7789 14.0921 10.3763 14.2526 9.78947L16 3.36842H14.8211L11.4526 0L9.76842 1.68421L8.08421 0ZM12.1263 10.7789C11.0184 10.7789 10.1053 11.6921 10.1053 12.8C10.1053 13.9079 11.0184 14.8211 12.1263 14.8211C13.2342 14.8211 14.1474 13.9079 14.1474 12.8C14.1474 11.6921 13.2342 10.7789 12.1263 10.7789ZM6.06316 10.7789C4.95526 10.7789 4.04211 11.6921 4.04211 12.8C4.04211 13.9079 4.95526 14.8211 6.06316 14.8211C7.17105 14.8211 8.08421 13.9079 8.08421 12.8C8.08421 11.6921 7.17105 10.7789 6.06316 10.7789ZM8.08421 1.91579L9.55789 3.36842H6.63158L8.08421 1.91579ZM11.4526 1.91579L12.9053 3.36842H11.4526L10.7368 2.65263L11.4526 1.91579ZM6.06316 12.1263C6.44211 12.1263 6.73684 12.4211 6.73684 12.8C6.73684 13.1789 6.44211 13.4737 6.06316 13.4737C5.68421 13.4737 5.38947 13.1789 5.38947 12.8C5.38947 12.4211 5.68421 12.1263 6.06316 12.1263ZM12.1263 12.1263C12.5053 12.1263 12.8 12.4211 12.8 12.8C12.8 13.1789 12.5053 13.4737 12.1263 13.4737C11.7474 13.4737 11.4526 13.1789 11.4526 12.8C11.4526 12.4211 11.7474 12.1263 12.1263 12.1263Z" fill="currentColor"/>
                    </svg>',
                    'multiple_builders' => [
                        'elementor' => [
                            'active' => true,
                            'widgets_count' => 5,
                            'templates_count' => 0 // templates in XStudio
                        ],
                    ],
                    'required_woocommerce' => true,
                ),
                'checkout' => array(
                    'title' => esc_html__('Checkout page builder', 'xstore'),
                    'logo' => '<svg width="1.3em" height="1.3em" viewBox="0 0 16 13" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M0.646465 0C0.290404 0 0 0.290404 0 0.646465C0 1.00253 0.290404 1.29293 0.646465 1.29293H2.08081L3.77778 8.08081C3.92172 8.65657 4.43687 9.0505 5.0303 9.0505H13.0909C13.6742 9.0505 14.1692 8.66414 14.3232 8.10101L16 1.93939H14.6465L13.0909 7.75758H5.0303L3.33333 0.969697C3.18939 0.393939 2.67424 0 2.08081 0H0.646465ZM12.2828 9.0505C11.2197 9.0505 10.3434 9.92677 10.3434 10.9899C10.3434 12.053 11.2197 12.9293 12.2828 12.9293C13.346 12.9293 14.2222 12.053 14.2222 10.9899C14.2222 9.92677 13.346 9.0505 12.2828 9.0505ZM6.46465 9.0505C5.40152 9.0505 4.52525 9.92677 4.52525 10.9899C4.52525 12.053 5.40152 12.9293 6.46465 12.9293C7.52778 12.9293 8.40404 12.053 8.40404 10.9899C8.40404 9.92677 7.52778 9.0505 6.46465 9.0505ZM9.69697 0.646465V2.58586H6.46465V3.87879H9.69697V5.81818L12.2828 3.23232L9.69697 0.646465ZM6.46465 10.3434C6.82828 10.3434 7.11111 10.6263 7.11111 10.9899C7.11111 11.3535 6.82828 11.6364 6.46465 11.6364C6.10101 11.6364 5.81818 11.3535 5.81818 10.9899C5.81818 10.6263 6.10101 10.3434 6.46465 10.3434ZM12.2828 10.3434C12.6465 10.3434 12.9293 10.6263 12.9293 10.9899C12.9293 11.3535 12.6465 11.6364 12.2828 11.6364C11.9192 11.6364 11.6364 11.3535 11.6364 10.9899C11.6364 10.6263 11.9192 10.3434 12.2828 10.3434Z" fill="currentColor"/>
                    </svg>',
                    'multiple_builders' => [
                        'elementor' => [
                            'active' => true,
                            'widgets_count' => 2,
                            'templates_count' => 0 // templates in XStudio
                        ],
                    ],
                    'required_woocommerce' => true,
                ),
            );

//        if ( !$has_pro ) {
//            $header_created_templates = get_option('et_multiple_headers', false);
//            $header_created_templates = !is_array($header_created_templates) ? array() : $header_created_templates;
//            $header_templates = function_exists('et_b_header_presets') ? et_b_header_presets() : array(0); // get prebuilt templates from demos headers
//            $header_templates = count($header_templates);
//            $header_templates += 10; // add prebuilt templates
//            unset($theme_builders_list['header']['templates_count']);
//            $theme_builders_list['header']['widgets_count'] = 23;
//            $theme_builders_list['header']['builder_url'] = admin_url('/customize.php?autofocus[panel]=header-builder');
//            $theme_builders_list['header']['templates_count_rendered'] = $header_templates;
//            $theme_builders_list['header']['created_count_rendered'] = count($header_created_templates) + 1;
//        }

        $theme_builders_list = array_merge(
        $theme_builders_list,
        array(
            'error-404' => array(
                'title' => esc_html__('Error-404 Builder', 'xstore'),
                'logo' => '<svg width="1.3em" height="1.3em" viewBox="0 0 16 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M8 0L0 13.8564H1.00924H16L8 0ZM3.20751 0.670175L2.30636 1.40976L3.76276 3.18248L4.66392 2.44176L3.20751 0.670175ZM12.7925 0.670175L11.3361 2.44176L12.2372 3.18248L13.6936 1.40976L12.7925 0.670175ZM8 2.32911L13.9826 12.6912H2.01735L8 2.32911ZM1.29256 2.86048L0.725928 3.87996L2.71825 4.98478L3.28374 3.96643L1.29256 2.86048ZM14.7074 2.86048L12.7163 3.96643L13.2818 4.98478L15.2741 3.87996L14.7074 2.86048ZM0.426682 5.70047V6.8656H2.75693V5.70047H0.426682ZM13.2431 5.70047V6.8656H15.5733V5.70047H13.2431ZM7.41744 6.28303V9.77841H8.58256V6.28303H7.41744ZM7.41744 10.361V11.5261H8.58256V10.361H7.41744Z" fill="currentColor"/>
                </svg>',
                'multiple_builders' => [
                    'elementor' => [
                        'active' => true,
                        'widgets_count' => 23,
                        'templates_count' => 10 // templates in XStudio
                    ],
                ],
            )
        )
    );

    ?>
    <div class="theme-builders-list">
        <?php
        $actions_icons = array(
                'tutorials' => '<svg width="1em" height="1em" viewBox="0 0 48 48" fill="none" xmlns="http://www.w3.org/2000/svg">
<path d="M41.7143 5H6.28571C2.81943 5 0 7.81943 0 11.2857V37.5714C0 41.0377 2.81943 43.8571 6.28571 43.8571H41.7143C45.1806 43.8571 48 41.0377 48 37.5714V11.2857C48 7.81943 45.1806 5 41.7143 5ZM31.9669 26.4274L21.6811 32.1417C21.336 32.3326 20.9531 32.4286 20.5714 32.4286C20.1703 32.4286 19.7691 32.3234 19.4126 32.1131C18.7143 31.7017 18.2857 30.952 18.2857 30.1429V18.7143C18.2857 17.9051 18.7143 17.1554 19.4126 16.744C20.1097 16.3337 20.9737 16.3223 21.6811 16.7154L31.9669 22.4297C32.6926 22.8331 33.1429 23.5977 33.1429 24.4286C33.1429 25.2594 32.6926 26.024 31.9669 26.4274Z" fill="currentColor"/>
</svg>',
            'documentation' => '<svg width="1em" height="1em" viewBox="0 0 48 48" fill="none" xmlns="http://www.w3.org/2000/svg">
<path d="M5.14296 6C2.30747 6 0 8.30747 0 11.143V37.4292C0 37.9057 0.0853052 38.3575 0.207593 38.7953C0.254451 38.6215 0.302077 38.4477 0.366078 38.2774L1.75896 34.572L2.9889 31.2951L6.09833 23.0182C7.09721 20.3576 9.6769 18.5717 12.5181 18.5717H43.4294V16.8573C43.4294 14.0219 41.1219 11.7144 38.2864 11.7144H22.9067L17.7972 7.45538C16.6703 6.51594 15.2411 6 13.7748 6H5.14296ZM12.5181 22.0003C11.0895 22.0003 9.80994 22.8864 9.30821 24.2236L3.57819 39.4828C3.0159 40.9765 4.12002 42.5721 5.71663 42.5721H38.9115C40.3401 42.5721 41.6196 41.686 42.1213 40.3489L47.8469 25.103C48.4195 23.607 47.3152 22.0003 45.7129 22.0003H12.5181Z" fill="currentColor"/>
</svg>',
        'support' => '<svg width="1em" height="1em" viewBox="0 0 48 48" fill="none" xmlns="http://www.w3.org/2000/svg">
<path d="M24.0932 0C19.4746 0 14.857 1.58485 11.1231 4.75507L18.2764 11.9106C21.748 9.43244 26.4384 9.43244 29.9101 11.9106L37.0634 4.75507C33.3294 1.58485 28.7118 0 24.0932 0ZM8.75533 7.1228C2.41489 14.5907 2.41489 25.5952 8.75533 33.0631L15.9108 25.9098C13.4327 22.4382 13.4327 17.7477 15.9108 14.2761L8.75533 7.1228ZM39.4311 7.1228L32.2756 14.2761C34.7537 17.7477 34.7537 22.4382 32.2756 25.9098L39.4311 33.0631C45.7715 25.5952 45.7715 14.5907 39.4311 7.1228ZM18.2764 28.2753L11.1231 35.4308C14.4055 38.2178 18.37 39.777 22.4188 40.114V44.651H9.0235C8.80162 44.6479 8.58133 44.6889 8.37543 44.7716C8.16953 44.8543 7.98213 44.9772 7.82411 45.133C7.6661 45.2888 7.54063 45.4744 7.45498 45.6791C7.36934 45.8838 7.32524 46.1035 7.32524 46.3254C7.32524 46.5473 7.36934 46.767 7.45498 46.9717C7.54063 47.1764 7.6661 47.3621 7.82411 47.5179C7.98213 47.6737 8.16953 47.7965 8.37543 47.8792C8.58133 47.962 8.80162 48.003 9.0235 47.9998H39.1629C39.3848 48.003 39.6051 47.962 39.811 47.8792C40.0169 47.7965 40.2043 47.6737 40.3623 47.5179C40.5203 47.3621 40.6458 47.1764 40.7314 46.9717C40.8171 46.767 40.8612 46.5473 40.8612 46.3254C40.8612 46.1035 40.8171 45.8838 40.7314 45.6791C40.6458 45.4744 40.5203 45.2888 40.3623 45.133C40.2043 44.9772 40.0169 44.8543 39.811 44.7716C39.6051 44.6889 39.3848 44.6479 39.1629 44.651H25.7676V40.114C29.8164 39.777 33.7809 38.2178 37.0634 35.4308L29.9101 28.2753C26.4384 30.7535 21.748 30.7535 18.2764 28.2753Z" fill="currentColor"/>
</svg>'
        );
        $actions = array(
            'tutorials' => array(
                'title' => $actions_icons['tutorials'] . esc_html__('Tutorials', 'xstore'),
                'url' => 'https://youtu.be/vrNKjc84MKE'
            ),
            'documentation' => array(
                'title' => $actions_icons['documentation'] . esc_html__('Documentation', 'xstore'),
                'url' => etheme_documentation_url('183-xstore-builders-getting-started', false)
            ),
            'support' => array(
                'title' => $actions_icons['support'] . esc_html__('Support forum', 'xstore'),
                'url' => etheme_support_forum_url()
            )
        );
        foreach ($theme_builders_list as $theme_builder_unique_key => $theme_builders_list_item_details) :

            $local_actions = $actions;

            $prebuilt_templates_key = $theme_builder_unique_key;
            $allow_multiple_builders = count($theme_builders_list_item_details['multiple_builders']) > 1;
            $allow_customizer_builder = isset($theme_builders_list_item_details['multiple_builders']['customizer']);
            $allow_elementor_builder = isset($theme_builders_list_item_details['multiple_builders']['elementor']);

            if ( $allow_customizer_builder )
                $theme_builders_list_item_details['multiple_builders']['customizer']['title'] = esc_html__('Customizer', 'xstore');

            if ( $allow_elementor_builder ) {
                $theme_builders_list_item_details['multiple_builders']['elementor']['title'] = esc_html__('Elementor', 'xstore');
//                if ( !$is_elementor ) {
//                    unset($theme_builders_list_item_details['multiple_builders']['elementor']);
//                    $allow_elementor_builder = false;
//                    if ( !$allow_multiple_builders )
//                        continue;
//                }
            }


            switch ($theme_builder_unique_key) {
                case 'header':
                    $local_actions['documentation']['url'] = etheme_documentation_url('212-new-xstore-header-builder-with-elementor', false);
                    $local_actions['tutorials']['url'] = 'https://youtu.be/ZZExw_HXgu0';
                    $header_actions = array_merge(array($local_actions['tutorials']), array(
                            'tutorials_header_sticky' => array(
                                'title' => $actions_icons['tutorials'] . esc_html__('Sticky Header Tutorial', 'xstore'),
                                'url' => 'https://youtu.be/2BDMGGzimb0'
                            ),
                            'tutorials_header_overlap' => array(
                                'title' => $actions_icons['tutorials'] . esc_html__('Transparent/Overlap Header Tutorial', 'xstore'),
                                'url' => 'https://youtu.be/n0PGQDm0I2o'
                            ),
                        ));
                    unset($local_actions['tutorials']);
                    $local_actions = array_merge($header_actions, $local_actions);


                    break;
                case 'footer':
                    $local_actions['documentation']['url'] = etheme_documentation_url('195-xstore-footer-builder-with-elementor', false);
                    break;
                case 'product-archive':
                    $local_actions['documentation']['url'] = etheme_documentation_url('191-xstore-products-archive-builder-with-elementor', false);
                    break;
                case 'cart':
                    $local_actions['documentation']['url'] = etheme_documentation_url('193-xstore-cart-page-builder-with-elementor', false);
                    break;
                case 'checkout':
                    $local_actions['documentation']['url'] = etheme_documentation_url('194-xstore-checkout-page-builder-with-elementor', false);
                    break;
                case 'error-404':
                    $prebuilt_templates_key = '404';
                    $local_actions['documentation']['url'] = etheme_documentation_url('192-xstore-error-404-page-builder-with-elementor', false);
                    break;
                case 'product':
                    $prebuilt_templates_key = 'single-product';
                    $local_actions['documentation']['url'] = etheme_documentation_url('190-xstore-single-product-builder-with-elementor', false);
                    break;
            }
//            if ( !isset($theme_builders_list_item_details['created_count_rendered'])) {
            if ( $allow_elementor_builder ) {
                $prebuilt_templates = get_option('et_studio_data_' . $prebuilt_templates_key, array());
                if ( isset($prebuilt_templates['templates']) )
                    $theme_builders_list_item_details['multiple_builders']['elementor']['templates_count'] = count($prebuilt_templates['templates']);

                $created_templates = get_posts(
                    [
                        'post_type' => 'elementor_library',
                        'post_status' => 'any',
                        'posts_per_page' => '-1',
                        'tax_query' => [
                            [
                                'taxonomy' => 'elementor_library_type',
                                'field' => 'slug',
                                'terms' => $theme_builder_unique_key,
                            ],
                        ],
                        'fields' => 'ids'
                    ]
                );
                $theme_builders_list_item_details['multiple_builders']['elementor']['customer_templates_count'] = count($created_templates);
            }

            if ( $allow_elementor_builder )
                $theme_builders_list_item_details['multiple_builders']['elementor']['url'] = $elementor_pro_theme_builder_link . '/templates/'.$theme_builder_unique_key;

            // there are unique pages for cart/checkout but these pages are set only by conditions
            if ($is_woocommerce && $allow_elementor_builder && in_array($theme_builder_unique_key, array('cart', 'checkout'))) {
                $cart_checkout_page_id = get_option('woocommerce_'.$theme_builder_unique_key.'_page_id'); // wc_get_page_id($theme_builder_unique_key) not working correct;
                if ($cart_checkout_page_id > 0) {
                    $theme_builders_list_item_details['multiple_builders']['elementor']['url'] = add_query_arg(array('post' => $cart_checkout_page_id, 'action' => 'elementor', 'et_page' => $theme_builder_unique_key ), admin_url('post.php'));
                    $created_templates = 1;
                } else {
                    // $builder_url = $elementor_pro_theme_builder_link . '/templates/single-page';
                    $theme_builders_list_item_details['multiple_builders']['elementor']['url'] = add_query_arg(array('post_type' => 'page', 'action' => 'elementor', 'et_page' => $theme_builder_unique_key), admin_url('post-new.php'));
                }
            }
            $required_elementor = $allow_elementor_builder && !$is_elementor;
            $required_pro = $allow_elementor_builder && !$has_pro;
            $required_woocommerce = isset($theme_builders_list_item_details['required_woocommerce']) && !$is_woocommerce;
            $locked = ($required_elementor && !$allow_multiple_builders) || (!!$required_pro && !$allow_multiple_builders) || !!$required_woocommerce;

            if ( $required_pro || $required_woocommerce )
                $theme_builders_list_item_details['multiple_builders']['elementor']['url'] = false;
            if ( $allow_customizer_builder && $required_woocommerce )
                $theme_builders_list_item_details['multiple_builders']['customizer']['url'] = false;

            $multiple_builders = $theme_builders_list_item_details['multiple_builders'];

            $title_link = !$locked && count($multiple_builders) == 1;

            $locked_url = admin_url( 'admin.php?page=et-panel-theme-builders' );

            $builder_url = !$locked ?
                $theme_builders_list_item_details['multiple_builders'][array_key_first($theme_builders_list_item_details['multiple_builders'])]['url'] :
                $locked_url;

            $info_details = array(
                'widgets_count' => array(
                    'title' => sprintf(esc_html__('%s widgets', 'xstore'), apply_filters('etheme_theme_label', 'XStore')),
                ),
                'templates_count' => array(
                    'title' => esc_html__('Prebuilt templates', 'xstore'),
                ),
                'customer_templates_count' => array(
                    'title' => esc_html__('Created templates', 'xstore'),
                ),
            );
            // @todo remove condition for cart/checkout links to redirect them to welcome page
        ?>
            <div class="theme-builder">
                <div class="theme-builder-title">
                    <h4 class="theme-builder-name">
                        <?php echo '<span class="theme-builder-logo">' . $theme_builders_list_item_details['logo'] . '</span>'; ?>
                        <?php if ( $title_link ) { ?><a href="<?php echo esc_url($builder_url); ?>" target="_blank"><?php } ?>
                            <?php echo esc_html($theme_builders_list_item_details['title']) ?>
                        <?php if ( $title_link ) { ?></a><?php } ?>
                    </h4>
                </div>
                <div class="theme-builder-info">
                    <?php
                    if ( $info_details ) {
                        foreach ($info_details as $info_key => $info_detail) { ?>
                            <div class="theme-builder-info-item">
                                <h5 class="theme-builder-info-item-title">
                                    <?php echo $info_detail['title']; ?>
                                </h5>
                                <div class="theme-builder-info-item-count">
                                    <?php
                                        $multiple_builders_counters = array();
                                        $all_counts = 0;
                                        foreach ($multiple_builders as $multiple_builder_key => $multiple_builder_details) {
                                            $all_counts += $multiple_builder_details[$info_key];
                                            $multiple_builders_counters[$multiple_builder_key] = array(
                                                'title' => $builder_icons[$multiple_builder_key] . sprintf(esc_html__('%s - %s', 'xstore'),
                                                    $theme_builders_list_item_details['multiple_builders'][$multiple_builder_key]['title'],
                                                    $multiple_builder_details[$info_key]),
                                                'url' => false
                                            );
                                        }

                                    if ( $all_counts > 0 && count($multiple_builders) > 1 ) {
                                        $global_admin_class->get_filters_form(
                                            $multiple_builders_counters,
                                            array(
                                                'arrow' => false,
                                                'custom_title' => '<strong'.( $all_counts > 0 ? ' class="et-counter"' : '') . '>'.$all_counts.'</strong>',
                                                'custom_class' => 'theme-builder-counter',
                                                'icon' => false,
                                                'ghost_filters' => true
                                            )
                                        );
                                    }
                                    else {
                                        ?>
                                        <strong<?php if ( $all_counts > 0) : ?> class="et-counter" <?php endif; ?>><?php echo $all_counts; ?></strong>
                                        <?php
                                    }
                                    ?>
                                </div>
                            </div>
                        <?php }
                    }
                    ?>
                </div>
                <div class="theme-builder-actions">
                    <?php
                    if (count($multiple_builders) > 1 && !$required_woocommerce) {
                        $builders_button = array();
                        $has_activated_builder = false;
                        foreach ($multiple_builders as $multiple_builder_key => $multiple_builder_details) {
                            $local_builder_url = $theme_builders_list_item_details['multiple_builders'][$multiple_builder_key]['url'];
                            $local_builder_class = '';
                            $builders_button[$multiple_builder_key] = array(
                                'title' => $builder_icons[$multiple_builder_key] . sprintf(esc_html__('Via %s', 'xstore'), $theme_builders_list_item_details['multiple_builders'][$multiple_builder_key]['title']),
                                'url' => $local_builder_url
                            );
                            if ( !$local_builder_url ) {
                                if ($required_woocommerce) {
                                    $title = $builder_icons['woocommerce'] . esc_html__('Install WooCommerce', 'xstore');
                                    $local_builder_url = admin_url( 'admin.php?page=et-panel-plugins&plugin=woocommerce' );
                                }
                                elseif( $required_elementor ) {
                                    $title = $builder_icons[$multiple_builder_key] . esc_html__('Via Elementor (Install Plugin)', 'xstore');
                                    $local_builder_url = admin_url( 'admin.php?page=et-panel-plugins&plugin=elementor' );
                                }
                                else {
//                                    $title = $builder_icons[$multiple_builder_key] . sprintf(esc_html__('Enable %s Builder', 'xstore'), $theme_builders_list_item_details['multiple_builders'][$multiple_builder_key]['title']);
                                    $title =  $builders_button[$multiple_builder_key]['title'];
                                    $local_builder_url = $locked_url;
                                    $local_builder_class = 'trigger-theme-builders-plugins-popup';
                                }
                                $builders_button[$multiple_builder_key] = array(
                                    'title' => $title,
                                    'url' => $local_builder_url,
                                    'classes' => $local_builder_class
                                );
                            }
                            else {
                                if ( !$has_activated_builder )
                                    $has_activated_builder = true;
                            }
                        }
                        $global_admin_class->get_filters_form(
                            $builders_button,
                            array(
                                'title' => true,
                                'custom_title' => $has_activated_builder ? esc_html__('Go to builder', 'xstore') : esc_html__('Enable Builder', 'xstore'),
                                'tag' => 'a',
                                'custom_class' => 'et-button no-loader',
                                'custom_icon' => '<svg width="1em" height="1em" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg" style="vertical-align: middle; transform: scale(1.3)">
                                    <g clip-path="url(#clip0_2421_399)">
                                        <path d="M13.1067 4.68948C13.0388 4.65554 12.954 4.63857 12.8946 4.64705L7.43003 4.51129C7.30275 4.50281 7.17548 4.54523 7.05668 4.63008L7.03971 4.64706C6.93789 4.74888 6.88698 4.86767 6.87849 4.99495C6.87 5.12223 6.91243 5.24951 6.99728 5.35133C7.09062 5.46164 7.22639 5.52952 7.37912 5.54649L11.6302 5.6568L4.77414 12.5129C4.57049 12.7166 4.57049 13.039 4.77414 13.2426C4.97779 13.4463 5.29174 13.4378 5.49539 13.2342L12.36 6.36957L12.4873 10.6207C12.4957 10.7649 12.5636 10.8837 12.657 10.9601C12.7418 11.045 12.8691 11.0874 13.0133 11.0959C13.1491 11.1128 13.2934 11.0534 13.3867 10.9601C13.4716 10.8752 13.5225 10.7565 13.5394 10.6207L13.4037 5.10526C13.3612 4.94404 13.3358 4.88464 13.3103 4.85919C13.2594 4.7913 13.2 4.73191 13.1067 4.68948Z" fill="currentColor"/>
                                    </g>
                                </svg>',
                                'on_hover' => false,
                                'ghost_filters' => true
                            )
                        );
                    }
                    else {
                        $local_builder_url = $builder_url;
                        $local_builder_text = esc_html__('Go to builder', 'xstore');
                        $local_builder_class = 'no-loader';
                        if ( $locked ) {
                            if ($required_woocommerce) {
                                $local_builder_text = esc_html__('Install WooCommerce', 'xstore');
                                $local_builder_url = admin_url('admin.php?page=et-panel-plugins&plugin=woocommerce');
                            } elseif ($required_elementor) {
                                $local_builder_text = esc_html__('Install Elementor', 'xstore');
                                $local_builder_url = admin_url('admin.php?page=et-panel-plugins&plugin=elementor');
                            } else {
                                $local_builder_text = esc_html__('Enable Builder', 'xstore');
                                $local_builder_url = $locked_url;
                                $local_builder_class = 'trigger-theme-builders-plugins-popup';
                            }
                        } ?>
                        <a href="<?php echo esc_url($local_builder_url); ?>" target="_blank" rel="nofollow" class="et-button <?php echo esc_attr($local_builder_class); ?>">
                            <svg width="1em" height="1em" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg" style="vertical-align: middle; transform: scale(1.3)">
                                <g clip-path="url(#clip0_2421_399)">
                                    <path d="M13.1067 4.68948C13.0388 4.65554 12.954 4.63857 12.8946 4.64705L7.43003 4.51129C7.30275 4.50281 7.17548 4.54523 7.05668 4.63008L7.03971 4.64706C6.93789 4.74888 6.88698 4.86767 6.87849 4.99495C6.87 5.12223 6.91243 5.24951 6.99728 5.35133C7.09062 5.46164 7.22639 5.52952 7.37912 5.54649L11.6302 5.6568L4.77414 12.5129C4.57049 12.7166 4.57049 13.039 4.77414 13.2426C4.97779 13.4463 5.29174 13.4378 5.49539 13.2342L12.36 6.36957L12.4873 10.6207C12.4957 10.7649 12.5636 10.8837 12.657 10.9601C12.7418 11.045 12.8691 11.0874 13.0133 11.0959C13.1491 11.1128 13.2934 11.0534 13.3867 10.9601C13.4716 10.8752 13.5225 10.7565 13.5394 10.6207L13.4037 5.10526C13.3612 4.94404 13.3358 4.88464 13.3103 4.85919C13.2594 4.7913 13.2 4.73191 13.1067 4.68948Z" fill="currentColor"/>
                                </g>
                            </svg>
                            <?php echo '<span>'.$local_builder_text.'</span>'; ?>
                        </a>
                        <?php
                        }
                        $global_admin_class->get_filters_form(
                                $local_actions,
                                array(
                                    'title' => false,
                                    'arrow' => true,
                                    'custom_icon' => '<svg width="1em" height="1em" viewBox="0 0 16 4" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M1.8 0C0.8058 0 0 0.8058 0 1.8C0 2.7942 0.8058 3.6 1.8 3.6C2.7942 3.6 3.6 2.7942 3.6 1.8C3.6 0.8058 2.7942 0 1.8 0ZM7.8 0C6.8058 0 6 0.8058 6 1.8C6 2.7942 6.8058 3.6 7.8 3.6C8.7942 3.6 9.6 2.7942 9.6 1.8C9.6 0.8058 8.7942 0 7.8 0ZM13.8 0C12.8058 0 12 0.8058 12 1.8C12 2.7942 12.8058 3.6 13.8 3.6C14.7942 3.6 15.6 2.7942 15.6 1.8C15.6 0.8058 14.7942 0 13.8 0Z" fill="currentColor"/>
                                    </svg>',
                                    'ghost_filters' => true
                                )
                        );
                    ?>
                </div>
                <?php
                    if ($locked) { ?>
                        <span class="locked<?php if ( !$required_woocommerce && !$required_elementor ) echo ' trigger-theme-builders-plugins-popup'; ?> mtips mtips-left">
                            <svg width="1em" height="1em" viewBox="0 0 17 21" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M8.5 0C6.16219 0 4.25 1.88969 4.25 4.2V6.3H2.39062C1.07259 6.3 0 7.35997 0 8.6625V18.6375C0 19.94 1.07259 21 2.39062 21H14.6094C15.9274 21 17 19.94 17 18.6375V8.6625C17 7.35997 15.9274 6.3 14.6094 6.3H12.75V4.2C12.75 1.88969 10.8378 0 8.5 0ZM8.5 1.575C9.97656 1.575 11.1562 2.74081 11.1562 4.2V6.3H5.84375V4.2C5.84375 2.74081 7.02344 1.575 8.5 1.575ZM8.5 12.075C9.38028 12.075 10.0938 12.7801 10.0938 13.65C10.0938 14.5199 9.38028 15.225 8.5 15.225C7.61972 15.225 6.90625 14.5199 6.90625 13.65C6.90625 12.7801 7.61972 12.075 8.5 12.075Z" fill="currentColor"/>
                            </svg>
                            <span class="mt-mes">
                                <?php
                                if ($required_woocommerce) {
                                    echo sprintf(esc_html__('Require %s plugin', 'xstore'),
                                        '<a href="'.admin_url( 'admin.php?page=et-panel-plugins&plugin=woocommerce' ).'" target="_blank" rel="nofollow">'.esc_html__('WooCommerce', 'xstore').'</a>');
                                }
                                elseif ( $required_elementor ) {
                                    echo sprintf(esc_html__('Require %s plugin', 'xstore'),
                                            '<a href="'.admin_url( 'admin.php?page=et-panel-plugins&plugin=elementor' ).'" target="_blank" rel="nofollow">'.esc_html__('Elementor', 'xstore').'</a>');
                                }
                                else {
                                    echo sprintf(esc_html__('Require %1s or the %2s plugin', 'xstore'),
                                        '<a href="'.$theme_builders_plugins['pro-elements']['url'].'" target="_blank" rel="nofollow">'.$theme_builders_plugins['pro-elements']['title'].'</a>',
                                        '<a href="'.$theme_builders_plugins['elementor-pro']['url'].'" target="_blank" rel="nofollow">'.$theme_builders_plugins['elementor-pro']['title'].'</a>');
                                } ?>
                            </span>
                        </span>
                    <?php }
                ?>
            </div>
        <?php endforeach;

        $global_admin_class->get_search_no_found();

        $global_admin_class->get_additional_panel_blocks();
        ?>
    </div>
</div>

<?php
function get_customizer_templates($type = 'header') {
    $count = array(
        'prebuilt' => 0,
        'templates' => 0
    );
    switch ($type) {
        case 'header':
            $created_templates = get_option('et_multiple_headers', false);
            $created_templates = !is_array($created_templates) ? array() : $created_templates;
            $count['templates'] = count($created_templates) + 1; // with default one
            $header_templates = function_exists('et_b_header_presets') ? et_b_header_presets() : array(0); // get prebuilt templates from demos headers
            $count['prebuilt'] = count($header_templates);
            $count['prebuilt'] += 10; // add prebuilt templates
        break;
        case 'single_product':
            $created_templates = get_option('et_multiple_single_product', false);
            $created_templates = !is_array($created_templates) ? array() : $created_templates;
            $count['templates'] = count($created_templates) + (get_option( 'etheme_single_product_builder', false ) ? 1 : 0); // with default one if SPBuilder is active
            break;
    }
    return $count;
}
if ( isset($_GET['et_trigger_theme_builders_plugins_popup']) ) {
    wp_add_inline_script('etheme_admin_js', '
			jQuery(document).ready(function($) {
			    setTimeout(function() {
                    $(document).find(".trigger-theme-builders-plugins-popup").first().trigger("click");
                }, 300);
		    });
		', 'after');
} ?>