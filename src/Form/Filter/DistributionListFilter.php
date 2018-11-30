<?php
namespace ZfMetal\EmailCampaigns\Form\Filter;

use Zend\InputFilter\InputFilter;
use ZfMetal\Commons\Filter\RenameUpload;

class DistributionListFilter extends InputFilter{

    public function __construct($em, $id = ''){

      $this->add(array(
          'name' => 'nameList',
          'required' => true,
          'validators' => array(
              array(
                  'name' => \ZfMetal\EmailCampaigns\Validator\NameListValidator::class,
                  'options' => [
                      'em' => $em,
                      'exclude' => $id
                  ]
              )
          ),
      ));

        $this->add(array(
            'name' => 'originEmail',
            'required' => true,

        ));

        $this->add(array(
            'name' => 'originName',
            'required' => true,

        ));

      $this->add(array(
          'name' => 'distributionList',
          'required' => false,
          'filters' => array(
              array('name' => RenameUpload::class,
                  "options" =>
                      [
                      "target" => 'uploads',
                      //"randomize" => true,
                      "use_upload_extension" => true,
                      "use_upload_name" => true,
                      "overwrite" => true
                  ]
              ),
          ),
          'validators' => array(
              array(
                  'name' => 'FileSize',
                  'options' => array(
                      'max' => "2MB",
                  ),
              ),
              array(
                  'name' => 'FileMimeType',
                  'options' => array(
                      'text/csv'
                  ),
              ),
          ),
      ));
    }
}
