<?php

use Vinkla\Hashids\Facades\Hashids;

function my_encrypt(int|string $value, bool $is_text = false): string {
    if (!$is_text) {
        return Hashids::encode($value);
    }
    return Crypt::encryptString($value);
}

function my_decrypt(int|string $value, bool $is_text = false): string|null {
    if (!$is_text) {
        $decoded = Hashids::decode($value);
        return $decoded[0] ?? null;
    }
    return Crypt::decryptString($value);
}

function get_dash_on_empty($value) {
    return !empty($value) ? $value : '-';
}

function generate_custom_html_title($title): string {
    return "<hr><div class='custom-html-title'>" . $title . "</div><hr>";
}

function get_created_updated_by_db_column($table, $prefix, $only_updated = false) {
    $created_arr = [
        'by' => $table->string($prefix . 'created_by')->nullable(),
        'on' => $table->timestamp($prefix . 'created_on')->nullable(),
    ];
    $updated_arr = [
        'by' => $table->string($prefix . 'updated_by')->nullable(),
        'on' => $table->timestamp($prefix . 'updated_on')->nullable(),
    ];

    if ($only_updated) {
        $ret_val = $updated_arr;
    } else {
        $ret_val = array_merge($created_arr, $updated_arr);
    }

    return $ret_val;
}

function setCreatedUpdatedBy() {
    return str_replace(' ', '_', get_logged_in_adm_name()) . '~#~' . get_logged_in_user_id() . '~#~' . $_SERVER['REMOTE_ADDR'];
}

function get_date_time_format($datetime, $format = null) {
    $format = is_null($format) ? config('constants.DB_DATE_FORMAT_VIEW') : $format;
    return date($format, strtotime($datetime));
}

function generate_status_html($status) {
    switch ($status) {
        case 0:
            return '<span class="badge badge-soft-danger rounded-pill me-1 fs-6">Inactive</span>';
        case 1:
        default:
            return '<span class="badge badge-soft-success rounded-pill me-1 fs-6">Active</span>';

    }
}

function generate_no_record_html($message = ''): string {
    return '<div class="p-3">
                <div class="alert alert-warning alert-icon text-center" role="alert">
                    <div class="d-flex align-items-center justify-content-center">
                        <i class="bx bx-info-circle text-amber-600"></i>
                        <span class="p-1">No Record Found.</span>
                    </div>
                </div>
            </div>';
}

function generate_created_updated_label($created_updated_data): string {
    $updated_by_on = '-';

    if (!empty($created_updated_data['updated_by'])) {
        $updated_by_on = $created_updated_data['updated_by'] . '<br>' . $created_updated_data['updated_on'];
    }
    return '<div class="created_updated_main_div">
                <div class="row p-2">
                    <div class="col-md-6">
                        <div class="row">
                            <div class="col-md-3 created_updated_label align-content-center">Created By: </div>
                            <div class="col-md-9 created_updated">' . $created_updated_data["created_by"] . '<br>
                                <span>' . $created_updated_data["created_on"] . '</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="row">
                            <div class="col-md-3 created_updated_label align-content-center">Updated By: </div>
                            <div class="col-md-9 created_updated">' . $updated_by_on . '</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>';
}
