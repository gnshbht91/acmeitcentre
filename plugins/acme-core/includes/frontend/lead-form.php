<?php

function acme_lead_form_shortcode()
{
    return '<p>Deprecated. Use [acme_form]</p>';
}

add_shortcode('acme_lead_form', 'acme_lead_form_shortcode');
