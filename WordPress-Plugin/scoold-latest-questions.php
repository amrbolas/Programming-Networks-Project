<?php
/**
 * Plugin Name: Scoold Latest Questions
 * Description: Displays the latest public questions from Scoold.
 * Version: 1.0
 * Author: Amr Bolas
 */

if (!defined('ABSPATH')) {
    exit;
}

function scoold_latest_questions_shortcode() {
    $url = 'https://app.amrbolas.site/questions';

    $response = wp_remote_get($url, [
        'timeout' => 30,
        'sslverify' => true,
        'headers' => [
            'User-Agent' => 'WordPress Scoold Integration'
        ]
    ]);

    if (is_wp_error($response)) {
        return '<p>Unable to connect to Scoold.</p>';
    }

    $status_code = wp_remote_retrieve_response_code($response);
    $html = wp_remote_retrieve_body($response);

    if ($status_code !== 200 || empty($html)) {
        return '<p>Scoold returned an invalid response.</p>';
    }

    libxml_use_internal_errors(true);

    $dom = new DOMDocument();
    $dom->loadHTML($html);

    $xpath = new DOMXPath($dom);

    $question_links = $xpath->query(
        '//a[contains(@href, "/question/") and contains(@class, "mediumText")]'
    );

    if (!$question_links || $question_links->length === 0) {
        return '<p>No questions found.</p>';
    }

    $output = '<div class="scoold-latest-questions">';
    $output .= '<h3>Latest Questions from Scoold</h3>';
    $output .= '<ul>';

    $count = 0;

    foreach ($question_links as $link) {
        if ($count >= 5) {
            break;
        }

        $title = trim($link->textContent);
        $href = $link->getAttribute('href');

        if (strpos($href, 'http') !== 0) {
            $href = 'https://app.amrbolas.site' . $href;
        }

        $output .= '<li>';
        $output .= '<a href="' . esc_url($href) . '" target="_blank">';
        $output .= esc_html($title);
        $output .= '</a>';
        $output .= '</li>';

        $count++;
    }

    $output .= '</ul>';
    $output .= '</div>';

    libxml_clear_errors();

    return $output;
}

add_shortcode('scoold_latest_questions', 'scoold_latest_questions_shortcode');
