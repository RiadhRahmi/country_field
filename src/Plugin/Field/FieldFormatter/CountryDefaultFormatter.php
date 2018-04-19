<?php


namespace Drupal\country_field\Plugin\Field\FieldFormatter;

use Drupal\Core\Annotation\Translation;
use Drupal\Core\Field\Annotation\FieldFormatter;
use Drupal\Core\Field\FieldItemListInterface;
use Drupal\Core\Field\FormatterBase;

/**
 * Plugin implementation of the 'country_field' formatter.
 *
 * @FieldFormatter(
 *   id = "country_default_formatter",
 *   module = "country_field",
 *   label = @Translation("Country "),
 *   field_types = {
 *     "country_field"
 *   }
 * )
 */
class CountryDefaultFormatter extends FormatterBase {


    /**
     * Builds a renderable array for a field value.
     *
     * @param \Drupal\Core\Field\FieldItemListInterface $items
     *   The field values to be rendered.
     * @param string $langcode
     *   The language that should be used to render the field.
     *
     * @return array
     *   A renderable array for $items, as an array of child elements keyed by
     *   consecutive numeric indexes starting from 0.
     */
    public function viewElements(FieldItemListInterface $items, $langcode)
    {
        $elements = array();
        $countries = \Drupal::service('country_manager')->getList();
        foreach ($items as $delta => $item) {
            if (isset($countries[$item->country])) {
                $elements[$delta] = array(
                    '#theme' => 'country_field',
                    '#country' => $countries[$item->country],
                );
            }
        }
        return $elements;
    }
}