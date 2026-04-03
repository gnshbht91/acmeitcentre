<?php
if (!defined('ABSPATH')) {
    exit;
}

function acme_get_courses() {
    $dal = new ACME_DAL();
    return $dal->get_courses();
}

function acme_get_course($id) {
    $dal = new ACME_DAL();
    return $dal->get_course($id);
}

function acme_get_leads($limit = 20) {
    $dal = new ACME_DAL();
    return $dal->get_leads($limit);
}

function acme_get_batches_by_course($course_id) {
    $dal = new ACME_DAL();
    return $dal->acme_get_batches_by_course($course_id);
}

function acme_get_instructor_by_batch($batch_id) {
    $dal = new ACME_DAL();
    return $dal->acme_get_instructor_by_batch($batch_id);
}

