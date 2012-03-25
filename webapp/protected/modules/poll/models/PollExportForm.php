<?php

/**
 * PollExportForm class file.
 */
class PollExportForm extends CFormModel
{
  /**
   * @param string File format to write to.
   */
  public $format = NULL;
  /**
   * @param string Text field delimiter.
   */
  public $delimiter = '\t';
  /**
   * @param string The type of results to export.
   * Can be 'full' or 'summary'
   */
  public $resultType = 'summary';


  private $_fields = array();
  private $_poll = NULL;
  private $_choices = NULL;
  private $_votes = NULL;
  private $_totalVotes = NULL;


  /**
   * Constructor.
   * @param Poll $poll The poll model to export.
   * @param string $scenario Name of the scenario that this model is used in.
   */
  public function __construct($poll, $scenario = '')
  {
    if (get_class($poll) == 'Poll') {
      $this->_poll = $poll;    
      $this->_choices = $poll->choices;
      $this->_votes = $poll->votes;
      $this->_totalVotes = $poll->totalVotes;
    }
    else
      throw new CException('Invalid Poll object.');

    parent::__construct($scenario);
  } 


  /**
   * @return array Result export file format
   */
  public function getFormats()
  {
    return array(
      'delimited' => $this->t('Delimited Text'),
      'excel' => $this->t('Microsoft Excel'),
      'json' => $this->t('JSON'),
    );
  }


  /**
   * @return array Delimited Text Format delimiter options
   */
  public function getDelimiters()
  {
    return array(
      ','  => $this->t('Comma (,)'),
      '\t' => $this->t('Tab (\t)'),
      ';'  => $this->t('Semicolon (;)'),
      ':'  => $this->t('Colon (:)'),
      '|'  => $this->t('Pipe (|)'),
      '.'  => $this->t('Period (.)'),
      ' '  => $this->t('Space ( )'),
    );
  }


  /**
   * @return array Type of data to export
   */
  public function getResultTypes()
  {
    return array(
      'summary' => $this->t('Summary'),
      'full' => $this->t('All Votes'),
    );
  }


  /**
   * Declares the validation rules.
   */
  public function rules()
  {
    return array(
      array('format, resultType', 'required'),
      array('delimiter', 'safe'),
    );
  }


  /**
   * Returns the form as a CForm instance.
   */
  public function cform()
  {
    $config = array(
      'attributes' => array(),
      'buttons' => array(),
      'elements' => array(),
    );

    // Setup buttons
    $config['buttons'] = array(
      'submit' => array(
        'type' => 'submit',
        'label' => 'Export',
      ),
    );

    // Setup elements
    $elements = array();

    $elements['format'] = array(
      'type' => 'dropdownlist',
      'items' => $this->getFormats(),
    );

    $elements['delimiter'] = array(
      'type' => 'dropdownlist',
      'items' => $this->getDelimiters(),
    );

    $elements['resultType'] = array(
      'type' => 'dropdownlist',
      'items' => $this->getResultTypes(),
    );

    $config['elements'] = $elements;

    return new CForm($config, $this);
  }


  /**
   * Export the results to the selected format.
   */
  public function export()
  {
    // Convert tab character
    if ($this->delimiter == '\t') $this->delimiter = "\t";

    // Setup the content type and extension
    switch ($this->format) {
      case 'json':
        $content_type = 'application/json';
        $extension = 'json';
        break;
      case 'excel':
        $this->delimiter = "\t";
        $content_type = 'application/x-msexcel';
        $extension = 'xls';
        break;
      case 'delimited':
      default:
        $content_type = $this->delimiter == "\t" ? 'text/tab-separated-values' : 'text/csv';
        $extension = $this->delimiter == "\t" ? 'tsv' : 'csv';
    }

    // Setup filename
    $filename = $this->toAscii($this->_poll->title) .'_'. date('Y.m.d-H.i.s') .'.'. $extension;

    // Setup the content rows to export
    $rows = array();
    switch ($this->resultType) {
      // Export all of the votes
      case 'full':
        $this->_fields = array(
          'poll_id' => $this->t('Poll ID'),
          'poll_title' => $this->t('Poll Title'),
          'choice_id' => $this->t('Choice ID'),
          'choice_label' => $this->t('Choice Label'),
          'vote_id' => $this->t('Vote ID'),
          'vote_user_id' => $this->t('User ID'),
          'vote_ip_address' => $this->t('IP Address'),
          'vote_timestamp' => $this->t('Date'),
        );

        $row = array();
        for ($i = 0; $i < sizeof($this->_votes); $i++) {
          foreach ($this->_fields as $id => $title) {
            $value = NULL;
            $object = NULL;
            $type = substr($id, 0, strpos($id, '_'));
            $key = substr($id, strpos($id, '_')+1);

            // Select the object we're pulling data from
            switch ($type) {
              case 'poll': $object = $this->_poll; break;
              case 'vote': $object = $this->_votes[$i]; break;
              case 'choice': 
                for ($j = 0; $j < sizeof($this->_choices); $j++) {
                  if ($this->_choices[$j]->id == $this->_votes[$i]->choice_id) {
                    $object = $this->_choices[$j];
                    break;
                  }
                }
                break;
            }

            if (isset($object->{$key})) {
              // Convert UNIX time to human-readable format
              $value = $key == 'timestamp' ? date('Y-m-d H:i:s', $object->{$key}) : $object->{$key};
            }

            // Add quotes for Text Delimited formats
            $row[$title] = $this->format == 'json' ? $value : '"'. str_replace('"', '""', $value) .'"';
          }
          $rows[] = $row;
        }

        break;
      // Summarize the poll results
      case 'summary':
      default:
        $this->_fields = array(
          $this->t('Choice'),
          $this->t('Votes'),
          $this->t('Percentage'),
        );
        if (!empty($this->_choices)) {
          foreach ($this->_choices as $choice) {
            $rows[] = array(
              // Add quotes for Text Delimited formats
              $this->t('Choice') => $this->format == 'json' ? $choice->label : '"'. $choice->label .'"',
              $this->t('Votes') => $choice->votes,
              $this->t('Percentage') => $this->_totalVotes > 0 ? 100 * round($choice->votes / $this->_totalVotes, 3) : 0,
            );
          }
        }
    }

    // Write the file
    $fh = tmpfile();

    if ($this->format == 'json') {
      fwrite($fh, json_encode($rows));
    }
    else {
      // Write the header row
      $header = '"'. implode('"'. $this->delimiter .'"', $this->_fields) .'"';
      fwrite($fh, $header ."\n");

      // Write the content rows
      for ($i = 0; $i < sizeof($rows); $i++) {
        fwrite($fh, implode($this->delimiter, $rows[$i]) ."\n");
      }
    }

    // Send the file to the browser
    header('Content-Type: application/force-download');
    header('Content-Type: '. $content_type);
    header('Content-Disposition: attachment; filename='. $filename);
    header('Cache-Control: max-age=0');
    header('Pragma: public');
    ob_clean();
    flush();
    $fstat = fstat($fh);
    fseek($fh, 0);
    echo fread($fh, $fstat['size']);
    fclose($fh);
    exit();
  }


  /**
   * Converts strings to ASCII characters.
   * See: http://cubiq.org/the-perfect-php-clean-url-generator
   * @param string $str The string to santize.
   * @param array $replace An array of additional characters to replace.
   * @param string $delimiter The string to replace offending characters with.
   * @return string Sanitized string.
   */
  public function toAscii($str, $replace = array(), $delimiter = '-')
  {
    if (!empty($replace)) {
      $str = str_replace((array)$replace, ' ', $str);
    }

    $clean = iconv('UTF-8', 'ASCII//TRANSLIT', $str);
    $clean = preg_replace("/[^a-zA-Z0-9\/_|+ -]/", '', $clean);
    $clean = strtolower(trim($clean, '-'));
    $clean = preg_replace("/[_|+ -]+/", $delimiter, $clean);

    return $clean;
  }

  
  /**
   * Shortcut to Yii::t()
   */
  function t($message, $category = 'Poll.export', $params = array(), $source = NULL, $language = NULL) 
  {
    return Yii::t($category, $message, $params, $source, $language);
  }

}
