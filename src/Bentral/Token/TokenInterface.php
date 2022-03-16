<?php

namespace Bentral\Token;

interface TokenInterface
{

    const PROPERTY_PAGE_ID                       = '{{ property_page_id }}';
    const PROPERTY_NAME                          = '{{ property_name }}';
    const PROPERTY_ADDRESS                       = '{{ property_address }}';
    const PROPERTY_CITY                          = '{{ property_city }}';
    const PROPERTY_POSTCODE                      = '{{ property_postcode }}';
    const PROPERTY_COUNTRY                       = '{{ property_country }}';
    const PROPERTY_MAIN_IMAGE                    = '{{ property_main_image }}';
    const PROPERTY_IMAGES                        = '{{ property_images }}';
    const PROPERTY_IMAGES_BASE64                 = '{{ property_images_base64 }}';
    const PROPERTY_IMAGE_URL                     = '{{ property_image_url }}';
    const PROPERTY_IMAGE_URL_THUMB               = '{{ property_image_url_thumb }}';
    const PROPERTY_CAPACITY_BASIC                = '{{ property_capacity_basic }}';
    const PROPERTY_CAPACITY_ADDITIONAL           = '{{ property_capacity_additional }}';
    const PROPERTY_SERVICES                      = '{{ property_services }}';
    const PROPERTY_LONGITUDE                     = '{{ property_longitude }}';
    const PROPERTY_LATITUDE                      = '{{ property_latitude }}';
    const EMBED_PRICELIST                        = '{{ embed_pricelist }}';
    const EMBED_CALENDAR                         = '{{ embed_calendar }}';
    const EMBED_BOOKING                          = '{{ embed_booking }}';
    const EMBED_PRICELIST_BASE64                 = '{{ embed_pricelist_base64 }}';
    const EMBED_CALENDAR_BASE64                  = '{{ embed_calendar_base64 }}';
    const EMBED_BOOKING_BASE64                   = '{{ embed_booking_base64 }}';
    const EMBED_RESULT_LINK                      = '{{ link }}';
    const EMBED_RESULT_IMAGE_URL                 = '{{ image_url }}';
    const EMBED_RESULT_TITLE                     = '{{ title }}';
    const EMBED_RESULT_PROPERTY_TITLE            = '{{ property_title }}';
    const EMBED_RESULT_ADDRESS                   = '{{ address }}';
    const EMBED_RESULT_CAPACITY_BASIC_TITLE      = '{{ capacity_basic_title }}';
    const EMBED_RESULT_CAPACITY_BASIC_VALUE      = '{{ capacity_basic_value }}';
    const EMBED_RESULT_CAPACITY_ADDITIONAL_TITLE = '{{ capacity_additional_title }}';
    const EMBED_RESULT_CAPACITY_ADDITIONAL_VALUE = '{{ capacity_additional_value }}';
    const EMBED_RESULT_PRICE                     = '{{ price }}';
    const EMBED_RESULT_CURRENCY                  = '{{ currency }}';
    const EMBED_RESULT_BOOK_TITLE                = '{{ book_title }}';
    const EMBED_RESULT_STAR_ON                   = '{{ star_on }}';
    const EMBED_RESULT_STAR_OFF                  = '{{ star_off }}';
    const EMBED_RESULT_FLOOR_SIZE                = '{{ floor_size }}';
    const EMBED_RESULT_DESCRIPTION               = '{{ description }}';
    const EMBED_RESULT_INTRO                     = '{{ intro_text }}';

}
