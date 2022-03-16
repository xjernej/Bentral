<?php

namespace Bentral\Wordpress;

use Bentral;
use Bentral\Token\TokenInterface;

class Token
{

    protected $pageReplacementMap = [
        TokenInterface::PROPERTY_PAGE_ID             => 'page_id',
        TokenInterface::PROPERTY_NAME                => 'name',
        TokenInterface::PROPERTY_ADDRESS             => 'address',
        TokenInterface::PROPERTY_CITY                => 'city',
        TokenInterface::PROPERTY_POSTCODE            => 'zip',
        TokenInterface::PROPERTY_COUNTRY             => 'country',
        TokenInterface::PROPERTY_IMAGES              => 'images',
        TokenInterface::PROPERTY_MAIN_IMAGE          => 'mainImage',
        TokenInterface::PROPERTY_CAPACITY_BASIC      => 'capacity_basic',
        TokenInterface::PROPERTY_CAPACITY_ADDITIONAL => 'capacity_additional',
        TokenInterface::PROPERTY_LATITUDE            => 'lat',
        TokenInterface::PROPERTY_LONGITUDE           => 'lon',
    ];

    protected $imageReplacementMap = [
        TokenInterface::PROPERTY_IMAGE_URL       => 'url',
        TokenInterface::PROPERTY_IMAGE_URL_THUMB => 'thumbUrl',
    ];

    public static function availablePageTokens()
    {
        return [
            TokenInterface::PROPERTY_PAGE_ID             => __('Page ID', 'bentral'),
            TokenInterface::PROPERTY_NAME                => __('Property name', 'bentral'),
            TokenInterface::PROPERTY_ADDRESS             => __('Property address', 'bentral'),
            TokenInterface::PROPERTY_CITY                => __('Property city', 'bentral'),
            TokenInterface::PROPERTY_POSTCODE            => __('Property post code', 'bentral'),
            TokenInterface::PROPERTY_COUNTRY             => __('Property country', 'bentral'),
            TokenInterface::PROPERTY_MAIN_IMAGE          => __('Property main image', 'bentral'),
            TokenInterface::PROPERTY_IMAGES              => __('Property images', 'bentral'),
            TokenInterface::PROPERTY_CAPACITY_BASIC      => __('Basic capacity', 'bentral'),
            TokenInterface::PROPERTY_CAPACITY_ADDITIONAL => __('Additional capacity', 'bentral'),
            TokenInterface::PROPERTY_SERVICES            => __('Property services', 'bentral'),
            TokenInterface::PROPERTY_LONGITUDE           => __('Property longitude', 'bentral'),
            TokenInterface::PROPERTY_LATITUDE            => __('Property latitude', 'bentral'),
            TokenInterface::EMBED_PRICELIST              => __('Embed price list', 'bentral'),
            TokenInterface::EMBED_CALENDAR               => __('Embed calendar', 'bentral'),
            TokenInterface::EMBED_BOOKING                => __('Embed booking', 'bentral'),
            TokenInterface::EMBED_PRICELIST_BASE64       => __('Embed price list (base 64 encoded)', 'bentral'),
            TokenInterface::EMBED_CALENDAR_BASE64        => __('Embed calendar (base 64 encoded)', 'bentral'),
            TokenInterface::EMBED_BOOKING_BASE64         => __('Embed booking (base 64 encoded)', 'bentral'),
            TokenInterface::EMBED_RESULT_STAR_ON         => __('Star - On', 'bentral'),
            TokenInterface::EMBED_RESULT_STAR_OFF        => __('Star - Off', 'bentral')
        ];
    }

    public static function availableImageTokens()
    {
        return [
            TokenInterface::PROPERTY_IMAGE_URL       => __('Image URL', 'bentral'),
            TokenInterface::PROPERTY_IMAGE_URL_THUMB => __('Image thumbnail URL', 'bentral'),
        ];
    }


    public static function availableResultTokens()
    {
        return [
            TokenInterface::EMBED_RESULT_LINK                      => __('Property URL', 'bentral'),
            TokenInterface::EMBED_RESULT_IMAGE_URL                 => __('Property image URL', 'bentral'),
            TokenInterface::EMBED_RESULT_TITLE                     => __('Unit title', 'bentral'),
            TokenInterface::EMBED_RESULT_PROPERTY_TITLE            => __('Property title', 'bentral'),
            TokenInterface::EMBED_RESULT_ADDRESS                   => __('Property address', 'bentral'),
            TokenInterface::EMBED_RESULT_FLOOR_SIZE                => __('Property size (m<sup>2</sup>)', 'bentral'),
            TokenInterface::EMBED_RESULT_INTRO                     => __('Property intro text', 'bentral'),
            TokenInterface::EMBED_RESULT_DESCRIPTION               => __('Property description', 'bentral'),
            TokenInterface::EMBED_RESULT_CAPACITY_BASIC_TITLE      => __('Property capacity title', 'bentral'),
            TokenInterface::EMBED_RESULT_CAPACITY_BASIC_VALUE      => __('Property capacity', 'bentral'),
            TokenInterface::EMBED_RESULT_CAPACITY_ADDITIONAL_TITLE => __('Property capacity additional title', 'bentral'),
            TokenInterface::EMBED_RESULT_CAPACITY_ADDITIONAL_VALUE => __('Property capacity additional', 'bentral'),
            TokenInterface::EMBED_RESULT_PRICE                     => __('Property price', 'bentral'),
            TokenInterface::EMBED_RESULT_CURRENCY                  => __('Property currency ', 'bentral'),
            TokenInterface::EMBED_RESULT_BOOK_TITLE                => __('Property book button title', 'bentral'),
        ];
    }

    public static function availableResultTokensCard()
    {
        return [
            TokenInterface::EMBED_RESULT_LINK                      => __('Property URL', 'bentral'),
            TokenInterface::EMBED_RESULT_IMAGE_URL                 => __('Property image URL', 'bentral'),
            TokenInterface::EMBED_RESULT_TITLE                     => __('Unit title', 'bentral'),
            TokenInterface::EMBED_RESULT_PROPERTY_TITLE            => __('Property title', 'bentral'),
            TokenInterface::EMBED_RESULT_ADDRESS                   => __('Property address', 'bentral'),
            TokenInterface::EMBED_RESULT_FLOOR_SIZE                => __('Property size (m<sup>2</sup>)', 'bentral'),
            TokenInterface::EMBED_RESULT_INTRO                     => __('Property intro text', 'bentral'),
            TokenInterface::EMBED_RESULT_DESCRIPTION               => __('Property description', 'bentral'),
            TokenInterface::EMBED_RESULT_CAPACITY_BASIC_TITLE      => __('Property capacity title', 'bentral'),
            TokenInterface::EMBED_RESULT_CAPACITY_BASIC_VALUE      => __('Property capacity', 'bentral'),
            TokenInterface::EMBED_RESULT_CAPACITY_ADDITIONAL_TITLE => __('Property capacity additional title', 'bentral'),
            TokenInterface::EMBED_RESULT_CAPACITY_ADDITIONAL_VALUE => __('Property capacity additional', 'bentral'),
            TokenInterface::EMBED_RESULT_BOOK_TITLE                => __('Property book button title', 'bentral'),
        ];
    }

    public static function availableServiceTokensCard()
    {
        return [
            TokenInterface::EMBED_RESULT_LINK                      => __('Property URL', 'bentral'),
            TokenInterface::EMBED_RESULT_IMAGE_URL                 => __('Property image URL', 'bentral'),
            TokenInterface::EMBED_RESULT_TITLE                     => __('Unit title', 'bentral'),
            TokenInterface::EMBED_RESULT_PROPERTY_TITLE            => __('Property title', 'bentral'),
            TokenInterface::EMBED_RESULT_ADDRESS                   => __('Property address', 'bentral'),
            TokenInterface::EMBED_RESULT_FLOOR_SIZE                => __('Property size (m<sup>2</sup>)', 'bentral'),
            TokenInterface::EMBED_RESULT_INTRO                     => __('Property intro text', 'bentral'),
            TokenInterface::EMBED_RESULT_DESCRIPTION               => __('Property description', 'bentral'),
            TokenInterface::EMBED_RESULT_CAPACITY_BASIC_TITLE      => __('Property capacity title', 'bentral'),
            TokenInterface::EMBED_RESULT_CAPACITY_BASIC_VALUE      => __('Property capacity', 'bentral'),
            TokenInterface::EMBED_RESULT_CAPACITY_ADDITIONAL_TITLE => __('Property capacity additional title', 'bentral'),
            TokenInterface::EMBED_RESULT_CAPACITY_ADDITIONAL_VALUE => __('Property capacity additional', 'bentral'),
            TokenInterface::EMBED_RESULT_BOOK_TITLE                => __('Property book button title', 'bentral'),
        ];
    }

    public function replacePageTokens($post_id, $propertyId, $unitId, $text, $data)
    {
        $replacedString = $text;
        $replacedString = str_replace(TokenInterface::PROPERTY_PAGE_ID, $post_id, $replacedString);

        foreach ($this->pageReplacementMap as $token => $dataKey) {
            if (!empty($data[$dataKey])) {
                $replacedString = str_replace($token, $data[$dataKey], $replacedString);
            }
        }

        $key            = get_option('bentral_embed_key');
        $lang           = strtolower(explode('_', get_locale())[0]);

        $replacedString = str_replace(TokenInterface::PROPERTY_PAGE_ID, $data['post_id'], $replacedString);
        $replacedString = str_replace(TokenInterface::PROPERTY_NAME, $data['name'], $replacedString);
        $replacedString = str_replace(TokenInterface::PROPERTY_ADDRESS, $data['address'], $replacedString);
        $replacedString = str_replace(TokenInterface::PROPERTY_CITY, $data['city'], $replacedString);
        $replacedString = str_replace(TokenInterface::PROPERTY_POSTCODE, $data['postcode'], $replacedString);
        $replacedString = str_replace(TokenInterface::PROPERTY_CAPACITY_BASIC, $data['capacity_basic'], $replacedString);
        $replacedString = str_replace(TokenInterface::PROPERTY_CAPACITY_ADDITIONAL, $data['capacity_additional'], $replacedString);
        $replacedString = str_replace(TokenInterface::PROPERTY_LONGITUDE, $data['lon'], $replacedString);
        $replacedString = str_replace(TokenInterface::PROPERTY_LATITUDE, $data['lat'], $replacedString);
        $replacedString = str_replace(TokenInterface::PROPERTY_LATITUDE, $data['lat'], $replacedString);
        $replacedString = str_replace(TokenInterface::EMBED_PRICELIST, '[bentral-widget type="price"]', $replacedString);
        $replacedString = str_replace(TokenInterface::EMBED_CALENDAR, '[bentral-widget type="calendar"]', $replacedString);
        $replacedString = str_replace(TokenInterface::EMBED_BOOKING, '[bentral-widget type="reservation"]', $replacedString);
        $replacedString = str_replace(TokenInterface::EMBED_PRICELIST_BASE64, base64_encode('[bentral-widget type="price"]'), $replacedString);
        $replacedString = str_replace(TokenInterface::EMBED_CALENDAR_BASE64, base64_encode('[bentral-widget type="price"]'), $replacedString);
        $replacedString = str_replace(TokenInterface::EMBED_BOOKING_BASE64, base64_encode('[bentral-widget type="reservation"]'), $replacedString);

        return str_replace(
            TokenInterface::PROPERTY_SERVICES,
            ob_get_clean(),
            $replacedString
        );
    }

    public function replaceImageTokens($text, $images)
    {
        $replacedString = $text;
        foreach ($this->imageReplacementMap as $token => $dataKey) {
            $replacedString = str_replace($token, $images[$dataKey], $replacedString);
        }

        return $replacedString;
    }
}